<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenu extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_submenu';
    protected $primaryKey = 'id_submenu';

    public function menu(){
        return $this->belongsTo('App\Menu', 'id_menu', 'id_menu');
    }

    public function page(){
        return $this->belongsTo('App\Page', 'id_page', 'id_page');
    }
}
