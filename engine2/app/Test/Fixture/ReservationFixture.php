<?php
/**
 * ReservationFixture
 *
 */
class ReservationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'time' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'num_of_person' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'message' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 450, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'date' => '2016-04-25',
			'time' => 'Lorem ipsum dolor sit a',
			'num_of_person' => 1,
			'message' => 'Lorem ipsum dolor sit amet',
			'type' => 1,
			'created' => '2016-04-25 08:19:16'
		),
	);

}
