<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/1/2017
 * Time: 5:54 PM
 */


/*
Template Name: Item
*/
?>


<?php get_template_part('parts/header'); ?>


<div class="container">
    <div style="padding: 15px;">
        <h1>Add a new item</h1>
        <form action="<?php echo get_template_directory_uri() ?>/parts/save-item.php">
            <div class="form-group row">
                <label for="name" class="col-2 col-form-label">Name*</label>
                <div class="col-10">
                    <input class="form-control" type="text" id="name" name="name">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="expiry" class="col-2 col-form-label">Shelf life (in days)</label>
                        <div class="col-10">
                            <?php //TODO Option to not put anything. ?>
                            <input class="form-control" type="number" id="expiry" name="expiry">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="priority" class="col-2 col-form-label">Priority*</label>
                        <div class="col-10">
                            <select name="priority" id="priority" class="form-control">
                                <option value="1">1 - Item is used frequently.</option>
                                <option value="2" selected>2 - Item is used sometimes.</option>
                                <option value="3">3 - Item is used rarely.</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div style="text-align: center"">
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>
