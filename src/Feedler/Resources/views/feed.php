<ol class="breadcrumb">
    <li><a href="<?=$this->generator->generate('index_page')?>">Главная</a></li>
    <li class="active">Feed</li>
</ol>
<h1><?=$data['title']?></h1>
<?php foreach ($data['feedData'] as $feed) { ?>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img src="<?=$feed['photo-url-500']?>" alt="<?=$feed['slug']?>"/>
            <div class="caption">
                <p><?=$feed['photo-caption']?></p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
