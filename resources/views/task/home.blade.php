@extends('task.layout')

@section('title', 'Home')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            @if(isset($tasks))
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-24 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @foreach($tasks as $task)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-{{ $task->id }}" type="checkbox" @if($task->status) checked @endif class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">{{ $task->status }}</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $task->name }}
                        </th>
                        <td class="px-24 py-4">
                            {{ Str::limit($task->description, 50) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $task->date }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ $task->image }}" alt="" class="w-20">
                        </td>
                        <td class="flex items-center px-6 py-10">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <span class="material-symbols-outlined">
                                    edit_square
                                </span>
                            </a>
                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
           @else
                <h3>Não existem tarefas!</h3>
           @endif
        </table>
    </div>

    <div class="flex justify-center">
        {{ $tasks->links() }}
    </div>
@endsection

@push('google-material-symbols')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endpush
