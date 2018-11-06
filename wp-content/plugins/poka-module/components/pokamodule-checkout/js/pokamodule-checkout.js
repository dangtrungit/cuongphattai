jQuery(document).ready(function($) {
	jQuery("body").on('click', '.field_gender >label, .field_choose_address >label', function(event) {
		event.preventDefault();
		/* Act on the event */
		var choose =  jQuery(this).data("choose-value");

		jQuery(this).closest(".field").find(".choose").removeClass('choose');
		jQuery(this).addClass('choose').closest(".field").find("input").val(choose);
	});

  if (jQuery("#province").length) {
      jQuery("#province").dropdown({
        forceSelection: false,
      });
  }

  // ----
  jQuery("body").on('click', '.textcode', function(event) {
  	event.preventDefault();
  	/* Act on the event */
      jQuery(".inputcode").toggle();
  });

  jQuery("body").on('change', '#province', function(event) {
    event.preventDefault();
    /* Act on the event */
      var province = jQuery(this).val();
    
      jQuery.ajax({
      url: MyAjax.ajaxurl + "pokamodule_ajax",
      type: 'post',
          data: {
              page          : "pokamodule-checkout",
              task          : "calculate-shipping",
              province      : province,
          },
      success: function(data) {
        if ( data == "EMPTY_CART") { location.reload(); }
        jQuery("body").trigger('update_checkout');
       }
     });
  });

  // ----
  jQuery("body").on('click', '.listorder .col_img button', function(event) {
  	event.preventDefault();
  	/* Act on the event */
    var product_id = jQuery(this).data("product-id");
    if (!confirm("Bạn có muốn bỏ Sản phẩm này khỏi giỏ hàng không ?")) {return;}

    jQuery.ajax({
      url: MyAjax.ajaxurl + "pokamodule_ajax",
      type: 'post',
          data: {
              page          : "pokamodule-checkout",
              task          : "delete-product",
              product_id    : product_id,
          },
      success: function(data) {
        location.reload(); 
      } 
    });
  });

  jQuery("body").on('click', '.choosenumber>div', function(event) {
   	var $abate     = jQuery(this).parent().find(".abate");
   	var $augment   = jQuery(this).parent().find(".augment");
   	var $number    = jQuery(this).parent().find(".number");
   	var quantity   = parseInt($number.text());
   	var product_id = $number.data("product-id");
   	
   	if (jQuery(this).hasClass("augment")) {
   		$number.text(quantity+1);
   	}

   	if (jQuery(this).hasClass("abate")  && quantity > 1 ) {
   		$number.text(quantity-1);
   	}

   	quantity_success = parseInt($number.text());
   	if ( quantity_success > 1 || !$abate.hasClass('active') ) {
      $abate.addClass('active');
   	}else{
   		 $abate.removeClass('active');
   	}
   	update_quantity(product_id, quantity_success);
  });

  jQuery("#orderform").submit(function(event) {
    /* Act on the event */
    event.preventDefault()
  });

  jQuery('#orderform')
    .form({
      fields: {
        name           : 'empty',
        chosse_gender  : 'empty',
        phonenumbers   : 'empty',
        order_email    : 'empty',
        province       : 'empty'
      }
    });
        
  jQuery("body").on('click', '#create_order', function(event) {
    var $this = jQuery(this);
    jQuery('#orderform').submit();

    if (jQuery("#orderform .field.error").length) { return; }
    if (jQuery(this).hasClass('doing')) {return;}

    jQuery('#wrap_cart .dimmer').dimmer('show');
    jQuery(this).addClass("doing");
  
    jQuery.ajax({
      url : MyAjax.ajaxurl + "pokamodule_ajax",
      type: 'post',
          data: {
              page          : "pokamodule-checkout",
              task          : "create-order",
              fdata         : jQuery("#orderform").serialize(),
          },
      success: function(data) {
        if ( data == "EMPTY_CART") { location.reload(); }

        $this.removeClass("doing");
        jQuery('#wrap_cart .dimmer').dimmer('hide');
        window.location.href = "?checkout=complete";
       }
    });
  });

  jQuery("body").on('click', '.inputcode button', function(event) {
    if ( !jQuery("#CouponCode").val() ) {
      jQuery("#CouponCode").addClass("error");
      return
    }
    var coupon_code = jQuery("#CouponCode").val();

    jQuery.ajax({
      url: MyAjax.ajaxurl + "pokamodule_ajax",
      type: 'post',
          data: {
              page          : "pokamodule-checkout",
              task          : "apply-coupon",
              coupon_code   : coupon_code,
          },
      success: function(data) {
        // console.log(data);
        if ( data == "EMPTY_CART") { location.reload(); }

        aData = data.split("|");
        if(aData[0]){
          jQuery(".area_total .total").html(aData[0]);
        }
        jQuery(".message").html(aData[1]);
       }
    });
   });


});

function update_quantity(product_id, quantity) {
	jQuery.ajax({
    url: MyAjax.ajaxurl + "pokamodule_ajax",
    type: 'post',
        data: {
            page          : "pokamodule-checkout",
            task          : "update-product",
            product_id    : product_id,
            quantity      : quantity,
        },
    success: function(data) {
    	if ( data == "EMPTY_CART") { location.reload(); }
      jQuery(".area_total .total").html(data);

     }
  });
}