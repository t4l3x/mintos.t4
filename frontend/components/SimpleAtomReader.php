<?php


namespace frontend\components;


use Exception;
use yii\web\UnsupportedMediaTypeHttpException;

class SimpleAtomReader
{

    private $feed;

    public function __construct($url)
    {
        $this->loadXml($url);
    }

    public function getFeedAsArray()
    {
        return json_decode(json_encode($this->feed), TRUE);
    }

    public function loadXml($url)
    {
        try {
            $this->feed = simplexml_load_file($url, "SimpleXMLElement");
        } catch (\Exception $e) {
            throw new UnsupportedMediaTypeHttpException('Not valid RSS feed');
        }
    }

    public function getFeed()
    {
        return $this->feed;
    }


    //   other codes /
}