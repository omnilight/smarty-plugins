<?php
/*
 * Smarty plugin
 */
function smarty_block_cache($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    static $caches = array();

    /** @var $controller CController */
    $controller = $template->getVariable('this')->value;

    if(!($controller instanceof CController || $controller instanceof CWidget))
        throw new CException('You must define \'$this\' variable for Smarty');

    // First time
    if(!isset($params['id']))
        throw new CException('id parameter not defined for smarty plugin');

    $id = $params['id'];
    unset($params['id']);

    if($repeat == true) {
        $caches[$id] = $controller->beginCache($id, $params);
    } else {
        if(isset($caches[$id]) && $caches[$id])
            $controller->endCache();
    }
}