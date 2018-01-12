<?php
namespace backend\widgets\imageGallery;

use backend\widgets\imageGallery\components\Path;
use backend\widgets\imageGallery\getRemote\GetImage;
use League\Flysystem\FilesystemInterface;
use trntv\filekit\filesystem\FilesystemBuilderInterface;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\widgets\imageGallery\events\StorageEvent;


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

        if ($this->filesystemComponent !== null) {
            $this->filesystem = \Yii::$app->get($this->filesystemComponent);
        } else {
            $this->filesystem = \Yii::createObject($this->filesystem);
            if ($this->filesystem instanceof FilesystemBuilderInterface) {
                $this->filesystem = $this->filesystem->build();
            }
        }
    }

    /**
     * @return FilesystemInterface
     * @throws InvalidConfigException
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param $filesystem
     */
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
    public function saveOld($remoteUrl,$storageDir)
    {

        $filename = implode('.', [
            \Yii::$app->security->generateRandomString(),
            $this->getExtension($remoteUrl)
        ]);
        $path = implode('/', [$this->getDirIndex(), $filename]);
        $storagePath=$storageDir."/".$path;
        echo $storagePath;
        die;

        $imageData=file_get_contents($remoteUrl);
        if($imageData === FALSE){
            echo "false";
        }else{
            echo "true";
        }
        echo "<pre>";
        print_r($imageData);
        echo "</pre>";
        die();
        if($imageData){
            if(file_put_contents($storagePath,$imageData)){
                echo "file put success";
                return true;
            }else{
                echo "file put failed";
                return false;
            }
        }else{
            return false;
        }

    }

    protected function getExtension($remoteUrl){
        $t=explode('.',$remoteUrl);
        return $t[count($t)-1];
    }

    /**
     * @param $files array|\yii\web\UploadedFile[]
     * @param bool $preserveFileName
     * @param bool $overwrite
     * @return array
     */
    public function saveAll($files, $preserveFileName = false, $overwrite = false)
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->save($file, $preserveFileName, $overwrite);
        }
        return $paths;
    }

    /**
     * @param $path
     * @return bool
     */
    public function delete($path)
    {
        if ($this->getFilesystem()->has($path)) {
            $this->beforeDelete($path, $this->getFilesystem());
            if ($this->getFilesystem()->delete($path)) {
                $this->afterDelete($path, $this->getFilesystem());
                return true;
            };
        }
        return false;
    }

    /**
     * @param $files
     */
    public function deleteAll($files)
    {
        foreach ($files as $file) {
            $this->delete($file);
        }

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
     * @throws InvalidConfigException
     */
    public function beforeSave($path)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = \Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path
        ]);
        $this->trigger(self::EVENT_BEFORE_SAVE, $event);
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

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function beforeDelete($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = \Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_BEFORE_DELETE, $event);
    }

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function afterDelete($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = \Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_AFTER_DELETE, $event);
    }
}
