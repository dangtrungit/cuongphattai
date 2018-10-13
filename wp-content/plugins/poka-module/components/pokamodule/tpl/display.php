<?php
	$page = $this->sPage ;
	
	$msg = '';
	if(isset($_GET['msg']) && $_GET['msg'] == 1){
		$msg = PMCommon::getMsgBE(array('Xóa sản phẩm thành công!'));
    }
?>
<div class="wrap">
    <?php
        echo $msg;
    ?>
	<h2>Danh sách</h2>
	<form action="" method="post" name="<?php echo $page;?>" id="<?php echo $page;?>">
	</form>
</div>