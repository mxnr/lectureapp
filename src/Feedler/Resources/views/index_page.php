<div class="container">
    <div class="jumbotron">
        <h1>Привет, Feedler!</h1>
        <p>
            Много контента и котиков
        </p>
        <p>
            <a class="btn btn-primary btn-lg" href="<?=$this->generator->generate('feed', array('name' => 'cats'))?>" role="button">Перейти к просмотру котиков</a>
        </p>
        <p>
            <a class="btn btn-primary btn-lg" href="<?=$this->generator->generate('feed', array('name' => 'dogs'))?>" role="button">Перейти к просмотру собачек</a>
        </p>    
    </div>
</div>
