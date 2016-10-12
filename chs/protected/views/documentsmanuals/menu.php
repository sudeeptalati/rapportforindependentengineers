<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 07/10/2016
 * Time: 16:26
 */?>

<style>

    #actions_menu {
        padding-top: 5px;
        padding-left: 25px;
        padding-right: 1px;
        padding-bottom: 5px;
        background: #89EACC;
        margin-top: -5px;
        margin-bottom: 0px;
        list-style: inline;
        border-radius: 15px;
        text-align: left;
    }

    #uplifts_menu {
        padding: 15px;
        background: #C7FAFF;
        list-style: inline;
        border-radius: 15px;
        text-align: center;
        text-transform: uppercase;
        font-size: 20px;
    }

    #uplifts_menu li {
        display: inline;


    }
    #uplifts_menu li + li {
        border-left: 1px solid;
        margin-left:2em;
        padding-left:2em;

    }

</style>

<div id='uplifts_menu'><?php

    //echo "<li>".CHtml::link("Go Mobile",array('/gomobile'))."</li>";
    echo "<li>".CHtml::link(" <i class='fa fa-plus-circle' aria-hidden='true'></i> Upload  ",array('documentsmanuals/create'))."</li>";
    echo "<li>".CHtml::link("<i class='fa fa-server' aria-hidden='true'></i> Manage ",array('documentsmanuals/admin'))."</li>";
    echo "<li>".CHtml::link("<i class='fa fa-file' aria-hidden='true'></i> Document Types ",array('documenttype/admin'))."</li>";
    echo "<li>".CHtml::link("<i class='fa fa-plus-circle' aria-hidden='true'></i> Document Types ",array('documenttype/create'))."</li>";

    ?>
</div>
<br>


<br>
