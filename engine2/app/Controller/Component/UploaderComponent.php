<?php
class UploaderComponent extends Component {

	public $maxfilesize =  16384000 ;

	/*
	 * upload any type of files
	 *
	 */

	public function upload($fileCtrl, $nameWithoutExtension, $imgextenstion, $category,$fileOrImage = null, $height = '', $width = '', $oldfile = null ){
		if($fileOrImage == null){
			return $this->uploadImage($fileCtrl, $nameWithoutExtension, $imgextenstion, $category, $height, $width);
		}elseif($fileOrImage == '1'){
			return $this->uploadImage($fileCtrl, $nameWithoutExtension, $imgextenstion,$category, $height, $width);
		}else{
			return $this->uploadFile($fileCtrl,$nameWithoutExtension,$category);
		}
	}

	/**
	 *	method deleteFile
	 *
	 * @param string $location
	 * @param stringwith extension $name
	 */

	public function deleteFile($image_path){
		
		if(fileExistsInPath($image_path)){
			if(unlink($image_path)){
				return true;
			}else{
				return "Delete Operatin is failed, try again.";
			}
		}else{
			return "File was not found.";
		}
	}

	/*
	 * @ get file extension
	 */
	public function getFileExtension($fileCtrl) {
		return substr(strrchr($fileCtrl['name'],'.'),1);
	}
	
	/*
	 * checkIsFileExist
	 */
	public function checkIsFileExist($location,$image_name){
		$actual_location = $this->getUploadDir($location);
		if(file_exists($actual_location."$image_name")){
			return true;
		}
		return false;
	} 

// all private methods

	/*
	 * file uplaoder
	 */
    private function uploadFile($fileCtrl, $imgName, $cat, $oldFile = null) {
		$dir_path = $this->getUploadDir ( $cat );

		$name = $imgName . "." . $this->getFileExtension ( $fileCtrl );

		if ($imgName && $fileCtrl ['tmp_name'] && $fileCtrl ['size'] < $this->maxfilesize) {
			if ($oldFile) {
				if (fileExistsInPath ( $dir_path . $oldFile )) {
					unlink ( $dir_path . $oldFile );
				}
			}
			return move_uploaded_file ( $fileCtrl ['tmp_name'], $dir_path . $name );

			//return $name;
		} else {
			return ( "File size has exceeded the limit. Maximum: " . $this->maxfilesize . " bytes can be allowed." );
		}
	}

	/*
	 * image uplaoder
	 */
	private function uploadImage($fileCtrl, $imgName,$imgextenstion, $cat = '', $h = '', $w = '') {
		$dir_path = $this->getUploadDir ( $cat );
		
		if ($imgName && $fileCtrl ['tmp_name'] && $fileCtrl ['size'] < $this->maxfilesize) {
			
			//check image valied	
			$nameExtention = $this->imageFileTypeDetectionToExtension($fileCtrl);
			if($nameExtention == false ){
				return "Please upload gif,jpg,jpeg,png type images.";
			}
			
			//set name
			if($imgextenstion == ''){
				$name = $imgName . ".{$nameExtention}";
			} else{
				$name = $imgName . ".{$imgextenstion}";
			}
			
			//pr($name);die();

			if (file_exists ( $dir_path . $name )) {
				unlink ( $dir_path . $name );
			}
			return $this->uploadResizeImage ( $fileCtrl, $name, $cat, $h, $w );

		} else {
			return "File size has exceeded the limit. Maximum: " . $this->maxfilesize . " bytes can be allowed.";
		}
	}

	/*
	 * image resizer
	 * @ call in uplodImage()
	 */
	private function uploadResizeImage($fileCtrl, $name, $cat = '', $h = '', $w = '') {
		$path = $this->getUploadDir ( $cat ) . $name;
		if ($h && $w) {
			$new_w = $w;
			$new_h = $h;
		} else {
			list ( $width, $height ) = getimagesize ( $fileCtrl ['tmp_name'] );

			if ($h && empty ( $w )) {
				$new_w = $width * ($h / $height);
				$new_h = $h;
			} elseif ($w && empty ( $h )) {
				$new_w = $w;
				$new_h = $height * ($w / $width);
			} else {
				$new_w = $width;
				$new_h = $height;
			}
		}


		return $this->smartResize ( $fileCtrl, $path, $extention = '', $new_w, $new_h ); // '' for target image type
	}

