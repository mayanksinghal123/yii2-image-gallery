<?php
namespace handy\imageGallery\src\actions;

use handy\imageGallery\components\Path;
use handy\imageGallery\events\UploadEvent;
use handy\imageGallery\Storage;
use yii\web\Response;

class ImageGalleryUploadAction extends BaseAction
{
    const EVENT_AFTER_SAVE = 'afterSave';
    /**
     * @var bool
     */
    public $disableCsrf = true;

    /**
     * @var string
     */
    public $remoteUrl;

    /**
     * @var string
     */
    public $responseFormat = Response::FORMAT_JSON;

    /**
     * @var array
     */
    public $response=['status'=>0,'data'=>null];
    public function init()
    {
        $this->remoteUrl= $_POST['remoteUrl'];
        \Yii::$app->response->format = $this->responseFormat;


        if ($this->disableCsrf) {
            \Yii::$app->request->enableCsrfValidation = false;
        }
    }

    /**
     * @return array
     * @throws \HttpException
     */
    public function run()
    {
        /*$path=new Path();
        $path->on(Path::EVENT_GET_PATH, function ($event) {
            //return json_encode(['path'=>$event->path]);
            return [];
        });*/

        $baseUrl=$this->getFileStorage()->baseUrl;
        $uploadDir=$this->getStorageDir($baseUrl);
        //$data=$this->getFileStorage()->save($this->remoteUrl,$uploadDir,$baseUrl,$path);
        $data=$this->getFileStorage()->save($this->remoteUrl,$uploadDir,$baseUrl);
        if(is_array($data)){
            $this->response['status']=1;
            $this->response['data']=$data;
        }else{
            $this->response['status']=0;
            $this->response['data']=null;
        }
        return json_encode($this->response);
        //$this->afterSave("https://eoimages.gsfc.nasa.gov/images/imagerecords/50000/50781/pakistan_amo_2011152_lrg.jpg");
        //$this->getFileStorage();
    }
    /**
     * @param $path
     */
    public function afterSave($path)
    {
        $this->trigger(self::EVENT_AFTER_SAVE, new UploadEvent([
            'path' => $path,
        ]));
    }
}
