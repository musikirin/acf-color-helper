<?php
require_once('./color.php');
use YAWP\Color as Color;
function randomHex(){
    return sprintf("%02x",mt_rand()%256);
}
function applyColor(){
    return new Color('#'.randomHex().randomHex().randomHex());
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        <?php
        $a = range(0,300);
        $colorArray = array_map("applyColor", $a);
        $i = 0;
        foreach($colorArray as $c){
            print ".c{$i} {\n";
            print "display:inline-block;";
            print "background: {$c->get_hex()};\n";
            print "color: {$c->get_text_hex()};\n";
            print "padding:5px;";
            print "margin:5px;";
            print "}\n";
            $i += 1;
        }
        ?>
    </style>
</head>
<body>
<?php
$i = 0;
foreach($colorArray as $c){
    print "<span class=\"c{$i}\">";
    $c->isDark ? print 1: print 0;
    print "</span>";
    $i += 1;
}
?>
</body>
</html>