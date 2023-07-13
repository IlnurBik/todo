@extends('layouts.todo')
@section('content')
<div class="row m-5 mt-5 w-75 m-auto">
    <h1 class="text-center">To-Do List</h1>
    <form action="{{ route('todo_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Название</label>
            <input class="form-control" name="name" type="text" placeholder="Введите название" aria-label="default input example">
            <div class="text-danger form-error" id="error-name"></div>
        </div>
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Выберите иконку для задачи</label>
            <input class="form-control" name="max_img" type="file" id="formFileMultiple" multiple>
            <div class="text-danger form-error" id="error-max_img"></div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Теги</label>
            <input class="form-control" type="text" name="tag" placeholder="Введите теги через запятую" aria-label="default input example">
            <div class="text-danger form-error" id="error-tag"></div>
        </div>
        <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
            <button id="submitForm" class="btn btn-primary" type="submit">Добавить</button>
        </div>
    </form>
</div>

<div class="row m-5 mt-5 w-75 m-auto">
    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Иконка</th>
            <th scope="col">Название</th>
            <th scope="col">Тег связь</th>
            <th scope="col" colspan="2">Действие</th>
        </tr>
        </thead>
        <tbody id="tbody">
        @foreach($tasks as $task)
        <tr class="align-middle" class="align-middle"s>
            <th scope="row">{{ $task->id }}</th>
            <td><img src="{{ asset('storage/'.$task->min_img) }}"></td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->tag }}</td>
{{--            <td>--}}
{{--                @foreach($task->tags as $tag)--}}
{{--                    {{$tag->name}}--}}
{{--                @endforeach--}}
{{--            </td>--}}
            <td><a type="button" href="{{ route('todo_edit', $task->id) }}" class="btn
            btn-warning">Редактировать</a></td>
            <td>
                <form action="{{ route('todo_destroy', $task->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
