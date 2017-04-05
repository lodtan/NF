<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo "css{$DS}style.css" ?>" />
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>

<?php
if (!isset($view)) {
	$tab_product = ModelRestaurant::selectAll();
	$controller="restaurant";
	$view="All";
}

include("{$ROOT}{$DS}view{$DS}header.php");

$filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}";
$filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
include("{$filepath}{$filename}");

?>
    </body>
</html>