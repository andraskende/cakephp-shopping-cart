<?php
App::uses('AppModel', 'Model');
class Order extends AppModel {

//////////////////////////////////////////////////

    public $validate = array(
        'name' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Name is invalid',
            ),
        ),
        'email' => array(
            'rule1' => array(
                'rule' => array('email'),
                'message' => 'Email is invalid',
            ),
        ),
        'phone' => array(
            'rule1' => array(
                'rule' => array('phone'),
                'message' => 'Phone is invalid',
            ),
        ),
        'billing_address' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Billing Address is invalid',
            ),
        ),
        'billing_city' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Billing City is invalid',
            ),
        ),
        'billing_state' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Billing State is invalid',
            ),
        ),
        'shipping_address' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Shipping Address is invalid',
            ),
        ),
        'shipping_city' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Shipping City is invalid',
            ),
        ),
        'shipping_state' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Shipping State is invalid',
            ),
        ),
        'creditcard_number' => array(
            'rule1' => array(
                'rule' => array('cc'),
                'message' => 'Credit Card Number is invalid',
            ),
        ),
        'creditcard_code' => array(
            'rule1' => array(
                'rule' => array('notBlank'),
                'message' => 'Credit Card Code is required',
            ),
            'rule2' => array(
                 'rule' => '/^[0-9]{3,4}$/i',
                 'message' => 'Credit Card Code is invalid',
            ),
        ),
    );

//////////////////////////////////////////////////

    public $hasMany = array(
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        )
    );

//////////////////////////////////////////////////

}