	/*
	 * image resizer with given dimension
	 * @ called in uploadResizeImage
	 */
	private function smartResize($fileCtrl, $newFile, $targetOutType = '', $width, $height, $output = 'file') {
		if ($height <= 0 && $width <= 0) {
			return "Height or Width required";
		}

		# Setting defaults and meta
		$file = $fileCtrl ['tmp_name'];
		$info = getimagesize ( $file );

		list ( $width_old, $height_old ) = $info;

		# Loading image to memory according to type
		
		if($targetOutType == ''){
			$outType = $info [2];
		} else {
			$outputtypes = array(
				'gif'	=> IMAGETYPE_GIF,
				'jpeg'	=> IMAGETYPE_JPEG,
				'jpg'	=> IMAGETYPE_JPEG,
				'png'	=> IMAGETYPE_PNG
			);
			
			if(array_key_exists($targetOutType, $outputtypes) == true){
				$outType = $outputtypes[$targetOutType];
			}else{
				$outType = $info [2];
			}
			
			
		}
		 
		switch ($outType) {
			case IMAGETYPE_GIF :
				$image = imagecreatefromgif ( $file );
				break;
			case IMAGETYPE_JPEG :
				$image = imagecreatefromjpeg ( $file );
				break;
			case IMAGETYPE_PNG :
				$image = imagecreatefrompng ( $file );
				break;
			default :
				$image = '';
				return false;
		}

		# This is the resizing/resampling/transparency-preserving magic
		$image_resized = imagecreatetruecolor ( $width, $height );
		if ($info [2] == IMAGETYPE_GIF) {
			$transparency = imagecolortransparent ( $image );
			if ($transparency >= 0) {
				$trnprt_color = imagecolorsforindex ( $image, $transparency );
				$transparency = imagecolorallocate ( $image_resized, $trnprt_color ['red'], $trnprt_color ['green'], $trnprt_color ['blue'] );
				imagefill ( $image_resized, 0, 0, $transparency );
				imagecolortransparent ( $image_resized, $transparency );
			}
		} elseif ($info [2] == IMAGETYPE_PNG) {
			imagealphablending ( $image_resized, false );
			$color = imagecolorallocatealpha ( $image_resized, 0, 0, 0, 127 );
			imagefill ( $image_resized, 0, 0, $color );
			imagesavealpha ( $image_resized, true );
		}

		imagecopyresampled ( $image_resized, $image, 0, 0, 0, 0, $width, $height, $width_old, $height_old );


		# Preparing a method of providing result
		switch (strtolower ( $output )) {
			case 'browser' :
				$mime = image_type_to_mime_type ( $info [2] );
				header ( "Content-type: $mime" );
				$output = NULL;
				break;
			case 'file' :
				$output = $newFile;
				break;
			case 'return' :
				return $image_resized;
				break;
			default :
				break;
		}


		# Writing image according to type to the output destination
		switch ($info [2]) {   //instead of output type $info[2] is used temporary
			case IMAGETYPE_GIF :
				imagegif ( $image_resized, $output );
				break;
			case IMAGETYPE_JPEG :
				imagejpeg ( $image_resized, $output );
				break;
			case IMAGETYPE_PNG :
				imagepng ( $image_resized, $output );
				break;
			default :
				return false;
		}


		return true;
	}

	/*
	 *detecting upload folder as category
	 * @
	 */
	private function getUploadDir($cat = null) {
		$upload_dir = WWW_ROOT . "img" . DS . "site";
		if($cat !== ''){			
			return $upload_dir . DS . $cat . DS;		
		} else{			
			return $upload_dir . DS;		
		}
		
	}
	//check upload locations
	private function checkuploaddirectory($locations){
		$location = explode('/', $locations);
		
		$upload_dir =  WWW_ROOT . "sites" . DS;
		
		$upload_dir_root = WWW_ROOT . "sites" . DS . "{$location[0]}";
		if(file_exists(WWW_ROOT . "sites" . DS . "{$location[0]}" . DS. "{$location[1]}")){
			$path = WWW_ROOT . "sites" . DS . "{$location[0]}" . DS. "{$location[1]}" .DS;
		}else{
			if (!file_exists($upload_dir_root)) {
    			mkdir("$upload_dir" . "{$location[0]}", 0777);
			}
			$upload_dir_root_cat = WWW_ROOT . "sites" . DS . "{$location[0]}" . DS. "{$location[1]}";
			if (!file_exists($upload_dir_root_cat)) {
	    		mkdir("{$upload_dir_root}/" . "{$location[1]}", 0777);
			}
			$path = WWW_ROOT . "sites" . DS . "{$location[0]}" . DS. "{$location[1]}" . DS;
		}
		return $path;
	}


	private function imageFileTypeDetectionToExtension($fileCtrl){
		//pr($fileCtrl) ;die();
		$info = getimagesize ( $fileCtrl ['tmp_name'] );

		switch ($info[2]){
			case 1 :
				return ".gif";
				break;
			case 2:
				return ".jpg";
				break;
			case 3:
				return ".png";
				break;
			default:
				return false;
		}
	}
}


