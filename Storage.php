<?php
namespace handy\imageGallery;

use handy\imageGallery\components\Path;
use handy\imageGallery\getRemote\GetImage;
use yii\base\Component;
use yii\base\InvalidConfigException;
use handy\imageGallery\events\StorageEvent;


class Storage extends Component
{

    /**
     * Event triggered after delete
     */
    const EVENT_GET_PATH= 'getStoragePath';
    /**
     * Event triggered after delete
     */
    const EVENT_BEFORE_DELETE = 'beforeDelete';
    /**
     * Event triggered after save
     */
    const EVENT_BEFORE_SAVE = 'beforeSave';
    /**
     * Event triggered after delete
     */
    const EVENT_AFTER_DELETE = 'afterDelete';
    /**
     * Event triggered after save
     */
    const EVENT_AFTER_SAVE = 'afterSave';
    /**
     * @var
     */
    public $baseUrl;
    /**
     * @var
     */
    public $filesystemComponent;
    /**
     * @var
     */
    protected $filesystem;
    /**
     * Max files in directory
     * "-1" = unlimited
     * @var int
     */
    public $maxDirFiles = 65535; // Default: Fat32 limit
    /**
     * @var int
     */
    private $dirindex = 1;
    /**
     * @throws InvalidConfigException
     */

    public function init()
    {
        if ($this->baseUrl !== null) {
            $this->baseUrl = \Yii::getAlias($this->baseUrl);
        }

    }

    public function getFilesystem()
    {
        return $this->filesystem;
    }

    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param $file string|\yii\web\UploadedFile
     * @param bool $preserveFileName
     * @param bool $overwrite
     * @param Path $pathObj
     * @return bool|array
     */
    public function save($remoteUrl,$storageDir,$baseUrl,$pathObj=null)
    {
        $filename = implode('.', [
            \Yii::$app->security->generateRandomString(),
            $this->getExtension($remoteUrl)
        ]);
        $path = implode('/', [$this->getDirIndex(), $filename]);
        $storagePath=$storageDir."/".$path;

        $finalImagePath=$baseUrl."/".$this->getDirIndex()."/".$filename;
        $baseUrlNew=$baseUrl."/".$this->getDirIndex()."/";
      $getImage=new GetImage();
      $getImage->remoteUrl=$remoteUrl;
      $getImage->storageUrl=$storagePath;
      if($getImage->startSave()){
          /*$pathObj->fileName=$filename;
          $pathObj->imagePath=$finalImagePath;
          $pathObj->start();*/
          return ['path'=>$filename,'url'=>$finalImagePath,'base_url'=>$baseUrlNew];
      }
      return false;
    }

    protected function getExtension($remoteUrl){
        $t=explode('.',$remoteUrl);
        return $t[count($t)-1];
    }

    /**
     * @return false|int|string
     */
    protected function getDirIndex()
    {
        return $this->dirindex;
    }

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function afterSave($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = \Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_AFTER_SAVE, $event);
    }

}
