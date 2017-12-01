<?php
class BrandShell extends Shell {

	public $uses = array('Product', 'Brand');

	public function main() {

		$brands = $this->Product->find('all', array(
			'recursive' => -1,
			'fields' => array(
				'Product.id',
				'Product.brand'
			),
			'conditions' => array(
				'Product.brand >' => ''
			),
			'group' => array(
				'Product.brand'
			),
			'order' => array(
				'Product.brand' => 'ASC'
			),
		));

		foreach($brands as $brand) {

			$count = $this->Brand->find('count', array(
				'recursive' => -1,
				'conditions' => array(
					'Brand.name' => $brand['Product']['brand']
				)
			));

			if($count == 0) {
				$this->Brand->create();
				$data['Brand']['name'] = $brand['Product']['brand'];

				$data['Brand']['slug'] = Inflector::slug(strtolower($brand['Product']['brand']), '-');

				$data['Brand']['active'] = 1;

				$this->Brand->save($data, false);
			}

		}

	}

}
