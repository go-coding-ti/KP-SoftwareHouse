<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'tb_project';
    protected $primaryKey = 'id_project';

    public function expertise(){
        return $this->belongsToMany('App\Expertise', 'tb_detail_expertise', 'id_project', 'id_expertise')->withPivot('id_detail_expertise');
    }

    public function trial(){
        return $this->hasMany('App\ProjectTrial', 'id_project');
    }
}
