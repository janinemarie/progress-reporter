<?php

/**
 * The file that registers the custom taxonomy.
 *
 * A class definition that includes
 *
 * @link       https://criticalhit.dev
 * @since      1.0.0
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/includes
 */

/**
 * Registers the custom taxonomy used by the plugin for core functionality.
 *
 * @since      1.0.0
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/includes
 * @author     Janine M. Paris <janine@criticalhit.dev>
 */
class Progress_Reporter_Custom_Taxonomy {
    /**
     * Adds a custom taxonomy for managing statuses on pages & posts.
     */
    public function initialize_plugin_custom_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Progress Report', 'Taxonomy general name', 'text_domain' ),
            'singular_name'              => _x( 'Progress Report', 'Taxonomy singular name', 'text_domain' ),
            'menu_name'                  => __( 'Progress', 'text_domain' ),
            'all_items'                  => __( 'All statuses', 'text_domain' ),
            'parent_item'                => __( 'Parent status', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent status:', 'text_domain' ),
            'new_item_name'              => __( 'New Status', 'text_domain' ),
            'add_new_item'               => __( 'Add New Status', 'text_domain' ),
            'edit_item'                  => __( 'Edit Status', 'text_domain' ),
            'update_item'                => __( 'Update Status', 'text_domain' )
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_in_rest'               => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_in_quick_edit'         => true,
            'rewrite'                    => array( 'slug' => 'progress' )
        );
        register_taxonomy( 'progress', array( 'post', 'page' ), $args );

        $progress_terms = array(
            'Approved',
            'Complete',
            'Needs written content',
            'Needs images',
            'Needs a featured image',
            'Needs editing',
            'Needs a custom layout',
            'Stuck'
        );

        foreach ($progress_terms as $progress_term) {
            $progress_term_case = strtolower($progress_term);
            $progress_term_slug = str_replace(' ', '-', $progress_term_case);

            if( !term_exists( $progress_term, 'progress' ) ) {
                wp_insert_term(
                    $progress_term,
                    'progress',
                    array(
                        'description' => '',
                        'slug'        => $progress_term_slug
                    )
                );
            } //end check for term
        } //end term foreach
    } //end initialize custom taxonomy fn

}
