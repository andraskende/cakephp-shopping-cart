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

    }

//////////////////////////////////////////////////

    public $maxQuantity = 99;

//////////////////////////////////////////////////

    public function add($id, $quantity = 1, $productmodId = null) {

        if($productmodId) {
            $productmod = ClassRegistry::init('Productmod')->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'Productmod.id' => $productmodId,
                    'Productmod.product_id' => $id,
                )
            ));
        }

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

        if($this->Session->check('Shop.OrderItem.' . $id . '.Product.productmod_name')) {
            $productmod['Productmod']['id'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_id');
            $productmod['Productmod']['name'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.productmod_name');
            $productmod['Productmod']['price'] = $this->Session->read('Shop.OrderItem.' . $id . '.Product.price');

        }

        if(isset($productmod)) {
            $product['Product']['productmod_id'] = $productmod['Productmod']['id'];
            $product['Product']['productmod_name'] = $productmod['Productmod']['name'];
            $product['Product']['price'] = $productmod['Productmod']['price'];
            $productmodId = $productmod['Productmod']['id'];
            $data['productmod_id'] = $product['Product']['productmod_id'];
            $data['productmod_name'] = $product['Product']['productmod_name'];
        } else {
            $product['Product']['productmod_id'] = '';
            $product['Product']['productmod_name'] = '';
            $productmodId = 0;
            $data['productmod_id'] = '';
            $data['productmod_name'] = '';
        }

        $data['product_id'] = $product['Product']['id'];
        $data['name'] = $product['Product']['name'];
        $data['weight'] = $product['Product']['weight'];
        $data['price'] = $product['Product']['price'];
        $data['quantity'] = $quantity;
        $data['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);
        $data['totalweight'] = sprintf('%01.2f', $product['Product']['weight'] * $quantity);
        $data['Product'] = $product['Product'];
        $this->Session->write('Shop.OrderItem.' . $id . '_' . $productmodId, $data);
        $this->Session->write('Shop.Order.shop', 1);

        $this->cart();

        return $product;
    }

//////////////////////////////////////////////////

    public function remove($id) {
        if($this->Session->check('Shop.OrderItem.' . $id)) {
            $product = $this->Session->read('Shop.OrderItem.' . $id);
            $this->Session->delete('Shop.OrderItem.' . $id);
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
        $this->Session->delete('Shop');
    }

//////////////////////////////////////////////////

}
