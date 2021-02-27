<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailExpertiseProject extends Model
{
    use SoftDeletes;
    protected $table = 'tb_detail_expertise';
    protected $primaryKey = 'id_expertise';
}
