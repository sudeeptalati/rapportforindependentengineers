<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">

        <div class="bg-warning btn-lg" title="Open in new tab">
            Open in new Window<br>
            <a href="index.php" target="_blank">
                <i class="fa fa-external-link fa-3x" aria-hidden="true"></i>
            </a>
        </div>

        <h2>
            <i class="ukwfa ukwfa-engineer-repair fa-5x" aria-hidden="true"></i>
        </h2>
        <h1>Welcome to Find An Engineer!</h1>

        <p class="lead"><?php //echo  Yii::$app->user->identity->username;?></p>
        <p>
               <a class="btn btn-lg btn-warning" href="index.php?r=engineer">
                <i class="ukwfa ukwfa-engineer-repair" aria-hidden="true"></i>
                My Account
            </a>
            <a class="btn btn-lg btn-success" href="index.php?r=site/login">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                Login
            </a>

            <a class="btn btn-lg btn-warning" href="index.php?r=site/request-password-reset">
                <i class="fa fa-key" aria-hidden="true"></i>
                Reset Password
            </a>


        </p>




    </div>
<!--
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
     </div>
    -->
</div>

