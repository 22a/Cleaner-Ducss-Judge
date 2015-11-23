<?php
/**
 * Common page header.
 * Before including this, one can set $title, $refresh,
 * $printercss, $jscolor and $menu.
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */
if (!defined('DOMJUDGE_VERSION')) die("DOMJUDGE_VERSION not defined.");

header('Content-Type: text/html; charset=' . DJ_CHARACTER_SET);

/* Prevent clickjacking by forbidding framing in modern browsers.
 * Really want to frame DOMjudge? Then change DENY to SAMEORIGIN
 * or even comment out the header altogether. For the public
 * interface there's no risk, and embedding the scoreboard in a
 * frame may be useful.
 */
if ( ! IS_PUBLIC ) header('X-Frame-Options: DENY');

$refresh_cookie = (!isset($_COOKIE["domjudge_refresh"]) || (bool)$_COOKIE["domjudge_refresh"]);

if ( isset($refresh) && $refresh_cookie ) {
	header('Refresh: ' . $refresh);
}

if(!isset($menu)) {
	$menu = true;
}
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
	<!-- DOMjudge version <?php echo DOMJUDGE_VERSION?> -->
<meta charset="<?php echo DJ_CHARACTER_SET?>"/>
<title><?php echo $title?></title>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-194x194.png" sizes="194x194">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ffb800">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#b5b5b5">

<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="../meehan.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" type="text/css" />
<?php
if ( IS_JURY ) {
	echo "<link rel=\"stylesheet\" href=\"style_jury.css\" type=\"text/css\" />\n";
	if (isset($printercss)) {
		echo "<link rel=\"stylesheet\" href=\"style_printer.css\" type=\"text/css\" media=\"print\" />\n";
	}
	echo "<script type=\"text/javascript\" src=\"../js/jquery.min.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"../js/jury.js\"></script>\n";
	if (isset($jscolor)) {
		echo "<script type=\"text/javascript\" src=\"" .
		"../js/jscolor.js\"></script>\n";
	}
	if (isset($jqtokeninput)) {
		echo "<link rel=\"stylesheet\" href=\"../token-input.css\" type=\"text/css\" />";
		echo "<script type=\"text/javascript\" src=\"../js/jquery.tokeninput.min.js\"></script>\n";
	}
	echo "<script type=\"text/javascript\" src=\"" .
		"../js/sorttable.js\"></script>\n";
}
echo "<script type=\"text/javascript\" src=\"../js/domjudge.js\"></script>\n";

if ( ! empty($extrahead) ) echo $extrahead;
?>
</head>
<?php

if ( IS_JURY ) {
	global $pagename;
	echo "<body onload=\"setInterval('updateMenu(" .
		(int)($pagename=='clarifications.php' && $refresh_cookie) . ", " .
		(int)($pagename=='judgehosts.php'     && $refresh_cookie) . ", " .
		(int)($pagename=='rejudgings.php'     && $refresh_cookie) . ")', 20000); " .
		"updateMenu(0,0,0)\">\n";
} else {
	echo "<body>\n";
}

/* NOTE: here a local menu.php is included
 *       both jury and team have their own menu.php
 */
if ( $menu ) include("menu.php");
