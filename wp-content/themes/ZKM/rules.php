<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/8/2017
 * Time: 5:52 PM
 */


/*
Template Name: Rules
*/
?>


<?php get_template_part('parts/header'); ?>
<div class="container">
    <div id="rules">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
        endwhile; endif; ?>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>
