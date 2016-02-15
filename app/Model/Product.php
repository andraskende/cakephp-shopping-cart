<?php
App::uses('AppModel', 'Model');
class Product extends AppModel {

////////////////////////////////////////////////////////////

    public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('lengthBetween', 3, 60),
                'message' => 'Name is required',
                'allowEmpty' => false,
                'required' => false,
            ),
            'rule2' => array(
                'rule' => array('isUnique'),
                'message' => 'Name already exists',
                'allowEmpty' => false,
                'required' => false,
            ),
        ),
        'slug' => array(
            'rule1' => array(
                'rule' => array('lengthBetween', 3, 50),
                'message' => 'Slug is required',
                'allowEmpty' => false,
                'required' => false,
            ),
            'rule2' => array(
                'rule' => '/^[a-z\-]{3,50}$/',
                'message' => 'Only lowercase letters and dashes, between 3-50 characters',
                'allowEmpty' => false,
                'required' => false,
            ),
            'rule3' => array(
                'rule' => array('isUnique'),
                'message' => 'Slug already exists',
                'allowEmpty' => false,
                'required' => false,
            ),
        ),
        'price' => array(
            'notempty' => array(
                'rule' => array('decimal'),
                'message' => 'Price is invalid',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'weight' => array(
            'notempty' => array(
                'rule' => array('decimal'),
                'message' => 'Weight is invalid',
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

////////////////////////////////////////////////////////////

    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
        'Brand' => array(
            'className' => 'Brand',
            'foreignKey' => 'brand_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
    );

////////////////////////////////////////////////////////////

    public $hasMany = array(
        'Productmod'
    );

////////////////////////////////////////////////////////////

    public function updateViews($products) {

        if(!isset($products[0])) {
            $a = $products;
            unset($products);
            $products[0] = $a;
        }

        $this->unbindModel(
            array('belongsTo' => array('Category', 'Brand'))
        );

        $productIds = Set::extract('/Product/id', $products);

        $this->updateAll(
            array(
                'Product.views' => 'Product.views + 1',
            ),
            array('Product.id' => $productIds)
        );


    }

////////////////////////////////////////////////////////////

}