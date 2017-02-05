<?php

namespace devgroup\dropzone;

use Yii;
use yii\base\Component;

/**
 * Class DropZoneComponent
 * @package devgroup\dropzone
 *
 * @property string $uploadDir
 * @property string $downloadUrl
 */
class DropZoneComponent extends Component
{
    /**
     * @var string
     */
    public $uploadUrl;

    /**
     * @var string
     */
    public $removeUrl;

    /**
     * @var string
     */
    private $_uploadDir;

    /**
     * @var string
     */
    private $_downloadUrl;

    /**
     * @var DropZoneComponent
     */
    private static $_instance;

    /**
     * @return DropZoneComponent
     */
    public static function getInstance()
    {
        if (static::$_instance instanceof DropZoneComponent) {
            return static::$_instance;
        }
        return static::$_instance = Yii::$app->get('dropZone');
    }

    /**
     * @param string $filename
     * @return string
     */
    public static function getDownloadUrlFile($filename)
    {
        return strtr(self::getInstance()->downloadUrl, ['{filename}' => $filename]);
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        if (!$this->_uploadDir) {
            $this->_uploadDir = Yii::getAlias('@webroot/upload') . '/';
        }
        return $this->_uploadDir;
    }

    /**
     * @param string $uploadDir
     * @return DropZoneComponent
     */
    public function setUploadDir($uploadDir)
    {
        $this->_uploadDir = Yii::getAlias($uploadDir);
        if (substr($this->_uploadDir, -1) != '/') {
            $this->_uploadDir .= '/';
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDownloadUrl()
    {
        if (!$this->_downloadUrl) {
            $this->_downloadUrl = Yii::getAlias('@web/upload') . '/';
        }
        return $this->_downloadUrl;
    }

    /**
     * @param mixed $downloadUrl
     * @return DropZoneComponent
     */
    public function setDownloadUrl($downloadUrl)
    {
        $this->_downloadUrl = $downloadUrl;
        return $this;
    }
}