<?php

defined('TEMPLATE_SYNC_VER') || define('TEMPLATE_SYNC_VER', '1.0.0-b.5');

return array(
	'name' => 'Template Sync',
	'version' => TEMPLATE_SYNC_VER,
	'author' => 'TJ Draper',
	'author_url' => 'https://buzzingpixel.com',
	'description' => 'Provide full, two way sync for templates in the database and filesystem',
	'namespace' => 'BuzzingPixel\Addons\TemplateSync',
	'services' => array(
		// Controllers
		'SyncTemplatesController' => 'Controller\SyncTemplates',

		// Services
		'FileTemplatesService' => 'Service\FileTemplates',
		'DbTemplatesService' => 'Service\DbTemplates',
		'TemplateCompareService' => 'Service\TemplateCompare',

		// Libraries
		'FileTemplateExtensionsLib' => 'Library\FileTemplateExtensions',

		// Helpers
		'DirectoryArrayHelper' => 'Helper\DirectoryArray'
	)
);