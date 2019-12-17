<?php
?>

<div class="site-frequent">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <ul>
                    <?php foreach ($data as $word => $count): ?>
                        <li><b><?=$word?></b> is used <b><?=$count?></b> times </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
</div>
