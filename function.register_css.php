<?php
/**
 * @param array $params
 * @param Smarty $smarty
 * @throws CException
 */
function smarty_function_register_css($params, &$smarty)
{
    /** @var $cs CClientScript */
    $cs = Yii::app()->clientScript;

    if(!empty($params['asset'])) {
        $owner = $smarty->getVariable('this')->value;
        if(!empty($params['path'])) {
            /** @var $as CAssetManager */
            $as = Yii::app()->assetManager;
            $url = $as->publish(Yii::getPathOfAlias($params['path']), false, -1, Yz::get()->alwaysUpdateAssets);
            $cs->registerCssFile($url . $params['asset']);
        }elseif(gettype($owner) == 'object')
            $cs->registerCssFile($owner->getAssetsUrl() . $params['asset']);
        else
            throw new CException("Owner doesn't have 'getAssetsUrl' or aren't an object");
    } elseif(!empty($params['url']))
        $cs->registerCssFile($params['url']);
    else
        throw new CException("Function 'assets' or 'url' parameters should be specified.");
}