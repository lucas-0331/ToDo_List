<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->orderBy('date', 'asc')->paginate(10);
        return view('task.home', compact('tasks'));
    }

    public function details($id)
    {
        $task = Task::query()->where('id', $id)->first();
        $date = $task->date;
        $date_format = Carbon::parse($date)->format('d/m/Y');
        return view('task.details', compact('task', 'date_format'));
    }

    public function id_user($id_user)
    {
        $tasks = Task::query()->where('id_user', $id_user)->get();
        return view('task.task_user', compact('tasks'));
    }

    public function edit($id)
    {
        $task = Task::query()->where('id', $id)->first();
        return view('task.edit', compact('task'));
    }

    public function edited(Request $request)
    {
        $request->validate([
            'task_id' => 'required',
            'task_name' => 'required',
            'task_description' => 'required',
            'task_date' => 'required',
            'task_image' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $task = Task::findOrFail($request->input('task_id'));

        $task->name = $request->input('task_name');
        $task->description = $request->input('task_description');
        $task->date = $request->input('task_date');

        if ($request->hasFile('task_image'))
        {
            if ($task->image)
            {
                Storage::delete($task->image);
            }
            $image = $request->file('task_image');
            $path_image = $image->store('img', 'public');
            $task->image = $path_image;
        }
        $task->save();
        return redirect()->route('edit', $task->id)->with('success', 'Edited with success!');
    }
}
