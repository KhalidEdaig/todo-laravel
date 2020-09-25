@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-4  justify-content-center my-1">
        <div class="col-xs">
            <a href="{{ route('todos.create') }}" class="btn btn-primary px-1 mx-1 py-1 my-1" role="button">Add
                Todo</a>
        </div>
        <div class="col-xs ml-2">
            @if (Route::currentRouteName()=='todos.index')
            <a href="{{ route('todos.undone') }}" class="btn btn-warning px-1 mx-1 py-1 my-1" role="button">Show All
                Todos open</a>
        </div>
        <div class="col-xs ml-2">
            <a href="{{ route('todos.done') }}" class="btn btn-success px-1 mx-1 py-1 my-1" role="button">Show All Todos
                done</a>
            @elseif (Route::currentRouteName()=='todos.done')
            <a href="{{ route('todos.index') }}" class="btn btn-dark px-1 mx-1 py-1 my-1" role="button">Show All
                Todos</a>
        </div>
        <div class="col-xs ml-2">
            <a href="{{ route('todos.undone') }}" class="btn btn-warning px-1 mx-1 py-1 my-1" role="button">Show All
                Todos open</a>
            @elseif (Route::currentRouteName()=='todos.undone')
            <a href="{{ route('todos.index') }}" class="btn btn-dark px-1 mx-1 py-1 my-1" role="button">Show All
                Todos</a>
        </div>
        <div class="col-xs ml-2">
            <a href="{{ route('todos.done') }}" class="btn btn-success px-1 mx-1 py-1 my-1" role="button">Show All Todos
                done</a>
            @endif
        </div>
    </div>

    @foreach ($todos as $todo)

    <div class="alert alert-{{ $todo->done ? 'success' : 'warning' }}">

        <div class="row">
            <div class="col-sm">
                <div class="my-1 d-flex justify-content-between">
                    <div>
                        <strong><span class="badge badge-dark">#{{ $todo->id }}</span></strong>
                        <small>
                            created : {{$todo->created_at->from()}}
                        </small>
                    </div>
                    <div>
                        <todo-info :todo="{{json_encode($todo)}}" :user-auth="{{ json_encode(Auth::user()) }}"
                            :user="{{ json_encode($todo->user) }}"
                            :todo-affected-by="{{json_encode($todo->todoAffectedBy)}}"
                            :todo-affected-to="{{json_encode($todo->todoAffectedTo)}}">
                        </todo-info>
                    </div>
                </div>
                <div class="py-1">
                    {{ $todo->title }}
                </div>
                @if ($todo->done)
                <span class="badge badge-success ">
                    done
                </span>
                @endif

            </div>

            <div class="col-sm form-inline justify-content-end my-1">
                {{--   button affected  --}}

                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle mx-2 my-1" style="width: 90px" type="button"
                        id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Affect
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        @foreach ($users as $user)
                        <a class="dropdown-item"
                            href="/todos/{{ $todo->id }}/affected-to/{{ $user->id }}">{{ $user->name }}</a>
                        @endforeach

                    </div>
                </div>

                {{--  button done/udndone  --}}
                @if ($todo->done==0)
                <form action="{{ route('todos.makeDone',$todo->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success mx-2 my-1" style="width: 90px">Done</button>
                </form>
                @else
                <form action="{{ route('todos.makeUndone',$todo->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <button type="submit" class="btn btn-warning mx-2 my-1" style="width: 90px">Undone</button>
                </form>
                @endif
                @can('edit', $todo)
                <a href="{{ route('todos.edit',$todo->id) }}" id="" class="btn btn-info mx-2 my-1" role="button"
                    style="width: 90px">Edit</a>
                @elsecannot('edit', $todo)
                <a href="{{ route('todos.edit',$todo->id) }}" id="" class="btn btn-info mx-2 my-1 disabled"
                    role="button" style="width: 90px">Edit</a>
                @endcan

                @can('delete', $todo)
                <form action="{{ route('todos.destroy',$todo->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-2 my-1" style="width: 90px">Delete</button>
                </form>
                @elsecannot('delete', $todo)
                <form action="{{ route('todos.destroy',$todo->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-2 my-1 " disabled style="width: 90px">Delete</button>
                </form>
                @endcan
            </div>
        </div>


    </div>
    @endforeach

    {{ $todos->links() }}

</div>
@endsection
