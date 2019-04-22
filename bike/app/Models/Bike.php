<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Bike.
 *
 * @package namespace App\Models;
 */
class Bike extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='bikes';

    protected $fillable = [
        'lng',
        'lat',
        'is_riding'
    ];

    public $casts=[
        'lng'=>'float',
        'lat'=>'float',
        'is_riding'=>'bool'
    ];

    public function riders(){
        return $this->hasMany(Rider::class,'bike_id');
    }

    public function users(){
        return $this->belongsToMany(
            User::class,
            'riders',
            'bike_id',
            'user_id')
            ->withTimestamps();
    }


}
