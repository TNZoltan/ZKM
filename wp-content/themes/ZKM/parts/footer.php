<?php
/**
 * Created by PhpStorm.
 * User: Zoli
 * Date: 8/2/2017
 * Time: 4:06 PM
 */
?>

<div id="footer">
        <?php wp_nav_menu(array(
            'container_id' => 'navigation',
            'container_class' => 'hide'
        )); ?>
</div>


<?php wp_footer(); ?>

<script>
    jQuery(document).ready(function () {
        var menupoints = jQuery('#navigation ul li a');
        jQuery(menupoints[0]).empty().prepend(
            '<img src="<?php echo get_template_directory_uri() ?>/library/img/recipe.png">'
        );
        jQuery(menupoints[1]).empty().prepend(
            '<img src="<?php echo get_template_directory_uri() ?>/library/img/home.png">'
        );
        jQuery(menupoints[2]).empty().prepend(
            '<img src="<?php echo get_template_directory_uri() ?>/library/img/apple.png">'
        );
        jQuery('#navigation').removeClass('hide');
    });
</script>