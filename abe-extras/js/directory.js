(function($){
	$(document).ready(function(){
		$('#address_group_repeat').hide(),
		$('.cmb2-id--doc-prefix').hide(),
		$('.cmb2-id--doc-suffix').hide(),
		$('#ppl_orders').hide();

		$("input[type=radio]").bind("change",function(){

		//lets add the interactivity by adding an event listener

		//make sure that these metaboxes appear properly in profession edit screen
		if ($('#in-contact_type-2').is(':checked')) //laity
			$('#address_group_repeat').hide(),
			$('.cmb2-id--doc-prefix').hide(),
			$('.cmb2-id--doc-suffix').hide(),
			$('#ppl_orders').hide();
		if ($('#in-contact_type-3').is(':checked')) //bishop
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-4').is(':checked')) //priest
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-5').is(':checked')) //advocate
			$('#address_group_repeat').hide(),
			$('.cmb2-id--doc-prefix').hide(),
			$('.cmb2-id--doc-suffix').hide(),
			$('#ppl_orders').hide();
		if ($('#in-contact_type-6').is(':checked')) //deacon
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-7').is(':checked')) //permDeacon
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-10').is(':checked')) //brother
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-11').is(':checked')) //Order Priest
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-11').is(':checked')) //Seminarian
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();
		if ($('#in-contact_type-11').is(':checked')) //Sister
			$('#address_group_repeat').show(),
			$('.cmb2-id--doc-prefix').show(),
			$('.cmb2-id--doc-suffix').show(),
			$('#ppl_orders').show();


        });
        })
})(jQuery);


   //          	array(
			// 		'name'    	=> __( 'Contact Type', 'cmb2' ),
			// 		'id'      	=> $prefix . 'contact_type',
			// 		'type'   	=> 'select',
			// 		'options' 	=> array(
			// 				'bishop'			=> __( 'Bishop', 'cmb2' ),
			// 				'priest'   			=> __( 'Priest', 'cmb2' ),
			// 				'deacon'  			=> __( 'Deacon', 'cmb2' ),
			// 				'sister' 			=> __( 'Sister', 'cmb2' ),
			// 				'laity'   			=> __( 'Laity', 'cmb2' ),
			// 				'permanent-deacon'	=> __( 'Permanent Deacon', 'cmb2' ),
			// 				'brother' 			=> __( 'Brother', 'cmb2' ),
			// 				'seminarian'   		=> __( 'Seminarian', 'cmb2' ),
			// 				'order-priest'     	=> __( 'Order Priest', 'cmb2' ),
			// 				'advocate'     		=> __( 'Advocate', 'cmb2' ),
			// 				'other'     		=> __( 'Other', 'cmb2' ),
			// 	),
			// ),