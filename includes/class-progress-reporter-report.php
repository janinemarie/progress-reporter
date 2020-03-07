<?php

/**
 * Fired during plugin activation
 *
 * @link       https://criticalhit.dev
 * @since      1.0.0
 *
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Progress_Reporter
 * @subpackage Progress_Reporter/includes
 * @author     Janine M. Paris <janine@criticalhit.dev>
 */
class Progress_Reporter_Report {
    //get all post types
    public function pr_get_all_post_types() {
        $post_types = get_post_types();
        return( $post_types );
    }

    public function pr_get_post_type_labels() {
        global $wp_post_types;
        $post_type_name = get_current_screen()->post_type;
        $labels = &$wp_post_types[ $post_type_name ]->labels;
        return $labels;
    }

    //get all posts in a specific post type
    public function pr_make_a_posts_array( $post_type ) {
        $get_posts_args = array('post_type' => $post_type);
        $posts_array = get_posts( $get_posts_args );

        return( $posts_array );
    } //end pr_make_a_posts_array()

    //read out the posts from a specific post type in the format we want
    public function pr_read_out_posts( $posts_array ) {
        //a list of icons for the custom taxonomy terms registered at install
        $custom_tax_icons = array(
            'Ready for review'       => '<span class="dashicons dashicons-yes" title="Ready for review"></span>',
            'Complete'               => '<span class="dashicons dashicons-yes" title="Ready for review"></span>',
            'Approved'               => '<span class="dashicons dashicons-yes-alt" title="Approved"></span>',
            'Stuck'                  => '<span class="dashicons dashicons-warning" title="Stuck"></span>',
            'Needs written content'  => '<span class="dashicons dashicons-editor-alignleft" title="Needs written content"></span>',
            'Needs images'           => '<span class="dashicons dashicons-align-right" title="Needs images"></span>',
            'Needs a featured image' => '<span class="dashicons dashicons-format-image" title="Needs a featured image"></span>',
            'Needs editing'          => '<span class="dashicons dashicons-edit" title="Needs editing"></span>',
            'Needs a custom layout'  => '<span class="dashicons dashicons-schedule" title="Needs a custom layout"></span>'
        );

        if ( $posts_array ) {
            $posts_container_id_lowercase = strtolower( $posts_array->post_type );
            //$posts_container_id = str_replace( ' ', '-', $posts_container_id_lowercase );
            //var_dump($posts_array);
            ?>
            <div id="<?php echo $posts_container_id_lowercase; ?>" class="posts">
                <h2><?php echo count($posts_array); echo ' '; echo $posts_array[0]->post_type; ?></h2>

                <?php

                foreach ( $posts_array as $post ) { ?>
                    <div class="post">
                        <p class="post-title"><?php echo $post->post_title; ?></p>
                        <div class="view-edit-links">
                            <a href="<?php get_site_url() ?>/<?php echo $post->post_name; ?>" target="_blank">View</a>
                            <a href="<?php get_site_url() ?>/wp-admin/post.php?post=<?php echo $post->ID ?>&action=edit" target="_blank">Edit</a>
                        </div>
                        <p class="post-progress">
                            <?php
                            $terms = get_the_terms( $post->ID , 'progress' );
                            if ( $terms ) {
                                foreach ( $terms as $term ) {
                                    if ( $custom_tax_icons[ $term->name ] ) {
                                        echo $custom_tax_icons[ $term->name ];
                                    } else {
                                        echo $term->name;
                                    }
                                    echo ' ';
                                }
                            }
                            ?>
                        </p>
                        <span class="open-close-details open-icon" title="See more details"></span>
                        <div class="post-details">
                            <p class="post-slug"><a href="<?php get_site_url(); echo $post->post_name; ?>">Slug: /<?php echo $post->post_name; ?></a></p>
                            <p class="post-status">Publish status: <?php echo $post->post_status; ?></p>
                            <p class="post-mod">Last modified: <?php echo $post->post_modified; ?></p>
                        </div>
                    </div>
                    <?php
                } //end foreach
                ?> </div> <?php
        } // end if
        return($custom_tax_icons);
    } // end pr_read_out_posts()

    //set up the entire view and read out all the posts from each post type
    public function pr_progress_report( $args ) {
        $post_types = $this->pr_get_all_post_types();

        ?>
        <div id="progress-wrapper">
            <h2>Progress on <?php echo get_bloginfo('name'); ?></h2>
            <?php
            foreach ( $post_types as $post_type ) {
                $posts_array = $this->pr_make_a_posts_array( $post_type );
                $this->pr_read_out_posts( $posts_array );
            } //end foreach
            ?>
        </div>
        <div id="key">
            <?php
            foreach ( $custom_tax_icons as $icon ) {
                echo $icon;
            }
            ?>
        </div>
        <?php
    } //end pr_progress_report()
}