<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mayank Singhal
 * Date: 12/30/17
 * Time: 2:47 AM
 * To change this template use File | Settings | File Templates.
 */

namespace backend\widgets\imageGallery\getRemote;


class GetImage {
    /**
     * @var string
     */
    public $remoteUrl;
    /**
     * @var string
     */
    public $storageUrl;

    function stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {

        switch($notification_code) {
            case STREAM_NOTIFY_RESOLVE:
            case STREAM_NOTIFY_AUTH_REQUIRED:
            case STREAM_NOTIFY_COMPLETED:
            case STREAM_NOTIFY_FAILURE:
            case STREAM_NOTIFY_AUTH_RESULT:
                var_dump($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max);
                /* Ignore */
                break;

            case STREAM_NOTIFY_REDIRECTED:
                echo "Being redirected to: ", $message;
                break;

            case STREAM_NOTIFY_CONNECT:
                echo "Connected...";
                break;

            case STREAM_NOTIFY_FILE_SIZE_IS:
                echo "Got the filesize: ", $bytes_max;
                break;

            case STREAM_NOTIFY_MIME_TYPE_IS:
                echo "Found the mime-type: ", $message;
                break;

            case STREAM_NOTIFY_PROGRESS:
                echo "Made some progress, downloaded ", $bytes_transferred, " so far";
                break;
        }
        echo "\n";
    }
    function startSave(){

        /*$ctx = stream_context_create();
        stream_context_set_params($ctx, array("notification" => "stream_notification_callback"));

        $data=file_get_contents("http://atomictoasters.com/wp-content/uploads/2012/12/B-50-KB-50-wiki.jpg", false, $ctx);
        if(file_put_contents("../../storage/web/source/article/3/soap.jpg",$data)){
            echo "diooooooooooooooooooooooooooooooooooooooo";
        }*/
        $data=file_get_contents($this->remoteUrl);
        if(file_put_contents($this->storageUrl,$data)){
            return true;
        }
        return false;

        
    }
}