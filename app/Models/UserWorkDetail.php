<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorkDetail extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_work_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'photo', 'country_id', 'state_id', 'city_id', 'address', 'country_ip', 'state_ip', 'city_ip', 'adress_ip_org',
    ];
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
