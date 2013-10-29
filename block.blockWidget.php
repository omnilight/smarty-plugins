<?php
/**
 * @param $params
 * @param $content
 * @param Smarty_Internal_Template $template
 * @param $repeat
 * @throws CException
 */
function smarty_block_blockWidget($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    /** @var $controller CController */
    $controller = $template->getVariable('this')->value;

    if(!($controller instanceof CController || $controller instanceof CWidget))
        throw new CException('You must define \'$this\' variable for Smarty');

    if($repeat == true) {
        // First time calling
        if(empty($params['name'])){
            throw new CException("Function 'name' parameter should be specified.");
        }

        if(empty($params['assign'])){
            $assign = null;
        } else
            $assign = $params['assign'];

        $name = $params['name'];
        unset($params['name'],$params['assign']);
        $properties = isset($params['properties'])?$params['properties'] : $params;

        $widget = $controller->beginWidget($name, $properties);

        if($assign !== null)
            $template->assign($assign, $widget);
        return '';

    } else {
        // Second time function calling

        echo $content;
        $controller->endWidget();

        return '';
    }
}