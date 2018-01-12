<?php
namespace backend\widgets\imageGallery;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

class ImageGallery extends InputWidget
{
    public $message;
    public $data;
    public $url;
    public $dims;

    /**
     * @var string
     */
    public $cont_height="150px";

    /**
     * @var string
     */
    public $cont_width="150px";
    /**
     * @var string
     */
    public $cont_unique_id;
    /**
     * @var string
     */
    public $function_name;

    /**
     * @var array
     */
    public $clientOptions = [];
    public function init()
    {
        parent::init();
        self::setAliases();

        $this->cont_unique_id=\Yii::$app->security->generateRandomString();
        if(!empty($this->message)){
            $this->function_name=$this->generateRandomString(7);
            $this->message=str_replace('onHandyImageGet',$this->function_name,$this->message);
        }
        if(!empty($this->dims) && is_array($this->dims)){
            if(!empty($this->dims['height']) && !empty($this->dims['width'])){
                $cont_height=$this->dims['height']."px";
                $cont_width=$this->dims['width']."px";
            }
        }
        if ($this->hasModel()) {
            $this->name = $this->name ?: Html::getInputName($this->model, $this->attribute);
            $this->value = $this->value ?: Html::getAttributeValue($this->model, $this->attribute);
        }
        if (!array_key_exists('name', $this->clientOptions)) {
            $this->clientOptions['name'] = $this->name;
        }

        $this->data= $this->render('pixabay/_pixabay_new', [
            'message' => $this->message,
        ]);
        $this->data=htmlentities($this->data);

        $this->clientOptions = ArrayHelper::merge(
            [
                'values' => $this->value,
                'pixabayHtmlData'=>$this->data,
                'url'=>Url::to($this->url),
                'dims'=>$this->dims,
                'cont_id'=>$this->cont_unique_id,
                'function_name'=>$this->function_name,
                'id'=>$this->options['id'],

            ],
            $this->clientOptions
        );
    }
    private function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @return string
     */
    public function getFileInputName()
    {
        return sprintf('_fileinput_%s', $this->id);
    }
    public function run()
    {
        ImageGalleryAsset::register($this->view);

        $this->registerClientScript();
        $content = Html::beginTag('div',['id'=>$this->cont_unique_id]);
        $content .= Html::beginTag('div');
        $content .= Html::hiddenInput($this->name, null, [
            'class' => 'empty-value',
            'id' => $this->options['id']
        ]);
        $content .= Html::endTag('div');
        $content .= Html::beginTag('div',['id'=>'piaxabay_img_container']);
        $content .= Html::endTag('div');
        $content .= Html::endTag('div');
        /*$inner=$this->render('_inner', [
            'message' => $this->message,
        ]);*/
        return $content;

        //$this->registerAssets();

    }
    public function registerClientScript(){

        /*$initJs = <<<JS
        function useImage(){
         alert("yessssssss");
        }
        
JS;
        $this->view->registerJs($initJs, View::POS_END);*/
        
        $options = Json::encode($this->clientOptions);
        $this->getView()->registerJs("uploadImageData({$options});");
        $this->registerAssets();
    }
    public function registerAssets()
    {
      $initCs=  <<<CSS
      .imageGallery_dims{
        height: $this->cont_height !important;
        width: $this->cont_width !important;
      }
CSS;

        $this->view->registerJs($this->message, View::POS_END);
        $this->view->registerCss($initCs);
    }
    protected function setAliases()
    {
        \Yii::setAlias('@imageGallery', realpath(__DIR__ . '/../imageGallery'));
    }

}