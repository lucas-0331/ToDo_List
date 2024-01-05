@extends('task.layout')

@section('title', 'Home')

@section('content')

    @if(isset($task))
<h1>{{ $task->name }}</h1>
{{ $task->id }}
{{ $task->description }}
{{ $task->user->name }}
    Teste
@else
    NÃO DEU
@endif

@endsection
