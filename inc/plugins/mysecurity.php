<?php 
// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

global $cache;
if(!isset($pluginlist))
    $pluginlist = $cache->read("plugins");

//ACP Hooks
if(is_array($pluginlist['active']) && in_array("mybbservice", $pluginlist['active'])) {
        $plugins->add_hook("mybbservice_actions", "mysecurity_mybbservice_actions");
        $plugins->add_hook("mybbservice_permission", "mysecurity_admin_config_permissions");
} else {
        $plugins->add_hook("admin_config_menu", "mysecurity_admin_config_menu");
        $plugins->add_hook("admin_config_action_handler", "mysecurity_admin_config_action_handler");
        $plugins->add_hook("admin_config_permissions", "mysecurity_admin_config_permissions");
}

function mysecurity_info()
{
	$info = array(
		"name"			=> "MySecurity",
		"description"	=> "Dieses Plugin hilft dir einige Sicherheitstipps zu beachten",
		"website"		=> "http://mybbservice.de",
		"author"		=> "MyBBService",
		"authorsite"	=> "http://mybbservice.de",
		"version"		=> "1.0",
		"guid" 			=> "",
		"compatibility" => "*",
		"dlcid"			=> "" // TODO
	);
	
	return $info;
}

// Nichts zu tun - ist das schön
function mysecurity_activate() {}

function mysecurity_deactivate() {}

function mysecurity_mybbservice_actions($actions)
{
    global $page, $lang, $info;
    $lang->load("mysecurity");

    $actions['mysecurity'] = array(
            "active" => "mysecurity",
            "file" => "../config/mysecurity.php"
    );

    $sub_menu = array();
    $sub_menu['10'] = array("id" => "mysecurity", "title" => $lang->mysecurity, "link" => "index.php?module=mybbservice-mysecurity");
    $sidebar = new SidebarItem($lang->globalignore);
    $sidebar->add_menu_items($sub_menu, $actions[$info]['active']);

    $page->sidebar .= $sidebar->get_markup();

    return $actions;
}

function mysecurity_admin_config_menu($sub_menu)
{
    global $lang;

    $lang->load("mysecurity");

    $sub_menu[] = array("id" => "mysecurity", "title" => $lang->mysecurity, "link" => "index.php?module=config-mysecurity");

    return $sub_menu;
}

function mysecurity_admin_config_action_handler($actions)
{
    $actions['mysecurity'] = array(
            "active" => "mysecurity",
            "file" => "mysecurity.php"
    );

    return $actions;
}

function mysecurity_admin_config_permissions($admin_permissions)
{
    global $lang;

    $lang->load("mysecurity");

    $admin_permissions['mysecurity'] = $lang->mysecurity_permissions;

    return $admin_permissions;
}
?>