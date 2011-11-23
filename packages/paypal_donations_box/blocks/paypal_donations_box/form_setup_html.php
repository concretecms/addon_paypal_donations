<? defined('C5_EXECUTE') or die(_("Access Denied.")); 

$includeAssetLibrary = true; 
$assetLibraryPassThru = array(
	'type' => 'image'
);
	$al = Loader::helper('concrete/asset_library');

$bf = null;

if ($bObj->donateButton_fID > 0) { 
	$bf = File::getByID($bObj->donateButton_fID);
}

?> 
<ul class="ccm-dialog-tabs" id="ccm-paypaldonations-tabs">
	<li class="ccm-nav-active"><a href="javascript:void(0)" id="ccm-paypaldonations-required"><?php echo t('Basic')?></a></li>
	<li><a href="javascript:void(0)" id="ccm-paypaldonations-optional"><?php echo t('Advanced')?></a></li>
</ul>

<div id="ccm-paypaldonations-required-tab"> 
	<div>
        <label><?=t('Paypal Account Email/Merchant ID')?>*</label>
        <input type="text" style="width:90%" name="paypal_user" id="paypal_user" value="<?=$bObj->paypal_user?>"/>
        <div class="ccm-note" style="margin-top:4px;">
            <?=t('Sign up for an account at')?>
            <a href="http://www.paypal.com" target="_blank">paypal.com</a>
        </div>
	</div>
    <div>
        <label><?=t('Item Name')?></label>
        <input type="text" style="width:90%" name="item_name" value="<?=$bObj->item_name?>"/>
    </div>
    <div>
        <label><?=t('Item Number')?></label>
        <input type="text" name="item_number" value="<?=$bObj->item_number?>"/>
    </div>    
</div>
<div id="ccm-paypaldonations-optional-tab" style="display:none">
	<div>
        <label><?=t('Title')?></label>
        <input type="text" name="title" style="width:90%" value="<?=$bObj->title?>"/>
        <div class="ccm-note" style="margin-bottom:4px; margin-top:4px;">
            <?=t('will appear above the donate button')?>
        </div>
    </div>
    <div style="float:left;">
        <label><?=t('Currency Code')?></label>
        <input type="text" name="currency_code" value="<?=$bObj->currency_code?>"/>
        <div class="ccm-note" style="margin-bottom:4px; margin-top:4px;">
        	<a href="https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes" target="_blank"><?=t('valid currency codes')?></a>
        </div>
    </div>
    <div style="float:left; margin-left: 10px;">
        <label><?=t('Currency Symbol')?></label>
        <input type="text" name="currency_symbol" value="<?=$bObj->currency_symbol?>" size="2"/>
    </div>
    <br style="clear:both" />
    <div>
        <label><?=t('Specify Amount(s)')?></label>
        <textarea name="amount"><?=$bObj->amount?></textarea>
        <div class="ccm-note" style="margin-bottom:4px; margin-top:4px;">
            <?=t('enter multiple ammounts on seperate lines, leave blank for any amount');?>
        </div>
    </div>
     
     <div>
        <label><?=t('Button Image')?></label>
        <?=$al->image('ccm-b-image', 'donateButton_fID', t('Choose Image'), $bf);?>
        <div class="ccm-note" style="margin-bottom:4px; margin-top:4px;">
            <?=t('leave blank for standard Paypal donate button')?>
        </div>
    </div>
     
     
     <div>
        <input type="checkbox" name="useSandbox" value="1" <?=($bObj->useSandbox?"checked=\"checked\"":"")?>/>
        <label style="display:inline"><?=t('Use Paypal Sandbox')?></label>
        <div class="ccm-note" style="margin-bottom:16px; margin-top:4px;">
            will post to use sandbox.paypal.com (for testing)
        </div>
    </div>
</div>


<!-- Tab Setup -->
<script type="text/javascript">
	var ccm_fpActiveTab = "ccm-paypaldonations-required";	
	$("#ccm-paypaldonations-tabs a").click(function() {
		$("li.ccm-nav-active").removeClass('ccm-nav-active');
		$("#" + ccm_fpActiveTab + "-tab").hide();
		ccm_fpActiveTab = $(this).attr('id');
		$(this).parent().addClass("ccm-nav-active");
		$("#" + ccm_fpActiveTab + "-tab").show();
	});
</script>