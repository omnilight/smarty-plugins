<?php
/**
 * Function returns plural form of message, based on $number parameter value.
 *
 * This function is based on {@see YiiBase::t} function code
 * @param string $message
 * @param integer $number
 * @param string $language
 * @return string
 */
function smarty_modifier_yiit($message, $category, $params = array())
{
    return Yii::t($category, $message, $params);
}