<?php
/*
Plugin Name: Rename Posts to Recipes
Description: Change the name of the default post type
Author: Robert Brian Gottier
Version: 0.0.1
Author URI: http://brianswebdesign.com
License: MIT
*/

class rename_posts {

    private $singular = 'Recipe';
    private $plural   = 'Recipes';

    /**
     * Class Constructor
     */
    public function __construct()
    {
        add_action( 'admin_menu', [ $this, 'change_post_label' ] );
        add_action( 'init', [ $this, 'change_post_object' ] );
    }

    // -----------------------------------------------------------------------

    /**
     * Change Post Label
     */
    public function change_post_label()
    {
        global $menu;
        global $submenu;

        $menu[5][0]                 = $this->plural;
        $submenu['edit.php'][5][0]  = $this->plural;
        $submenu['edit.php'][10][0] = 'Add ' . $this->singular;
        $submenu['edit.php'][16][0] = $this->singular . ' Tags';
    }

    // -----------------------------------------------------------------------

    /**
     * Change Post Object
     */
    public function change_post_object()
    {
        global $wp_post_types;

        $labels                     = &$wp_post_types['post']->labels;

        $labels->name               = $this->plural;
        $labels->singular_name      = $this->singular;
        $labels->add_new            = 'Add ' . $this->singular;
        $labels->add_new_item       = 'Add ' . $this->singular;
        $labels->edit_item          = 'Edit ' . $this->singular;
        $labels->new_item           = 'New ' . $this->singular;
        $labels->view_item          = 'View ' . $this->singular;
        $labels->search_items       = 'Search ' . $this->plural;
        $labels->not_found          = 'No ' . $this->plural . ' found';
        $labels->not_found_in_trash = 'No ' . $this->plural . ' found in Trash';
        $labels->all_items          = 'All ' . $this->plural;
        $labels->menu_name          = $this->plural;
        $labels->name_admin_bar     = $this->singular;
    }

    // -----------------------------------------------------------------------

}

new rename_posts;