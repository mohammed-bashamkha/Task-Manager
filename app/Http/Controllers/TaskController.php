<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::with('categories')->paginate(10);

        return response()->json($tasks, 200);
    }
    public function store(StoreTaskRequest $request) {
        $this->authorize('create', Task::class);
        $user = Auth::user();
        $user_id = $user->id;

        $validateData = $request->validated();
        $validateData['user_id'] = $user_id;
        $validateData['assigned_to'] = $user_id;
        $task = Task::create($validateData);

        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, $id) {
        $task = Task::findOrFail($id);
        $this->authorize('update', $task);
        $task->update($request->validated());

        return response()->json($task, 200);
    }

    public function show($id) {
        $task = Task::findOrFail($id);

        $this->authorize('view', $task);
        return response()->json($task, 200);
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json("Task With ID ($id) Deleted Seccssfuly", 200);
    }
    ////
    public function getTaskForUser($id) {
        $task = Task::findOrFail($id); // to get tasks fot user
        $this->authorize('view', $task);
        return response()->json($task, 200);
     }

     public function AddCategoriesToTasks(Request $request,$taskId) {
        $task = Task::findOrFail($taskId);
        $this->authorize('addTaskToCategory', $task);
        $task->categories()->attach($request->category_id);
        return response()->json('Category Attached successfully', 200,);
     }

     public function getTaskCategories($taskId) {
        $categories = Auth::user()->categories;
        $categories= Task::findOrFail($taskId)->categories; // to get task categories
        return response()->json($categories, 200);
     }

     public function getCategoriesTask($category_id) {
        $tasks= Category::findOrFail($category_id)->tasks; // to get categories task
        return response()->json($tasks, 200);
     }


     public function getAllTasks() {
        $task = Task::all();
        return response()->json($task, 200);
    }

    public function getTaskBypriority() {
        $task = Auth::user()->tasks()->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")->get();
        return response()->json($task, 200);
    }


    public function addToFavorite($taskId) {
        Task::findOrFail($taskId);
        Auth::user()->favoriteTask()->syncWithoutDetaching($taskId);
        return response()->json(['message' => 'Added To Favorites Seccussfully'], 200,);
    }
    public function removeFromFavorite($taskId) {
        Task::findOrFail($taskId);
        Auth::user()->favoriteTask()->detach($taskId);
        return response()->json(['message' => 'Removed From Favorites Seccussfully'], 200,);
    }
    public function getFavoriteTask() {
        $task = Auth::user()->favoriteTask;
        return response()->json($task, 200);
    }
}
