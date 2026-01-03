<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Expectation;

class TaskController extends Controller
{
    public function index() {
        try
        {
            $task = Auth::user()->tasks;
            return response()->json($task, 200);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Error fetching tasks',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(StoreTaskRequest $request) {
        $user_id = Auth::user()->id;
        $validateData = $request->validated();
        $validateData['user_id'] = $user_id;
        $task = Task::create($validateData);
        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, $id) {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id)
        {
            return response()->json(['message'=>"There is no Task  For Id : {$task->id}"], 200);
        }
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    public function show($id) {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id) {
            return response()->json([
                'message' => "The Task With ID ($id) Not Found"
            ], 200);
        }
        return response()->json($task, 200);
    }

    public function destroy($id) {
        try {
            $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
        if($task->user_id != $user_id) {
            return response()->json([
                'message' => "The Task With ID ($id) Not Allowed To Deleted"
            ], 200);
        }
        $task->delete();
        return response()->json("Task With ID ($id) Deleted Seccssfuly", 200);
        }
        catch( Exception $exception) {
            return response()->json([
                'message' => 'Task was Deleted or Not Found',
                'more' => "<-$exception->"
            ], 404);
        }
    }
    ////
    public function getTaskForUser($id) {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id); // to get tasks fot user
        if($task->user_id != $user_id) {
            return response()->json([
                'message' => "The Task With ID ($id) Not Allowed To Visit"
            ], 200);
        }
        return response()->json($task, 200);
     }

     public function AddCategoriesToTasks(Request $request,$taskId) {
        $user_id = Auth::user()->id;
        $task = Task::findOrFail($taskId);
        if($task->user_id != $user_id) {
            return response()->json([
                'message' => "The Task With ID ($taskId) Not Allowed To Added"
            ], 200);
        }
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
