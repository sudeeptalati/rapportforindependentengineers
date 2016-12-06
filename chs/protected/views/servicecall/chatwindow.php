<?php

Yii::app()->clientScript->registerScript('chat_window-div-toggle', "
                                        $('#close_chat_window-button').click(function(){
	                                    $('#chat_window').hide();
	                                    $('#chat_window_icon').show();
	                                    return false;
                                        });
                                ");
?>






<?php

Yii::app()->clientScript->registerScript('chat_window-div-open', "
                                        $('#chat_window_icon').click(function(){
	                                    $('#chat_window').show();
	                                    $('#chat_window_icon').hide();
	                                    return false;
                                        });
                                ");
?>










<?php $fullchatarray = json_decode($model->communications, true); ?>

<div class="chat-form">


    <div id="chat_window" style="display: block;">
        <div class="chat-button" id="close_chat_window-button">
            <table>
                <tr>
                    <td><h3>Communications</h3>
                    </td>
                    <td>X</td>
                </tr>
            </table>
        </div>
        <div id="chat_text">
            <table class="chat_table">
                <tr>
                    <th style="width:15%"></th>
                    <th style="width:70%"></th>
                    <th style="width:15%"></th>
                </tr>

                <?php $fullchatarray = json_decode($model->communications, true); ?>

                <?php if (!empty($fullchatarray)): ?>

                    <?php foreach ($fullchatarray['chats'] as $c) { ?>
                        <tr>
                            <?php if ($c['person'] === 'me'): ?>
                                <td></td>
                                <td>
                                    <div id='me_talkbubble'> <?php echo $c['message']; ?></div>
                                </td>
                                <td>
                                    <div class="person" style="text-align: right"><b><?php echo $c['person']; ?>
                                            says:</b></div>
                                    <div class="chat_time"
                                         style="display:none;font-size: 10px;"> <?php echo $c['date']; ?>:
                                    </div>
                                </td>
                            <?php else: ?>
                                <td>
                                    <div class="person"><b><?php echo $c['person']; ?> says:</b>
                                        <div style="width: 40px;border-radius: 50%;"
                                                  >

                                            <i class="fa fa-industry" aria-hidden="true"></i>



                                        </div>
                                    </div>
                                    <div class="chat_time"
                                         style="display:none;font-size: 10px;"><?php echo $c['date']; ?></div>
                                </td>
                                <td>
                                    <div id='amica_talkbubble'><?php echo $c['message']; ?></div>
                                </td>
                                <td></td>

                            <?php endif; ?>
                        </tr>
                    <?php }///end of foreach  ?>

                <?php endif////end of if (!empty($fullchatarray)): ?>

            </table>
        </div><!-- <div class="chat_text">    -->


        <div style="text-align: right;">
            <div id="chat_message_error"></div>
            <?php //echo CHtml::label('Chat message','chat_message'); ?>
            <table>
                <tr>
                    <td style="width: 80%">
                        <?php echo CHtml::textArea('chat_message', '', array('style' => 'width:100%;height:50px;')); ?>

                    </td>
                    <td style="width: 20%">
                        <?php echo CHtml::button("Send", array('style' => 'width:50px;height:50px;', 'title' => "Reply to this Chat", 'onclick' => 'js:replytothecchat();')); ?>
                    </td>
                </tr>
            </table>

        </div>

    </div> <!-- <div id="chat_window"> -->

</div><!--<div class="chat-form" style="display:none">-->


<div id="chat_window_icon" style="
    bottom: 0em;
    right: 0em;
    position: fixed;
    padding: 25px;
    color: #0a689e;
    display:none;
">

    <i class="fa fa-comments fa-3x"></i>

</div>



<script type="text/javascript">//<![CDATA[


    document.getElementById('chat_text').scrollTop=document.getElementById('chat_text').scrollHeight+100;

    console.log("Height scroll"+document.getElementById('chat_text').scrollHeight);

    function replytothecchat() {
        console.log('Open Chat Window To disReply to this Chat');


        var chat_msg = document.getElementById("chat_message").value;

        chat_msg = chat_msg.replace(/\s+/, "")

        if (chat_msg == '' || chat_msg == null) {
            document.getElementById("chat_message").style.backgroundColor = "#FEEEEE";
            document.getElementById("chat_message_error").innerHTML = 'Please input some reason for Rejection';
            document.getElementById("chat_message_error").style.color = "#C00000";
            //alert('Please specify the reason');
        }
        else {

            service_id = '<?php echo $model->id; ?>';
            api_key = '<?php echo $model->contract->api_key; ?>';
            send_msg_url = '<?php echo Yii::app()->request->baseUrl; ?>';


            send_msg_final_url = send_msg_url + '/index.php?r=api/sendmessageviaportal';

            console.log("send_msg_final_url : " + send_msg_final_url);





            $.ajax({
                type: 'POST',
                url: send_msg_final_url,

                data: {'chat_msg': chat_msg, 'service_id': service_id, 'api_key': api_key},
                success: function (data, status) {

                    console.log(data);
                    //alert(data);
                    location.reload();


                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    alert("Details: " + desc + "\nError:" + err);
                }
            }); // end ajax call


        }

    }///end of function replytothecchat


</script>
