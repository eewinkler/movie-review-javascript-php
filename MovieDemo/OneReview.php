<!DOCTYPE html>
<html>
<head>
<title>OneReview</title>
<link href="movies.css" type="text/css" rel="stylesheet">
</head>
<body>

<!-- Name: Ethan Winkler -->

<div class='header'>
	<img src="images/rancidbanner.png" alt="Rancid Tomatoes">
</div>

<?php
$movieDir = $_GET['movieDir'];
//$movieDir = 'princessbride';
//echo "You sent me '" . $movieDir . "' as a query parameter";

$arr = file($movieDir . '/info.txt');
echo "<h1>" . $arr[0] . " ( " . $arr[1] . ")<h1>";

echo freshOrRotten($arr);

$image = $movieDir . '/overview.png';
echo "<div class='overview'><img src=" . "'" . $image . "'" . "alt='general overview' /></div></div>";

$rev = glob("./".$movieDir."/review*.txt");

echo reviews($rev);

echo overview($movieDir);

function freshOrRotten ($arr){
    if ($arr[2] < 50){
        echo "<div class='main'><div class='percent'><span class='tom'><img src='images/rottenlarge.png' alt='Rotten' height='83'/></span><span class='num'>".$arr[2]."%</span>";
    }
    else {
        echo "<div class='main'><div class='percent'><span class='tom'><img src='images/freshlarge.png' alt='Fresh' height='83' /></span><span class='num'>".$arr[2]."%</span>";
    }
}

function reviews ($rev){ 
    echo "<div class='allreviews'><div class='left'>";
    for ($i = 0; $i < sizeOf($rev); $i++) {
        $one = file($rev[$i]);
        if (($i === 4) && (sizeOf($rev) <= 7)) {
            echo "</div><div class='right'>";
        }
        if (($i === 5) && (sizeOf($rev) > 7)) {
            echo "</div><div class='right'>";
        }
        echo "<p class='review'>";
        if (strcmp($one[1], "ROTTEN") === 1) {
            echo "<img src='images/rotten.gif' alt='Rotten' /> <q>" . $one[0] . "</q></p>";
            echo "<p class='author'><img src='images/critic.gif' alt='Critic' />" . $one[2] . "<br />" . $one[3] . "</p>";
        }
        else {
            echo "<img src='images/fresh.gif' alt='Fresh' /> <q>" . $one[0] . "</q></p>";
            echo "<p class='author'><img src='images/critic.gif' alt='Critic' />" . $one[2] . "<br />" . $one[3] . "</p>";
        }
    }
    echo "</div></div>";
}

function overview ($movieDir){
    $arr = file($movieDir . '/overview.txt');
    $result = "<div class='credits'><dl>";
    for ($index = 0; $index < count($arr); $index +=1) {
        $arr_colon = explode(":", $arr[$index]);
        for ($index1 = 0; $index1 < count($arr_colon); $index1 +=1) {
            if ($index1 == 0){
                $result = $result . '<dt>' . $arr_colon[$index1] . ':</dt>';
            }
            else if (($index1 % 2) != 0){
                $result = $result . '<dd>' . $arr_colon[$index1] . '</dd>';
            }
            else if (($index1 % 2) == 0){
                $result = $result . '<dt>' . $arr_colon[$index1] . ':</dt>';
            }
        }
    }
    $result .= "</dl></div></div>";
    
    return $result;
}

?> 

</body>
</html>