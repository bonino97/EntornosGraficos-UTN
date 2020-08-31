<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slogan', 'state', 'comments', 'file', 'user_id'
    ];

    /**
     * Get student of the report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
