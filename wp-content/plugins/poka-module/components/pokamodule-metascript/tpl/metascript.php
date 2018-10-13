<?php
	$meta_script_head   = get_option( "meta_script_head");
	$meta_script_footer = get_option( "meta_script_footer");
?>

<div class="wrap">
    <h3><i class="fa fa-code" aria-hidden="true"></i> Cập nhật mã CSS & JS Frontend</h3>
    <div class="success-area" style="display: none"></div>
    
    <div class="btn-redirect">
        <span class="btn btn-blue btn-success" show_textarea="location-head" location="0">Header</span>
        <span class="btn btn-blue" show_textarea="location-footer" location="1">Footer</span>
    </div>

    <div class="box-edit">
        <form id="f_meta_script">
            <textarea class="edit-metascript location-head" rows="20" name="location-head"><?php echo $meta_script_head ?></textarea>
            <textarea class="edit-metascript location-footer" rows="20" name="location-footer"><?php echo $meta_script_footer ?></textarea>
        </form>
    </div>
    
    <a class="btn-submit">Lưu</a>
</div>
