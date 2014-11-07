<?php


add_filter( 'cmb2_meta_boxes', 'cmb2_staff_metaboxes' );



/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_staff_metaboxes( array $meta_boxes ) {

	$prefix = '_doc_';


	$meta_boxes['ppl_name'] = array(
		'id'            => 'ppl_name',
		'title'         => __( 'Name', 'cmb2' ),
		'object_types'  => array( 'people', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'        => array(

				array(
					'name' => __( 'Prefix', 'cmb2' ),
					'id'   => $prefix . 'prefix',
					'type' => 'text_medium',
					'attributes'  => array(
						'placeholder' => 'Prefix',
				),
			),
				array(
					'name' => __( 'First Name', 'cmb2' ),
					'id'   => $prefix . 'emp_first_name',
					'type' => 'text_medium',
					'attributes'  => array(
						'placeholder' => 'First',
				),
			),
				array(
					'name' => __( 'Middle', 'cmb2' ),
					'id'   => $prefix . 'middle_name',
					'type' => 'text_medium',
					'attributes'  => array(
						'placeholder' => 'optional',
				),
			),
				array(
					'name' => __( 'Last Name', 'cmb2' ),
					'id'   => $prefix . 'emp_last_name',
					'type' => 'text_medium',
					'attributes'  => array(
						'placeholder' => 'Last',
				),
			),
				array(
					'name' => __( 'Suffix', 'cmb2' ),
					'id'   => $prefix . 'suffix',
					'type' => 'text_medium',
					'attributes'  => array(
						'placeholder' => 'Suffix',
				),
			),

		),
	);



	$meta_boxes['emp_contact_info'] = array(
		'id'            => 'emp_contact_info',
		'title'         => __( 'Contact Information', 'cmb2' ),
		'object_types'  => array( 'people', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'        => array(

			array(
				//'name' => __( 'Phone', 'cmb2' ),
				'id'          => 'phone_group',
				'type'        => 'group',
				'options'     => array(
					'group_title'   => __( 'Phone {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Phone', 'cmb2' ),
					'remove_button' => __( 'Remove Phone', 'cmb2' ),
					'sortable'      => true, // beta
				),
				'fields'      => array(

			array(
				'name'    => __( 'Phone type', 'cmb2' ),
				'id'      => 'phone_type_select',
				'type'    => 'select',
				'options' => array(
					'fa-phone' => __( 'Office', 'cmb2' ),
					'fa-mobile'   => __( 'Mobile', 'cmb2' ),
					'none'     => __( 'Other', 'cmb2' ),
				),
			),

			array(
				'name' => __( 'Phone number', 'cmb2' ),
				'id'   => 'emp_phone',
				'type' => 'text_medium',
				'attributes'  => array(
				'placeholder' => '704-###-####',
				),
			),
				),
				),


			array(
				'name' => __( 'Email', 'cmb2' ),
				'id'   => $prefix . 'emp_email',
				'type' => 'text_email',
				'default' => '@charlottediocese.org',
				'repeatable' => true,
			),


			array(
				'id'          => 'address_group',
				'type'        => 'group',
				'options'     => array(
					'group_title'   => __( 'Address {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Address', 'cmb2' ),
					'remove_button' => __( 'Remove Address', 'cmb2' ),
					//'sortable'      => true, // beta
				),
				'fields'      => array(

			array(
				'name' => __( 'Address Line 1', 'cmb2' ),
				'id'   => 'emp_address_line_1',
				'type' => 'text',
			),

			array(
				'name' => __( 'Address Line 2', 'cmb2' ),
				'id'   => 'emp_address_line_2',
				'type' => 'text',
			),

			array(
				'name' => __( 'City', 'cmb2' ),
				'id'   => 'emp_city',
				'type' => 'text_medium',
			),

			array(
				'name' => __( 'State', 'cmb2' ),
				'id'   => 'emp_state',
				'type' => 'text_small',
				'default' => 'NC'
			),

			array(
				'name' => __( 'Zip', 'cmb2' ),
				'id'   => 'emp_zip',
				'type' => 'text_small',
			),

				),
				),

		),
	);


	$meta_boxes['ppl_orders'] = array(
		'id'            => 'ppl_orders',
		'title'         => __( 'Orders', 'cmb2' ),
		'object_types'  => array( 'people', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'        => array(
			array(
				'name' => __( 'Date of Ordination', 'cmb2' ),
				'id'   => $prefix . 'date_of_ordination',
				'type' => 'text_date',
			),
		),
	);




	return $meta_boxes;
}


if ( ! function_exists( 'doc_phone' ) ) :

function doc_phone() {

$phone_entries = get_post_meta( get_the_ID(), 'phone_group', true );

	if($emp_phone){

		foreach ( $phone_entries as $phone_entry ) { ?>
			<a href="tel:<?php echo $phone_entry['emp_phone']; ?>" itemprop="telephone">
				<?php echo $phone_entry['emp_phone']; ?>
			</a>
		<?php
		} //endforeach
	}

}
endif;


if ( ! function_exists( 'doc_staff_email' ) ) :

function doc_staff_email() {

$emp_emails = get_post_meta( get_the_id(), '_doc_emp_email', true );

	if($emp_emails){

		foreach ( $emp_emails as $email ) { ?>

			<a href="mailto:<?php echo $email; ?>" itemprop="email">
				<?php echo $email; ?>
			</a>
		<?php
		}
	}

}
endif;