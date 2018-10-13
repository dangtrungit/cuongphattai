jQuery(document).ready(function() {
	jQuery(".btn").click(function(event) {
		var show_textarea = jQuery(this).attr('show_textarea');
		jQuery(".btn-success").removeClass("btn-success");
		jQuery(this).addClass("btn-success");

		jQuery(".edit-metascript").hide();
		jQuery("."+show_textarea).show();
	});

	jQuery(".btn-submit").click(function(event) {
		jQuery.ajax({
			url: MyAjax.ajaxurl + "pokamodule_ajax",
			type: 'post',
	          	data: {  
	          		f_data       : jQuery("#f_meta_script").serialize(),
	           		page         : "pokamodule-metascript",
	            	task         : "save_change" 
	        	},
			success: function(data) {
				jQuery(".success-area").text("Cập nhật thành công !").stop().fadeIn("slow").delay(6000).fadeOut("slow");
	   			jQuery('html, body').animate({
			        	scrollTop: jQuery(".success-area").offset().top - 150
			    	}, 1000);
			}
	   	});
	});
});