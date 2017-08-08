<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 7/31/2017
 * Time: 4:08 PM
 */
?>
<?php /* enable this
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
*/ ?>
<script src="<?php echo get_template_directory_uri() ?>/vue.js"></script>

<?php get_template_part('parts/header'); ?>

<div id="app">
    <div id="navigation" v-cloak>
            <label class="shopping-list wrapper">
                <input type="radio" value="recipesFinder" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/recipe.png">
            </label>
            <label class="check-list wrapper">
                <input type="radio" value="checkList" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/home.png">
            </label>
            <label class="recipes-button wrapper">
                <input type="radio" value="shoppingList" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/apple.png">
            </label>
    </div>
    <div id="content" v-cloak>
        <div id="success">
            Saved.
        </div>
        <?php // The Ingredients Feature ?>
        <div id="check-list" v-if="selectedView == 'checkList'">
            <div
                    v-for="food in foodList"
                    class="food-wrapper col-xs-4 col-md-3 col-lg-2"
                    :class="[food.in_fridge == 1 ? 'active' : 'inactive']"
                    :style="{backgroundImage: 'url(' + food.img + ')'}"
                    @click="checked(food)"
            >
                <div class="food-title">
                    <h1>{{ food.name }}</h1>
                </div>
            </div>
            <div style="clear: left; text-align: center;">
                <button class="save-list btn btn-info form-control" @click="submitted('check')">Save items</button>
            </div>
        </div>

        <?php // The Recipes Feature ?>
        <div id="recipes-finder" v-else-if="selectedView == 'recipesFinder'">
            <div id="recipes-header">
                <div class="list">
                    <span class="badge" v-for="food in foodList" v-if="food.in_fridge == 1">{{ food.name }}</span>
                </div>
                <div class="icon">
                    <img src="<?php echo get_template_directory_uri() ?>/library/img/fridge.png">
                </div>
            </div>
            <div id="recipes-body">
                <div class="row">
                    <template v-for="recipe in recipeList">
                        <div class="col-lg-4 col-md-6">
                            <div
                                    class="recipe row"
                                    :class="[recipe.available == true ? 'ready' : 'non-ready']"
                            >
                                <div class="thumb" :style="{backgroundImage: 'url(' + recipe.img + ')'}"></div>
                                <a :href="recipe.link">
                                    <div class="name"><h4>{{ recipe.name }}   <img v-if="recipe.available" src="<?php echo get_template_directory_uri() ?>/library/img/tick.png"></h4></div>
                                </a>
                                <div class="ingredients">
                                    <span class="badge" v-for="ingredient in recipe.ingredients" :class="[ingredient.available ? 'available' : 'inavailable']">{{ ingredient.name }}</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <?php // The Shopping List Feature ?>
        <div id="shopping-list" v-else-if="selectedView == 'shoppingList'">
            <div class="container">
                    <div class="row"
                         v-for="(food, key,index) in foodList"
                         v-if="food.in_fridge == 0"
                         :class="[checkItem(food.name) ? 'done' : 'not-done']">
                        <div class="col-xs-6">
                            <h4 class="title">{{ food.name }}</h4>
                        </div>
                        <div class="col-xs-6">
                            <input class="tick form-control" type="checkbox" @click="updateItem(food.name)">
                        </div>
                    </div>
            </div>
            <div style="clear: left; text-align: center;" >
                <button class="save-list btn btn-info form-control" @click="submitted('shopping')">Save items</button>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>

<?php $foodList = getFoodList(); ?>
<?php $recipeList = getRecipeList(); ?>

<?php
foreach($recipeList as $recipe){
    foreach($recipe->ingredients as $ingredient){
        foreach ($foodList as $food){
            if (intval($food->index) == intval($ingredient->food_id)){
                $ingredient->name = $food->name;
            }
        }
    }
}
//Sorting the list
function available( $a, $b ) {
    if ($a->in_fridge == 0 && $b->in_fridge == 1){
        return 1;
    } else if ($a->in_fridge == 1 && $b->in_fridge == 0){
        return -1;
    } else
        return 0;
};
usort($foodList,'available');

$i = 1;
while ($foodList[$i]->in_fridge == 1){
    if ($foodList[$i-1]->priority > $foodList[$i]->priority){
        $copy = $foodList[$i];
        $foodList[$i] = $foodList[$i-1];
        $foodList[$i-1] = $copy;
    }
    $i++;
}
$i++;
if ($i != count($foodList)){
    while (count($foodList) == $i){
        if ($foodList[$i-1]->priority > $foodList[$i]->priority){
            $copy = $foodList[$i];
            $foodList[$i] = $foodList[$i-1];
            $foodList[$i-1] = $copy;
        }
        $i++;
    }
}
?>



<script>

    new Vue({
        el: '#app',
        data: {
            selectedView: 'checkList',
            foodList: {},
            recipeList: {},
            shoppingList: []
        },
        methods: {
            checkItem: function(name){
                return this.shoppingList.includes(name);
            },
            updateItem: function(name){
                if (this.checkItem(name)){
                    var i = this.shoppingList.indexOf(name);
                    if(i != -1) {
                        this.shoppingList.splice(i, 1);
                    }
                } else {
                    this.shoppingList.push(name);
                }
            },
            checked: function (food) {
                if (food.in_fridge == "0"){
                    food.in_fridge = "1";
                } else {
                    food.in_fridge = "0";
                }
            },
            submitted: function (list) {
                var data = {};
                if (list == 'check'){
                    this.foodList.forEach(function(food){
                        if (food.in_fridge){
                            data[food.index] = food.in_fridge;
                        }
                    });
                } else if (list == 'shopping'){
                    jQuery('input:checkbox:checked').prop('checked', false);
                    for (j = 0; j<this.foodList.length;j++){
                        for (i = 0; i<this.shoppingList.length;i++){
                            if (this.foodList[j].name == this.shoppingList[i]){
                                data[this.foodList[j].index] = '1';
                                this.foodList[j].in_fridge = 1;
                            }
                        }
                    }
                    this.shoppingList = [];
                }
                jQuery.ajax({
                    url: '<?php echo get_template_directory_uri() ?>/parts/save-list.php',
                    method: 'POST',
                    data: data,
                    success: function (data){
                        jQuery("#success").fadeIn();
                        setTimeout(function(){
                            jQuery("#success").fadeOut();
                        }, 1000);
                    }
                });
                this.updateRecipes();
            },
            updateRecipes: function () {
                for (x = 0; x < this.recipeList.length; x++) {
                    var count = 0;
                    for (i = 0; i < this.recipeList[x].ingredients.length; i++) {
                        var valid = false;
                        for (j = 0; j < this.foodList.length; j++) {
                            if (this.foodList[j].in_fridge == "1") {
                                if (this.foodList[j].index == this.recipeList[x].ingredients[i].food_id) {
                                    valid = true;
                                }
                            }
                        }
                        if (valid) count++;
                        this.$data.recipeList[x].ingredients[i].available = valid;
                    }
                    this.$data.recipeList[x].available = (count == this.recipeList[x].ingredients.length);
                    this.$data.recipeList[x].missing = this.recipeList[x].ingredients.length - count;
                }
                this.recipeList.sort(function(a,b){
                    return a.missing - b.missing;
                });
            }
        },
        created: function (){
            this.foodList = <?php echo json_encode($foodList); ?>;
            this.recipeList = <?php echo json_encode($recipeList); ?>;
            this.updateRecipes();
        }
    });

</script>