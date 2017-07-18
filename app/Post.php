<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $fillable = [
        'content',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment()
    {
        if(is_admin()) {
            return $this->hasMany('App\Comment')->withTrashed();
        } else {
            return $this->hasMany('App\Comment');
        }
    }
}
