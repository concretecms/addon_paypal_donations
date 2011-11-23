<?
defined('C5_EXECUTE') or die(_("Access Denied.")); 
?>
<style>
	.block-paypal-donations { text-align:center;}
	.block-paypal-donations div { margin-bottom:8px;}
	.block-paypal-donations label { display: inline;}
</style>
<div class="block-paypal-donations">
<form action="<?=$controller->paypal_url?>" method="post">
    <?=$controller->getTitle()?>
    <input type="hidden" name="business" value="<?=$controller->paypal_user?>">
    <input type="hidden" name="cmd" value="_donations">
    <?= $controller->getItemNameField() ?>
    <?= $controller->getItemNumberField() ?>
    <input type="hidden" name="currency_code" value="<?=$controller->currency_code?>">
    <?=$controller->getReturnUrlField()?>
    <!-- Display the payment button. -->
    <?=$controller->getAmountField(); ?>
    <div>
	<?=$controller->getSubmitButton(); ?>
    </div>
</form>
</div>