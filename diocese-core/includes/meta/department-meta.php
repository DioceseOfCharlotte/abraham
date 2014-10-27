<?php


add_filter( 'cmb2_meta_boxes', 'cmb2_department_metaboxes' );



/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_department_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_doc_';


    $meta_boxes['dept_contact_info'] = array(
        'id'            => 'dept_contact_info',
        'title'         => __( 'Contact Information', 'cmb2' ),
        'object_types'  => array( 'department', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
        'fields'        => array(

            array(
                'name' => __( 'Phone', 'cmb2' ),
                'id'          => 'dept_phone_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __( '{#}', 'cmb2' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Phone', 'cmb2' ),
                    'remove_button' => __( 'Remove Phone', 'cmb2' ),
                    'sortable'      => true, // beta
                ),
                'fields'      => array(

            array(
                'name'    => __( 'Type', 'cmb2' ),
                'id'      => 'dept_phone_type_select',
                'type'    => 'select',
                'options' => array(
                    'fa-phone' => __( 'Office', 'cmb2' ),
                    'fa-mobile'   => __( 'Mobile', 'cmb2' ),
                    'none'     => __( 'Other', 'cmb2' ),
                ),
            ),

            array(
                'name' => __( 'Number', 'cmb2' ),
                'id'   => 'dept_phone',
                'type' => 'text_medium',
                'add_button' => __( 'Add Another Phone', 'cmb2' ),
                'attributes'  => array(
                'placeholder' => '704-###-####',
            ),
                //'repeatable' => true,
            ),
                ),
                ),
            array(
                'name' => __( 'Email', 'cmb2' ),
                'id'   => $prefix . 'dept_email',
                'type' => 'text_email',
                'add_button'    => __( 'Add Another email', 'cmb2' ),
                'attributes'  => array(
                'placeholder' => '@charlottediocese.org',
            ),
                'repeatable' => true,
            ),
        ),
    );

    return $meta_boxes;
}


if ( ! function_exists( 'doc_dept_phone' ) ) :

function doc_dept_phone() {

            $dept_phone_entries = get_post_meta( get_the_ID(), 'dept_phone_group', true );

            foreach ( $dept_phone_entries as $dept_phone_entry ) { ?>
            <a href="tel:<?php echo $dept_phone_entry['dept_phone']; ?>" itemprop="telephone">
                <?php echo $dept_phone_entry['dept_dept_phone']; ?>
            </a>
        <?php
        } //endforeach

}
endif;


if ( ! function_exists( 'doc_department_email' ) ) :

function doc_department_email() {

$dept_emails = get_post_meta( get_the_id(), '_doc_dept_email', true );

	if($dept_emails){

	    foreach ( $dept_emails as $dept_email ) { ?>

	        <a href="mailto:<?php echo $dept_email; ?>" itemprop="email">
	            <?php echo $dept_email; ?>
	        </a>
	    <?php
	    }
	}

}
endif;
