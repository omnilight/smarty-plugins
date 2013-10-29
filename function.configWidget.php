<?php

/**
 * @param $params
 * @param Smarty $smarty
 * @throws CException
 */
function smarty_function_configWidget($params, &$smarty)
{
    if(empty($params['name'])){
        throw new CException("Function 'name' parameter should be specified.");
    }

    $name = $params['name'];
    unset($params['name']);
    $properties = isset($params['properties'])?$params['properties'] : $params;

    Yii::app()->widgetFactory->widgets[$name] = $properties;

    return '';
}