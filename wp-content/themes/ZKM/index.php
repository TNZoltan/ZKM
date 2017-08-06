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
                <input type="radio" value="shoppingList" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/recipe.png">
            </label>
            <label class="check-list wrapper">
                <input type="radio" value="checkList" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/home.png">
            </label>
            <label class="recipes-button wrapper">
                <input type="radio" value="recipesFinder" v-model="selectedView">
                <img @click="setHeight()" src="<?php echo get_template_directory_uri() ?>/library/img/apple.png">
            </label>
    </div>
    <div id="content" v-cloak>
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
                <button id="save-list" @click="submitted()" class="btn btn-info form-control">Save items</button>
            </div>
            <div id="success">
                Saved.
            </div>
        </div>
        <div id="recipes-finder" v-else-if="selectedView == 'recipesFinder'">
            <div id="recipes-header">
                <span>You have the following ingredients:</span>
                <span>
                    <ul>
                       <li v-for="food in foodList" v-if="food.in_fridge == 1">{{ food.name }}</li>
                    </ul>
                </span>
            </div>
            You can make...
            <div id="recipeList">
                <template v-for="recipe in recipeList">
                    <div v-if="recipeIsAvailable(recipe)">
                        {{ recipe.name }}
                    </div>
                </template>
            </div>
        </div>
        <div id="shopping-list" v-else-if="selectedView == 'shoppingList'">
            I am shoppingList
        </div>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>

<?php $foodList = getFoodList(); ?>
<?php $recipeList = getRecipeList(); ?>

<?php
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
while (count($foodList) == $i){
    if ($foodList[$i-1]->priority > $foodList[$i]->priority){
        $copy = $foodList[$i];
        $foodList[$i] = $foodList[$i-1];
        $foodList[$i-1] = $copy;
    }
    $i++;
}
?>



<script>
    new Vue({
        el: '#app',
        data: {
            selectedView: 'recipesFinder', //TODO Save the latest one in session and put it here
            foodList: {},
            recipeList: {}
            /*validRecipe: false*/
        },
        methods: {
            recipeIsAvailable: function (recipe){
                var allValid = true;
                for(i = 0; i < recipe.ingredients.length; i++){
                    var valid = false;
                    for (j = 0; j < this.foodList.length; j++){
                        if (this.foodList[j].in_fridge == "1"){
                            if (this.foodList[j].index == recipe.ingredients[i].food_id){
                                valid = true;
                            }
                        }
                    }
                    if (!valid) allValid = false;
                    recipe.ingredients[i].available = valid;
                }
                return allValid;
            },
            checked: function (food) {
                if (food.in_fridge == "0"){
                    food.in_fridge = "1";
                } else {
                    food.in_fridge = "0";
                }
            },
            submitted: function () {
                var data = {};
                this.foodList.forEach(function(food){
                    if (food.in_fridge){
                        data[food.index] = food.in_fridge;
                    }
                });
                jQuery.ajax({
                    url: '<?php echo get_template_directory_uri() ?>/parts/save-list.php',
                    method: 'POST',
                    data: data,
                    success: function (data){
                        jQuery("#success").fadeIn();
                        setTimeout(function(){
                            jQuery("#success").fadeOut();
                        }, 2000);
                    }
                });
            }
        },
        created: function (){
            this.foodList = <?php echo json_encode($foodList); ?>;
            this.recipeList = <?php echo json_encode($recipeList); ?>;
        }
    });

</script>