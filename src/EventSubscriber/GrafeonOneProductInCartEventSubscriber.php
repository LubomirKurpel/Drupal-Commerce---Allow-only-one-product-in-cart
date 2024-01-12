<?php

namespace Drupal\grafeon_one_product_in_cart\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\commerce_cart\Event\CartEntityAddEvent;
use Drupal\commerce_cart\Event\CartEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class EntityTypeSubscriber.
 *
 * @package Drupal\custom_events\EventSubscriber
 */
class GrafeonOneProductInCartEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   *
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents() {
	$events = array();
    $events['commerce_cart.entity.add'][] = array('onProductAdded');
    return $events;
  }
  
	/**
	 * Sets quantity to 1 and ensures only one product in the cart.
	 *
	 * @param \Drupal\commerce_cart\Event\CartEntityAddEvent $event
	 *   The cart event.
	 */
	public function onProductAdded(CartEntityAddEvent $event) {
	  // We only want 1 quantity.
	  $cart = $event->getCart();
	  $added_order_item = $event->getOrderItem();
	  $cart_items = $cart->getItems();
	  foreach ($cart_items as $cart_item) {
		if ($cart_item->id() != $added_order_item->id()) {
		  $cart->removeItem($cart_item);
		  $cart_item->delete();
		}
	  }

	  $quantity = $cart_items[0]->getQuantity();
	  if ($quantity > 1) {
		$cart_items[0]->setQuantity(1);
	  }

	  $cart->save();
	}

}