<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TemporaryTaskCreateRequest;
use App\Models\Task;
use App\Models\TemporaryTask;
use App\TestService;
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
     * Display a welcome page listing tasks or any other relevant information.
     *
     * @return \Inertia\Response
     *
     */
    public function index()
    {
        return Inertia::render('Welcome');
    }

    /**
     * Display the user dashboard with a listing of tasks.
     *
     * @return \Inertia\Response
     *
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'tasks' => auth()->user()->tasks,
        ]);
    }

    /**
     * Show the form for creating a new task.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     *
     */
    public function create(Request $request)
    {
        return Inertia::render('Task/Create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param \App\Http\Requests\TaskCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(TaskCreateRequest $request): RedirectResponse
    {
        dd($request);
        $data = $request->validated();
        $data['status'] = false;
        $data['user_id'] = auth()->id();
        Task::create($data);
        return Redirect::route('dashboard');
    }

    /**
     * Display the details of the specified task.
     *
     * @param \App\Models\Task $task
     * @return \Inertia\Response
     *
     */
    public function show(Task $task)
    {
        return Inertia::render('Task/Details', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the details of the specified task.
     *
     * @param \App\Models\Task $task
     * @return \Inertia\Response
     *
     */
    public function edit(Task $task)
    {
        return Inertia::render('Task/Edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the details of the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     *
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
     * Remove the specified task from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(Task $task)
    {
        dd($task);
        $task->delete();
        return Redirect::route('dashboard');
    }

    /**
     * Change the status of the specified task.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function status(Request $request, Task $task)
    {
        $task->update([
            'status' => !$request->input('status'),
        ]);
        return Redirect::route('dashboard');
    }
}
