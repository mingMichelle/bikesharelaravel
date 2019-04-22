<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NearCriteria.
 *
 * @package namespace App\Criteria;
 */
class NearCriteria implements CriteriaInterface
{
    // 经度
    protected $lng;
    // 纬度
    protected $lat;
    // 距离
    protected $distance;

    //最小经度
    protected $lngMin;
    //最大经度
    protected $lngMax;
    //最小纬度
    protected $latMin;
    //最大纬度
    protected $latMax;

    /**
     * 因为地球的平均周长为40000km
     * 周长除以360，得到每一度的距离
     */
    const DISTANCE_PRE_DEGREE = 111111.11;

    /**
     * NearCriteria constructor.
     * @param $lng
     * @param $lat
     * @param $distance
     */
    public function __construct($lng, $lat, $distance)
    {
        $this->lng = $lng;
        $this->lat = $lat;
        $this->distance = $distance;

        // 度数差
        $degree = $distance / self::DISTANCE_PRE_DEGREE;

        $this->lngMin = $lng - $degree;
        $this->lngMax = $lng + $degree;
        $this->latMin = $lat - $degree;
        $this->latMax = $lat + $degree;
    }

    /**
     * 获取当前坐标点的距离计算Sql语句
     * @return string
     */
    public function getDistanceSqlString() {
        return 'getDistance(' . $this->lat . ',' . $this->lng . ',lat,lng)';
    }


    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
            ->where('lng', '>', $this->lngMin)
            ->where('lng', '<', $this->lngMax)
            ->where('lat', '>', $this->latMin)
            ->where('lat', '<', $this->latMax);
        return $model;
    }
}
