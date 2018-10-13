<?php
	if(is_admin()){
		require_once "poka-backend.php";
	}else{
		require_once "poka-frontend.php";
	}
	