function imtst_full_quote(full, base_id){
	full_quote_id = '#full_quote-'+base_id;
	quote_id = '#'+base_id;
	read_more_id = '#read_more-'+base_id;
	read_less_id = '#read_less-'+base_id;
	if(full==1){
		//show full quote
		jQuery(full_quote_id).attr('class', 'imtst_quote_show');
		jQuery(read_less_id).css('display', 'block');
		jQuery(quote_id).attr('class', 'imtst_quote_hide');
		jQuery(read_more_id).css('display', 'none');
	}else{
		jQuery(full_quote_id).attr('class', 'imtst_quote_hide');
		jQuery(read_less_id).css('display', 'none');
		jQuery(quote_id).attr('class', 'imtst_quote_show');
		jQuery(read_more_id).css('display', 'block');		
	}
}
