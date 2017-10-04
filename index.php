<?php
require_once('./lib/color.php');
use Musikirin\ACF_Helper\Color as Color;

// Random Generator for debug.
function randomHex()
{
    return sprintf("%02x", mt_rand() % 256);
}

function applyColor()
{
    return new Color('#' . randomHex() . randomHex() . randomHex());
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

        // 文字色取得テスト用のランダムCSS
        $a = range(0, 300);
        $colorArray = array_map("applyColor", $a);
        $i = 0;
        foreach($colorArray as $c):
        ?>
        .c<?php echo $i; ?> {
            display: inline-block;
            background: <?php $c->the_hex(); ?>;
            color: <?php $c->the_text_hex(); ?>;
            padding: 5px;
            margin: 5px;
        }

        <?php
            $i += 1; // CSSのクラス名を定義するための変数
            endforeach;
        ?>
    </style>
</head>
<body>
<h1>ACF Color Picker Helper</h1>
<main>
    <h2>文字色取得関数のテスト</h2>

    <?php
    $i = 0;
    foreach ($colorArray as $c) {
        print "<span class=\"c{$i}\">";
        $c->isDark ? print 1 : print 0;
        print "</span>";
        $i += 1;
    }
    ?>
</main>
</body>
</html>