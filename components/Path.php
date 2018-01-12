<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 02-01-2018
 * Time: 12:18
 */
namespace backend\widgets\imageGallery\components;
use backend\widgets\imageGallery\events\StorageEvent;
use yii\base\Component;

class Path extends Component
{
    /**
     * Event triggered after delete
     */
    const EVENT_GET_PATH= 'getStoragePath';
    public $imagePath;
    public $fileName;

    public function start()
    {
        $this->trigger(self::EVENT_GET_PATH,new StorageEvent(['path' => $this->imagePath,'imageName' => $this->fileName]));
    }
}