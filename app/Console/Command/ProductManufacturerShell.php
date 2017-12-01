<?php
class ProductBrandShell extends Shell {

	public $uses = array('Product', 'Brand');

	public function main() {

		$products = $this->Product->find('all');

		print_r($products);

		foreach($products as $product) {
			$d['Product']['id'] = $product['Product']['id'];
			$mid = $this->Brand->field('id', array('name' => $product['Product']['brand']));
			$d['Product']['brand_id'] = $mid;
			print_r($d);
			$this->Product->save($d, false);
		}

	}

}
