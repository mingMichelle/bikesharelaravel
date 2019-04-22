<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Rider.
 *
 * @package namespace App\Models;
 */
class Rider extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='riders';

    protected $fillable = [
        'user_id',
        'bike_id',
        'start_at',
        'end_at',
        'money',
        'is_pay'
    ];

    protected $casts=[
        'is_pay'=>'bool'
    ];

    public $dates=[
        'start_at',
        'end_at'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function bike(){
        return $this->belongsTo(Bike::class,'bike_id');
    }


}
