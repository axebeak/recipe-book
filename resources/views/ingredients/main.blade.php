@extends('layout')

@section('content')
<div class="row">
    <div class="col">
        <h3 class="mt-3">Ингредиенты</h3>
    </div>
    <div class="col text-right">
        <h3 class="mt-3">
            <a class="btn btn-outline-info" href="/ingredients/create">Добавить ингредиент</a>
        </h3>
    </div>
</div>
<table class="table table-dark text-center mt-3">
  <thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($ingredients as $ingredient)
    <tr>
      <th scope="row">{{ $ingredient->name }}</th>
      <td>
        <a href="/ingredients/{{ $ingredient->id }}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href="#"><i id="delete-item-{{ $ingredient->id }}" class="fa fa-times delete-item" aria-hidden="true"></i></a>
        <span>
          <form id="item-{{ $ingredient->id }}" method="POST" action="/ingredients/{{ $ingredient->id }}">
              @csrf
              @method('DELETE')
          </form>
        </span> 
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection