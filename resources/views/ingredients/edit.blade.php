@extends('layout')

@section('content')
<h3 class="mt-4 mb-4">Добавление Ингредиента</h3>
<div class="row pb-4 ml-2 mb-4 mt-2 bottom-border">
    <div class="col">
        Название
    </div>
    <div class="col">
        <form id="ingredient-form" method="POST" action="{{ $link }}">
            @csrf
            @method($method)
            @if (!empty($ingredient))
            <input type="text" name="name" value="{{ $ingredient->name }}">
            @else
                <input type="text" name="name" value="">
            @endif
        </form>
    </div>
    <div class="col">
    </div>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col text-center">
        <button form="ingredient-form" class="btn btn-outline-info btn-lg text-center">Сохранить</button>
    </div>
</div>
@endsection