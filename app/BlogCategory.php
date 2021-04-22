<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_blog_category';
    protected $primaryKey = 'id_blog_category';

    public function blog(){
        return $this->hasMany('App\Blog', 'id_blog_category');
    }
}
