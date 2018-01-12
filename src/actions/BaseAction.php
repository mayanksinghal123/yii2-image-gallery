<?php
namespace handy\imageGallery\src\actions;

use yii\base\Action;
use yii;


abstract class BaseAction extends Action
{
    /**
     * @var string file storage component name
     */
    public $fileStorage = 'fileStorage';
    /**
     * @var string Request param name that provides file storage component name
     */
    public $fileStorageParam = 'fileStorage';
    /**
     * @var string session key to store list of uploaded files
     */
    public $sessionKey = '_uploadedFiles';


    /**
     * @return \handy\imageGallery\Storage
     * @throws \HttpException
     * @throws \yii\base\InvalidConfigException
     */
    protected function getFileStorage()
    {
        $fileStorageId = Yii::$app->request->get($this->fileStorageParam, $this->fileStorage);
        $fileStorage = Yii::$app->get($fileStorageId,true,true);
        if (!$fileStorage) {
            throw new \HttpException(400);
        }
        return $fileStorage;
    }
    protected function getDemo(){

        echo "<pre>";
        print_r(Yii::$app->get("fileStorage"));
        echo "</pre>";
        die();
    }

    protected function getStorageDir($fileStorageUrl){
        $hostInfo= Yii::$app->request->hostInfo;
        if(Yii::$app->request->serverName=='localhost'){
             $hostInfo=$hostInfo."/contaqt2";
        }
        $storagePath=explode($hostInfo,$fileStorageUrl);
        $pathDir=$storagePath[1];
        $currentUrl = Yii::$app->urlManager->parseRequest(Yii::$app->request);
        $dirCount = count(explode('/',$currentUrl[0]));
        switch($dirCount){
            case 0: return $pathDir;

            case 1:  return "..".$pathDir;
                    break;
            case 2:  return "../..".$pathDir;
                    break;
            case 3:  return "../../..".$pathDir;
                break;
        }
        return false;
    }
}
