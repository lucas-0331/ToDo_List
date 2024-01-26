<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TemporaryTaskCreateRequest;
use App\Models\Task;
use App\Models\TemporaryTask;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Welcome');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'tasks' => auth()->user()->tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Task/Create', [
            'status' => session('status'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $task = new Task();
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->status = false;
        $task->date = $data['date'];
        $task->user_id = auth()->id();
        $task->save();
        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Inertia::render('Task/Details', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Task/Edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'image' => $request->input('image'),
        ]);
        return Redirect::route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return Redirect::route('dashboard');
    }

    /**
     * Change resource task status.
     */
    public function status(Request $request, Task $task)
    {
        $task->update([
            'status' => !$request->input('status'),
        ]);
        return Redirect::route('dashboard');
    }
}
