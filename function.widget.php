<?php

/**
 * @param $params
 * @param Smarty $smarty
 * @throws CException
 */
function smarty_function_widget($params, &$smarty){

    /** @var $controller CController */
    $controller = $smarty->getVariable('this')->value;

    if(!($controller instanceof CController || $controller instanceof CWidget))
        throw new CException('You must define \'$this\' variable for Smarty as an instance of CController or CWidget');

    if(empty($params['name'])){
        throw new CException("Function 'name' parameter should be specified.");
    }

    $name = $params['name'];
    unset($params['name']);
    $properties = isset($params['properties'])?$params['properties'] : $params;

    return $controller->widget($name, $properties, true);
}