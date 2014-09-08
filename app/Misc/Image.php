<?php
namespace Misc;
/**
 * File holds class for manipulating images
 *
 * PHP version 5.3.5
 *
 * @category   Onion
 * @package    Misc
 * @subpackage Core
 * @author     markus karileet <markuskarileet@hotmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @link       -
 */
class Image {
	
	
	/**
	 * Method uploads picture to server
	 * @param var $file HTTP FILE object
	 * @param var $name Filename
	 * @throws \Exception
	 */
	public static function uploadImage($file, $name) {
		//check whether user uploaded a image or not
		if (strlen($file["picture"]["name"]) > 0) {
			//check if uploaded file is PNG
			if ($file["picture"]["type"] != "image/png" 
		        && $file["picture"]["type"] != "image/jpg"
                && $file["picture"]["type"] != "image/jpeg") {
				throw new \Exception('Image can be PNG/JP(E)G only!');
			}
			move_uploaded_file($file["picture"]["tmp_name"], APPPATH . 'uploads/'.$name);
		}
	}	
	
	/**
	 * Method creates a cropped thumbnail of image
	 * http://stackoverflow.com/questions/14649645/resize-image-in-php
	 * @param unknown $image_path
	 * @param unknown $thumb_width
	 * @param unknown $thumb_height
	 * @param unknown $prefix
	 */
	public static function createCroppedThumbnail($path, $image, $thumb_width, $thumb_height, $prefix) {
		$image_path = $path . $image;
		if (!file_exists($image_path)) {
			$image_path = IMAGES . NOIMAGE;
		}
		if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
			echo "The width is invalid";
			exit(1);
		}
	
		if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
			echo "The height is invalid";
			exit(1);
		}
	
		
		
		$extension = pathinfo($image_path, PATHINFO_EXTENSION);
		switch ($extension) {
			case "jpg":
			case "jpeg":
				$source_image = imagecreatefromjpeg($image_path);
				break;
			case "gif":
				$source_image = imagecreatefromgif($image_path);
				break;
			case "png":
				$source_image = imagecreatefrompng($image_path);
				break;
			default:
				exit(1);
				break;
		}
	
		$source_width = imageSX($source_image);
		$source_height = imageSY($source_image);
	
		if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
			$source_x = 0;
			$source_y = 0;
		}
	
		if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
			$source_y = 0;
			$temp_width = $source_height * $thumb_width / $thumb_height;
			$source_x = ($source_width - $temp_width) / 2;
			$source_width = $temp_width;
		}
	
		if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
			$source_x = 0;
			$temp_height = $source_width * $thumb_height / $thumb_width;
			$source_y = ($source_height - $temp_height) / 2;
			$source_height = $temp_height;
		}
	
		$target_image = ImageCreateTrueColor($thumb_width, $thumb_height);
	
		imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);
	
		switch ($extension) {
			case "jpg":
			case "jpeg":
				imagejpeg($target_image, $path . $prefix . '/' . $image);
				break;
			case "gif":
				imagegif($target_image, $path . $prefix . '/' . $image);
				break;
			case "png":
				imagepng($target_image, $path . $prefix . '/' . $image);
				break;
			default:
				exit(1);
				break;
		}
	
		imagedestroy($target_image);
		imagedestroy($source_image);
	}

	/**
	 * Mehtod returns file extension from filename. When no extension is found
	 * Exception is thrown
	 * 
	 * @param String $name Filename
	 * @throws \Exception
	 * @return String
	 */
	public static function getFileExtension($name) {
	    if(stristr($name, '.')) {
	       $parts = explode('.', $name);
	       return strtolower(array_pop($parts));
	    } else {
	        throw new \Exception('Filename has no extension!');
	    }
	}
}