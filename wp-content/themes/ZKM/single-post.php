<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/6/2017
 * Time: 3:28 AM
 */

global $post;
$image = getImgOfRecipe($post->ID);
?>
<?php get_template_part('parts/header'); ?>
<div class="container">
    <div id="the-recipe">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_title(); ?>
            <img src="<?php echo $image?>">
            <?php the_content(); ?>

        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>