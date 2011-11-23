<?
	defined('C5_EXECUTE') or die(_("Access Denied."));
	Loader::block('library_file');
	class PaypalDonationsBoxBlockController extends BlockController {
		
		var $pobj;
		 
		protected $btTable = 'btPaypalDonationsBox';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "300";
		
		
		public $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		public $paypal_url_sandbox = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		
		public $paypal_user = '';
		public $useSandbox = 0; 
		public $currency_code = 'USD';
		public $currency_symbol = '$';
		
		
		function __construct($obj = null) {		
			parent::__construct($obj);	 
			if($this->useSandbox) {
				$this->paypal_url = $this->paypal_url_sandbox;
			}
		}
		
		/** 
		 * Used for localization. If we want to localize the name/description we have to include this
		 */
		public function getBlockTypeDescription() {
			return t("Take paypal donations on your site.");
		}
		
		public function getBlockTypeName() {
			return t("Paypal Donations Box");
		}
		
		public function getJavaScriptStrings() {
			return array('paypal-email-required' => t('Paypal Account Email/Merchant ID is required'));
		}
		
		public function getAmountField() {
			if(strlen($this->amount)) {
				$amounts = explode('<br />',nl2br($this->amount));
				if(is_array($amounts) && count($amounts) > 1) {
					$select = '<select name="amount">';
						foreach($amounts as $v) {
							if(is_numeric($v)) {
								$select.='<option value="'.number_format($v,2).'">'.$this->currency_symbol.number_format($v,2).'</option>';
							} else {
								$select.='<option value="">'.$v.'</option>';
							}
						}
					$select .="</select>";
					
					
					return '<div><label>'.t('Amount')."</label> ". $select .'</div>';
				} else {
					if(is_numeric($amounts[0])) {
						return '<input type="hidden" name="amount" value="'.number_format($amounts[0],2).'"/>';
					}
				}			
			}
			return '';
		}		
		
		public function getTitle() {
			if(strlen($this->title)) {
				return "<h3>".$this->title."</h3>";
			} else {
				return "";
			}
		}
		
		public function getSubmitButton() {
			if(is_numeric($this->donateButton_fID) && $this->donateButton_fID > 0) {
				$fo = File::getByID($this->donateButton_fID);
				if($fo) {
					return '<input type="image" name="submit" border="0"
					src="'.$fo->getRelativePath().'"
					alt="PayPal - The safer, easier way to pay online">';
				}
			} 
			return '<input type="image" name="submit" border="0"
					src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif"
					alt="PayPal - The safer, easier way to pay online">';
			
		}
		
		public function getItemNameField() {
			if(strlen($this->item_name)) {
				return '<input type="hidden" name="item_name" value="'.$this->item_name.'">';
			} else { 
				return '';
			}
		}
		
		
		public function getItemNumberField() {
			if(strlen($this->item_number)) {
				return '<input type="hidden" name="item_number" value="'.$this->item_number.'">';
			} else {
				return '';
			}
		}
		
		public function getReturnUrlField() {
			global $c;
			return '<input type="hidden" name="return" value="'.BASE_URL.View::url($c->getCollectionPath()).'"/>';
		}
		
	
		public function save($data) {
			if($data['useSandbox']) {
				$data['useSandbox'] = 1;
			} else {
				$data['useSandbox'] = 0;
			}
			parent::save($data);
		}
	
	}
	
?>