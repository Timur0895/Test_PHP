@extends('index');

@section('content')
@if (isset($tag))
    <h1 class="my-md-5 my-4">Обновить тег</h1>
@else
    <h1 class="my-md-5 my-4">Добавить тег</h1>   
@endif
<div class="row">
    <div class="col-lg-5 col-md-8">
        <form
            @if (isset($tag))
                action="{{route('updateTag', ['id' => $tag->id])}}"
            @else
                action="{{route('storeTag')}}" 
            @endif
             method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input name="title" type="text" @if(isset($tag)) value={{$tag->title}} @endif class="@error('title') is-invalid @enderror form-control" placeholder="Напишите название" id="floatingName">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if (isset($tag))
                    <label for="floatingDescription">{{$tag->title}}</label>
                @else
                    <label for="floatingDescription">Описание</label>    
                @endif
                <div class="invalid-feedback">
                    Пожалуйста, заполните поле
                </div>
            </div>
            @if (isset($tag))
                <button class="btn btn-info" type="submit">Обновить</button>
            @else
                <button class="btn btn-primary" type="submit">Добавить</button>    
            @endif
            
        </form>
    </div>
</div>
@endsection