<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_blog';
    protected $primaryKey = 'id_blog';

    public function category(){
        return $this->belongsTo('App\BlogCategory', 'id_blog_category');
    }
}
