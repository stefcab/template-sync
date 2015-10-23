<?php

namespace BuzzingPixel\Addons\TemplateSync\Service;

class PartialFileTemplates
{
	private $returnTemplates = array();

	/**
	 * Get partial file templates from file system
	 *
	 * @return array
	 */
	public function get($path)
	{
		// Set variables
		$templateBasePath = SYSPATH . 'user/templates/';
		$path = $templateBasePath . ee()->config->item('site_short_name') .
			'/' . $path . '/';

		// Make sure directory exists
		if (! is_dir($path)) {
			mkdir($path);
		}

		// Recursively load files
		$this->processRecursively($path);

		return $this->returnTemplates;
	}

	/**
	 * Process directories recursively
	 *
	 * @param string $path
	 * @param string $prefix
	 */
	private function processRecursively($path, $prefix = '')
	{
		// Load helpers
		$dirArray = ee('template_sync:DirectoryArrayHelper');

		$templates = $dirArray->process($path);

		foreach ($templates as $template) {
			// Process sub-directories
			if (is_dir($path . $template)) {
				$this->processRecursively($path . $template . '/', $prefix . $template . ':');

				continue;
			}

			$pathInfo = pathinfo($template);
			$content = file_get_contents($path . $template);

			// Make sure hidden files (starting with .) are not included
			if ($pathInfo['filename']) {
				$this->returnTemplates[$prefix . $pathInfo['filename']] = $content;
			}
		}
	}
}