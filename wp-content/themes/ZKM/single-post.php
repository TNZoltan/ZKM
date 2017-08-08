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
<div class="site">
    <div class="container">
        <div id="the-recipe" class="row">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="col-sm-8">
                    <div class="title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="desc">
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="<?php echo $image?>">
                </div>

            <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<?php get_template_part('parts/footer'); ?>

<style>
    .site {
        background: url('<?php echo get_template_directory_uri() ?>/library/img/background.jpg')
    }
</style>
