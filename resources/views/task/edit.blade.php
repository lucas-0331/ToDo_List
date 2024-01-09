@extends('task.layout')

@section('title', 'Edit')

@section('button-nav-right')
    <a href="#" class="flex items-center" onclick="submit_form()">
        <span class="material-symbols-outlined">
            save
        </span>
        <span class="ms-2">
            Salvar
        </span>
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-12 p-5 gap-4 h-screen bg-white dark:text-white border-b dark:bg-gray-800 dark:border-gray-700">
        <div class="grid col-start-2 col-span-10 red rounded-3xl dark:bg-gray-900 justify-center border-2 border-gray-500 bg-white p-10">
            <div class="text-2xl font-bold">
                @if($message = Session::get('success'))
                    <div class="flex justify-center bg-green-700 font-bold p-5 mx-6 rounded-xl">
                        <span class="font-bold">{{ $message }}</span>
                    </div>
                @endif
                <form id="edit_form" action="{{ route('edited') }}" method="post" enctype="multipart/form-data" class="flex-col w-full m-2">
                    @csrf
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_name" class="mx-2">Task Name: </label>
                        <input type="hidden" id="task_id" name="task_id" value="{{ $task->id }}">
                        <input type="text" id="task_name" name="task_name" value="{{ $task->name }}" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_description" class="mx-2">Task Description: </label>
                        <textarea id="task_description" name="task_description" rows="8" cols="50" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">{{ $task->description }}</textarea>
                    </div>
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_date" class="mx-2">Task Date: </label>
                        <input type="date" id="task_date" name="task_date" value="{{ $task->date }}" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                    <div class="flex justify-between items-center m-5 mt-10">
                        <img src="{{ $task->image }}" alt="{{ $task->name }}" class="w-40 rounded-full">
                        <label for="task_image" class="mx-2"></label>
                        <input type="file" id="task_image" name="task_image" value="{{ $task->date }}" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection