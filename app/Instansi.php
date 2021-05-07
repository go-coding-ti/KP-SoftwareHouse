<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instansi extends Model
{
    use SoftDeletes;

    protected $table = 'tb_instansi';
    protected $primaryKey = 'id_instansi';
}
