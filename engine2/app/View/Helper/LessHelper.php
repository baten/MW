<?php
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class LessHelper extends Helper {
	public function lessCss($files){
		//echo Configure::read('App.cssBaseUrl');
		$lessHtml = '';
		foreach($files as $serial => $lessFiles){
			$lessHtml .=  "<link rel='stylesheet/less' type='text/css' href='/{$lessFiles}.less' >";
		}
		if ($lessHtml != '') {
			return $lessHtml;
		}
	}
}
