<?php

class Lipa_Na_Mpesa extends WC_Payment_Gateway {



  function __construct(){
    $this->id = 'lipa_na_mpesa';
    $this->method_title = __('Lipa Na Mpesa', 'lipa_na_mpesa');
    $this->method_description = __( 'Lipa na Mpesa STK Push', 'lipa_na_mpesa');
    $this->title = __('Lipa Na Mpesa', 'lipa_na_mpesa');
    $this->has_fields = true;
    $this->icon = null;
    $this->supports = array('lipa_na_mpesa_form');
    $this->init_form_fields();

    $this->init_settings();

    // Get settings.
		$this->title              = $this->get_option( 'title' );
		$this->description        = $this->get_option( 'description' );
    $this->enabled        = $this->get_option( 'enabled' );
    $this->consumer_key        = $this->get_option( 'consumer_key' );
    $this->consumer_secret        = $this->get_option( 'consumer_secret' );
    $this->call_back_url        = $this->get_option( 'call_back_url' );
    $this->environment        = $this->get_option( 'environment' );
    $this->business_short_code = $this->get_option( 'business_short_code' );
    $this->passkey        = $this->get_option( 'passkey' );
    $this->countries  = $this->get_option('countries');

    add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );


  }

  public function init_form_fields(){
    global $woocommerce;
    $countries_obj   = new WC_Countries();
    $countries   = $countries_obj->__get('countries');

    $this->form_fields = array (
      'enabled' => array(
        'title' => __('Enable/Disable', 'lipa_na_mpesa'),
        'label' => __('Enable this payment gateway', 'lipa_na_mpesa'),
        'type' => 'checkbox',
        'default' => 'yes'
      ),
      'title' => array(
        'title'    => __( 'Title', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'desc_tip'  => __( 'Payment title of checkout process.', 'lipa_na_mpesa' ),
        'default'  => __( 'Lipa Na Mpesa', 'lipa_na_mpesa' ),
      ),
      'description' => array(
        'title'    => __( 'Description', 'lipa_na_mpesa' ),
        'type'    => 'textarea',
        'desc_tip'  => __( 'Payment description of checkout process.', 'lipa_na_mpesa' ),
        'default'  => __( 'Lipa Na Mpesa STK Push', 'lipa_na_mpesa' ),
        'css'    => 'max-width:450px;'
      ),
      'business_short_code' => array(
        'title'    => __( 'Business Short Code', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'desc_tip'  => __( 'The organization shortcode used to receive the transaction', 'lipa_na_mpesa' ),
      ),
      'passkey' => array(
        'title'    => __( 'Passkey', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'desc_tip'  => __( 'The set passkey', 'lipa_na_mpesa' ),
      ),
      'consumer_key' => array(
        'title'    => __( 'Consumer Key', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'desc_tip'  => __( 'Mpesa consumer key', 'lipa_na_mpesa' ),
      ),
      'consumer_secret' => array(
        'title'    => __( 'Consumer Secret', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'desc_tip'  => __( 'Mpesa consumer secret', 'lipa_na_mpesa' ),
      ),
      'call_back_url' => array(
        'title'    => __( 'Callback Url', 'lipa_na_mpesa' ),
        'type'    => 'text',
        'disabled' => true,
        'desc_tip'  => __( 'Payment title of checkout process.', 'lipa_na_mpesa' ),
        'default'  => __( site_url('/wp-json/mpesa/v1/payment_callback'), 'lipa_na_mpesa' ),
      ),
      'environment' => array(
        'title'    => __( 'Environment', 'lipa_na_mpesa' ),
        'type'    => 'select',
        'label' => 'Application environment (TEST/LIVE)',
        'desc_tip'  => __( 'The application environment', 'lipa_na_mpesa' ),
        'options' => array (
          'blank' => __('choose environemnt type', 'lipa_na_mpesa'),
          'LIVE' => __('LIVE', 'lipa_na_mpesa'),
          'TEST' => __('TEST', 'lipa_na_mpesa'),
        ),
      ),
    );
  }


  public function payment_fields() {


	// ok, let's display some description before the payment form
	if ( $this->description ) {
		// you can instructions for test mode, I mean test card numbers etc.
		if ( $this->environment == 'TEST' ) {
			$this->description .= ' | TEST MODE ENABLED. In test mode, your payments will be reversed at midnight</a>.';
			$this->description  = trim( $this->description );
		}
		// display the description with <p> tags etc.
		echo wpautop( wp_kses_post( $this->description ) );
	}

  $customer_id = get_current_user_id();

	// I will echo() the form, but you can close PHP tags and print it directly in HTML
	//echo '<fieldset id="wc-' . esc_attr( $this->id ) . 'payment-form" class="wc-payment-form" style="background:transparent;">';

	// Add this action hook if you want your custom payment gateway to support it
	do_action( 'lipa_na_mpesa_form_start', $this->id );

	// I recommend to use inique IDs, because other gateways could already use #ccNo, #expdate, #cvc
	echo '<div class="form-row form-row-first wc-payment-form"><label>Mpesa Phone Number <span class="required">*</span></label>
		<input id="mpesa_phone_number" name="mpesa_phone_number" type="text" autocomplete="off" value="'. get_user_meta( $customer_id, 'billing_phone', true ) .'">
		</div>';

	do_action( 'lipa_na_mpesa_form_end', $this->id );

	//echo '<div class="clear"></div></fieldset>';

}


public function process_payment($order_id){
  global $woocommerce;
  global $wp_json;
  global $wpdb;

  $customer_order = new WC_Order( $order_id );


  $credentials = base64_encode($this->consumer_key.':'.$this->consumer_secret);
  $res = wp_remote_get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials', array(
    'headers' => array(
        'Authorization' => 'Basic ' . $credentials
    ),
  ));

  $data = json_decode($res['body'], true);

  $access_token = $data['access_token'];

  $phone_number = preg_replace('/^0/','254',$_POST['mpesa_phone_number']);
  $password = base64_encode($this->business_short_code . $this->passkey . date('YmdHis'));

  $payload = array(
    'BusinessShortCode' => $this->business_short_code,
    'Password' => $password,
    'Timestamp' => date('YmdHis'),
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => (int) $customer_order->order_total,
    'PartyA' => $phone_number,
    'PartyB' => $this->business_short_code,
    'PhoneNumber' => $phone_number,
    'CallBackURL' => $this->call_back_url,
    'AccountReference' => $customer_order->get_order_number(),
    'TransactionDesc' => 'Test Transaction '
  );



  // Send this payload to Safaricom for processing
    $response = wp_remote_post( 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', array(
      'method'    => 'POST',
      'headers' => array(
          'Authorization' => 'Bearer ' . $access_token,
          'Content-Type' => 'application/json'
      ),
      'body'      => json_encode($payload),
      'timeout'   => 90,
      'sslverify' => false,
    ) );


    if ( is_wp_error( $response ) )
      throw new Exception( __( 'Encountered an error while processing payment. Sorry for the inconvenience.', 'lipa_na_mpesa' ) );
    if ( empty( $response['body'] ) )
      throw new Exception( __( 'Mpesa\'s Response could not get any data.', 'lipa_na_mpesa' ) );

      $resp = json_decode($response['body'], true);

      $CheckoutReqID = $resp['CheckoutRequestID'];
      $MerchantReqID = $resp['MerchantRequestID'];

      //insert into mpesa-payments table
      $table_name = $wpdb->prefix . 'lipa_na_mpesa_payments';
      $wpdb->query("INSERT INTO $table_name(order_id, merchant_request_id, checkout_request_id) VALUES('$order_id','$MerchantReqID','$CheckoutReqID')");


      // Mark as on-hold (we're awaiting the cheque)
    $customer_order->update_status('on-hold', __( 'Awaiting payment verification', 'woocommerce' ));

    // Reduce stock levels
    //$customer_order->reduce_order_stock();

    // Remove cart

    $woocommerce->cart->empty_cart();

    // Return thankyou redirect
    return array(
        'result' => 'success',
        'redirect' => $this->get_return_url( $customer_order )
    );




}


}
