# Color class for ACF
When you use Advanced Custom Field's Color Picker, you should define Color Style in HTML Head.
This class help for defining color style like a SASS at head.

You create new ACF_Color instance from HEX color code by Advanced Custom Field's Color Picker.
And you will define color style of css in html header.
You can get lighter color, darker color, and readable text color from functions.

## EXAMPLE
```
$primary = new Color(<?php the_field('primary'; ?>);
.primary {
 background-color:<?php $primary->the_hex(); ?>
 color:<?php $primary->the_text_hex(); ?>
}
```