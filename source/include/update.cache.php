<?php
/* Copyright 2012-2023, Bergware International.
 * Copyright 2024-2026 Dan Landon.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

/* Define the docroot path. */
if (!defined('DOCROOT')) {
	define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] ?: '/usr/local/emhttp');
}

/* Get the Unraid Wrappers and Helpers files. */
require_once(DOCROOT."/webGui/include/Wrappers.php");
require_once(DOCROOT."/webGui/include/Helpers.php");

define('CACHE_DIRS', DOCROOT."/plugins/dynamix.cache.dirs/scripts/rc.cachedirs");

exec(CACHE_DIRS." stop >/dev/null");

$new		= isset($default) ? array_replace_recursive($_POST, $default) : $_POST;

$config		= '';
$options	= '';
$enable		= '';
$adaptive	= '';
$minDepth	= '';
$depth		= '';
$keys		= [];

foreach ($new as $key => $value) {
	if (!strlen($value)) continue;
	switch ($key) {
		case '#config':
			$config		= $value;
			$options	= '';
			break;

		case '#prefix':
			parse_str($value, $prefix);
			break;

		case 'service':
			$enable		= $value;
			break;

		case 'adaptive':
			$adaptive	= $value;
			break;

		case 'minDepth':
			$minDepth		= $value;
			break;

		case 'depth':
			$depth		= $value;
			break;

		case 'include':
			$list = explode(',', $value);
			foreach ($list as $insert) {
				$options .= "-{$prefix[$key]} \"".str_replace([' ','[',']','(',')'],['\ ','\[','\]','\(','\)'], trim($insert))."\" ";
			}
			break;

		case 'other':
			$options .= stripcslashes(trim($value))." ";
			break;

		default:
			if ($key[0] != '#') {
				$options .= (isset($prefix[$key]) ? "-{$prefix[$key]} " : "")."$value ";
			}
			break;
	}
}

/* Turn on concise logging to cut down on the syslog messages. */
$options .= "-z ";

/* Set adaptive or fixed scan. */
if ($adaptive == 1) {
	$minDepth = !empty($new['minDepth']) ? $new['minDepth'] : 4;

	$options .= "-C ".(int)$minDepth." ";

	if (!empty($depth)) {
		$options .= "-d ".(int)$depth." ";
	}
} else {
	$options .= "-D ".(int)$depth;
}

$options = trim($options);
$keys['options'] = $options;

file_put_contents_atomic($config, $options);

/* Start cache_dirs if enabled and included files are selected. */
if (($enable) && ($new['include'])) {
	exec(CACHE_DIRS." start >/dev/null");
}
?>
