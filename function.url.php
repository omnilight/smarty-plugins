<?php
/**
 * Allows to generate urls using CHtml::createUrl().
 *
 * Syntax:
 * {url}
 * {url route="controller/action"}
 * {url route=["controller/action","param"=>1]}
 * {url route="/absolute/url"}
 * {url route="http://host/absolute/url"}
 *
 * @see CHtml::createUrl()
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_function_url($params, &$smarty){
    if(empty($params['route'])){
        throw new CException("Function 'route' parameter should be specified.");
    }

    $route = $params['route'];

    if(isset($params['absolute'])){
        return Yii::app()->createAbsoluteUrl($route[0],array_slice($route,1));
    } else {
        return CHtml::normalizeUrl($route);
    }
}