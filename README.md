# Woocommerce-Shipping-Tax-Netherlands-Dutch-
This project provides a simple solution to calculate shipping tax corresponding Dutch legislation.

For background information have a look at https://wordpress.org/support/topic/no-right-method-for-shipping-tax-in-the-netherlands/#post-14602764
This solution can be used as a basic solution and needs or maybe configured to suit specific situations.

In short the situation is as follow:
Woocommerce provides a setting shipping tax class based on cart items. Using this default setting it will charge the highest tax rate when there are multiple products in the cart with different tax rates. 
Dutch legislation is based upon other rules. When the cart items have different tax rates, the shipping tax needs to be calculated by means of a weighted average. 

The solution described in this project is composed of a calculation function based upon two and only two tax rates (standard and non-standard). 
The function can be placed within functions.php of your child theme and will be executed from the Woocommerce core file class-wc-tax.php (located in /wp-content/plugins/woocommerce/includes).

The call looks like this: $taxrate = NL_Tax::Calculate_NL_Shipping_Tax();  /* Tax calculation shipping for The Netherlands */ and is added just before the line
return $matched_tax_rates; (line 635 - 638 Woocommerce version 5.4.1 ).

Shortcoming of this solution: After every Woocommerce update, class-wc-tax.php needs to be changed.

The following files have been added to this project:
README.md
class-wc-tax.php
Calculate_NL_Shipping_Tax.php
Shipping Tax calculation NL.xlsx (to check the outcome)
