<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/1/2017
 * Time: 5:53 PM
 */


/*
Template Name: Recipe
*/
?>


<?php get_template_part('parts/header'); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/parts/dropdownchecklist-1.5.css" type="text/css" />

<div class="container">
    <div style="padding: 15px;">
        <h1>Add a new recipe</h1>
        <form action="<?php echo get_template_directory_uri() ?>/parts/save-recipe.php">
            <div class="form-group row">
                <label for="name" class="col-2 col-form-label">Name</label>
                <div class="col-10">
                    <input class="form-control" type="text" id="name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="desc" class="col-2 col-form-label">Description</label>
                <div class="col-10">
                    <textarea class="form-control" id="desc" name="desc"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="priority" class="col-2 col-form-label">Ingedients</label>
                <div class="col-10">
                    <select id="dropdown-checkbox" name="food[]" multiple="multiple" class="form-control">

                        <?php $foodList = getFoodList(); ?>
                        <?php foreach($foodList as $food){ ?>
                             <option value="<?php echo $food->name; ?>"><?php echo $food->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div style="text-align: center"">
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        $("#dropdown-checkbox").dropdownchecklist({ width: 550, height: 150 });
    });
</script>
<script src="<?php echo get_template_directory_uri() ?>/parts/jquery-ui-1.11.2.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/parts/dropdownchecklist-1.5.js"></script>

<?php get_template_part('parts/footer'); ?>
