jQuery(document).ready(function($) {
    /*
     * Select/Upload image(s) event
     */
    jQuery('body').on('click', '.poka_upload_image_button', function(e){
        e.preventDefault();
            var gallery_name = jQuery(this).data("gallery-name");
            var has_label    = jQuery(this).hasClass("has_label");

            var button = jQuery(this),
                custom_uploader = wp.media({
            title: 'Upload/Add image', 
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Use this images' // button label text
            },
            multiple: true // for multiple image selection set to true
        }).on('select', function() { // it also has "open" and "close" events 

             // if you sen multiple to true, here is some code for getting the image IDs
            var attachments = custom_uploader.state().get('selection');
                // attachment_ids = new Array();
            var list_attachment = "";
            var attachment_ids = "";
            var i = button.prev().find("ul li.image").length;

            attachments.each(function(attachment) {
                if (attachment.attributes.sizes.thumbnail !== undefined) {
                    attachment_url = attachment.attributes.sizes.thumbnail.url;
                }else{
                    attachment_url = attachment.attributes.sizes.full.url;
                }

                if(has_label){
                    list_attachment += '<li class="image ui-sortable-handle" data-attachment_id="'+ attachment.id +'"><img style="max-width:100%;" src="'+ attachment_url +'" /><input type="hidden" value="'+attachment.id+'" name="'+ gallery_name +'['+i+'][id]"><input type="text" name="'+ gallery_name +'['+i+'][label]" class="attachment_label" placeholder="Label" value=""><input type="text" name="'+ gallery_name +'['+i+'][url]" class="link_redirect" placeholder="Redirect ..."><i title="Delete image" class="poka-btn-remove-image fa fa-times" aria-hidden="true"></i></li>';
                }else{
                    list_attachment += '<li class="image ui-sortable-handle" data-attachment_id="'+ attachment.id +'"><img style="max-width:100%;" src="'+ attachment_url +'" /><input type="hidden" value="'+attachment.id+'" name="'+ gallery_name +'['+i+'][id]"><input type="text" name="'+ gallery_name +'['+i+'][url]" class="link_redirect" placeholder="Redirect ..."><i title="Delete image" class="poka-btn-remove-image fa fa-times" aria-hidden="true"></i></li>';

                }
             
                i++;
            });  
            var attachment_ids_before = button.prev().find("ul").next().val();
            button.prev().find("ul").append(list_attachment).next().val(attachment_ids_before+attachment_ids);
        })
        .open();
    });

    /*
     * Remove image event
     */
    jQuery('body').on('click', '.poka-btn-remove-image', function(){
        jQuery(this).parent().remove();
    });
    
    if ( jQuery(".poka_images_container .sortable").length ) {
        jQuery( ".poka_images_container .sortable" ).sortable({
            placeholder: "ui-sortable-placeholder",
            update: function( event, ui ) {
                var attachment_ids_sort = "";
      
                jQuery(this).find(".ui-sortable-handle").each(function function_name(argument) {
                    attachment_ids_sort += jQuery(this).data("attachment_id")+",";
                });

                jQuery(this).next().val(attachment_ids_sort);
            }
        });
    }

});