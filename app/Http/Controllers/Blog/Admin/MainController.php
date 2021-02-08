<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

class MainController extends AdminBaseController
{
    public function index()
    {
        MetaTag::setTags(['title' => 'Админ панель']);
        return view('blog.admin.main.index');
    }

}
