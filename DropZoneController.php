<?php

namespace devgroup\dropzone;

use yii\web\Controller;

/**
 * Class DropZoneController
 * @package devgroup\dropzone
 */
class DropZoneController extends Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => UploadAction::className(),
            ],
            'remove' => [
                'class' => RemoveAction::className(),
            ]
        ];
    }
}