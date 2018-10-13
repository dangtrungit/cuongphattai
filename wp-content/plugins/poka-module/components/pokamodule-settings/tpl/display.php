<?php
	$msg = '';
	
	if(isset($_POST['action']) &&  $_POST['action'] == 'save_change'){
		if(!isset($_POST['name_of_nonce_field']) || !wp_verify_nonce($_POST['name_of_nonce_field'], 'poka-settings')){
		}else{
			if(isset($_POST['poka']) && is_array($_POST['poka'])){
			    foreach($_POST['poka'] as $key => $value){
			        if($key == 'phone'){
			            update_option('_poka_number_call', sanitize_text_field($value));
                    }
                }
				
				$msg = PMCommon::getMsgBE(array('Cập nhật thành công!'));
            }
		}
	}
	$call   = get_option( "_poka_number_call");
?>

<div class="wrap">
    <h1>Cài đặt</h1>
    <?php
        echo $msg;
    ?>
    <form method="post" action="">
        <table class="form-table poka-form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="phone">Số Điện Thoại</label>
                    </th>
                    <td>
                        <input name="poka[phone]" type="number" id="phone" value="<?php echo $call; ?>" class="regular-text">
                        <p class="description">Hiện thị số điện thoại ngoài FrontEnd</p>
                    </td>
                </tr>
            </tbody>
        </table>
	
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Lưu thay đổi">
	
	        <?php wp_nonce_field('poka-settings', 'name_of_nonce_field'); ?>
            <input type="hidden" name="action" value="save_change">
        </p>
    </form>
</div>
