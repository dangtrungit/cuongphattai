<?php
$productID = $obj->ID;
$video = get_post_meta($productID, 'video', true);


?>
<table class="form-table">

	<tbody>
    <tr>

        <th scope="row"><label for="poka-like">Video hướng dẫn sử dụng</label></th>

        <td>

            <?php

            $content = $video   = get_post_meta($productID, 'video', true);//$post->post_content;

            $editor_id = 'video';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
	</tbody>
</table>
<?php
$productID = $obj->ID;
$luuy = get_post_meta($productID, 'luuy', true);


?>
<table class="form-table">

    <tbody>
    <tr>

        <th scope="row"><label for="poka-like">Những điểm cần lưu ý</label></th>

        <td>

            <?php

            $content = $luuy   = get_post_meta($productID, 'luuy', true);//$post->post_content;

            $editor_id = 'luuy';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
    </tbody>
</table>
<!------->
<?php
$productID = $obj->ID;
$luuy = get_post_meta($productID, 'luuy', true);


?>
<table class="form-table">

    <tbody>
    <tr>

        <th scope="row"><label for="poka-like">Những điểm cần lưu ý</label></th>

        <td>

            <?php

            $content = $luuy   = get_post_meta($productID, 'luuy', true);//$post->post_content;

            $editor_id = 'luuy';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
    </tbody>
</table>
<!-------------->
<?php
$productID = $obj->ID;
$luuy = get_post_meta($productID, 'luuy', true);

?>
<table class="form-table">

    <tbody>
    <tr>

        <th scope="row"><label for="poka-like">Những điểm cần lưu ý</label></th>

        <td>

            <?php

            $content = $luuy   = get_post_meta($productID, 'luuy', true);//$post->post_content;

            $editor_id = 'luuy';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
    </tbody>
</table>
<!-------------->
<?php
$productID = $obj->ID;
$luuy = get_post_meta($productID, 'luuy', true);


?>
<table class="form-table">

    <tbody>
    <tr>

        <th scope="row"><label for="poka-like">Những điểm cần lưu ý</label></th>

        <td>

            <?php

            $content = $luuy   = get_post_meta($productID, 'luuy', true);//$post->post_content;

            $editor_id = 'luuy';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
    </tbody>
</table>
<!-------------->
<?php
$productID = $obj->ID;
$luuy = get_post_meta($productID, 'luuy', true);
?>
<table class="form-table">

    <tbody>
    <tr>

        <th scope="row"><label for="poka-like">Những điểm cần lưu ý</label></th>

        <td>

            <?php

            $content = $luuy   = get_post_meta($productID, 'luuy', true);//$post->post_content;

            $editor_id = 'luuy';

            $settings =   array(

                'wpautop' => true, //Whether to use wpautop for adding in paragraphs. Note that the paragraphs are added automatically when wpautop is false.

                'media_buttons' => true, //Whether to display media insert/upload buttons

                'textarea_name' => $editor_id, // The name assigned to the generated textarea and passed parameter when the form is submitted.

                'textarea_rows' => get_option('default_post_edit_rows', 10), // The number of rows to display for the textarea

                'tabindex' => '', //The tabindex value used for the form field

                'editor_css' => '', // Additional CSS styling applied for both visual and HTML editors buttons, needs to include <style> tags, can use "scoped"

                'editor_class' => '', // Any extra CSS Classes to append to the Editor textarea

                'teeny' => false, // Whether to output the minimal editor configuration used in PressThis

                'dfw' => false, // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)

                'tinymce' => true, // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array

                'quicktags' => true, // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.

                'drag_drop_upload' => true //Enable Drag & Drop Upload Support (since WordPress 3.9)

            );

            wp_editor( $content, $editor_id, $settings );



            ?>

        </td>

    </tr>
    </tbody>
</table>