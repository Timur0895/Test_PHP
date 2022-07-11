@extends('index');

@section('content')
@if (isset($category))
<h1 class="my-md-5 my-4">Обновить категорию</h1>
@else
<h1 class="my-md-5 my-4">Добавить категорию</h1>   
@endif
<div class="row">
    <div class="col-lg-5 col-md-8">
        <form
            @if (isset($category))
                action="{{route('updateCategory', ['id' => $category->id])}}"
            @else
                action="{{route('storeCategory')}}" 
            @endif method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input name="title" type="text" @if(isset($category)) value={{$category->title}} @endif class="@error('title') is-invalid @enderror form-control" placeholder="Напишите название" id="floatingName">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if (isset($category))
                    <label for="floatingDescription">{{$category->title}}</label>
                @else
                    <label for="floatingDescription">Описание</label>    
                @endif
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            @if (isset($category))
                <button class="btn btn-info" type="submit">Обновить</button>
            @else
                <button class="btn btn-primary" type="submit">Добавить</button>    
            @endif
            
        </form>
    </div>
</div>
@endsection