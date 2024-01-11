@extends('task.layout')

@section('title', 'Details')

@section('content')
    @if(isset($task))
        <div class="grid grid-cols-2 grid-rows-3 gap-4 p-10 h-screen bg-white dark:text-white border-b dark:bg-gray-800 dark:border-gray-700">
            <div class="col-span-2 flex h-1/2 items-center justify-center font-bold text-5xl dark:text-white">
                <h1 class="">{{ ucfirst($task->name) }}</h1>
            </div>
            <div class="flex items-center justify-center">
                @if(Str::startsWith($task->image, ['http://', 'https://']))
                    <img src="{{ $task->image }}" alt="Image URL" class="w-1 rounded-full">
                @else
                    <img src="{{ asset('storage/' . $task->image) }}" alt="Image PATH" class="w-1/3 rounded-full">
                @endif
            </div>
            <div class="flex-col h-full">
                <div class="flex items-start">
                    {{ $task->description }}
                </div>
                <div class="flex items-end mt-auto justify-end">
                    <a href="{{ route('id_user', $task->id_user) }}">Author: {{ $task->user->name }}</a>
                </div>
            </div>
            <div class="row-start-3 col-start-2 flex items-center justify-end">
                {{ $date_format }}
            </div>
        </div>
    @else
        <div class="flex items-center justify-center text-white dark:bg-gray-800">
            Sem tarefas
        </div>
    @endif
@endsection
