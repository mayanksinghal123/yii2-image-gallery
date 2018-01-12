<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 02-01-2018
 * Time: 11:27
 */
namespace backend\widgets\imageGallery\events;
use yii\base\Event;
class UploadEvent extends Event
{
    /**
     * @var string
     */
    public $path;

}