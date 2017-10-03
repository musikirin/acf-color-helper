# Color class for ACF
When you use Advanced Custom Field's Color Picker, you should define Color Style in HTML Head.
This class help for defining color style like a SASS(scss) at head.

Advanced Custom Fieldでカラーピッカーを使用すると、HTMLのヘッダータグにCSSを書く必要がでてきます。
このクラスは、head内のCSSでもSASS（SCSS）のように色に乗算をしたり、最適な文字色を得られるクラスです。

You define new ACF_Color instance from HEX color code by Advanced Custom Field's Color Picker.
You can get lighter color, darker color, and readable text color from functions.
Just only. :)

最初にACFから得られるカラーコードでクラスをインスタンス化します。
あとは関数から、暗い色、明るい色、最適な文字色を取り出すことができます。

## EXAMPLE
```
$primary = new Color(<?php the_field('primary'; ?>);

.primary {
 background-color:<?php $primary->the_hex(); ?>
 color:<?php $primary->the_text_hex(); ?>
}
```