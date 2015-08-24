<?php
/**
 * Date: 08.08.14
 * Time: 13:28
 *
 * This file is part of the MihailDev project.
 *
 * (c) MihailDev project <http://github.com/mihaildev/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace mihaildev\imagine;
use Yii;
use Imagine\Image\Box;
use Imagine\Image\Color;
use Imagine\Image\Point;
use yii\imagine\BaseImage;

/**
 * Class ImageHandler
 *
 * @package mihaildev\imagine
 */
class Image extends BaseImage{

	/**
	 * Constructs the Size with given width and height
	 *
	 * @param integer $width
	 * @param integer $height
	 *
	 * @return \Imagine\Image\Box
	 */
	public static function box($width, $height){
		return new Box($width, $height);
	}

	/**
	 * Constructs a point of coordinates
	 *
	 * @param integer $x
	 * @param integer $y
	 *
	 * @return \Imagine\Image\Point
	 */
	public static function point($x, $y){
		return new Point($x, $y);
	}

	/**
	 * Constructs image color, e.g.:
	 *     - ImageHandler::color('fff') - will produce non-transparent white color
	 *     - ImageHandler::color('ffffff', 50) - will product 50% transparent white
	 *     - ImageHandler::color(array(255, 255, 255)) - another way of getting white
	 *     - ImageHandler::color(0x00FF00) - hexadecimal notation for green
	 *
	 * @param array|string|integer $color
	 * @param integer $alpha
	 *
	 * @return \Imagine\Image\Color
	 */
	public static function color($color, $alpha = 0){
		return new Color($color, $alpha);
	}

	/**
	 * @param $filename string
	 * @param $width integer
	 * @param $height integer
	 * @return \Imagine\Image\ImageInterface|\Imagine\Image\ManipulatorInterface
	 */
	public static function aligning($filename, $width, $height)
	{
		return self::aligningImage(static::getImagine()->open(Yii::getAlias($filename)), $width, $height);
	}

	/**
	 * @param $image \Imagine\Image\ImageInterface
	 * @param $width
	 * @param $height
	 * @return \Imagine\Image\ImageInterface|\Imagine\Image\ManipulatorInterface
	 */
	public static function aligningImage($image, $width, $height){
		$maxBox = new Box($width, $height);

		if($maxBox->contains($image->getSize())){
			return $image;
		}

		$ratios = array(
			$maxBox->getWidth() / $image->getSize()->getWidth(),
			$maxBox->getHeight() / $image->getSize()->getHeight()
		);

		$box = $image->getSize()->scale(min($ratios));

		return $image->resize($box);
	}
} 