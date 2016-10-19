<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome admin!</h1>

        <p class="lead"><?php echo  Yii::$app->user->identity->username;?></p>
        <h1>
            <i class="ukwfa ukwfa-engineer-repair fa-3x"></i>
        </h1>

        <p>

        </p>
    </div>
    <div class="progress-container">
        <ul class="progressbar">
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=engineer">Engineers</a>
            </li>
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=customer">Customers</a>
            </li>
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=deadregions">Dead Regions</a>
            </li>
        </ul>
    </div>


    <div class="progress-container">
        <ul class="progressbar">
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=brand">Brands</a>
            </li>
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=producttype">Appliances</a>
            </li>
            <li class="active">
                <a class="btn btn-lg btn-success" href="index.php?r=postcodes">Postcodes</a>
            </li>
        </ul>
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

