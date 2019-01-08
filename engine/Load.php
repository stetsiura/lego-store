<?php

namespace Engine;

use \Engine\DI\DI;

class Load
{
	const ENTITY_MODEL_MASK = '%s\Model\%s\%s';
	const REPOSITORY_MASK_MODEL = '%s\Model\%s\%sRepository';
	
	/**
	 * @var \Engine\DI\DI
	 */
	public $di;
	
	public function __construct(DI $di)
	{
		$this->di = $di;
	}
	
	/**
	 * @param string $modelName
	 * @param string $modelDir
	 * @return bool
	 */
	public function model($modelName, $modelDir = false)
	{		
		$modelName = ucfirst($modelName);
		$modelDir = $modelDir ? $modelDir : $modelName;
		
		$namespaceModel = sprintf(
			self::REPOSITORY_MASK_MODEL,
			ENV, $modelDir, $modelName
		);
		
		$classExists = class_exists($namespaceModel);
		
		if ($classExists) {			
			$modelRegistry = $this->di->get('model') ?: new \stdClass();
			$modelRegistry->{lcfirst($modelName)} = new $namespaceModel($this->di);
			
			$this->di->set('model', $modelRegistry);
		}

		return $classExists;
	}
}