<?php
/*
 * Smarty plugin
 */
function smarty_block_script($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    if($repeat)
        return;

    /** @var $cs CClientScript */
    $cs = Yii::app()->clientScript;

    if(!isset($params['id']))
        throw new CException('id parameter not defined for smarty plugin');

    $id = $params['id'];
    $position = isset($params['position'])?$params['position'] : CClientScript::POS_READY;

    $stripScriptTag = isset($params['stripScriptTag'])?$params['stripScriptTag']:true;

    if($stripScriptTag) {
        $content = preg_replace('#^[\r\n\s]*<script\s+[^>]*>#ms','',$content);
        $content = preg_replace('#</script\s*[^>]*>[\r\n\s]*$#ms','',$content);
    }

    $cs->registerScript($id, $content);
}