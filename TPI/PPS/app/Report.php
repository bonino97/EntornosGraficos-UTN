<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'state', 'grade', 'comments', 'file', 'user_id'
    ];

    //Falta la foreing key de id_user con el usuario
}
