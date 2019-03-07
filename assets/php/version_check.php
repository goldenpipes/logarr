<?php
require("functions.php");
// check current version number
// open version file on external server
$file = fopen($ext_version_loc, "r");
$vnum = fgets($file);
fclose($file);
// check users local file for version number
$userfile = fopen($vnum_loc, "r");
$user_vnum = fgets($userfile);
fclose($userfile);

$user_version = floatval(substr($user_vnum, 0, -1));
$ext_version = floatval(substr($vnum, 0, -1));


if (!$file) {
	// data
	$data = array("version" => 0);

	echo "<script type='text/javascript'>";
	echo "console.log('ERROR: Logarr was unable check GitHub for the latest version');";
	echo "</script>";
} else {
	if ($user_vnum == $vnum || (bccomp($user_version, $ext_version, 5) >= 0)) {
		// data
		$data = array("version" => 0);
	} else {
		// data
		$data = array("version" => $vnum);
	}
}

// send the json data
echo json_encode($data);