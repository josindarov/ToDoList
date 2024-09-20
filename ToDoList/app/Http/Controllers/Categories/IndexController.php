<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Kalnoy\Nestedset\Collection;

class IndexController extends Controller
{
    public function __invoke(): Collection
    {
        return Category::get()->toTree();
    }
}
