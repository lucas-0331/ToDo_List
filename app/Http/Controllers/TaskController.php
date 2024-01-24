<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Models\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $tasks = Task::query()->orderBy('date', 'asc')->paginate(10);
//        return view('task.home', compact('tasks'));
        return Inertia::render('Welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Task/Create', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        $request->validate([
//            'task_name' => 'required',
//            'task_description' => 'required',
//            'task_date' => 'required',
//            'task_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        $task = new Task();
//        $task->name = $request->input('task_name');
//        $task->description = $request->input('task_description');
//        $task->date = $request->input('task_date');
//        $task->status = false;
//
//        if ($request->hasFile('task_image')) {
//            $image = $request->file('task_image');
//            $path_image = $image->store('img', 'public');
//            $task->image = $path_image;
//        }
//        $task->save();
//
//        return redirect()->route('task.index')->with('success', 'Your new task has been added successfully');
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
//        $data['user_id'] = auth()->id();
//        dd($data);
//        $task = Task::create($data);
        $task = new Task();
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->status = false;
        $task->date = $data['date'];
        $task->user_id = auth()->id();
        $task->save();
//        dd($task);
        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $date = $task->date;
        $date_format = Carbon::parse($date)->format('d/m/Y');
        return view('task.details', compact('task', 'date_format'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, Task $task)
//    {
//        $request->validate([
//            'task_name' => 'required',
//            'task_description' => 'required',
//            'task_date' => 'required|date',
//            'task_image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//
//        $path_image = null;
//
//        if ($request->hasFile('task_image')) {
//            if ($task->image) {
//                Storage::delete($task->image);
//            }
//            $image = $request->file('task_image');
//            $path_image = $image->store('img', 'public');
//        } else {
//            $path_image = $task->image;
//        }
//
//        $task->update([
//            'name' => $request->input('task_name'),
//            'description' => $request->input('task_description'),
//            'date' => $request->input('task_date'),
//            'image' => $path_image,
//        ]);
//        return redirect()->route('task.edit', ['task' => $task->id])->with('success', 'Edited with success!');
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
//        dd($task);
        $task->delete();

        return Redirect::route('dashboard');
//        return response()->json(['success' => true]);

    }
//    public function destroy(Task $task)
//    {
//        $task->delete();
//        return redirect()->route('task.index')->with('success', 'Your task was successfully deleted');
//    }

    /**
     * Change resource status.
     */
    public function status(Task $task)
    {
        $status = !$task->status;
        $task->update([
            'status' => $status,
        ]);

        return response()->json(['success' => true]);
    }

    public function hello()
    {
        return Inertia::render('Task/Hello');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'tasks' => auth()->user()->tasks
        ]);
    }

    /**
     * Learn vue and pratice.
     */
    public function learn()
    {
        return Inertia::render('Task/Learn');
    }

    /**
     * Challange VueSchool
     */
    public function price()
    {
        return Inertia::render('Task/Price');
    }
}
