<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Repo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'url',
      'bitbucket',
      'account',
      'directory',
      'remote',
      'branch',
      'auto_deploy',
      'comments',
      'post_deploy'
    ];

    public function logs()
    {
      return $this->hasMany('App\Models\Log')->orderBy('created_at','desc');
    }

}
