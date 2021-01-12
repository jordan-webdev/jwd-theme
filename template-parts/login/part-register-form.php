<?php
/*
 * Registration Form
 */
$register = get_field("register");
$text_1 = $register['text_1'];
$text_2 = $register['text_2'];
?>

<form method="post" class="register">

	<h2 class="title">NEW CUSTOMERS</h2>

	<p class="text"><?php echo esc_html($text_1); ?></p>

	<div class="inputs">
		<div class="field-wrap">
			<label for="reg_email">
				Email address
				<span class="required">*</span>
			</label>
			<input type="email" class="input" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
		</div>
		<div class="field-wrap">
			<label for="reg_password">
				Password
				<span class="required">*</span>
			</label>
			<input type="password" class="input" name="password" id="reg_password" />
		</div>
		<span class="required-msg">* Required Fields</span>
	</div>


	<div class="create-account-wrap">
		<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
		<button type="submit" class="btn create-account" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">REGISTER</button>
	</div>

	<p class="text"><?php echo esc_html($text_2); ?></p>

	<a class="btn" href="<?php echo wc_get_checkout_url(); ?>">GUEST CHECKOUT</a>

</form>
