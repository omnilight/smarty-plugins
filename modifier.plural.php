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
function smarty_modifier_plural($message, $number, $language = null)
{
    if($language === null)
        $language = Yii::app()->getLanguage();
    $expressions = Yii::app()->getLocale($language)->getPluralRules();
    $chunks=explode('|',$message);
    if($n=min(count($chunks),count($expressions)))
    {
        for($i=0;$i<$n;$i++)
            $chunks[$i]=$expressions[$i].'#'.$chunks[$i];

        $message=implode('|',$chunks);
    }
    $message=CChoiceFormat::format($message,$number);
    return strtr($message, array(
        '{n}' => $number
    ));
}