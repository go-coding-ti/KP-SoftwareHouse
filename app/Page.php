<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_page';
    protected $primaryKey = 'id_page';
}
