<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \App\Entities\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => (string)$model->name,
            'email' => (string)$model->email,
            'mobile' => (string)$model->mobile,
            'nickname' => (string)$model->nickname,
            'gender' => $this->convertGender($model),
            'money' => (int)$model->money,
            'is_deposit' => (bool)$model->is_deposit,
            'avatar' => (string)$this->convertAvatar($model),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
    /**
     * 转换头像
     * @param User $user
     * @return mixed|string
     */
    public function convertAvatar(User $user) {
        $cdnDomain = 'http://xxx.xxx.com/';  //模拟一下
        $avatar = $user->avatar;
        if ($avatar) {
            if (starts_with($avatar, 'http')) {
                return $avatar;
            } else {
                return $cdnDomain . $avatar;
            }
        } else {
            return asset('images/default_avatar.png');
        }
    }

    /**
     * 转换性别
     * @param User $user
     * @return string
     */
    private function convertGender(User $user) {
        if ($user->gender === 1) {
            return '男性';
        } elseif ($user->gender === 2) {
            return '女性';
        } else {
            return '未知';
        }
    }
}
