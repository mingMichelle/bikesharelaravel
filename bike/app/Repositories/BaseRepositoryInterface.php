<?php
/**
 * Created by PhpStorm.
 * User: edu
 * Date: 2017/6/8
 * Time: 16:48
 */

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * 定义基本Repository接口
 * Interface BaseRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface extends RepositoryInterface, RepositoryCriteriaInterface {

}