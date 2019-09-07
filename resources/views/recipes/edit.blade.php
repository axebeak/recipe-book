@extends('layout')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="col mt-2 mb-2">
            @if ($method === 'POST')
                <h3 class="ml-3">Добавление Рецепта</h3>
            @else
                <h3 class="ml-3">Изменение Рецепта</h3>
            @endif
            <form method="POST" action="{{ $link }}" id="recipe">
                @csrf
                @method($method)
                <div class="col bottom-border pb-2">
                        <div class="row mt-3">
                            <div class="col col-xl-3 title">
                                Название:
                            </div>
                            <div class="col">
                                <input type="text" class="big-input p-2" name="name" placeholder="Name" value="{!! !empty($recipe) ? $recipe->name : '' !!}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col col-xl-3 title">
                                Описание:
                            </div>
                            <div class="col">
                                <textarea class="p-2" name="description" placeholder="Description">{!! !empty($recipe) ? $recipe->description : '' !!}</textarea>
                            </div>
                        </div>
                    <input type="hidden" name="ingredients" v-model="ingredientsJson">
                </div>
            <div class="ingredients-container mt-3 mb-3 pb-4 bottom-border">
                <div class="row ml-1">
                    <div class="col">Ингредиент</div>
                    <div class="col">Количество</div>
                </div>
                <div class="ingredients mt-1 mb-1">
                </div>
            </form>
                <div class="row ml-1">
                    <div class="col">
                        <a class="btn btn-outline-info add-ingredient">Добавить</a>
                    </div>
                    <div class="col text-right mt-2">
                        Нет в списке?
                    </div>
                    <div class="col">
                        <a href="/ingredients/create" class="btn btn-outline-info">Создать новый ингредиент</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"><button class="ml-2 btn btn-outline-info btn-lg" form="recipe">Сохранить</button></div>
            </div>
        </div>

<script type="application/javascript">

$(".add-ingredient").click(function(){
    $(".ingredients").append(renderIngredients())
})

$(document).on('click','.remove-ingredient',function() {
    $(this).parent().remove();
});

var ingredients = {}

@foreach ($ingredients as $ingredient)
    ingredients['{{ $ingredient->name }}'] = ''
@endforeach

@if(!empty($recipe->ingredients))
    @for ($i = 0; $i < count($recipe->ingredients); $i++)
        ingredients['{{ $recipe->ingredients[$i]->name }}'] = '{{ $recipe->ingredients[$i]->ammount }}' 
    @endfor
@endif

function renderIngredients(selected = false){
    var ingredientSelect = `
        <div class="row mt-2 mb-2 ml-1">
            <div class="col">
                <select name="ingredients[]">
    `
    var inputValue = ''
    
    for (var ingredient in ingredients){
        var ifSelected = ''
        if (ingredient == selected){
            var ifSelected = 'selected'
            var input = ingredients[ingredient]
        } 
        ingredientSelect = ingredientSelect + `
            <option value="${ingredient}" ${ifSelected}>${ingredient}</option>
        `
    }
    
    inputValue = typeof input !== "undefined" ? input : inputValue 
    
    var ingredientValue = `
            </div>
            <div class="col">
                <input type="text" name="ammounts[]" value="${inputValue}">
            </div>
            <i class="fa fa-times remove-ingredient" aria-hidden="true"></i>
        </div>
    `
    
    ingredientSelect = ingredientSelect + '</select>' + ingredientValue
    
    return ingredientSelect
}

for (ingredient in ingredients){
    if (ingredients[ingredient] == 0){
        continue   
    }
    $(".ingredients").append(renderIngredients(ingredient))
}

</script>

@endsection