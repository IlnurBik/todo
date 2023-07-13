@extends('layouts.todo')
@section('content')
<div class="row m-5 mt-5 w-50 m-auto">
    <h1 class="text-center">To-Do List</h1>
    <form action="{{ route('todo_update', $task->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Название</label>
            <input class="form-control" name="name" type="text" value="{{ $task->name }}" placeholder="Введите название" aria-label="default input example">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <p>Иконка</p>
            <img src="{{ asset('storage/'.$task->min_img) }}" class="img-thumbnail">
            <br>
            <a href="{{ asset('storage/'.$task->min_img) }}" target="_blank">Открыть полный размер</a>
        </div>
        <div class="mb-3">
            <p>Исходная картинка</p>
            <img src="{{ asset('storage/'.$task->max_img) }}" class="img-thumbnail">
            <br>
            <a href="{{ asset('storage/'.$task->max_img) }}" target="_blank">Открыть полный размер</a>
        </div>
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Для замены иконки выберите новый файл</label>
            <input class="form-control" name="max_img" type="file" id="formFileMultiple" multiple>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Теги</label>
            <input class="form-control" type="text" name="tag" placeholder="Введите теги через запятую" value="{{ $task->tag }}" aria-label="default input example">
            @error('tag')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="{{route('todo_index')}}">Вернуться назад</a>
            <button class="btn btn-primary" type="submit">Обновить</button>
        </div>
    </form>
</div>

@endsection
