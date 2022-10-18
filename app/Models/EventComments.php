<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class EventComments extends Model
{
    use HasFactory;

    protected $table = 'event_comments';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'event_id', 'parent_id', 'comment'];

     /**
     * Write Your Code..
     *
     * @return string
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function replies()
    {
        // return $this->hasMany(events_comments::class, 'parent_id');
        return $this->hasMany(Comment::class, 'parent_id');
    }


}
