<?php
/*
Plugin Name: EDD Custom Checkout Form
Plugin URI:
Description: Custom checkout form for EDD
Author: rajiv shakya
Author URI: 
Version: 1.2.9
License: GPLv2 or later

 */
class eddCustomCheckoutForm 
{
	
	public $bump = '';

	public static $_instance = null;

	public function __construct()
	{
		add_shortcode('CUSTOM-CHECKOUT-FORM', array($this, 'checkout_form'));

		add_action('wp_head', array($this, 'define_ajaxurl'));

		add_action('wp_ajax_submit_basic_info_checkout', array($this, 'submit_basic_info_checkout'));
        add_action('wp_ajax_nopriv_submit_basic_info_checkout', array($this, 'submit_basic_info_checkout'));

        add_action('edd_purchase_form_before_cc_form', array($this, 'checkout_bump'), 10, 1);

        add_action( 'admin_init', array($this, 'child_plugin_has_parent_plugin' ));



	}

	public function child_plugin_has_parent_plugin()
	{
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'edd-funneler/edd-funneler.php' ) ) {
		       add_action( 'admin_notices', array($this,'child_plugin_notice' ));

		       deactivate_plugins( plugin_basename( __FILE__ ) ); 

		       if ( isset( $_GET['activate'] ) ) {
		           unset( $_GET['activate'] );
		       }
		   }
	}

	function child_plugin_notice()
	{
       ?><div class="error"><p>Sorry, but this plugin requires WooFunneler plugin to work. Please install and activate WooFunneler plugin first</p></div><?php
	}

	public function checkout_bump()
	{
	    $cart = edd_get_cart_contents();
	    
	    echo $this->render('bump_item_table', array('bump' => $this->bump));
	}


	public function define_ajaxurl()
	{
		echo '<script type="text/javascript">
		       var ajaxurl = "' . admin_url('admin-ajax.php') . '";
		     </script>';
	}

	public function submit_basic_info_checkout()
	{
		$name = $_POST['fullname'];
		$email = $_POST['email'];
		$shipping_address = $_POST['shipping_address'];
		$state = $_POST['state'];
		$postal = $_POST['postal'];
		$country = $_POST['country'];


	}

	public function checkout_form($attrs)
	{
		if (!is_admin()) {
			$data = array();
			

			if(isset($attrs['bump_id']) && $attrs['bump_id']) {

				$this->bump = $attrs['bump_id'];

			}

			wp_enqueue_script('jquery');
			wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), 1.1 );

			wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '1.1', true );

			wp_enqueue_script('custom-checkout-form', plugins_url('assets/js/custom-checkout-form.js', __FILE__), array('jquery'),'1.1' );

			wp_enqueue_style('custom-checkout-form', plugins_url('assets/css/custom-checkout-form.css', __FILE__), array(), '1.1');

			return  $this->render('checkout_form_basic');	
		}
		
	}

	public static function render($view, $data = null)
    {
        // Handle data
        ($data) ? extract($data) : null;

        ob_start();
        include plugin_dir_path(__FILE__) . 'inc/' . $view . '.php';
        $view = ob_get_contents();
        ob_end_clean();

        return $view;
    }


}
new eddCustomCheckoutForm();


