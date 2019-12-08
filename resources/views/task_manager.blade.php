@extends('master')

@section('content')
    <a href="{{ route('logout') }}">Logout</a> <br>

    <h2>Add new task</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form name="add_task" method="post" action="{{ route('task-manager.add') }}">
        @csrf

        <label>Title</label> <br/>
        <input type="text" name="title"/>
        <br/>

        <label>Description</label><br/>
        <textarea name="description" rows="4"></textarea>
        <br/>

        <input type="submit" value="Add new task"/>
    </form>

    <h2>Tasks TODO</h2>
    <table>
        <tr>
            <td>Title</td>
            <td>Description</td>
            <td>User</td>
            <td>Close task</td>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->user->name }}</td>
                <td><a href="{{ route('task-manager.complete', ['id' => $task->id]) }}">Complete</a></td>
            </tr>
        @endforeach
    </table>
@stop