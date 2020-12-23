<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'branch', 'education_id', 'abbr', 'created_at', 'display_order', 'status'
    ];

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['branch_id'];

    protected $dates = ['deleted_at'];
}