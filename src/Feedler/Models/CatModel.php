<?php

namespace Feedler\Models;

class CatModel
{
    private $data;

    private $title = 'Список котиков';

    public function __construct()
    {
        $this->process();
    }


    public function process()
    {
        $data = file_get_contents('http://catsofinstagram.com/api/read/json');
        $data = str_replace('var tumblr_api_read = ', '', $data);
        $data = str_replace(';','',$data);
        $this->data = json_decode($data, true);
    }

    public function getPosts()
    {
        return $this->data['posts'];
    }

    public function getTitle()
    {
        return $this->title;
    }
}
