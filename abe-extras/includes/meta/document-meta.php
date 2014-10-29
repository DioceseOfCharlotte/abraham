<?php


add_filter( 'cmb2_meta_boxes', 'cmb2_document_metaboxes' );



/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_document_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_doc_';


    $meta_boxes['documents_group'] = array(
        'id'           => 'documents_group',
        'title'        => __( 'Department Documents', 'cmb2' ),
        'object_types' => array( 'document', ),
        'fields'       => array(
            array(
                'id'          => $prefix . 'document_group',
                'type'        => 'group',
                'options'     => array(
                    'group_title'   => __( 'Document {#}', 'cmb2' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Document', 'cmb2' ),
                    'remove_button' => __( 'Remove Document', 'cmb2' ),
                    'sortable'      => true, // beta
                ),
                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
                    array(
                        'name' => 'Document Title',
                        'id'   => 'title',
                        'type' => 'text',
                        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
                    ),
                    array(
                        'name' => 'Description',
                        'id'   => 'description',
                        'type' => 'textarea_small',
                    ),
                    array(
                        'name' => 'Document Upload',
                        'id'   => 'doc_file',
                        'type' => 'file',
                    ),
                ),
            ),
        ),
    );

    // Add other metaboxes as needed

    return $meta_boxes;
}