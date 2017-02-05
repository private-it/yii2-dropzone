<?php

namespace devgroup\dropzone;

use yii\base\BootstrapInterface;
use yii\base\Object;
use yii\helpers\Url;
use yii\web\Application;

/**
 * Class DropZoneComponent
 * @package devgroup\dropzone
 *
 * @property string $uploadDir
 * @property string $downloadUrl
 */
class DropZoneBootstrap extends Object implements BootstrapInterface
{
    /**
     * @var bool|callable
     */
    public $autoRegisterAssets = false;

    /**
     * @var bool|callable
     */
    public $autoRegisterController = false;

    /**
     * @var string
     */
    public $controllerName = 'dropZone';

    /**
     * @var string
     */
    public $controllerClass = 'devgroup\dropzone\DropZoneController';

    /**
     * @var string
     */
    public $controllerConfig = [];

    /**
     * @var array
     */
    public $componentConfig = [];

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_REQUEST, function () use ($app) {

            $cmp = $this->componentConfig;
            $cmp['class'] = DropZoneComponent::className();

            if (is_callable($this->autoRegisterAssets)) {
                $this->autoRegisterAssets = call_user_func($this->autoRegisterAssets, $app);
            }
            if ($this->autoRegisterAssets) {
                $app->view->registerAssetBundle(DropZoneAsset::className());
            }

            if (is_callable($this->autoRegisterController)) {
                $this->autoRegisterController = call_user_func($this->autoRegisterController, $app);
            }
            if ($this->autoRegisterController) {

                $ctrl = $this->controllerConfig;
                $ctrl['class'] = $this->controllerClass;
                $app->controllerMap[$this->controllerName] = $ctrl;

                $cmp['uploadUrl'] = Url::to(['/' . $this->controllerName . '/upload']);
                $cmp['removeUrl'] = Url::to(['/' . $this->controllerName . '/remove']);

            }

            $app->set('dropZone', $cmp);

        });
    }
}