<?php

namespace Engine\Core\Image;

use \Engine\Core\Config\Config;

class Image
{
	const PRODUCT_IMAGE_THUMB_SCALE = "250x250";
	
	const PRODUCT_IMAGE_ORIGINAL_SCALE = "800x800";

	const CATEGORY_IMAGE_BIG_SCALE = "1260x1000";

	const CATEGORY_IMAGE_SMALL_SCALE = "700x700";

	const NEWS_IMAGE_THUMB_SCALE = "420x420";

	const NEWS_IMAGE_ORIGINAL_SCALE = "900x1800";

	const SLIDER_IMAGE_SCALE = "1000x600";
	
	/**
	 * @var \Engine\DI\DI;
	 */
	protected $di;
	
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
	}	

	public function resizeProductOriginalImage($inputFile, $outputFile)
	{
		$this->resize($inputFile, $outputFile, self::PRODUCT_IMAGE_ORIGINAL_SCALE);
	}

	public function resizeProductThumbnailImage($inputFile, $outputFile)
	{
		$this->resize($inputFile, $outputFile, self::PRODUCT_IMAGE_THUMB_SCALE);
	}

	public function resizeCategoryBigImage($inputFile, $outputFile) {
        $this->resize($inputFile, $outputFile, self::CATEGORY_IMAGE_BIG_SCALE);
	}
	
	public function resizeCategorySmallImage($inputFile, $outputFile) {
        $this->resize($inputFile, $outputFile, self::CATEGORY_IMAGE_SMALL_SCALE);
    }

    public function resizeNewsOriginalImage($inputFile, $outputFile) {
        $this->resize($inputFile, $outputFile, self::NEWS_IMAGE_ORIGINAL_SCALE);
    }

    public function resizeNewsThumbImage($inputFile, $outputFile) {
        $this->resize($inputFile, $outputFile, self::NEWS_IMAGE_THUMB_SCALE);
    }

    public function resizeSliderImage($inputFile, $outputFile) {
        $this->resize($inputFile, $outputFile, self::SLIDER_IMAGE_SCALE);
    }

	/**
	 * @param string $inputFile
	 * @param string $outputFile
	 * @param string $scale
	 * @return string
	 */
	/* private function resize($inputFile, $outputFile, $scale = self::ORIGINAL_SCALE)
	{
		$size = $this->getSizeArray($scale);
		
		$image = new \Imagick();
		$image->readImage($inputFile);    
		$image->scaleImage($size[0], $size[1], true);
		$image->writeImage($outputFile);
		$image->clear();
		$image->destroy();
	}
	
	private function getSizeArray($scale) {
		
		$size = explode('x', $scale);
		
		for ($i = 0; $i < count($size); $i++) {
			$size[$i] = (int)$size[$i];
		}
		
		return $size;
		
	} */
	
	private function resize($inputFile, $outputFile, $scale = self::ORIGINAL_SCALE)
	{
		$command = $this->command($inputFile, $outputFile, $scale);
		exec($command, $output, $return);
	}
	
	private function command($inputFile, $outputFile, $scale = self::ORIGINAL_SCALE)
	{
		$command = $this->convertPath() . 
			$inputFile . 
			' -resize ' .
			$scale . 
			' ' . 
			$outputFile;
		
		return $command;
	}
	
	/**
	 * @return string
	 */
	private function convertPath()
	{
		if (SRV == "DEV") {
			return 'convert ';
		} else {
			return '/usr/bin/convert ';
		}
		
		return '/usr/bin/convert ';
	}
}