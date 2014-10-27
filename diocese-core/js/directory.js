(function($){
	$(document).ready(function(){
		$("#address_group_repeat").hide();

		//lets add the interactivity by adding an event listener
		$("#_doc_contact_type_select").bind("change",function(){
			if ($(this).val()=="laity"){
				// photographer
				$("#address_group_repeat").hide();
			}else if ($(this).val()=="advocate"){
				//programmer
				$("#address_group_repeat").hide();
			} else {
				//still confused, hasn't selected any
				$("#address_group_repeat").show();
			}
		});

		//make sure that these metaboxes appear properly in profession edit screen
		if($("#_doc_contact_type_select").val()=="deacon") //photographer
			$("#address_group_repeat").show();
		else if ($("#_doc_contact_type_select").val()=="permanent-deacon") //programmer
			$("#address_group_repeat").show();

	})
})(jQuery);
