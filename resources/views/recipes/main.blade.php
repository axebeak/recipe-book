@extends('layout')

@section('content')
<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <h3>Мои Рецепты</h3>
        </div>
        <div class="col col-xl-3">
            <a href="/recipes/create" class="btn btn-outline-info">Добавить новый</a>
        </div>
    </div>
    <table class="table table-dark text-center">
      <thead>
        <tr>
          <th scope="col">Рецепт</th>
          <th scope="col">Описания</th>
          <th scope="col">Действия</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        @foreach ($recipes as $recipe)
          <th scope="row">{{ $recipe->name }}</th>
          <td>{{ $recipe->description }}</td>
          <td><a href="/recipes/{{ $recipe->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a> <a href="/recipes/{{ $recipe->id }}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="#"><i id="delete-item-{{ $recipe->id }}" class="fa fa-times delete-item" aria-hidden="true"></i></a>
          <span>
              <form id="item-{{ $recipe->id }}" method="POST" action="/recipes/{{ $recipe->id }}">
                  @csrf
                  @method('DELETE')
              </form>
          </span> 
          </td>
        @endforeach
        </tr>
      </tbody>
    </table>
</div>

<script>
$(document).on('click','.delete-item',function() {
    let id = $(this).attr("id").replace("delete-item-", "")
    $('form#item-' + id).submit()
});
</script>
@endsection