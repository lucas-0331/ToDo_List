@extends('task.layout')

@section('title', 'Home')

@push('jquery')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('content')
    <div class="relative overflow-x-auto shadow-md ">
        @if($message = Session::get('success'))
            <div class="flex justify-center bg-green-700 items-center text-3xl font-bold text-white h-20">
                <span id="success_message" class="font-bold">{{ $message }}</span>
            </div>
        @elseif($message = Session::get('fail'))
            <div class="flex justify-center bg-red-600 items-center text-4xl font-bold text-white h-20">
                <span id="fail_message" class="font-bold">{{ $message }}</span>
            </div>
        @endif
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
                            <div class="flex items-center p-2">
                                <input id="checkbox-table-search-{{ $task->id }}" type="checkbox" @if($task->status) checked @endif class="w-7 h-7 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-{{ $task->id }}" class="sr-only">{{ $task->status }}</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $task->name }}
                        </th>
                        <td class="px-24 py-4">
                            {{ Str::limit($task->description, 60) }}
                        </td>
                        <td class="px-6 py4 font-bold
                            @php
                                $current_date = \Carbon\Carbon::now();
                                $task_date = \Carbon\Carbon::parse($task->date);
                                if ($current_date->isSameDay($task_date))
                                {
                                    echo 'text-yellow-500';
                                }
                                elseif ($current_date->greaterThan($task_date))
                                {
                                    echo 'text-red-600';
                                }
                                else
                                {
                                    echo 'text-gray-400';
                                }
                            @endphp">
                            {{ $task_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if(Str::startsWith($task->image, ['http://', 'https://']))
                                <img src="{{ $task->image }}" alt="Image URL" class="w-20 rounded-full">
                            @else
                                <img src="{{ asset('storage/' . $task->image) }}" alt="Image PATH" class="w-20 rounded-full">
                            @endif
                        </td>
                        <td class="flex items-center px-6 py-10">
                            <a href="{{ route('task.details', $task->id) }}" class="font-medium text-white-600 dark:text-white-500 hover:underline">
                                <span class="material-symbols-outlined">
                                    visibility
                                </span>
                            </a>
                            <a href="{{ route('task.edit', $task->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ms-3">
                                <span class="material-symbols-outlined">
                                    edit_square
                                </span>
                            </a>
                            <a href="#" onclick="confirm_delete('{{ route('task.destroy', $task->id) }}', '{{ $task->name }}')" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
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

    <div id="confirm_delete_modal" class="modal z-50 rounded hidden fixed top-1/3 left-1/3 w-1/3 h-1/4 border-4 border-gray-400 bg-gray-700">
        <div class="modal-content w-full h-full font-medium text-white flex flex-col justify-between">
            <p class="text-2xl m-4">Are you sure you want to delete the task <span id="modal_task_name" class="font-bold"></span>?</p>
            <div class="flex justify-between m-4 font-bold">
                <button onclick="close_modal()" class="bg-red-600 w-1/3 h-20 text-2xl rounded hover:bg-red-500">Cancel</button>
                <button onclick="delete_task()" class="bg-green-700 w-1/3 h-20 text-2xl rounded hover:bg-green-600">Yes</button>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        {{ $tasks->links() }}
    </div>
@endsection
