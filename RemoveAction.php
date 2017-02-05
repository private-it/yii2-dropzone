<?php

namespace devgroup\dropzone;

use Yii;
use yii\base\Action;
use yii\web\Response;

/**
 * Class RemoveAction
 * @package devgroup\dropzone
 */
class RemoveAction extends Action
{
    /**
     * @return int
     */
    public function run()
    {
        $filename = Yii::$app->request->post('filename');
        $cmp = DropZoneComponent::getInstance();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return boolval(unlink($cmp->uploadDir . $filename));
    }
}
