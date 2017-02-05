<?php

namespace devgroup\dropzone;

use Yii;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Class UploadAction
 * @package devgroup\dropzone
 */
class UploadAction extends Action
{
    /**
     * @var string
     */
    public $requestFileKey = 'file';

    /**
     * @var null|callable
     */
    public $afterUploadHandler = null;

    /**
     * @var null|callable
     */
    public $afterUploadData = null;

    /**
     * @return string
     * @throws HttpException
     */
    public function run()
    {
        $file = UploadedFile::getInstanceByName($this->requestFileKey);
        if ($file->hasError) {
            throw new HttpException(500, 'Upload error', $file->error);
        }

        $cmp = DropZoneComponent::getInstance();

        $fileName = $file->name;
        if (file_exists($cmp->uploadDir . $fileName)) {
            $fileName = $file->baseName . '-' . uniqid() . '.' . $file->extension;
        }
        $file->saveAs($cmp->uploadDir . $fileName);

        $response = [
            'filename' => $fileName,
        ];

        if (isset($this->afterUploadHandler)) {
            $data = [
                'data' => $this->afterUploadData,
                'file' => $file,
                'dirName' => $cmp->uploadDir,
                'src' => $cmp::getDownloadUrlFile($fileName),
                'filename' => $fileName,
                'params' => Yii::$app->request->post(),
            ];

            if ($result = call_user_func($this->afterUploadHandler, $data)) {
                $response['afterUpload'] = $result;
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}
