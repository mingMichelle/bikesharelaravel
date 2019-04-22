<?php

namespace App\Repositories;

use App\Models\Bike;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BikeRepository.
 *
 * @package namespace App\Repositories;
 */
interface BikeRepository extends BaseRepositoryInterface
{
    /**
     * 根据经纬度坐标和距离获取单车列表
     * @param $lng
     * @param $lat
     * @param $distance
     * @return mixed
     */
    public function getNearBikes($lng, $lat, $distance);

    /**
     * 根据用户位置在附近生成一辆单车
     * 模拟
     * @param $lng
     * @param $lat
     * @return mixed
     */
    public function generateBikeByGeo($lng, $lat);

    /**根据Bike生成二维码图片，并且保存在服务器上，供客户端调用
     * @param Bike $bike
     * @return mixed
     */
    public function generateBikeQrCodeToDisk(Bike $bike);

    /**
     * 开锁
     * @param $userId
     * @param $bikeId
     * @return mixed
     */
    public function unLockBike($userId, $bikeId);

    /**
     * 硬件服务器解锁单车
     * @param $bikeId
     * @return mixed
     */
    public function notifyHardControlServerUnlockBike($bikeId);

    /**
     * 单车上锁
     * @param $bikeId
     * @return mixed
     */
    public function lockBike($bikeId);

    /**
     * 模拟硬件控制服务器执行上锁
     * @param $bikeId
     * @return mixed
     */
    public function notifyHardControlServerLockBike($bikeId);
}
