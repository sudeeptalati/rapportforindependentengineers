<?php $this->layout='column1'; ?>
<div id="sidemenu">
    <?php include('setup_sidemenu.php'); ?>

</div>
<div id="submenu">
    <li><?php echo CHtml::link('Perform Tasks', array('/tasksToDo/completeTasks')); ?></li>
    <li><?php echo CHtml::link('Manage Tasks', array('/tasksToDo/admin')); ?></li>
    <li><?php echo CHtml::link('Tasks Lifetime', array('/tasksToDo/tasksLifetime')); ?></li>
    <li><?php echo CHtml::link('Notification Rules', array('/notificationRules/admin')); ?></li>
</div>

<br>

<?php
    $baseUrl = Yii::app()->getBaseUrl();
    $setupmodel=Setup::model();
    $internet_available = '';

    $advanceSettingsModel = AdvanceSettings::model()->findAllByAttributes(array('parameter' => 'internet_connected'));
    foreach ($advanceSettingsModel as $settings) {
        //echo "Name = ".$settings->name;
        //echo "<br>Value = ".$settings->value;
        $internet_available = $settings->value;
    }//end of advanced foreach.
?>

<div class="success">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <span class="sr-only">Performing Tasks...</span>
</div>


<?php
///////DELETING THE OLD JOBS///////////

$notification_lifetime = '';
$notification_lifetimeModel = AdvanceSettings::model()->findAllByAttributes(array('parameter' => 'notification_lifetime'));
foreach ($notification_lifetimeModel as $lifetime) {
    $notification_lifetime = $lifetime->value;
}//end of advanced foreach.
TasksToDo::model()->clearOldNotification($notification_lifetime);

///////DELETING THE OLD JOBS///////////


$q = new CDbCriteria(array(
    'condition' => "status NOT LIKE :match",         // no quotes around :match
    'params' => array(':match' => "%finished%")  // Aha! Wildcards go here
));
$tasksModel = TasksToDo::model()->findAll($q);

foreach ($tasksModel as $task){
    echo TasksToDo::model()->listTasksToDo($task->id);
}
//echo "<br>Total count of table = ".$total_tasks;
$tasksModel = TasksToDo::model()->findAll();
?>

<table>
    <tr>
        <th>#</th>
        <th>Task</th>
        <th>Status</th>
        <th>Send To</th>
        <th>Created</th>
        <!--
        <th>Scheduled</th>
        <th>Executed</th>
        -->
        <th>Finished</th>
        <th>Frequency Type</th>
    </tr>

<?php foreach ($tasksModel as $task) : ?>
    <?php ?>
    <tr>
        <td><?php echo $task->id;?></td>
        <td>
            <?php echo CHtml::link($task->task, array('/tasksToDo/view', 'id'=>$task->id)); ?>
        </td>
        <td><?php echo $task->status;?></td>

        <td><?php echo $task->send_to;?></td>
        <td><?php echo $setupmodel->formatdatewithtime($task->created); ?></td>
        <!--
        <td><?php echo $setupmodel->formatdatewithtime($task->scheduled); ?></td>
        <td><?php echo $setupmodel->formatdatewithtime($task->executed); ?></td>
        -->
        <td><?php echo $setupmodel->formatdatewithtime($task->finished); ?></td>
        <td><?php echo $task->frequency_type;?></td>


    </tr>

<?php endforeach; ?>
</table>











