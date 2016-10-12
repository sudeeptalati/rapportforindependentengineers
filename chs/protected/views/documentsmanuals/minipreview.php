<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 10/10/2016
 * Time: 13:11
 */
?>
<?php //echo $preview_link; ?>

<a id="new_window_link" target="_blank" href="<?php echo $preview_link; ?>" title="Open in new Window">
    <h1 style="text-align: right">Open in new window <i class="fa fa-external-link-square" ></i></h1>
</a>
<embed allowfullscreen style="min-width:800px;height:800px;" id="img_preview_tag" src="<?php echo $preview_link; ?>"></embed>
