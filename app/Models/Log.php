<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'repo_id',
      'content',
      'madeBy',
      'user_id'
    ];

  public function repo()
  {
    return $this->belongsTo('App\Models\Repo');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function getContentAttribute()
  {
    if(isset($this->attributes['content']))
      return json_decode($this->attributes['content']);
  }

  public function setContentAttribute($val)
  {
    $this->attributes['content'] = json_encode($val);
  }

}
