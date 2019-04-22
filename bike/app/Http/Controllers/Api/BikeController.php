<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateBikeRequest;
use App\Http\Requests\GetNearBikesRequest;
use App\Http\Requests\LockBikeRequest;
use App\Http\Requests\UnlockBikeRequest;
use App\Repositories\BikeRepository;

class BikeController extends Controller {
    protected $bikeRepository;

    /**
     * BikeController constructor.
     * @param BikeRepository $bikeRepository
     */
    public function __construct(BikeRepository $bikeRepository)
    {
        $this->bikeRepository = $bikeRepository;
    }

    /**
     * 获取附近单车
     * @param GetNearBikesRequest $request
     * @return mixed
     */
    public function getNearBikes(GetNearBikesRequest $request) {
        return $this->bikeRepository->getNearBikes(
            $request->get('lng'),
            $request->get('lat'),
            $request->get('distance')
        );
    }

    /**
     * 生成一辆单车
     * @param GenerateBikeRequest $request
     * @return mixed
     */
    public function generateBikeByGeo(GenerateBikeRequest $request) {
        $lng = $request->get('lng');
        $lat = $request->get('lat');
        $bike = $this->bikeRepository->generateBikeByGeo($lng, $lat);
        return $bike;
    }

    /**
     * 根据Bike的Id来解锁单车
     * @param UnlockBikeRequest $request
     * @return mixed
     */
    public function unLockBike(UnlockBikeRequest $request) {
        $bikeId = $request->get('bike_id');
        return $this->bikeRepository->unLockBike(\Auth::id(), $bikeId);
    }

    /**
     * 根据BikeId来执行上锁结算,并且返回结算后的骑行记录信息
     * @param LockBikeRequest $request
     * @return mixed
     */
    public function lockBike(LockBikeRequest $request)
    {
        $bikeId = $request->get('bike_id');
        return $this->bikeRepository->lockBike($bikeId);
    }
}
