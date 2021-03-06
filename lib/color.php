<?php
namespace Musikirin\ACF_Helper;
/**
 * Advanced Custom Field"s Color Picker helper.
 * @author musikirin <main@musikirin.com>
 */

/**
 * Class Color
 * @package Musikirin\ACF_Helper
 * @author musikirin <main@musikirin.com>
 */
class Color
{

    /**
     * Brightness coefficient of each primary colors when calculate best text color.
     * テキストカラーを算出するときの各原色にかかる係数。
     * 
     * @var array
     */
    private $brightMod = array(
    'r' => 0.15,
    'g' => 1,
    'b' => 0.5
    );

    /**
     * YAHelper Color constructor.
     * @param $_color_code
     */
    function __construct($_color_code)
    {
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
     * @return array $c array(R,G,B)形式のRGB値
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
     *
     * @param $value
     * @return array array(R,G,B)に乗算したarray.
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
     *
     * @return string HEX color code like a "#ffffff".
     */
    function get_hex()
    {
        return $this->hex;
    }

    /**
     * HEXカラーコードをprint出力
     * Print out HEX color code.
     * @return string
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
     * @param $value array[int]
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
     * This function returns multipled HEX color code.
     * @param $hex
     * @return string
     */
    function get_multiply_hex($hex)
    {
        $b = $this->color_multiply($hex);
        return $this->array_rgb2hex($b);
    }

    /**
     * 乗算したHEXカラーコードを返してprint
     * This function prints Multipiled HEX color code.
     * @param $hex
     * @return string
     */
    function the_multiply_hex($hex)
    {
        return print $this->get_multiply_hex($hex);
    }

    /**
     * 色から最適な文字色を返す。
     * Function returns best text color by Judgement whether constructed color was dark or light.
     * @param $dark : Return color when argument's color was dark.
     * @param $light : Opposite.
     * @return string
     */
    function get_text_hex($dark = '#ffffff', $light = '#000000')
    {
        if ($this->isDark) {
            // When color was dark. Return this.
            return $dark;
        } else {
            // When color was light. Return this.
            return $light;
        }
    }

    /**
     * 最適な文字色をprint
     * Function returns best text color by HEX color code.
     */
    function the_text_hex()
    {
        print $this->get_text_hex();
    }
}