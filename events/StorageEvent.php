<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 02-01-2018
 * Time: 11:27
 */
namespace handy\imageGallery\events;
use yii\base\Event;
class StorageEvent extends Event
{
    /**
     * @var string
     */
    public $path;
    public $imageName;

}