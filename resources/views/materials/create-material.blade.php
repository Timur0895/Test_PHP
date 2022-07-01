@extends('index');

@section('content')
    <h1 class="my-md-5 my-4">Добавить материал</h1>
    <div class="row">
        <div class="col-lg-5 col-md-8">
            <form
                @if (isset($material))
                    action="{{route('updateMaterial', ['id' => $material->id])}}"
                @else
                    action="{{route('createMaterial')}}" 
                @endif method="POST">
                @csrf
                
                <div class="form-floating mb-3">
                    <select name="type" class="form-select" id="floatingSelectType">
                        @if (isset($material))
                            <option selected={{$material->type}}>{{$material->type}}</option>
                        @endif
                        <option value="Книга">Книга</option>
                        <option value="Статья">Статья</option>
                        <option value="Видео">Видео</option>
                        <option value="Сайт/Блог">Сайт/Блог</option>
                        <option value="Подборка">Подборка</option>
                        <option value="Ключевые идеи книги">Ключевые идеи книги</option>
                    </select>
                    <label for="floatingSelectType">Тип</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <select name="category" class="form-select" id="floatingSelectCategory">
                        @if (isset($material))
                            <option selected={{$material->category}}>{{$material->category}}</option>
                        @endif
                        @foreach ($categories as $item)
                            <option value={{$item->id}}>{{$item->title}}</option> 
                        @endforeach
                        
                    </select>
                    <label for="floatingSelectCategory">Категория</label>
                    <div class="invalid-feedback">
                        Пожалуйста, выберите значение
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input
                        @if (isset($material))
                            value="{{$material->title}}"
                        @endif
                        name="title" type="text" class="form-control" placeholder="Напишите название" id="floatingName">
                    <label for="floatingName">Название</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input @if (isset($material))
                                value="{{$material->authors}}"
                            @endif name="authors" type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor">
                    <label for="floatingAuthor">Авторы</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                <div class="form-floating mb-3">
                <textarea name="description" class="form-control" placeholder="Напишите краткое описание" id="floatingDescription" style="height: 100px"></textarea>
                @if (isset($material))
                    <label for="floatingDescription">{{$material->description}}</label>
                @else
                    <label for="floatingDescription">Описание</label>    
                @endif
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
                @if (isset($material))
                    <button class="btn btn-info" type="submit">Обновить</button>
                @else   
                    <button class="btn btn-primary" type="submit">Добавить</button>
                @endif
            </form>
        </div>
    </div>
@endsection
