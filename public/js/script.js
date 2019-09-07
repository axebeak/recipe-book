$(".add-ingredient").click(function(){
    $(".ingredients").append(ingridient)
})

$(document).on('click','.remove-ingredient',function() {
    $(this).parent().remove();
});

$(document).on('click','.delete-item',function() {
    let id = $(this).attr("id").replace("delete-item-", "")
    $('form#item-' + id).submit()
});

var ingridient = renderIngredients()

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
