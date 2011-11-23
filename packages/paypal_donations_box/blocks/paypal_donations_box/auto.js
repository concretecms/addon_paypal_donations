// JavaScript Document

var paypal_donationsBlock ={

	validate:function(){
		var failed=0; 
		
		var val = $('#paypal_user').val();
		if(!val || val.length==0){
			alert(ccm_t('paypal-email-required'));
			$('#paypal_user').focus();
			failed=1;
		}
		
		if(failed){
			ccm_isBlockError=1;
			return false;
		}
		return true;
	} 
}

ccmValidateBlockForm = function() { return paypal_donationsBlock.validate(); }