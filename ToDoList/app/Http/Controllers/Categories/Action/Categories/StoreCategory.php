<?php

namespace App\Http\Controllers\Categories\Action\Categories;

use App\Models\Category;
use Illuminate\Http\Request;

class StoreCategory
{
    public function execute(Request $request) : Category
    {

        $parentCategory = Category::find($request->parent_id);

        $category = Category::create([
            'name' => $request->input('name')
        ]);

        if ($parentCategory) {
            $parentCategory->appendNode($category); // Add as a child node
        }

        return $category;
    }
}
