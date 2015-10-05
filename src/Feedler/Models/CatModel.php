<?php

namespace Feedler\Models;

class CatModel extends FeedModel
{
    protected $title = 'Список котиков';

    protected $url = 'http://catsofinstagram.com/api/read/json';
}
