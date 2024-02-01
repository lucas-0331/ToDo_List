<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\TemporaryTask;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Http\Resources\TemporaryTaskResource;
use App\Http\Requests\TemporaryTaskStoreRequest;


class TemporaryTaskController extends Controller
{
    /**
     * Display a listing with temporary task.
     *
     * @return \Inertia\Response
     *
     */
    public function index()
    {
        return Inertia::render('Task/TemporaryTask', [
            'temporary_tasks' => TemporaryTaskResource::collection(auth()->user()->temporary_task()->paginate(10)),
        ]);
    }
//    public function index()
//    {
//        $task = TemporaryTask::query()->inRandomOrder()->first();
//        return Inertia::render('Task/TemporaryTask', [
//            'unique_task' => new TemporaryTaskResource($task),
//            'temporary_tasks' => TemporaryTaskResource::collection(auth()->user()->temporary_task()->paginate(10)),
//        ]);
//    }

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
     * Store a newly created temporary task in storage.
     *
     * @param \App\Http\Requests\TemporaryTaskStoreRequest $request
     * @return
     */
    public function store(TemporaryTaskStoreRequest $request)
    {
        $header = $request->validated('header');
        $file = $request->file('file');

        if ($file){
            $file_name = time().'-'.$file->getClientOriginalName();
            $file_path = $file->storeAs('tmp', $file_name, 'local');
            $rows = SimpleExcelReader::create(Storage::path($file_path))->useDelimiter(';');

            if (!$header) $rows->noHeaderRow();

            $rows->useHeaders(['title', 'description', 'date', 'status'])->getRows()->each(function ($row){
                TemporaryTask::create([
                    'name' => $row['title'],
                    'description' => $row['description'],
                    'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $row['date']),
                    'status' => !!preg_match('/sim/i', $row['status']),
                    'user_id' => auth()->user()->id,
                ]);
            });
        }

        return Redirect::route('temporary.index')->with([
            'message' => 'Your file CSV imported with success!',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified temporary task from storage.
     *
     * @param \App\Models\TemporaryTask $temporaryTask
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(TemporaryTask $temporaryTask)
    {
        $temporaryTask->delete();
        return Redirect::route('temporary.index')->with([
            'message' => 'Your temporary task deleted with success!',
            'status' => 'success',
        ]);
    }

    public function import(Request $request, TemporaryTask $temporaryTask)
    {
        dd($request, $temporaryTask->get());
    }
}
