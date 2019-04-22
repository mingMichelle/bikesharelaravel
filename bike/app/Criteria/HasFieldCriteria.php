<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class HasFieldCriteria.
 *  给model的查询提供一个where条件
 * @package namespace App\Criteria;
 */
class HasFieldCriteria implements CriteriaInterface
{
    protected $field;

    protected $value;

    /**
     * HasFieldCriteria constructor.
     * @param $field  数据表字段的填充
     * @param $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
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
        $model = $model->where($this->field, '=', $this->value);
        return $model;
    }
}
