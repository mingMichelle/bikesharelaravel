<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Rider;

/**
 * Class RiderTransformer.
 *
 * @package namespace App\Transformers;
 */
class RiderTransformer extends TransformerAbstract
{
    /**
     * 可能包含的数据
     * @var array
     */
    protected $availableIncludes = [
        'bike',
        'user'
    ];

    /**
     * Transform the Rider entity.
     *
     * @param \App\Models\Rider $model
     *
     * @return array
     */
    public function transform(Rider $model)
    {
        return [
            'id'         => (int) $model->id,
            'start_at' => $model->start_at->format('Y-m-d H:i:s'),
            'end_at' => $model->end_at,
            'money' => $model->money,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * 获取Bike的关联数据并输出
     * @param Rider $rider
     * @return \League\Fractal\Resource\Item
     */
    public function includeBike(Rider $rider) {
        return $this->item($rider->bike, new BikeTransformer(), API_HIDDEN_KEY);
    }

    /**
     * 获取User关联数据
     * @param Rider $rider
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Rider $rider) {
        return $this->item($rider->user, new UserTransformer(), API_HIDDEN_KEY);
    }
}
