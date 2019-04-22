<?php

namespace App\Repositories;

use App\Criteria\HasFieldCriteria;
use App\Criteria\NearCriteria;
use App\Exceptions\NeedJsonException;
use App\Models\Rider;
use App\Presenters\BikePresenter;
use App\Presenters\RiderPresenter;
use Carbon\Carbon;
use Location\Coordinate;
use Location\Distance\Vincenty;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BikeRepository;
use App\Models\Bike;
use App\Validators\BikeValidator;

/**
 * Class BikeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BikeRepositoryEloquent extends BaseRepositoryEloquent implements BikeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bike::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BikeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 根据经纬度坐标和距离获取单车列表
     * @param $lng
     * @param $lat
     * @param $distance
     * @return mixed
     */
    public function getNearBikes($lng, $lat, $distance)
    {
        $nearCriteria = new NearCriteria($lng, $lat, $distance);
        $result = $this->pushCriteria($nearCriteria)
            ->all(['*']);   //  all 所有的

        $result = $result->filter(function ($value, $key) use ($lng, $lat, $distance) {
            return $this->getDistance($lng, $lat, $value->lng, $value->lat) < $distance;
        });

        $result = $this->setPresenter(app(BikePresenter::class))
            ->parserResult($result);
        return $result;
    }

    /**
     * 计算距离
     * @param $lng1
     * @param $lat1
     * @param $lng2
     * @param $lat2
     * @return float
     */
    private function getDistance($lng1, $lat1, $lng2, $lat2) {
        // 官方文档上拷下来的
        $coordinate1 = new Coordinate($lat1, $lng1);    //  Mauna Kea Summit
        $coordinate2 = new Coordinate($lat2, $lng2);

        $calculator = new Vincenty();

        $distance = $calculator->getDistance($coordinate1, $coordinate2);
        return $distance;
    }

    /**
     * 根据用户位置在附近生成一辆单车
     * 模拟
     *
     *  0.00009 : 10 米的距离所对应的角度
     *  10 / 111000 = 0.00009
     *
     * @param $lng
     * @param $lat
     * @return mixed
     */
    public function generateBikeByGeo($lng, $lat)
    {
        $sp = [1, -1];  //实现正负
        $newLng = $lng + (0.00009 * rand(1, 9)) * $sp[rand(0, 1)];
        $newLat = $lat + (0.00009 * rand(1, 9)) * $sp[rand(0, 1)];

        $bike = $this->create([
            'lng' => $newLng,
            'lat' => $newLat
        ]);
        // 将二维码图片保存到服务器
        $this->generateBikeQrCodeToDisk($bike);
        return $bike;
    }


    /**根据Bike生成二维码图片，并且保存在服务器上，供客户端调用
     * @param Bike $bike
     * @return mixed
     */
    public function generateBikeQrCodeToDisk(Bike $bike)
    {
        \QrCode::format('png')
            ->size(256)
            ->generate('bike:' . $bike->getKey(), base_path('public/qr/' . $bike->getKey() . '.png'));
    }

    /**
     * 开锁
     * @param $userId
     * @param $bikeId
     * @return mixed
     */
    public function unLockBike($userId, $bikeId)
    {
        //获取单车
        $bike = $this->find($bikeId);
        //获取用户
        $user = app(UserRepository::class)->find($userId);
        //获取当前用户正在骑行的记录
        $rider = app(RiderRepository::class)
            ->pushCriteria(new HasFieldCriteria('user_id', $userId))
            ->pushCriteria(new HasFieldCriteria('is_pay', false))
            ->first();

        //判断单车是否正在被骑行
        if ($bike->is_riding) {
            throw new NeedJsonException(406, '该单车正在被骑行');
        } elseif (!$user->is_deposit) {//判断用户是否已经缴纳押金
            throw new NeedJsonException(406, '您还没有缴纳押金');
        } elseif ($rider) {//判断用户是否有未结算的骑行记录
            throw new NeedJsonException(406, '不能同时解锁两辆车');
        } else {
            //开锁
            $unlock = $this->notifyHardControlServerUnlockBike($bikeId);
            if ($unlock) {
                \DB::beginTransaction();
                try {
                    //创建一个骑行记录
                    $riderRecord = app(RiderRepository::class)
                        ->setPresenter(app(RiderPresenter::class))
                        ->create([
                            'user_id' => $userId,
                            'bike_id' => $bikeId,
                            'start_at' => Carbon::now()
                        ]);
                    //变更单车的状态
                    $this->update(['is_riding' => true], $bikeId);
                    //提交
                    \DB::commit();
                    //返回一个骑行记录
                    return $riderRecord;

                } catch (\Exception $exception) {
                    //回滚
                    \DB::rollBack();
                    throw new NeedJsonException(406, '内部错误');
                }
            } else {
                throw new NeedJsonException(500, '硬件服务器错误');
            }
        }
    }

    /**
     * 硬件服务器解锁单车
     * @param $bikeId
     * @return mixed
     */
    public function notifyHardControlServerUnlockBike($bikeId)
    {
        sleep(5);
        return true;
    }

    /**
     * 单车上锁
     * @param $bikeId
     * @return mixed
     */
    public function lockBike($bikeId)
    {
        $hardLock = $this->notifyHardControlServerLockBike($bikeId);

        if ($hardLock !== true) {
            throw new NeedJsonException(500, '上锁失败');
        }

        //获取BikeId对应的未结算骑行记录
        $rider = app(RiderRepository::class)
            ->pushCriteria(new HasFieldCriteria('bike_id', $bikeId))
            ->pushCriteria(new HasFieldCriteria('is_pay', false))
            ->first();

        if ($rider) {
            //执行上锁之后的结算
            $user = app(UserRepository::class)->find($rider->user_id);
            $userMoney = (int)$user->money;

            $startTime = $rider->start_at;
            $endTime = Carbon::now();
            //获取当前时间和开始骑行时间的分钟差,进行向上取整
            $payMoney = ceil(($endTime->diffInMinutes($startTime)) / 30);

            //判断用户余额是否足够支付
            if ($userMoney < $payMoney) {
                throw new NeedJsonException(406, '您的余额不足');
            } else {
                //开启事务
                \DB::beginTransaction();
                try {
                    //更新骑行记录的信息
                    $newRider = app(RiderRepository::class)
                        ->setPresenter(app(RiderPresenter::class))
                        ->update([
                            'end_at' => $endTime,
                            'money' => $payMoney,
                            'is_pay' => true
                        ], $rider->getKey());

                    //计算用户钱包扣除费用之后的金额
                    $newMoney = $userMoney - $payMoney;

                    //更新用户的钱包余额
                    app(UserRepository::class)->update([
                        'money' => $newMoney
                    ], $user->getKey());

                    //更改单车的骑行状态
                    $this->update(['is_riding' => false], $bikeId);

                    //提交事务
                    \DB::commit();
                    return $newRider;

                } catch (\Exception $exception) {
                    \DB::rollBack();
                    throw new NeedJsonException(406, '内部错误');
                }
            }
        } else {
            throw new NeedJsonException(404, '骑行记录不存在');
        }
    }

    /**
     * 模拟硬件控制服务器执行上锁
     * @param $bikeId
     * @return mixed
     */
    public function notifyHardControlServerLockBike($bikeId)
    {
        sleep(3);
        return true;
    }
}
