<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    
    protected $guarded = ["id"];
    
    public function validateIngredients($ingredients, $ammounts){
        if (!is_array($ingredients)){
            return '';
        }
        if (count($ingredients) !== count($ammounts)){
            throw new \Exception("Number of ingredients must be equal to the number of their ammounts");
        }
        $result = [];
        for ($i = 0 ; $i <= count($ingredients) - 1; $i++){
            $result = $result + [$i => ['name' => $ingredients[$i], 'ammount' => $ammounts[$i]]];
        }

        return json_encode($result,  JSON_UNESCAPED_UNICODE);
    }
}
