<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Bike;

/**
 * Class BikeTransformer.
 *
 * @package namespace App\Transformers;
 */
class BikeTransformer extends TransformerAbstract
{
    /**
     * Transform the Bike entity.
     *
     * @param \App\Models\Bike $model
     *
     * @return array
     */
    public function transform(Bike $model)
    {
        return [
            'id' => (int) $model->id,
            'lng' => (float)$model->lng,
            'lat' => (float)$model->lat,
            'is_riding' => (bool)$model->is_riding,
            'qr_code' => (string)$this->getQrUrl($model),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * 获取单车二维码的Url
     * @param Bike $bike
     * @return string
     */
    private function getQrUrl(Bike $bike) {
        return asset('/qr/' . $bike->getKey() . '.png');
    }
}
