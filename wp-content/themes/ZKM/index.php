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
            <div style="clear: left; text-align: center;padding: 10px 0;">
                <button @click="submitted()" class="btn btn-info form-control">Save items</button>
            </div>
        </div>
        <div id="recipes-finder" v-else-if="selectedView == 'recipesFinder'">
            I am recipesFinder
        </div>
        <div id="shopping-list" v-else-if="selectedView == 'shoppingList'">
            I am shoppingList
        </div>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>

<?php $foodList = getFoodList(); ?>

<?php
    foreach ($foodList as $food){
        $food->checked = false;
    }
?>

<script>
    new Vue({
        el: '#app',
        data: {
            selectedView: 'checkList', //TODO Save the latest one in session and put it here
            foodList: {}
        },
        methods: {
            checked: function (food) {
                if (food.in_fridge == "0"){
                    food.in_fridge = "1";
                } else {
                    food.in_fridge = "0";
                }
            },
            submitted: function () {

            }
        },
        created: function (){
            this.foodList = <?php echo json_encode($foodList); ?>;
        }
    });

</script>