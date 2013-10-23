<?php
class CartComponent extends Component {

//////////////////////////////////////////////////

	public $components = array('Session');

//////////////////////////////////////////////////

	public $controller;

//////////////////////////////////////////////////

	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->controller = $collection->getController();
		parent::__construct($collection, array_merge($this->settings, (array)$settings));
	}

//////////////////////////////////////////////////

	public function startup(Controller $controller) {
		//$this->controller = $controller;
	}

//////////////////////////////////////////////////

	public $maxQuantity = 99;

//////////////////////////////////////////////////

	public function add($id, $quantity = 1) {

		if(!is_numeric($quantity)) {
			$quantity = 1;
		}

		$quantity = abs($quantity);

		if($quantity > $this->maxQuantity) {
			$quantity = $this->maxQuantity;
		}

		if($quantity == 0) {
			$this->remove($id);
			return;
		}

		$product = $this->controller->Product->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'Product.id' => $id
			)
		));
		if(empty($product)) {
			return false;
		}

		$this->Cart = ClassRegistry::init('Cart');

		$cartdata['Cart']['sessionid'] = $this->Session->id();
		$cartdata['Cart']['quantity'] = $quantity;
		$cartdata['Cart']['product_id'] = $product['Product']['id'];
		$cartdata['Cart']['name'] = $product['Product']['name'];
		$cartdata['Cart']['weight'] = $product['Product']['weight'];
		$cartdata['Cart']['weight_total'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
		$cartdata['Cart']['price'] = $product['Product']['price'];
		$cartdata['Cart']['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);

		$existing = $this->Cart->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'Cart.sessionid' => $this->Session->id(),
				'Cart.product_id' => $product['Product']['id'],
			)
		));
		if($existing) {
			$cartdata['Cart']['id'] = $existing['Cart']['id'];
			$cartdata['Cart']['quantity'] = $existing['Cart']['quantity'] + $quantity;
			$cartdata['Cart']['weight_total'] = sprintf('%01.2f', $cartdata['Cart']['weight_total'] * $cartdata['Cart']['quantity']);
			$cartdata['Cart']['subtotal'] = sprintf('%01.2f', $cartdata['Cart']['price'] * $cartdata['Cart']['quantity']);

		} else {
			$this->Cart->create();
		}
		$this->Cart->save($cartdata, false);

		$data['product_id'] = $product['Product']['id'];
		$data['name'] = $product['Product']['name'];
		$data['weight'] = $product['Product']['weight'];
		$data['price'] = $product['Product']['price'];
		$data['quantity'] = $cartdata['Cart']['quantity'];
		$data['subtotal'] = $cartdata['Cart']['subtotal'];
		$data['totalweight'] = $cartdata['Cart']['weight_total'];
		$data['Product'] = $product['Product'];
		$this->Session->write('Shop.OrderItem.' . $id, $data);
		$this->Session->write('Shop.Order.shop', 1);

		$this->cart();

		return $product;
	}

//////////////////////////////////////////////////

	public function remove($id) {
		if($this->Session->check('Shop.OrderItem.' . $id)) {
			$product = $this->Session->read('Shop.OrderItem.' . $id);
			$this->Session->delete('Shop.OrderItem.' . $id);

			ClassRegistry::init('Cart')->deleteAll(
				array(
					'Cart.sessionid' => $this->Session->id(),
					'Cart.product_id' => $id,
				),
				false
			);

			$this->cart();
			return $product;
		}
		return false;
	}

//////////////////////////////////////////////////

	public function cart() {
		$shop = $this->Session->read('Shop');
		$quantity = 0;
		$weight = 0;
		$subtotal = 0;
		$total = 0;
		$order_item_count = 0;

		if (count($shop['OrderItem']) > 0) {
			foreach ($shop['OrderItem'] as $item) {
				$quantity += $item['quantity'];
				$weight += $item['totalweight'];
				$subtotal += $item['subtotal'];
				$total += $item['subtotal'];
				$order_item_count++;
			}
			$d['order_item_count'] = $order_item_count;
			$d['quantity'] = $quantity;
			$d['weight'] = sprintf('%01.2f', $weight);
			$d['subtotal'] = sprintf('%01.2f', $subtotal);
			$d['total'] = sprintf('%01.2f', $total);
			$this->Session->write('Shop.Order', $d + $shop['Order']);
			return true;
		}
		else {
			$d['quantity'] = 0;
			$d['weight'] = 0;
			$d['subtotal'] = 0;
			$d['total'] = 0;
			$this->Session->write('Shop.Order', $d + $shop['Order']);
			return false;
		}
	}

//////////////////////////////////////////////////

	public function clear() {
		ClassRegistry::init('Cart')->deleteAll(array('Cart.sessionid' => $this->Session->id()), false);
		$this->Session->delete('Shop');
	}

//////////////////////////////////////////////////

}
