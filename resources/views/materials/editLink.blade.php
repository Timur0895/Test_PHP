@extends('index');

@section('content')
<h1 class="my-md-5 my-4">Изменить Ссылку</h1>
<div class="row">
    <div class="col-lg-5 col-md-8">
        <form action="{{route('updateLink', ['id' => $link->id])}}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input
                    @if (isset($link->title))
                        value="{{$link->title}}"
                    @endif
                    name="title" type="text" class="@error('title') is-invalid @enderror form-control" placeholder="Напишите название" id="floatingName">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="floatingName">Название</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <div class="form-floating mb-3">
                <input value="{{$link->url}}" name="url" type="text" class="@error('url') is-invalid @enderror form-control" placeholder="Напишите авторов" id="floatingAuthor">
                @error('url')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="floatingAuthor">Ссылка</label>
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            <button class="btn btn-info" type="submit">Обновить</button>            
        </form>
    </div>
</div>
@endsection