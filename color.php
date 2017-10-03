<?php

/**
 * Class ACF_Color
 * When you use Advanced Custom Field's Color Picker, you should define Color Style in HTML Head.
 * This class help for defining color style like a SASS at head.
 */
class ACF_Color
{
    /**
     * YAHelper Color constructor.
     * @param $_color_code
     */
    function __construct($_color_code)
    {
        $this->brightMod = array(
            'r' => 0.15,
            'g' => 1,
            'b' => 0.5
        );
        $this->rgb = $this->rgb_array($_color_code);
        $this->r = $this->rgb[0];
        $this->g = $this->rgb[1];
        $this->b = $this->rgb[2];
        $this->hex = $this->array_rgb2hex($this->rgb);
        $this->isDark = $this->isDark();
    }

    /**
     * Return array(R,G,B)
     * 16進数のカラーコードからRGBの配列に変換
     * @return array
     */
    private function rgb_array($hex)
    {
        $a = preg_replace('/#/', "", $hex);
        $b = array(substr($a, 0, 2), substr($a, 2, 2), substr($a, 4, 2));
        $c = array_map(function ($x) {
            return hexdec($x);
        }, $b);
        return $c;
    }

    /**
     * Change from array(R,G,B) to HEX color code like #ffffff.
     * RGBの配列から16進数のカラーコードを生成する。
     * @param $array
     * @return string
     */
    private function array_rgb2hex($array)
    {
        return "#" . sprintf("%02x", $array[0]) . sprintf("%02x", $array[1]) . sprintf("%02x", $array[2]);
    }

    /**
     * Multiple to array(R,G,B). Multipiled value will fixed by from 0 to 255.
     * array(R,G,B)に対して乗算をし、0〜255の範囲に修正する。
     */
    private function color_multiply($value)
    {
        return array_map(function ($x) use ($value) {
            return max(min(round($x * $value), 255), 0);
        }, $this->rgb);
    }

    /**
     * This function will judge whether argument color is dark.
     * 色とRGBそれぞれの輝度から暗い色かを判定する。
     * @return bool
     */
    private function isDark()
    {
        $l = $this->brightMod['r'] * 255 + $this->brightMod['g'] * 255 + $this->brightMod['b'] * 255;
        $t = $this->brightMod['r'] * $this->r + $this->brightMod['g'] * $this->g + $this->brightMod['b'] * $this->b;
        return $t < ($l / 2);
    }

    /**
     * HEXカラーコードをそのまま出力
     * Return HEX Color code.
     * @return mixed
     */
    function get_hex()
    {
        return $this->hex;
    }

    /**
     * HEXカラーコードをprint出力
     * Print out HEX color code.
     * @return mixed
     */
    function the_hex()
    {
        return print $this->hex;
    }

    /**
     * HEXをrgb(i,i,i)に変換
     * Translate from HEX color code to RGB array.
     * @return string
     */
    function get_rgb()
    {
        return "rgb($this->r,$this->g,$this->b)";
    }

    /**
     * HEXをrgb(i,i,i)に変換してprint
     * Translate from HEX color code to RGB array and print out.
     * @return string
     */
    function the_rgb()
    {
        return print $this->get_rgb();
    }

    /**
     * 乗算したrgb(i,i,i)を返す。
     * Return multipled RGB array.
     * @param $value
     * @return string
     */
    function get_multiply_rgb($value)
    {
        $b = $this->color_multiply($value);
        return "rgb($b[0],$b[1],$b[2])";
    }

    /**
     * 乗算したrgb(i,i,i)を返してprint。
     * Print multipled RGB array.
     * @param $value
     * @return string
     */
    function the_multiply_rgb($value)
    {
        return print $this->get_multiply_rgb($value);
    }

    /**
     * 乗算したHEXカラーコードを返す。
     * Return multipled HEX color code.
     * @param $value
     * @return string
     */
    function get_multiply_hex($value)
    {
        $b = $this->color_multiply($value);
        return $this->array_rgb2hex($b);
    }

    /**
     * 乗算したHEXカラーコードを返してprint
     * Print Multipiled HEX color code.
     * @param $value
     * @return string
     */
    function the_multiply_hex($value)
    {
        return print $this->get_multiply_hex($value);
    }

    /**
     * 色から最適な文字色を返す。
     * Return best text color by Judgement whether constructed color was dark or light.
     * @return string
     */
    function get_text_hex()
    {
        if ($this->isDark) {
            return "#ffffff";
        } else {
            return "#000000";
        }
    }

    /**
     * 最適な文字色をprint
     * Print best text color by HEX color code.
     */
    function the_text_hex()
    {
        print $this->get_text_hex();
    }
}