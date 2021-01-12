<?php
/*
 * List of Cart Items that can be modified
 */

$cart = WC()->cart;
?>

<div class="details">
  <span class="list-count">
    <span class="count-number"><?php echo $cart->get_cart_contents_count(); ?></span>
    <span class="count-text"> items</span>
   </span>
  <div class="subtotal-wrapper">
    <span class="subtotal-text">Cart Subtotal:</span>
    <div class="subtotal-amount">
      <?php echo $cart->get_cart_subtotal(); ?>
    </div>
  </div>
</div>

<form class="" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

  <ul class="c-list">
    <?php  foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
      $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
    ?>
      <li class="c-item">
        <div class="thumb-wrap">
          <?php echo get_the_post_thumbnail( $product_id, "full", array("class" => "thumb") ); ?>
        </div>

        <div class="content">
          <div class="labels">
            <h2 class="title"><?php echo get_the_title($product_id); ?></h2>
            <span class="price">
              <?php
                echo apply_filters( 'woocommerce_cart_item_price', $cart->get_product_price( $_product ), $cart_item, $cart_item_key );
              ?>
            </span>
          </div>
          <div class="options">
            <div class="update">
              <span class="update-text">Qty:</span>
              <!-- Quantity Box -->
              <?php
                $product_quantity = woocommerce_quantity_input( array(
                  'input_name'    => "cart[{$cart_item_key}][qty]",
                  'input_value'   => $cart_item['quantity'],
                  'max_value'     => $_product->get_max_purchase_quantity(),
                  'min_value'     => '0',
                  'product_name'  => $_product->get_name(),
                ), $_product, false );

                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
              ?>
              <!-- Update Button -->
              <button class="update-btn" type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
              <input type="hidden" name="update_cart" value="<?php echo $product_id; ?>">
            </div>
            <div class="delete">
              <?php
								// @codingStandardsIgnoreLine
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="fa fa-trash" aria-hidden="true"></span></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

  <?php do_action( 'woocommerce_cart_actions' ); ?>

  <?php wp_nonce_field( 'woocommerce-cart' ); ?>
</form>

<div class="btns">
  <a class="btn checkout" href="<?php echo wc_get_checkout_url(); ?>">CHECKOUT NOW</a>
  <a class="btn btn--secondary view-edit" href="<?php echo wc_get_cart_url(); ?>">VIEW AND EDIT CART</a>
</div>
