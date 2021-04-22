<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_menu';
    protected $primaryKey = 'id_menu';

    public function page(){
        return $this->belongsTo('App\Page', 'id_page', 'id_page');
    }

    public function submenu(){
        return $this->hasMany('App\Submenu', 'id_menu', 'id_menu');
    }
}
