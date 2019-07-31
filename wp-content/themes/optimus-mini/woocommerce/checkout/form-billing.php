<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-billing-fields">
	<?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()): ?>
        <header>
            <h3><?php esc_html_e('Billing &amp; Shipping', 'woocommerce');?></h3>
        </header>

	<?php else: ?>
        <header>
            <h3><?php esc_html_e('Billing details', 'woocommerce');?></h3>
        </header>

	<?php endif;?>

	<?php do_action('woocommerce_before_checkout_billing_form', $checkout);?>

    <div class="woocommerce-billing-fields__field-wrapper">

        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="billing_first_name">First name</label>
                    <input type="text" name="billing_first_name" id="billing_first_name" placeholder="First name">
                </div>
                <div class="field">
                    <label for="billing_last_name">Last name</label>
                    <input type="text" name="billing_last_name" id="billing_last_name" placeholder="Last name">
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="billing_phone">Phone</label>
                    <input type="text" name="billing_phone" id="billing_phone" placeholder="Phone">
                </div>

                <div class="field">
                    <label for="billing_email">Email address</label>
                    <input type="text" name="billing_email" id="billing_email" placeholder="Email address">
                </div>
            </div>

            <div class="two fields">
                <div class="field">
                    <label for="billing_city">City</label>
                    <input type="text" name="billing_city" id="billing_city" placeholder="City">
                </div>

                <div class="field">
                    <label for="billing_address">Delivery address</label>
                    <textarea name="billing_address" id="billing_address" placeholder="Delivery address"></textarea>
                </div>
            </div>
        </div>


    </div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout);?>
</div>

<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()): ?>
    <div class="woocommerce-account-fields">
		<?php if (!$checkout->is_registration_required()): ?>

            <p class="form-row form-row-wide create-account">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                           id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true);?>
                           type="checkbox" name="createaccount" value="1"/>
                    <span><?php esc_html_e('Create an account?', 'woocommerce');?></span>
                </label>
            </p>

		<?php endif;?>

		<?php do_action('woocommerce_before_checkout_registration_form', $checkout);?>

		<?php if ($checkout->get_checkout_fields('account')): ?>

            <div class="create-account">
				<?php foreach ($checkout->get_checkout_fields('account') as $key => $field): ?>
					<?php woocommerce_form_field($key, $field, $checkout->get_value($key));?>
				<?php endforeach;?>
                <div class="clear"></div>
            </div>

		<?php endif;?>

		<?php do_action('woocommerce_after_checkout_registration_form', $checkout);?>
    </div>
<?php endif;?>
