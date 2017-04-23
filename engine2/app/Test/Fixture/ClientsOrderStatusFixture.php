<?php
/**
 * ClientsOrderStatusFixture
 *
 */
class ClientsOrderStatusFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'clients_order_status';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'client_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'data' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'section' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_viewed' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'code' => array('column' => 'code', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '55485d3d-4234-43af-9a55-1975cdd1d5ac',
			'code' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'datetime' => '2015-05-05 06:03:41',
			'data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'status' => 'Lorem ipsum dolor sit amet',
			'section' => 'Lorem ipsum dolor sit amet',
			'is_viewed' => 1
		),
	);

}
