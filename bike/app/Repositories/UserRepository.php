<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends BaseRepositoryInterface
{
    /**
     * 根据username自动判断查找用户
     * @param $username
     * @return mixed
     */
    public function findByUserName($username);

    /**
     * 用户交纳押金
     * @param $userId
     * @param int $money
     * @return mixed
     */
    public function payDeposit($userId, $money = 299);

    /**
     * 退回押金
     * @param $userId
     * @return mixed
     */
    public function backDeposit($userId);

    /**
     * 充值
     * @param $userId
     * @param $money
     * @return mixed
     */
    public function payMoney($userId, $money);

    /**
     * 修改手机号码
     * @param $userId
     * @param $mobile
     * @return mixed
     */
    public function changeMobile($userId, $mobile);

    /**
     * 修改密码
     * @param $userId
     * @param $password
     * @return mixed
     */
    public function changePassword($userId, $password);
}
