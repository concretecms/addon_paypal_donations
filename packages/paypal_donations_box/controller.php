<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class PaypalDonationsBoxPackage extends Package {

	protected $pkgHandle = 'paypal_donations_box';
	protected $appVersionRequired = '5.3.1';
	protected $pkgVersion = '1.0.1';
	
	public function getPackageDescription() {
		return t("Take paypal donations on your site.");
	}
	
	public function getPackageName() {
		return t("Paypal Donations Box");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('paypal_donations_box', $pkg);		
	}

}