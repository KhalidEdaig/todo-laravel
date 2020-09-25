@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Add New Todo
    </div>
    <div class="card-body">
        <form action="{{ route('todos.update',$todo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                    value="{{ old('done',$todo->title) }}">
            </div>
            <div class="form-group">
                <label for="content">Desciption</label>
                <textarea class="form-control" id="content" rows="3" name="contet">
                    {{ old('done',$todo->content) }}
                </textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="done" name="done" value='1'
                    {{ $todo->done ? "checked" : "" }}>
                <label class="form-check-label" for="done">Done</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>
@endsection
