<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class State extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'country_id', 'state_name', 'abbr', 'created_at', 'status',
    ];

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['state_id'];
}