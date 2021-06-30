/**
 * Performs tax calculations and loads tax rates
 *
 * @class NL_Tax, can be added to functions.php in your child theme.
 */
class NL_Tax {

	/**
	 * Shipping Tax calculation following Dutch tax rules
	 *
	 * @return float tax percentage
	 */

        public function Calculate_NL_Shipping_Tax()
        {
       		$total_price_nonstandard_tax = 0;
	   	$total_price_standard_tax = 0;

		$taxperc = 0.00;

		/* Scan cart-items */
							
		foreach ( WC()->cart->get_cart() as $cart_item ) {

   			$item_name = $cart_item['data']->get_title();
   			$quantity = $cart_item['quantity'];
			$price = $cart_item['data']->get_price();
			$tax_class = $cart_item['data']->get_tax_class();
			$taxrates = WC_Tax::get_rates($tax_class);
			
			/* Find taxrate current cart-item */

			for ($i = 0; $i < 10; $i++) {
    				$taxrate = $taxrates[$i][rate];
				if( $taxrate > 0 ) break;
			}
				
			/* Calculate tax amount current cart-item */
				
			$taxprice = $price * ( 100 / ( 100 + $taxrate )) * $quantity;
			
				
			/* Summarize tax price, split into standard and non-standard tax */
				
	   		if( $tax_class == "") { 
				$taxrate_standard = $taxrate;
				$total_price_standard_tax += $taxprice; 
			}
	   		else { 
				$taxrate_nonstandard = $taxrate;
				$total_price_nonstandard_tax += $taxprice;
			}
		}
				
		/* At this point taxrates are known for both standard and non-standard tax     */
		/* Shipping tax percentage can now be calculated using Dutch legislation rules */
			
		$taxperc = 	( $total_price_standard_tax / ( $total_price_standard_tax + $total_price_nonstandard_tax ) * $taxrate_standard ) + 
				( $total_price_nonstandard_tax / ( $total_price_standard_tax + $total_price_nonstandard_tax ) * $taxrate_nonstandard ); 
			
		return $taxperc;
	}
}
