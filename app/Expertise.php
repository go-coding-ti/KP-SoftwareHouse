<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expertise extends Model
{
    use SoftDeletes;
    protected $table = 'tb_expertise';
    protected $primaryKey = 'id_expertise';
}
