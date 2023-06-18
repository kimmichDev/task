<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskAssignMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::when(request()->has('filter_status') && request('filter_status') != 'all', fn ($query) => $query->whereStatus(request('filter_status')))
            ->with("user")
            ->latest("id")
            ->paginate()
            ->withQueryString();
        $users = User::all(['id', 'name']);
        return view("admin.task.index", ["tasks" => $tasks, "users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.task.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route("task.index")->with("info", "Created successfully !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("admin.task.edit", ["task" => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        if ($task->user) {
            Mail::to($task->user->email)->send(new TaskAssignMail('Your task is updated !'));
        }
        return redirect()->route("task.index")->with("info", "Updated successfully !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with("info", "Deleted successfully !");
    }

    public function assign(Request $request, Task $task)
    {
        $task->update(["user_id" => $request->user_id]);
        Mail::to(User::find($request->user_id)->email)->send(new TaskAssignMail("You are assigned a task"));
        return redirect()->back()->with("info", "Assigned successfully !");
    }
}
