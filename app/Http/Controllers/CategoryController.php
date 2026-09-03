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
        Gate::authorize('viewAny', Category::class);

        $categories = Category::get();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        Gate::authorize('viewAny', Category::class);

        Category::create([
            'name' => $request->name,
        ]);
    }
}
