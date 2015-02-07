<?php
add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_sample_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_cmb2_';

    /**
     * Sample metabox to demonstrate each field type included
     */
    $meta_boxes[] = array(
        'id'            => 'test_metabox',
        'title'         => __( 'Test Metabox', 'cmb2' ),
        'object_types'  => array( 'page', 'post' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
        'fields'        => array(
            array(
                'name'       => __( 'Test Text', 'cmb2' ),
                'desc'       => __( 'field description (optional)', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'text',
                'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
                // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
                // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
                // 'on_front'        => false, // Optionally designate a field to wp-admin only
                // 'repeatable'      => true,
            ),
            array(
                'name' => __( 'Website URL', 'cmb2' ),
                'desc' => __( 'field description (optional)', 'cmb2' ),
                'id'   => $prefix . 'url',
                'type' => 'text_url',
                // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
                // 'repeatable' => true,
            ),
            array(
                'name' => __( 'Test Text Email', 'cmb2' ),
                'desc' => __( 'field description (optional)', 'cmb2' ),
                'id'   => $prefix . 'email',
                'type' => 'text_email',
                // 'repeatable' => true,
            ),
        ),
    );


    $meta_boxes[] = array(
        'id'            => 'movies_metabox',
        'title'         => __( 'Movie Metabox', 'cmb2' ),
        'object_types'  => array( 'movies' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
        'fields'        => array(

            array(
                'name'       => __( 'Is Featured', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'checkbox',
            ),
            array(
                'name'       => __( 'Director', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'text',
            ),
            array(
                'name'       => __( 'Released Date', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'text_date',
            ),
            array(
                'name'       => __( 'Poster2', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'file',
            ),
            array(
                'name'       => __( 'Gallery', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'file_list',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'            => 'aboutus_metabox',
        'title'         => __( 'About Us Metabox', 'cmb2' ),
        'object_types'  => array( 'movies' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
        'fields'        => array(
            array(
                'name'       => __( 'Is Featured', 'cmb2' ),
                'id'         => $prefix . 'text',
                'type'       => 'checkbox',
            ),

        ),
    );

    $options[0] = '--Select--';
    $option_posts = get_posts();
    if($option_posts){
        foreach ( $option_posts as $row ) {
            $options[$row->ID] = $row->post_title;
        }
    }
    $meta_boxes[] = array(
        'id'            => 'postselect_metabox',
        'title'         => __( 'Select Post Metabox', 'cmb2' ),
        'object_types'  => array( 'movies' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
        'fields'        => array(
            array(
                'name'       => __( 'Posts', 'cmb2' ),
                'desc'    => 'Select an post',
                'id'         => $prefix . 'post_select',
                'type'    => 'select',
                'options' => $options,
                'default' => 'custom',
                'repeatable'      => true,
            ),
        ),
    );

    // Add other metaboxes as needed

    return $meta_boxes;
}