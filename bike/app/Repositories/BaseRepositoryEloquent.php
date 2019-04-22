<?php
/**
 * Created by PhpStorm.
 * User: edu
 * Date: 2017/5/26
 * Time: 10:52
 */

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class BaseRepositoryEloquent extends BaseRepository{

    public function paginate($limit = null, $columns = ['*'], $method = "paginate"){
        $pageSize = request('page_size',$limit);
        return parent::paginate($pageSize, $columns, $method);
    }
}