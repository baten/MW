<?php
/**
 * ProductStockFixture
 *
 */
class ProductStockFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'product_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'attributes' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 160, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'attributeValues' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 160, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'sold' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '58ef49a4-e2c0-402b-b22a-1ae3cdd1d5ac',
			'product_id' => 'Lorem ipsum dolor sit amet',
			'attributes' => 'Lorem ipsum dolor sit amet',
			'attributeValues' => 'Lorem ipsum dolor sit amet',
			'quantity' => 1,
			'sold' => 1
		),
	);

}
