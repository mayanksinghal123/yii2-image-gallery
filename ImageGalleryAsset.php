<?php

namespace handy\imageGallery;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Widget asset bundle
 */
class ImageGalleryAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@imageGallery/web/';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/main.css',
        'css/image_gallery.css'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/main.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
