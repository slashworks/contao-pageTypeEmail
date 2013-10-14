<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package PageTypeEmail
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'slashworks',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Pages
	'slashworks\PageEmail' => 'system/modules/pageTypeEmail/pages/PageEmail.php',
));
