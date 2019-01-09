<?php

namespace Engine\Core\File;

class File
{
	/**
	 * @var \Engine\DI\DI;
	 */
	protected $di;
	
	/**
	 * @var \Engine\Core\Request\Request;
	 */
	protected $request;
	
	/**
	 * @var \Engine\Core\Image\Image;
	 */
	protected $image;
	
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
		$this->request = $this->di->get('request');
		$this->image = $this->di->get('image');
	}
	
	/**
	 * @param string $htmlInputName
	 * @return bool
	 */
	public function fileUploaded($htmlInputName)
	{
		if (empty($this->request->files)) {
			return false;
		}
		
		if (file_exists($this->request->files[$htmlInputName]['tmp_name'])) {
			return true;
		}
		
		return false;
	}

	public function processNewsContentImage($htmlInputName)
    {
        if (!$this->fileUploaded($htmlInputName)) {
            return '';
        }

        $tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
        $extension = $this->extension($this->request->files[$htmlInputName]['name']);

        $fileNames = $this->newsContentImageFileNames($extension);

        $this->moveUploadedFile($tmpFilePath, $fileNames['full']);

        $this->image->resizeNewsOriginalImage($fileNames['full'], $fileNames['full']);

        return $fileNames['client'];
    }
	
	/**
	 * @param string $htmlInputName
	 * @return array
	 */
	public function processProductFile($htmlInputName)
	{
		if (!$this->fileUploaded($htmlInputName)) {
			return $this->productImagesFileNames(null, true);
		}		
		
		$tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
		$extension = $this->extension($this->request->files[$htmlInputName]['name']);
		
		$fileNames = $this->productImagesFileNames($extension);
		
		$this->moveUploadedFile($tmpFilePath, $fileNames['original']);
		
		$this->image->resizeProductThumbnailImage($fileNames['original'], $fileNames['thumbnail']);

        $this->image->resizeProductOriginalImage($fileNames['original'], $fileNames['original']);
		
		return $fileNames;
	}

	public function processNewsCoverFile($htmlInputName)
    {
        if (!$this->fileUploaded($htmlInputName)) {
            return $this->newsImagesFileNames(null, true);
        }

        $tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
        $extension = $this->extension($this->request->files[$htmlInputName]['name']);

        $fileNames = $this->newsImagesFileNames($extension);

        $this->moveUploadedFile($tmpFilePath, $fileNames['original']);

        $this->image->resizeNewsThumbImage($fileNames['original'], $fileNames['thumbnail']);

        $this->image->resizeNewsOriginalImage($fileNames['original'], $fileNames['original']);

        return $fileNames;
    }

	public function processCategoryImageFile($htmlInputName)
    {
        if (!$this->fileUploaded($htmlInputName)) {
            return $this->categoryImageFileNames(null, true);
        }

        $tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
        $extension = $this->extension($this->request->files[$htmlInputName]['name']);

        $fileNames = $this->categoryImageFileNames($extension);

        $this->moveUploadedFile($tmpFilePath, $fileNames['big']);

        $this->image->resizeCategoryBigImage($fileNames['big'], $fileNames['big']);

        $this->image->resizeCategorySmallImage($fileNames['big'], $fileNames['small']);

        return $fileNames;
    }

    public function processCategoryThumbFile($htmlInputName)
    {
        if (!$this->fileUploaded($htmlInputName)) {
            return $this->categoryImageFileNames(null, true);
        }

        $tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
        $extension = $this->extension($this->request->files[$htmlInputName]['name']);

        $fileNames = $this->categoryThumbFileNames($extension);

        $this->moveUploadedFile($tmpFilePath, $fileNames['original']);

        return $fileNames;
    }

    private function newsImagesFileNames($extension, $empty = false)
    {
        if ($empty) {
            return [
                'original' => '',
                'original_basename' => '',
                'thumbnail' => '',
                'thumbnail_basename' => ''
            ];
        }

        $baseName = $this->uniqueBasename($extension);

        $originalImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'news/cover/original/' . $baseName;
        $thumbnailImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'news/cover/thumb/' . $baseName;

        return [
            'original' => $originalImagePath,
            'original_basename' => $baseName,
            'thumbnail' => $thumbnailImagePath,
            'thumbnail_basename' => $baseName
        ];
    }

    private function categoryImageFileNames($extension, $empty = false)
    {
        if ($empty) {
            return [
                'big' => '',
                'big_basename' => '',
                'small' => '',
                'small_basename' => ''
            ];
        }

        $bigBaseName = $this->uniqueBasename($extension);

        $bigImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/big/'.  $bigBaseName;

        $smallBaseName = $this->uniqueBasename($extension);

        $smallImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/small/'.  $smallBaseName;

        return [
            'big' => $bigImagePath,
            'big_basename' => $bigBaseName,
            'small' => $smallImagePath,
            'small_basename' => $smallBaseName
        ];
    }

    private function categoryThumbFileNames($extension, $empty = false)
    {
        if ($empty) {
            return [
                'original' => '',
                'original_basename' => ''
            ];
        }

        $baseName = $this->uniqueBasename($extension);

        $fullImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/thumb/'.  $baseName;

        return [
            'original' => $fullImagePath,
            'original_basename' => $baseName
        ];
    }

    private function productImagesFileNames($extension, $empty = false) {
	    if ($empty) {
            return [
                'original' => '',
                'original_basename' => '',
                'thumbnail' => '',
                'thumbnail_basename' => ''
            ];
        }

        $baseName = $this->uniqueBasename($extension);

        $originalImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'products/original/' . $baseName;
        $thumbnailImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'products/thumb/' . $baseName;

        return [
            'original' => $originalImagePath,
            'original_basename' => $baseName,
            'thumbnail' => $thumbnailImagePath,
            'thumbnail_basename' => $baseName
        ];
    }

    private function newsContentImageFileNames($extension, $empty = false)
    {
        if ($empty) {
            return [
                'basename' => '',
                'client' => '',
                'full' => ''
            ];
        }

        $baseName = $this->uniqueBasename($extension);

        $dirPart = date('Ymd');
        $dirName = FILE_ROOT_DIR . UPLOADS_PATH . 'news/' . $dirPart;

        if (!file_exists($dirName)) {
            mkdir($dirName, 0777);
        }

        return [
            'basename' => $baseName,
            'client' => CLIENT_UPLOADS_PATH . 'news/' . $dirPart . '/' . $baseName,
            'full' => $dirName . '/' . $baseName
        ];
    }
	
	/**
	 * @param string $basename
	 */
	public function removeProductOriginalImage($basename)
	{
		if (!empty($basename)) {
			$path = FILE_ROOT_DIR . UPLOADS_PATH . 'products/original/' . $basename;
			$this->removeFile($path);
		}		
	}
	
	/**
	 * @param string $basename
	 */
	public function removeProductThumbnailImage($basename)
	{
		if (!empty($basename)) {
			$path = FILE_ROOT_DIR . UPLOADS_PATH . 'products/thumb/' . $basename;
			$this->removeFile($path);
		}
	}
	
	public function removeSliderImage($basename)
	{
		if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'slider/'. $basename;
			$this->removeFile($path);
		}
	}

	public function removeCategoryBigImage($basename)
    {
        if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/big/'. $basename;

            $this->removeFile($path);
        }
    }

    public function removeCategorySmallImage($basename)
    {
        if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/small/'. $basename;

            $this->removeFile($path);
        }
    }

    public function removeCategoryThumbImage($basename)
    {
        if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'categories/thumb/'. $basename;

            $this->removeFile($path);
        }
    }

    /**
     * @param string $basename
     */
    public function removeNewsOriginalImage($basename)
    {
        if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'news/cover/original/' . $basename;
            $this->removeFile($path);
        }
    }

    /**
     * @param string $basename
     */
    public function removeNewsThumbnailImage($basename)
    {
        if (!empty($basename)) {
            $path = FILE_ROOT_DIR . UPLOADS_PATH . 'news/cover/thumb/' . $basename;
            $this->removeFile($path);
        }
    }
	
	/**
	 * @param string $path
	 */
	public function removeFile($path)
	{
        if (file_exists($path)) {
            unlink($path);
        }
	}
	
	public function processSliderFile($htmlInputName)
	{
        if (!$this->fileUploaded($htmlInputName)) {
            return $this->sliderFileNames(null, true);
        }

        $tmpFilePath = $this->request->files[$htmlInputName]['tmp_name'];
        $extension = $this->extension($this->request->files[$htmlInputName]['name']);

        $fileNames = $this->sliderFileNames($extension);

        $this->moveUploadedFile($tmpFilePath, $fileNames['full']);

        $this->image->resizeSliderImage($fileNames['full'], $fileNames['full']);

        return $fileNames;
	}
	
	private function sliderFileNames($extension, $empty = false)
	{
        if ($empty) {
            return [
                'basename' => '',
                'full' => ''
            ];
        }

        $baseName = $this->uniqueBasename($extension);

        $originalImagePath = FILE_ROOT_DIR . UPLOADS_PATH . 'slider/' . $baseName;

        return [
            'basename' => $baseName,
            'full' => $originalImagePath
        ];
	}


	
	/**
	 * @param string $htmlInputName
	 * @param string $destinationFileName
	 */
	private function moveUploadedFile($tmpFileName, $destinationFileName)
	{
		move_uploaded_file($tmpFileName, $destinationFileName);
	}
	
	/**
	 * @param string $extension
	 * @return string
	 */
	private function uniqueBasename($extension)
	{
		$baseName = md5((string) rand(100000, 999999) . date('Y-m-d H:i:s')) . '-' . date('Y-m-d-H-i-s') . '.' . $extension;
		
		return $baseName;
	}
	
	private function extension($originalName)
	{
		$pathParts = pathinfo($originalName);
		$extension = $pathParts['extension'];
		
		return $extension;
	}
}