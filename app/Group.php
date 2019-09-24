<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    public $timestamps = true;

    public function details() {
        return $this->hasMany('App\GroupDetail', 'groups_id');
    }
}
