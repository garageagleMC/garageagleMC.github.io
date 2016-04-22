<!DOCTYPE html>
<html>
<body>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<h1>HiveMC Stat Getter</h1>

<a href="index.php"><button class="button">Home</button></a> &nbsp; <a href="stats.php"><button class="button">HiveMC Stats (Beta)</button></a>
<br /><br />

<?php
error_reporting(E_ALL);

function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT,5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);

    $data = curl_exec($ch);
    echo (curl_error($ch));

    curl_close($ch);

    return $data;
}
echo "To use this stat getter, enter a username. Then press enter.";

// The json website variables
//$uuid="b1cc231b1b7d4bd182cf030fbdf89dc6";
$game="deathrun";
if (!empty($_REQUEST["ign"])) {
	$username=$_REQUEST["ign"];
} else {
	$username = "";
}


?>

<form>
	Username:<input type="text" name="ign">
</form>

<?php if (! empty($username)): ?>

<?php
// Decodes the json file
//$gamedata=json_decode(file_get_contents("http://hivemc.com/json/$game/$uuid"));

$contents = curl_get_contents("http://hivemc.com/json/userprofile/".$username);

echo "CONTENTS = ".print_r($contents,true);

$playerdata=json_decode($contents);

//print_r($playerdata);

?>

<div><?php echo("You are looking at ".$playerdata->username."'s stats."); ?></div>
<div><?php echo("Rank: $playerdata->rankName"); ?></div>
<div><?php echo("Tokens: $playerdata->tokens"); ?></div>
<div><?php echo("Credits: $playerdata->credits"); ?></div>
<br /><br />
<div><strong>Survival Games</strong></div>

<div><?php echo("Victories: ".$playerdata->sg->victories); ?></div>
<div><?php echo("Kills: ".$playerdata->sg->kills); ?></div>
<div><?php echo("Deaths: ".$playerdata->sg->deaths); ?></div>
<div><?php echo("Points: ".$playerdata->sg->points); ?></div>
<br /><br />
<div><strong>The Herobrine</strong></div>

<div><?php echo("Captures: ".$playerdata->hb->captures); ?></div>
<div><?php echo("Kills: ".$playerdata->hb->kills); ?></div>
<div><?php echo("Deaths: ".$playerdata->hb->deaths); ?></div>
<div><?php echo("K/D Ratio: ".$playerdata->hb->kd); ?></div>
<div><?php echo("Points: ".$playerdata->hb->points); ?></div>
<div><?php echo("Points: ".$playerdata->hb->points); ?></div>
<br /><br />
<div><strong>Trouble in Minevill</strong></div>

<div><?php echo("Detective: ".$playerdata->timv->detective); ?></div>
<div><?php echo("Innocent: ".$playerdata->timv->innocent); ?></div>
<div><?php echo("Traitor: ".$playerdata->timv->traitor); ?></div>
<div><?php echo("Most Points: ".$playerdata->timv->mostPoints); ?></div>
<div><?php echo("Karma: ".$playerdata->timv->karma); ?></div>



<?php endif; ?>
