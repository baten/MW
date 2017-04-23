<?php
App::uses('AppModel', 'Model');

class Basket extends AppModel {
	
public $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Product' => array(
			'className' => 'Ecommerce.Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),*/
	);

	function deletBasketAll($readSession){
		$this->query("DELETE FROM `baskets` WHERE `basketSession`='".$readSession."'");
	}
}
?>