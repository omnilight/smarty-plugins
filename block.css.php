<?php
/*
 * Smarty plugin
 */
function smarty_block_css($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    if($repeat)
        return;

    /** @var $cs CClientScript */
    $cs = Yii::app()->clientScript;

    if(!isset($params['id']))
        throw new CException('id parameter not defined for smarty plugin');

    $id = $params['id'];
    $position = isset($params['pos'])?$params['pos'] : CClientScript::POS_READY;

    $cs->registerCss($id, $content);
}