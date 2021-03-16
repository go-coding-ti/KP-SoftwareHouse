<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTrial extends Model
{
    use SoftDeletes;

    protected $table = 'tb_project_trial';
    protected $primaryKey = 'id_project_trial';

    public function project(){
        return $this->belongsTo('App\Project', 'id_project');
    }
}
