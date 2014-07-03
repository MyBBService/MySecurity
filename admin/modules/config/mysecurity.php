<?php
if(!defined("IN_MYBB"))
{
	header("HTTP/1.0 404 Not Found");
	exit;
}

if(function_exists("mybbservice_info"))
    define(MODULE, "mybbservice-mysecurity");
else
    define(MODULE, "config-mysecurity");

$page->add_breadcrumb_item($lang->mysecurity, "index.php?module=".MODULE);

$page->output_header($lang->mysecurity);
generate_tabs("important");

echo "Admin Modul von MySecurity";

$page->output_footer();

function generate_tabs($selected)
{
	global $lang, $page;

	$sub_tabs = array();
	$sub_tabs['important'] = array(
		'title' => $lang->mysecurity_important,
		'link' => "index.php?module=".MODULE,
		'description' => $lang->mysecurity_important_desc
	);
	$sub_tabs['recommended'] = array(
		'title' => $lang->mysecurity_recommended,
		'link' => "index.php?module=".MODULE."&amp;action=recommended",
		'description' => $lang->mysecurity_recommended_desc
	);

	$page->output_nav_tabs($sub_tabs, $selected);
}
?>