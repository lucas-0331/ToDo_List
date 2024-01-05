<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class SiteController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->paginate(10);
        return view('task.home', compact('tasks'));
    }

    public function details($id)
    {
        $task = Task::query()->where('id', $id)->first();
        return view('task.details', compact('task'));
    }
}
