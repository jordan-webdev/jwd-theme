<?php
/*
 * Login Form
 */

$text = get_field("sign_in_text");
?>

<form class="woocommerce-form woocommerce-form-login login" method="post">

	<h2 class="title">REGISTERED CUSTOMERS</h2>

	<p class="text"><?php echo esc_html($text); ?></p>

	<div class="inputs">
		<div class="field-wrap">
			<label for="username">
				Email
				<span class="required">*</span>
			</label>
			<input type="text" class="input" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
		</div>
		<div class="field-wrap">
			<label for="password">
				Password
				<span class="required">*</span>
			</label>
			<input class="input" type="password" name="password" id="password" />
		</div>
		<span class="required-msg">* Required Fields</span>
	</div>

	<?php //do_action( 'woocommerce_login_form' ); ?>

	<div class="sign-in-wrap">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="btn" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>">SIGN IN</button>
		<label class="remember">
			<input class="input-remember" name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<span class="remember-text">Remember me</span>
		</label>
		<a class="forgot-pass" href="<?php echo esc_url( wp_lostpassword_url() ); ?>?allow_access=true">Forgot Your Password?</a>
	</div>

</form>
