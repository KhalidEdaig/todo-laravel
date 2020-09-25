@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Add New Todo
    </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-body">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
            <div class="form-group">
                <label for="content">Desciption</label>
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="done" name="done">
                <label class="form-check-label" for="done">Done</label>
            </div>
            <button-action action="Add"></button-action>
        </form>
    </div>

</div>
@endsection
