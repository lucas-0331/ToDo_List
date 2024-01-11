@extends('task.layout')

@section('title', 'New Task')

@section('button-nav-right')
    <a href="#" class="flex items-center" onclick="submit_form_new_task()">
        <span class="material-symbols-outlined">
            save
        </span>
        <span class="ms-2">
            Save
        </span>
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-12 p-5 gap-4 h-screen bg-white dark:text-white border-b dark:bg-gray-800 dark:border-gray-700">
        <div class="grid col-start-2 col-span-10 red rounded-3xl dark:bg-gray-900 justify-center border-2 border-gray-500 bg-white p-10">
            <div class="text-2xl font-bold">
                <form id="new_task_form" action="{{ route('create_task') }}" method="post" enctype="multipart/form-data" class="flex-col w-full m-2">
                    @csrf
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_name" class="mx-2">Task Name: </label>
                        <input type="text" id="task_name" name="task_name" placeholder="Task Name" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_description" class="mx-2">Task Description: </label>
                        <textarea id="task_description" name="task_description" placeholder="Task Description" rows="8" cols="50" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700"></textarea>
                    </div>
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_date" class="mx-2">Task Date: </label>
                        <input type="date" id="task_date" name="task_date" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                    <div class="block justify-between items-baseline m-5">
                        <label for="task_image" class="mx-2"></label>
                        <input type="file" id="task_image" name="task_image" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-gray-700">
                    </div>
                    <div class="block justify-between items-baseline m-5 mt-12">
                        <button id="save_new_task" type="submit" class="w-full border-2 border-gray-500 rounded p-2 focus:border-transparent dark:bg-green-700 hover:bg-green-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
