<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.url.php
 * Type:     modifier
 * Name:     prepend
 * Purpose:  prepends string
 * -------------------------------------------------------------
 */
function smarty_modifier_url($string, $type = 'static')
{
    switch($type) {
        default:
            $prepend = '';
            break;
        case 'static':
            $prepend = Yii::app()->baseUrl;
            break;
    }

    return $prepend . $string;
}