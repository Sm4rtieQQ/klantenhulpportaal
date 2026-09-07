<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);
    }

    public function update(CategoryRequest $request, int $categoryId)
    {
        $category = Category::find($categoryId);

        $newData = [
            'name' =>  $request->name,
        ];

        $category->update($newData);
    }

    public function destroy(Category $category)
    {
        if ($category->tickets()->count() > 0) {
            return response()->json(['message' => 'Kan "' . $category->name . '" niet verwijderen, er zijn nog tickets aan verbonden.'], 409);
        }

        $category->delete();
        return response()->json(['message' => $category->name . ' succesvol verwijderd.']);
    }
}
