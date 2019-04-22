<?php

namespace App\Repositories;

use App\Criteria\HasFieldCriteria;
use App\Exceptions\NeedJsonException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 根据username自动判断查找用户
     * @param $username
     * @return mixed
     */
    public function findByUserName($username)
    {
        // 判断是不是email格式
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return $this->pushCriteria(new HasFieldCriteria('email', $username))->first();
        } elseif (is_numeric($username)) {
            return $this->pushCriteria(new HasFieldCriteria('mobile', $username))->first();
        } else {
            return $this->pushCriteria(new HasFieldCriteria('name', $username))->first();
        }

    }

    /**
     * 用户交纳押金
     * @param $userId
     * @param int $money
     * @return mixed
     */
    public function payDeposit($userId, $money = 299)
    {
        $user = $this->find($userId);

        if ($user->is_deposit) {
            throw new NeedJsonException(406, '该用户已经缴纳过押金了');
        } else {
            return $this->update([
                'is_deposit' => true,
                'deposit_money' => $money
            ], $userId);
        }
    }

    /**
     * 退回押金
     * @param $userId
     * @return mixed
     */
    public function backDeposit($userId)
    {
        //查验该用户有没有正在骑行单车
        $rider = app(RiderRepository::class)
            ->pushCriteria(new HasFieldCriteria('user_id', $userId))
            ->pushCriteria(new HasFieldCriteria('is_pay', false))
            ->first();

        if ($rider) {
            throw new NeedJsonException(406, '您正在骑行单车，请骑行完毕之后在执行操作');
        }

        $user = $this->find($userId);

        if ($user->is_deposit) {
            //如果已经缴纳则退回
            return $this->update([
                'is_deposit' => false
            ], $userId);
        } else {
            throw new NeedJsonException(406, '您还没有缴纳押金');
        }

    }

    /**
     * 充值
     * @param $userId
     * @param $money
     * @return mixed
     */
    public function payMoney($userId, $money)
    {
        $user = $this->find($userId);

        if ($user->is_deposit) {
            //计算充值之后的余额
            $inputMoney = $user->money + $money;
            return $this->update([
                'money' => $inputMoney
            ], $userId);
        } else {
            throw new NeedJsonException(406, '请先缴纳押金');
        }
    }

    /**
     * 修改手机号码
     * @param $userId
     * @param $mobile
     * @return mixed
     */
    public function changeMobile($userId, $mobile)
    {
        return $this->update(['mobile' => $mobile], $userId);
    }

    /**
     * 修改密码
     * @param $userId
     * @param $password
     * @return mixed
     */
    public function changePassword($userId, $password)
    {
        // TODO: 第三方验证
        return $this->update(['password' => \Hash::make($password)], $userId);
    }
}
