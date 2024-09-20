<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Action\Categories\StoreCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\JsonResponse;
use Modules\Task\app\Models\Task;

class StoreController extends Controller
{
    private StoreCategory $category;

    function __construct(StoreCategory $category)
    {
        $this->category = $category;
    }

    public function __invoke(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->category->execute($request);
        $category->save();
        return response()->json($category);
    }
}
