@include('header')

@extends('layout')

@section('content')

<div class="ml-3 mt-4 mb-4">
    <h3>{{ $recipe->name }} <a href="/recipes/{{ $recipe->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h3>
</div>
<div class="container">
    {{ $recipe->description }}
</div>
<div class="title-big mt-5 mb-5 ml-3">Ингредиенты</div>
@if (!empty($recipe->ingredients))
    @foreach ($recipe->ingredients as $ingredient)
    <div class="row bottom-border p-4 title">
        <div class="col">{{ $ingredient->name }}</div>
        <div class="col text-center">{{ $ingredient->ammount }}</div>
    </div>
    @endforeach
@endif
@endsection