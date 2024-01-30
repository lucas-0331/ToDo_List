<?php

namespace App\Http\Controllers;

use App\Http\Resources\TemporaryTaskResource;
use App\Models\TemporaryTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\TemporaryTaskRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class TemporaryTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = TemporaryTask::query()->inRandomOrder()->first();
        return Inertia::render('Task/TemporaryTask', [
            'unique_task' => new TemporaryTaskResource($task),
            'temporary_tasks' => TemporaryTaskResource::collection(auth()->user()->temporary_task()->paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TemporaryTask $temporaryTask)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            $jump_first_line = 0;
            $content = file_get_contents($file->getRealPath());
            $lines = explode("\r\n", $content);

            foreach ($lines as $line) {
                if ($jump_first_line === 1) {
                    $columns = preg_split('/[;|\r\n]/', $line, 0, PREG_SPLIT_NO_EMPTY);
                    if (isset($columns[0])) {
                        $title = $columns[0];
                    } else {
                        continue;
                    }
                    $description = $columns[1];
                    $date = $columns[2];
                    $status = $columns[3];
                    $status = !!preg_match('/sim/i', $status);
                    $task = new TemporaryTask();
                    $task->name = $title;
                    $task->description = $description;
                    $task->date = Carbon::hasFormat($date, 'd/m/Y') ? Carbon::createFromFormat('d/m/Y', $date) : Carbon::now();
                    $task->status = $status;
                    $task->user_id = auth()->user()->id;
                    $task->save();
                } else {
                    $jump_first_line++;
                    continue;
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemporaryTask $temporaryTask)
    {
        return Inertia::render('Task/EditTemporary', [
            'task' => $temporaryTask,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemporaryTask $temporaryTask)
    {
        $temporaryTask->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'image' => $request->input('image'),
        ]);

        return Redirect::route('temporary.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemporaryTask $temporaryTask)
    {
        //
    }

    public function import(Request $request, TemporaryTask $temporaryTask)
    {
        dd($request, $temporaryTask->get());
    }
}
