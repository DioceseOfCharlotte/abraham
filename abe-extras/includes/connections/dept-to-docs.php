<?php
/**
 * Sets up relational Custom Posts with the Posts to Posts library.
 *
 * @package    Directory
 * @subpackage Includes
 * @since      0.1.0
 * @author     Marty Helmick <info@martyhelmick.com>
 * @copyright  Copyright (c) 2013 - 2014, Marty Helmick
 * @link       https://github.com/m-e-h/directory
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


add_action( 'p2p_init', 'dept_to_doc_connection' );


function dept_to_doc_connection() {

    p2p_register_connection_type( array(
        'name' => 'departments_to_documents',
        'from' => 'department',
        'to' => 'document',
    ) );
}