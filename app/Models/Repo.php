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
      'directory',
      'remote',
      'branch',
      'auto_deploy',
      'comments'
    ];

}