<?php

/**
 * Register script with {@link CClientScript::registerScriptFile} or
 * {@link CClientScript::registerCoreScript}.
 * <br>
 * Possible parameters are:
 * <br>
 * name - name of package or core script<br>
 * url - URL of your script. You must use either name or url<br>
 * asset - path to script in assets folder. Url of this folder is
 * defined with two methods. If widget's owner has method getAssetsUrl,
 * than it will be called to publish all assets. Otherwise you must define
 * parameter 'path'<br>
 * position - position of the script Could be {@link CClientScript::POS_HEAD},
 * {@link CClientScript::POS_BODY} or {@link CClientScript::POS_END}
 * depends - array or comma separated string with the names of depended packages
 *
 * @param array $params
 * @param Smarty $smarty
 * @throws CException
 *
 * @todo Maybe this function is too heavy
 */
function smarty_function_register_script($params, &$smarty){
    /** @var $cs CClientScript */
    $cs = Yii::app()->clientScript;

    if(isset($params['position']))
        $position = $params['position'];
    else
        $position = CClientScript::POS_END;

    if(isset($params['depends'])) {
        if(!is_array($params['depends']))
            $depends = preg_split('/[\s,]+/',$params['depends'],-1,PREG_SPLIT_NO_EMPTY);
        else
            $depends = $params['depends'];
        foreach($depends as $depend) {
            $cs->registerCoreScript($depend);
        }
    }

    if(!empty($params['name']))
        $cs->registerCoreScript($params['name']);
    elseif(!empty($params['asset'])) {
        $owner = $smarty->getVariable('this')->value;
        if(!empty($params['path'])) {
            /** @var $as CAssetManager */
            $as = Yii::app()->assetManager;
            $url = $as->publish(Yii::getPathOfAlias($params['path']), false, -1, Yz::get()->alwaysUpdateAssets);
            $cs->registerScriptFile($url . $params['asset'], $position);
        }elseif(gettype($owner) == 'object')
            $cs->registerScriptFile($owner->getAssetsUrl() . $params['asset'], $position);
        else
            throw new CException("Owner doesn't have 'getAssetsUrl' or aren't an object");
    } elseif(!empty($params['url']))
        $cs->registerScriptFile($params['url'], $position);
    else
        throw new CException("Function 'name', 'assets' or 'url' parameters should be specified.");
}