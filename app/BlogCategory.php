<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\BlogCategory;

class BlogCategory extends Model
{
    protected $table = 'tb_blog_category';
    protected $primaryKey = 'id_blog_category';
}
