<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.javascript.php
 * Type:     modifier
 * Name:     prepend
 * Purpose:  prepends string
 * -------------------------------------------------------------
 */
function smarty_modifier_javascript($string,$type='encode')
{
    return call_user_func(array('CJavaScript',$type),$string);
}