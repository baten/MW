<?php
/**
 * BrandFixture
 *
 */
class BrandFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'meta_keys' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'meta_description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 450, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'images' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => '54244b60-5e08-4083-a128-1035cdd1d5ac',
			'title' => 'Lorem ipsum dolor sit amet',
			'meta_keys' => 'Lorem ipsum dolor sit amet',
			'meta_description' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'images' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'order' => 1,
			'status' => 'Lorem ipsum dolor sit amet'
		),
	);

}
