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
    <div id="navigation">
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
    <div id="content" style="height: 600px">
        <div id="check-list" v-if="selectedView == 'checkList'">
            <div
                v-for="food in foodList"
                class="food-wrapper col-xs-4 col-md-3 col-lg-2"
                :class="[food.in_fridge == 1 ? 'active' : 'inactive']"
                :style="{backgroundImage: 'url(' + food.img + ')'}"
            >
                <div class="food-title">
                    {{ food.name }}
                </div>

            </div>

        </div>
        <div id="recipes-finder" v-if="selectedView == 'recipesFinder'">
            I am recipesFinder
        </div>
        <div id="shopping-list" v-if="selectedView == 'shoppingList'">
            I am shoppingList
        </div>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>



<script>
    new Vue({
        el: '#app',
        data: {
            selectedView: 'checkList', //TODO Save the latest one in session and put it here
            foodList: {}
        },
        methods: {
        },
        created: function (){
            <?php $foodList = getFoodList(); ?>
            this.foodList = <?php echo json_encode($foodList); ?>;
        }
    });

</script>