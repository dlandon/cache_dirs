<?PHP
/* Copyright 2012-2023, Bergware International.
 * Copyright 2024-2025 Dan Landon.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */
?>
<?
/* Define the docroot path. */
if (!defined('DOCROOT')) {
	define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] ?: '/usr/local/emhttp');
}

define('CACHE_DIRS', DOCROOT."/plugins/dynamix.cache.dirs/scripts/rc.cachedirs");

$new		= isset($default) ? array_replace_recursive($_POST, $default) : $_POST;

$config		= '';
$options	= '';
$enable		= '';
$adaptive	= '';
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

		case 'depth':
			$depth		= $value;
			break;

		case 'include':
			$list = explode(',', $value);
			foreach ($list as $insert) {
				$options .= "-{$prefix[$key]} \"" . str_replace([' ','[',']','(',')'],['\ ','\[','\]','\(','\)'], trim($insert)) . "\" ";
			}
			break;

		default:
			if ($key[0] != '#') {
				$options .= (isset($prefix[$key]) ? "-{$prefix[$key]} " : "") . "$value ";
			}
			break;
	}
}

exec(CACHE_DIRS." stop >/dev/null");
if (isset($adaptive) && $adaptive == 1) {
	if (isset($depth) && $depth > 0) {
		$options .= "-d " . $depth;
	}
} else {
	$options .= "-D " . ($depth ?? 9999);
}
$options = trim($options);
$keys['options'] = $options;
file_put_contents($config, $options);

/* Start cache_dirs if enabled and included files are selected. */
if (($enable) && ($new['include'])) {
	exec(CACHE_DIRS." start >/dev/null");
}
?>
