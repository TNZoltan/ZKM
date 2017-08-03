<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 7/31/2017
 * Time: 4:08 PM
 */
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>

<?php get_template_part('parts/header'); ?>

<div id="app">
    <div id="navigation">
            <label class="shopping-list wrapper">
                <input type="radio" value="shoppingList" v-model="selectedView">
                <img src="<?php echo get_template_directory_uri() ?>/library/img/recipe.png">
            </label>
            <label class="check-list wrapper">
                <input type="radio" value="checkList" v-model="selectedView">
                <img src="<?php echo get_template_directory_uri() ?>/library/img/home.png">
            </label>
            <label class="recipes-button wrapper">
                <input type="radio" value="recipesFinder" v-model="selectedView">
                <img src="<?php echo get_template_directory_uri() ?>/library/img/apple.png">
            </label>
        </ul>
    </div>
    {{ selectedView }}
</div>

<script>
    new Vue({
        el: '#app',
        data: {
            selectedView: 'checkList' //TODO Save the latest one in session and put it here
        }
    });
</script>


<?php get_template_part('parts/footer'); ?>