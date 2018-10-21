function open_media_up(target, target_src){
    tb_show('', 'media-upload.php?type=image&post_id=1&TB_iframe=true&flash=0');
        window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            jQuery(target).val(imgurl);
            jQuery(target_src).attr('src', attachment.url);
            tb_remove();
    };
    return false;
}