<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'tb_product';
    protected $primaryKey = 'id_product';

    public function page(){
        return $this->belongsTo('App\Page', 'id_page', 'id_page');
    }
}
