<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        $category = Auth::user()->tasks;
        return response()->json($category, 200);
    }
    public function store(StoreCategoryRequest $reguest) {
        $user_id = Auth::user()->id;
        $validateData = $reguest->validated();
        $validateData['user_id'] = $user_id;
        $category = Category::create($validateData);
        return response()->json($category, 201);
    }
    public function update(UpdateCategoryRequest $request,$category_id) {
        $category = Category::findOrFail($category_id);
        $category->update($request->validated());
        return response()->json($category ,200);
    }
    public function show($category_id) {
        $category  = Category::findOrFail($category_id);
        return response()->json($category , 200);
    }
    public function destroy($category_id) {
        $task = Category::findOrFail($category_id);
        $task->delete();
        return response()->json("Task With ID ($category_id) Deleted Seccssfuly", 200);
    }
}
