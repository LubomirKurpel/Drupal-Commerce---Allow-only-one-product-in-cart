# Drupal Commerce - Allow only one product in cart

## What does this module do?
A simple module registering event subscriber which reacts to add to cart event removing all the products from cart and placing only newly added product into the cart in a quantity of 1. 

This might be useful for single-product websites or subscription-based websites where this functionality is desired.

## Requirements
- Drupal Commerce
- Drupal 8 / 9 (not tested in 9 but it should work)

## Installation
To install this module you will want to put the source in the [appropriate directory](https://www.drupal.org/docs/8/extending-drupal-8/installing-modules#mod_location).
After you have placed the module there, simply enable it as you would any other module.

## Configuring
No configuration is needed. Simply enabling the module and clearing the cache should do the trick. Module does no change to database tables so removing the module is done by uninstalling and deleting the folder. Easy as that.
