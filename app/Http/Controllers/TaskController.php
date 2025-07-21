<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use PhpParser\Node\Stmt\TryCatch;

class TaskController extends Controller
{
    public function index()
    {
        $Tasks = Auth::user()->tasks;
        // $Tasks = $request->user()->tasks; -> This is A Valid Way Too
        return response()->json($Tasks, 200);
    }

    public function GetTasksOrdered(Request $request)
    {
        $order = $request->order;
        if ($request->order == 'true') {
            $Tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority, 'High', 'Medium', 'Low')")->get(); // There Is no error here just a red line from VS
            return response()->json($Tasks, 200);
        }
        if ($request->order == 'false') {
            $Tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority, 'Low', 'Medium', 'High')")->get(); // There Is no error here just a red line from VS
            return response()->json($Tasks, 200);
        }
    }

    public function GetAllTasks()
    {
        $Tasks = Task::all();
        return view('user',compact('Tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        $userid = Auth::user()->id;
        $FinalData = $request->validated(); 
        $FinalData['user_id'] = $userid;
        $data = Task::create($FinalData);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        return response()->json(Task::findorfail($id), 201);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $user_id = Auth::user()->id;
        $E_Data = Task::findorfail($id);
        if ($E_Data->user_id == $user_id) {
            $E_Data->update($request->validated());
            return response()->json($E_Data, 200);
        } else {
            return response()->json(['messege' => 'This Is Not Your Task'], 403);
        }
    }

    public function destroy($id)
    {
        try {
            $del = Task::findorfail($id);
            $del->delete();
            return response()->json(['Massege' => 'Item Deleted'], 200);
        } catch (Exception $th) {
            return response()->json(
                ['error' => 'Task Not Found', 'details' => $th->getMessage()],
                403
            );
        }
    }

    public function GetUser($id)
    {
        $user = Task::find($id)->user;
        return response()->json($user, 200);
    }

    public function GetUserProfile($id)
    {
        $user = Task::find($id)->user->profile;
        return response()->json($user, 200);
    }

    public function AddCategoryToTask(Request $request, $taskId)
    {
        $task = Task::findorfail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json('Done!', 200);
    }

    public function GetTaskCategory($id)
    {
        $category = Task::find($id)->categories;
        return response()->json($category, 200);
    }

    public function GetCategoryTasks($id)
    {
        $tasks = Category::find($id)->tasks;

        return response()->json($tasks, 200);
    }

    public function AddTaskToFavorite($id)
    {
        Auth::User()->FavoriteTasks()->syncWithoutDetaching($id);
        return response()->json(['Info' => 'The Task Added Succesfully'], 200);
    }
    public function DeleteFavoriteTask($id)
    {
        Auth::User()->FavoriteTasks()->detach($id);
        return response()->json(['Info' => 'The Task Removed Succesfully'], 200);
    }

    public function GetAllFavoriteTasks()
    {
        $Tasks = Auth::User()->FavoriteTasks()->first();
        return response()->json(['Info' => $Tasks], 200);
    }
}
