<?php

class ApiController extends RController
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers
     */
    Const APPLICATION_ID = 'ASCCPE';

    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    // Actions

    public function actionViewFullDiaryJsonData($engg_id)
    {
        //echo "ENGG ID IN API CONTROLLER = ".$engg_id."<br>";
        $diary_events_array = array();
        $mydata = array();

        if ($engg_id == '0') {
            //echo "value is zero"."<br>";

            /*** CODE TO DISPLAY ALL THE ENGINEERS APPOINTMENTS THIS PART IS CALLED WHEN ENGG_ID=0 ***/

            $diaryModel = Enggdiary::model()->findAll();
            $i = 1;
            $end_date = '';
            foreach ($diaryModel as $data) {
                if ($data->status != '102') {
                    //echo "<br>Servicecall id in API contr = ".$data->servicecall_id;
                    $customer_name = $data->servicecall->customer->fullname;
                    //echo "<br>Customer name from id = ".$customer_name;
                    $customer_postcode = $data->servicecall->customer->postcode;
                    $engineer_name = $data->engineer->fullname;
                    //$engineer_name = $data->engineer_id;

                    $start_date = date("Y-m-d H:i", $data->visit_start_date);

                    if (!empty($data->visit_end_date)) {
                        $end_date = date("Y-m-d H:i", $data->visit_end_date);
                    }

                    //$end_date = date("Y-m-d H:i",$data->visit_end_date);

                    $diary_events_array['id'] = $data->id;///id of the engg diary
                    $diary_events_array['service_id'] = $data->servicecall_id;
                    $diary_events_array['title'] = "" . $customer_name . " " . $customer_postcode . "\n " . $engineer_name . ""; ///** HERE WE WIL DISPLAY custtomer name and postcode
                    $diary_events_array['start'] = $start_date;
                    $diary_events_array['end'] = $end_date;
                    $diary_events_array['url'] = Yii::app()->baseUrl . "/index.php?r=Servicecall/view&id=" . $data->servicecall_id;
                    $diary_events_array['allDay'] = false;
                    $diary_events_array['textColor'] = "white";

                    array_push($mydata, $diary_events_array);
                    $i++;
                }//end of displaying only those appointments that are not cancelled

            }//end of foreach().
            echo json_encode($mydata);
            /***** END OF CODE TO DISPLAY ALL THE ENGINEERS APPOINTMENTS **********/

        }//end of if engg_id value is zero.
        else {
            //echo "value is ".$engg_id."<br>";

            /*** CODE TO DISPLAY SPECIFIC ENGG DIARY, THIS CODE IS CALLED WHEN ENGG_ID!=0 ***/

            $diaryModel = Enggdiary::model()->findAllByAttributes(
                array('engineer_id' => $engg_id)
            );

            $i = 1;
            foreach ($diaryModel as $data) {
                if ($data->status != '102') {
                    //echo $data->servicecall_id;
                    $customer_name = $data->servicecall->customer->fullname;
                    $customer_postcode = $data->servicecall->customer->postcode;
                    $engineer_name = $data->engineer->fullname;

                    $start_date = date("Y-m-d H:i", $data->visit_start_date);

                    if (!empty($data->visit_end_date)) {
                        $end_date = date("Y-m-d H:i", $data->visit_end_date);
                    }
                    //$end_date = date("Y-m-d H:i",$data->visit_end_date);

                    $diary_events_array['id'] = $data->id;///id of the engg diary
                    $diary_events_array['service_id'] = $data->servicecall_id;
                    $diary_events_array['title'] = $customer_name . " " . $customer_postcode . "\n " . $engineer_name . " "; ///** HERE WE WIL DISPLAY custtomer name and postcode
                    $diary_events_array['start'] = $start_date;
                    $diary_events_array['end'] = $end_date;
                    $diary_events_array['url'] = Yii::app()->baseUrl . "/index.php?r=Servicecall/view&id=" . $data->servicecall_id;
                    $diary_events_array['allDay'] = false;
                    //'end' => "$year-$month-22",

                    //echo "id = ".$data->id."<br>";
                    //echo "Visit date = ".$date."<br>";
                    //echo "service_id = ".$data->servicecall_id."<hr>";

                    array_push($mydata, $diary_events_array);
                    $i++;
                }//end of if, displaying only those that are not cancelled.

            }//end of foreach().
            echo json_encode($mydata);

            /*** END OF CODE TO DISPLAY SPECIFIC ENGG DIARY, THIS CODE IS CALLED WHEN ENGG_ID!=0 ***/

        }//end of else of engg id value == 0.

    }//end of ViewFullDiaryJsonData().

    public function actionUpdateDiary()
    {
        //echo "IN ACTION UPDATE DIARY<br>";
        $diary_id = $_GET['diary_id'];
        //echo "Diary id = ".$diary_id."<br>";
        $days_moved = $_GET['days_moved'];
        //echo "days moved = ".$days_moved;
        $minutes_moved = $_GET['minutes_moved'];
        //echo "<br> Minutes moved = ".$minutes_moved;
        //echo "Days moved in api contr = ".$days_moved."<br>";
//    	$end_date = $_GET['end_date'];
//    	echo "end days in api contr = ".$end_date;

//    	if($model = 'Enggdiary')
//    	{
        //echo "enggdiary is sent<br>";
        Enggdiary::model()->updateAppointment($diary_id, $days_moved, $minutes_moved);
        //}

    }//end of updateDiary().


    public function actionUpdateEndDateTime()
    {

        //echo "in action update actionUpdateEndDateTime<br>";

        $diary_id = $_GET['diary_id'];
        //echo "Diary id = ".$diary_id."<br>";
        $minutes = $_GET['minutes'];
        //echo "minutes in model func = ".$minutes."<br>";

        Enggdiary::model()->updateEndDateTime($diary_id, $minutes);


    }//end of UpdateMinutes().

    public function actionDisplayEngineerId()
    {
        $diary_events_array = array();
        $mydata = array();

        $model = Enggdiary::model();

        $model->attributes = $_POST['Enggdiary'];
        //echo $model->engineer_id;
        //echo "ENGINEER ID IN CONTROLLER :".$model->engineer_id."<br>";
        $engg_id = $model->engineer_id;

        //$this->forward('viewFullDiaryJson/');

        /*

        $enggAppointmentData = Enggdiary::model()->findAllByPk($engg_id);


        $i=1;
        foreach ($enggAppointmentData as $data)
        {
            $customer_name=$data->servicecall->customer->fullname;
            $customer_postcode=$data->servicecall->customer->postcode;

            $start_date= date("Y-m-d H:i",$data->visit_start_date);
            $end_date = date("Y-m-d H:i",$data->visit_end_date);

            $diary_events_array['id'] = $data->id;///id of the engg diary
            $diary_events_array['service_id'] = $data->servicecall_id;
            $diary_events_array['title'] = $customer_name." ".$customer_postcode; ///** HERE WE WIL DISPLAY custtomer name and postcode
            $diary_events_array['start'] = $start_date;
            $diary_events_array['end'] = $end_date;
            $diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/".$data->servicecall_id;
            $diary_events_array['allDay'] = false ;

            echo "start date = ".date('d-m-Y H:i',$data->visit_start_date)."<br>";
            echo "Service id = ".$data->servicecall_id."<br>";
            echo "Customer name = ".$data->servicecall->customer->fullname."<br>";

            array_push($mydata,$diary_events_array);
            $i++;

        }//end of foreach().

        echo json_encode($mydata);

        */


    }//end of actionDisplayEngineerId().

    public function actionCreateNewDiaryEntry()
    {
        //echo "IN CreateNewDiaryEntry action";

        $notes = $_GET['notes'];
        $start_date = $_GET['start_date'];
        //echo "<hr>START DATE = ".$start_date;
        //echo "<br>STRTOTIME START DATE = ".strtotime($start_date);

        $engg_id = $_GET['engg_id'];
        //echo "<br>ENGG_ID in api contr = ".$engg_id;
        $service_id = $_GET['service_id'];
        //echo "<br>SERVICE_ID in api contr = ".$service_id;

        $slots = $_GET['slots'];

        ////Check if there is alreday a appointment booked with the service id
        ////if appointmnet is booked then cancel it


        $all_events_with_serviceid = Enggdiary::model()->findAllByAttributes(
            array('servicecall_id' => $service_id));

        foreach ($all_events_with_serviceid as $diary_events) {

            //echo $diary_events->id;

            Enggdiary::model()->updateByPk($diary_events->id,
                array(
                    'status' => '102'
                )
            );


        }///end of foreach ($all_events_with_serviceid as $diary_events) {


        $newEnggDiaryModel = new Enggdiary;
        //echo "<hr>Service id to be saved = ".$service_id;
        $newEnggDiaryModel->servicecall_id = $service_id;
        //echo "<br>Engineer id to be saved = ".$engg_id;
        $newEnggDiaryModel->engineer_id = $engg_id;
        $newEnggDiaryModel->status = '3';//CHANGE STATUS OF APPOINTMENT TO BOOKED(VISIT START DATE).
        $status_id = $newEnggDiaryModel->status;
        //echo "<br>Visit satrt date to be saved = ".$start_date;
        $newEnggDiaryModel->visit_start_date = $start_date;
        $newEnggDiaryModel->slots = $slots;
        $newEnggDiaryModel->notes = $notes;


        $saved = $newEnggDiaryModel->save();
        if ($saved == true) {
            //echo "Diary model saved";

            ////Updating engg id in servicecalls model
            Servicecall::model()->update_engg_diary_id_by_servicecall_id($service_id, $newEnggDiaryModel->id);


            $notificationModel = NotificationRules::model()->findAllByAttributes(array('job_status_id' => $status_id, 'active' => '1'));
            if (count($notificationModel) != 0) {


                try {
                    $internet_status = '';
                    $advanceModel = AdvanceSettings::model()->findAllByAttributes(array('parameter' => 'internet_connected'));
                    foreach ($advanceModel as $data) {
                        $internet_status = $data->value;
                    }

                    if ($internet_status == 1) {
                        $response = NotificationRules::model()->performNotification($status_id, $service_id, 'daily');
                    }//end of if(check for internet connection).
                    else {
                        //echo "PLEASE CHECK YOUR INTERNET CONNECTION";
                    }


                }//end of try inside if(), to catch email ans sms sent errors.
                catch (exception $e) {
                    //echo "<br>error message = ".$e.message;
                }
            }//end of if(rule is present).
            else {
                //echo "<br>Rule is not present";
            }

        }//end of if($newEnggDiaryModel->save()).
        else {
            //echo "<br>Problem in saving diary";
        }


    }//end of actionCreateNewDiaryEntry().

    public function actionGetAllBookedAppointment()
    {

        //echo "actionGetAllBookedAppointment is called ";
        $diary_events_array = array();
        $mydata = array();


        $diaryModel = Enggdiary::model()->findAll();
        $i = 1;
        foreach ($diaryModel as $data) {
            if ($data->status != '102') {
//		    	echo "<hr>Engg diary id = ".$data->id;
//		    	echo "<br> Engg name = ".$data->engineer->fullname;
//		    	echo "<br>servicecall id = ".$data->servicecall_id;
//		    	echo "<br>Appt start time = ".date('Y-m-d H:i', $data->visit_start_date);
//		    	echo "<br>Appt end time = ".date('Y-m-d H:i', $data->visit_end_date);

                $diary_events_array['title'] = 'Booked';
                $diary_events_array['start'] = date('Y-m-d H:i', $data->visit_start_date);
                $diary_events_array['end'] = date('Y-m-d H:i', $data->visit_end_date);
                $diary_events_array['textColor'] = "pink";

                array_push($mydata, $diary_events_array);
            }//end of displaying only those appointmens that are not cancelled.
        }//end of foreach().


        //echo "<hr>JSON ENCODED DATA <hr>";
        echo json_encode($mydata);

    }//end of actionGetAllBookedAppointment().

    public function actionRaiseServicecall()
    {
        $finalArray = array();
        $title = $_GET['title'];
        //echo "title from url = ".$title;
        $first_name = $_GET['first_name'];
        //echo "<br>first name from url = ".$first_name;
        $last_name = $_GET['last_name'];
        //echo "<br>last name from url = ".$last_name;
        $phone = $_GET['phone'];
        //echo "<br>phone from url = ".$phone;
        $town = $_GET['town'];
        //echo "<br>town from url = ".$town;
        $email = $_GET['email'];
        //echo "<br>email from url = ".$email;
        $postcode_e = $_GET['postcode_e'];
        //echo "<br>postcode_e from url = ".$postcode_e;
        $postcode_s = $_GET['postcode_s'];
        //echo "<br>postcode_s from url = ".$postcode_s;
        $address_line_1 = $_GET['address_line_1'];
        //echo "<br>address_line_1 from url = ".$address_line_1;
        $address_line_2 = $_GET['address_line_2'];
        //echo "<br>address_line_2 from url = ".$address_line_2;
        $address_line_3 = $_GET['address_line_3'];
        //echo "<br>address_line_3 from url = ".$address_line_3;
        $county = $_GET['county'];
        //echo "<br>county from url = ".$county;
        $brand_id = $_GET['brand_id'];
        //echo "<br>brand id from url = ".$brand_id;
        $productType_id = $_GET['productType_id'];
        //echo "<br>productType_id from url = ".$productType_id;
        $contract_id = $_GET['contract_id'];
        //echo "<br>contract id from url = ".$contract_id;
        $model_number = $_GET['model_number'];
        //echo "<br>model number from url = ".$model_number;
        $serial_number = $_GET['serial_number'];
        //echo "<br>serial number = ".$serial_number;
        $visit_date = $_GET['visit_date'];
        //echo "<br>Vist date = ".$visit_date;
        $username = $_GET['username'];
        //echo "<br>User name = ".$username;
        $password = $_GET['password'];
        //echo "<br>Password = ".$password;
        $hassedPassword = hash('sha256', $password);
        //echo "<br>Hassed password = ".$hassedPassword;


        $userModel = User::model()->findAllByAttributes(array('username' => $username, 'password' => $hassedPassword));

        /*
        if($userModel)
        {
            foreach ($userModel as $user)
            {
//	    		echo "<br>User name from database = ".$user->username;
//	    		echo "<br>User id from database = ".$user->id;
                $userId = $user->id;

            }
        }//end of if $userModel not null.

        */

        if ($userModel) {
            foreach ($userModel as $user) {
                $userId = $user->id;
                echo "<br>Authorised user";
                echo "<br>user id outside foreach = " . $userId;

                /***** SAVING CUSTOMER DEATILS WITH PROD ID = 0 *******/
                $newProductModel = new Product;
                $newProductModel->customer_id = '';
                $newProductModel->contract_id = $contract_id;
                $newProductModel->brand_id = $brand_id;
                $newProductModel->product_type_id = $productType_id;

                if ($newProductModel->save()) {
                    echo "<br>Product Saved";
                    echo "<br> Prodduct ID :" . $newProductModel->id;
                    //	    		$finalArray['status'] = 'ok';
                    //	    		$finalMessage = json_encode($finalArray);
                    //	    		echo "<br>".$finalMessage;
                } else {
                    echo "<br>Product nOT Saved";
                    $finalArray['status'] = '0';
                    $finalArray['message'] = 'Problem in saving product';
                    $finalMessage = json_encode($finalArray);
                    echo "<br>" . $finalMessage;
                    return;
                }

                /****** SAVING CUSTOMER DETAILS ********/
                $product_id = $newProductModel->id;
                $newCustomerModel = new Customer();
                $newCustomerModel->product_id = $product_id;
                $newCustomerModel->title = $title;
                $newCustomerModel->first_name = $first_name;
                $newCustomerModel->last_name = $last_name;
                $newCustomerModel->address_line_1 = $address_line_1;
                $newCustomerModel->town = $town;
                $newCustomerModel->telephone = $phone;
                $newCustomerModel->postcode_e = $postcode_e;
                $newCustomerModel->postcode_s = $postcode_s;

                if ($newCustomerModel->save()) {
                    //echo "<hr>CUSTOMER SAVED....!!!!!!!!!!!!!";
                    //	    		$finalArray['status'] = 'ok';
                    //	    		$finalMessage = json_encode($finalArray);
                    //	    		echo "<br>".$finalMessage;
                } else {
                    //echo "<br>PROBLEM IN SAVING CUSTOMER........";
                    $finalArray['status'] = '0';
                    $finalArray['message'] = 'Problem in saving Customer';
                    $finalMessage = json_encode($finalArray);
                    echo "<br>" . $finalMessage;
                    return;
                }
                $customer_id = $newCustomerModel->id;
                $prod_id_from_cust = $newCustomerModel->product_id;
                echo "<br> Customer id of saved model = " . $customer_id;
                $newProdModel = Product::model()->findByPk($prod_id_from_cust);
                $engg_id = $newProdModel->engineer_id;
                /***** END OF SAVING CUSTOMER DEATILS WITH PREVIOUS PROD ID = 0 *******/

                /* SAVING SERVICE CALL DETAILS WITH PREVIOUS PRODUCT AND CUSTOMER DETAILS */
                $newServicecall = new Servicecall;
                $newServicecall->customer_id = $customer_id;
                $newServicecall->product_id = $prod_id_from_cust;
                $newServicecall->fault_description = 'This is test from api contr';
                $newServicecall->recalled_job = '0';
                $newServicecall->job_status_id = '2';
                $newServicecall->contract_id = $contract_id;
                $newServicecall->engineer_id = '0';
                //$newServicecall->activity_log = 'Service status is changed to remotly booked by admin on'

                if ($newServicecall->save()) {
                    //echo "<hr>SERVICE CALL SAVED......!!!!!!!";
                    //echo "<hr>SERVICE ID is".$newServicecall->id;
                    //	    		$finalArray['status'] = 'ok';
                    //	    		$finalMessage = json_encode($finalArray);
                    //	    		echo "<br>".$finalMessage;
                } else {
                    echo "<br>PROBLEM IN SAVING SERVICECALL";
                    $finalArray['status'] = '0';
                    $finalArray['message'] = 'Problem in saving Service call';
                    $finalMessage = json_encode($finalArray);
                    echo "<br>" . $finalMessage;
                    return;
                }
                /***** END of saving servicecall details *********/

                /****** SAVING DIARY DETAILS *****/
                $newDiaryModel = new Enggdiary();
                $newDiaryModel->engineer_id = '0';
                $newDiaryModel->visit_start_date = $visit_date;
                $newDiaryModel->servicecall_id = $newServicecall->id;
                $newDiaryModel->status = '3';
                $newDiaryModel->slots = "2";


                if ($newDiaryModel->save()) {
                    //echo "<hr>DIARY  SAVED......!!!!!!!";
                    $finalArray['status'] = '1';
                    $finalArray['message'] = 'All details saved';
                    $finalMessage = json_encode($finalArray);
                    echo "<br>" . $finalMessage;
                } else {
                    //echo "<br>PROBLEM IN SAVING DIARY";
                    $finalArray['status'] = '0';
                    $finalArray['message'] = 'Problem in saving Diary';
                    $finalMessage = json_encode($finalArray);
                    echo "<br>" . $finalMessage;
                    return;
                }
                /* END OF SAVING DIARY DETAILS WITH PREVIOUS SERVICE CALL DETAILS */
            }//end of foreach().
        }//end of if valid user().
        else {
            echo "<br>Not an authorised user";
        }

    }//end of actionRaiseServicecall().

    public function actioncurrentAppointments($id)
    {
        //echo "Hello";
        //echo "Current time = ".time()."<br>";
        $today = time();
        $month = date('n', $today);
        $day = '1';
        $n = $month - 1;
        $year = date('Y', $today);
        //echo "<br>Month = ".$month;
        $newdate = strtotime("$day-$n-$year");
        //echo "<br>New Date = ".$newDate;
        //echo "<br>new date in normal format = ".date('d-M-Y', $newdate);
        //echo "<hr>";

        $diary_events_array = array();
        $display_data = array();

        //echo "<hr>engg in current app api contr = ".$id."<hr>";

        /*** STARTING OF IF  ELSE ******/
        if ($id == '0') {
            $date = time();

            $diaryDetails = Enggdiary::model()->findAll(array(
                'condition' => 'visit_start_date >= :date',
                'params' =>
                    array(':date' => $newdate
                    ),
            ));

            foreach ($diaryDetails as $data) {
                if ($data->status != '102') {
                    //echo "<hr>visit time = ".date('d-M-Y',$data->visit_start_date);
                    //echo "<br>comp = ".$data->engineer->company;
                    //echo "<br>engg = ".$data->engineer->fullname;
                    //echo "<br>cust = ".$data->servicecall->customer->fullname;

                    $customer_name = $data->servicecall->customer->fullname;
                    $customer_postcode = $data->servicecall->customer->postcode;
                    $engineer_name = $data->engineer->fullname;

                    $start_date = date("Y-m-d H:i", $data->visit_start_date);

                    if (!empty($data->visit_end_date)) {
                        $end_date = date("Y-m-d H:i", $data->visit_end_date);
                    }

                    $diary_events_array['id'] = $data->id;///id of the engg diary
                    $diary_events_array['service_id'] = $data->servicecall_id;
                    $diary_events_array['title'] = "\n " . $customer_name . " " . $customer_postcode . "\n " . $engineer_name . ""; ///** HERE WE WIL DISPLAY custtomer name and postcode
                    $diary_events_array['start'] = $start_date;
                    $diary_events_array['end'] = $end_date;
                    $diary_events_array['url'] = Yii::app()->baseUrl . "/index.php?r=Servicecall/view&id=" . $data->servicecall_id;
                    $diary_events_array['allDay'] = false;
                    $diary_events_array['textColor'] = "white";

                    array_push($display_data, $diary_events_array);
                }//end of if(status).

            }//end of foreach().

            //echo "<br>";
            echo(json_encode($display_data));


        }//end of if, displays all enggs appointments.
        else {
            $date = time();

            $diaryDetails = Enggdiary::model()->findAll(array(
                'condition' => 'engineer_id = :id AND visit_start_date > :date',
                'params' =>
                    array(':id' => $id,
                        ':date' => $date
                    ),
            ));

            foreach ($diaryDetails as $data) {
                if ($data->status != '102') {
                    //echo "<hr>visit time = ".date('d-M-Y',$data->visit_start_date);
                    //echo "<br>comp = ".$data->engineer->company;
                    //echo "<br>engg = ".$data->engineer->fullname;
                    //echo "<br>cust = ".$data->servicecall->customer->fullname;

                    $customer_name = $data->servicecall->customer->fullname;
                    $customer_postcode = $data->servicecall->customer->postcode;
                    $engineer_name = $data->engineer->fullname;

                    $start_date = date("Y-m-d H:i", $data->visit_start_date);

                    if (!empty($data->visit_end_date)) {
                        $end_date = date("Y-m-d H:i", $data->visit_end_date);
                    }

                    $diary_events_array['id'] = $data->id;///id of the engg diary
                    $diary_events_array['service_id'] = $data->servicecall_id;
                    $diary_events_array['title'] = "\n " . $customer_name . " " . $customer_postcode . "\n " . $engineer_name . ""; ///** HERE WE WIL DISPLAY custtomer name and postcode
                    $diary_events_array['start'] = $start_date;
                    $diary_events_array['end'] = $end_date;
                    $diary_events_array['url'] = Yii::app()->baseUrl . "/index.php?r=Servicecall/view&id=" . $data->servicecall_id;
                    $diary_events_array['allDay'] = false;
                    $diary_events_array['textColor'] = "white";

                    array_push($display_data, $diary_events_array);
                }//end of if(status).

            }//end of foreach().

            //echo "<br>";
            echo(json_encode($display_data));

        }//end of else, displays perticular enggs appointments only.


    }//end of actioncurrentAppointments().

    public function actionList()
    {
    }

    public function actionView()
    {
    }

    public function actionCreate()
    {
    }

    public function actionUpdate()
    {
    }

    public function actionDelete()
    {
    }

    public function actionRemoteservicecallbooking()
    {
        $output['status'] = 'NOT OK';
        $output['message'] = 'Service NOYT ';
        $output['api_key'] = 'CAREYS';

        $user_id = '1';///taking as remote user
        $contract_id = '1000000';///Unknown Contract
        $engineer_id = '90000000';////Unassigned Engineer
        $job_status = '2';///remotely booked

        $remote_data_string = implode(" ", $_POST);
        $remote_data_json = json_decode($remote_data_string);


        $newRemoteProductModel = new Product;
        $newRemoteProductModel->customer_id = '888888888';
        $newRemoteProductModel->contract_id = $contract_id;
        $newRemoteProductModel->brand_id = $remote_data_json->manufacturer_id;
        $newRemoteProductModel->product_type_id = $remote_data_json->product_id;
        $newRemoteProductModel->model_number = $remote_data_json->model_number;
        if ($newRemoteProductModel->save()) {
            $output['product_status'] = 'SAVED';
            $output['product_message'] = 'Product saved';

            $newRemoteCustomerModel = new Customer();
            $newRemoteCustomerModel->product_id = $newRemoteProductModel->id;
            $newRemoteCustomerModel->title = $remote_data_json->title;
            $newRemoteCustomerModel->first_name = $remote_data_json->first_name;
            $newRemoteCustomerModel->last_name = $remote_data_json->last_name;
            $newRemoteCustomerModel->address_line_1 = $remote_data_json->line_1;
            $newRemoteCustomerModel->address_line_2 = $remote_data_json->line_2;
            $newRemoteCustomerModel->address_line_3 = $remote_data_json->line_3;
            $newRemoteCustomerModel->town = $remote_data_json->town;
            $newRemoteCustomerModel->postcode = $remote_data_json->postcode;
            $newRemoteCustomerModel->telephone = $remote_data_json->telephone;
            $newRemoteCustomerModel->mobile = $remote_data_json->cell;

            if ($newRemoteCustomerModel->save()) {
                $output['customer_status'] = 'SAVED';
                $output['customer_message'] = 'Customer saved';

                $newRemoteServicecall = new Servicecall;
                $newRemoteServicecall->customer_id = $newRemoteCustomerModel->id;
                $newRemoteServicecall->product_id = $newRemoteProductModel->id;
                $newRemoteServicecall->fault_description = $remote_data_json->fault_description;
                $newRemoteServicecall->fault_date = date('d-M-Y');
                $newRemoteServicecall->notes = $remote_data_json->other_notes;
                $newRemoteServicecall->recalled_job = '0';
                $newRemoteServicecall->job_status_id = $job_status;
                $newRemoteServicecall->contract_id = $contract_id;
                $newRemoteServicecall->engineer_id = $engineer_id;
                //$newServicecall->activity_log = 'Service status is changed to remotly booked by admin on'

                if ($newRemoteServicecall->save()) {
                    $output['servicecall_status'] = 'SAVED';
                    $output['servicecall_message'] = 'Servicecall saved';

                    $output['status'] = 'ALL_PCS_SAVED';
                    $output['message'] = 'Servicecall Customer & Product saved';
                }///end of if($newRemoteServicecall->save())

            }///end of if($newRemoteCustomerModel->save())

        }///end of if($newRemoteProductModel->save())
        echo json_encode($output);
    }///end of function send Response

    public function actionCheckservice()
    {
        //header("Access-Control-Allow-Origin: *");
        $output['status'] = 'OK';
        $output['message'] = 'Service OK';
        $output['api_key'] = 'CAREYS';
        echo json_encode($output);
    }///end of function getStatusCodeMessages

    public function actionGetmyservicecallsfromserver()
    {
        //echo "GETTING SERVICECALLS FROM THE PORTAL";
        $all_contracts = Contract::model()->findAll();


        foreach ($all_contracts as $contract) {
            //echo "<hr>RUNNING ";

            $portal_url =$contract->portal_url;
            $e = $contract->portal_login_email;
            $p = $contract->portal_encrypt_pass;

            $method = "POST";
            $data = "";
            $url = $portal_url . "?r=servicecalls/getdataforengineerdesktop";

            $data = "email=" . $e . "&pwd=" . $p . "&data=" . $data;
            $result = Setup::model()->callportal($url, $data, $method);

            //echo $result;
            $json_response = json_decode($result);




            $response_array=json_decode($result,true);
            //echo $response_array['data'];

            $this->processservicecall_recieved( $response_array['data']);


        }///end of foreach ($all_contracts as $contract) {


    }//end of function checkAuth






    public function actionSendmessageviaportal()
    {

        $output['status'] = 'NOT OK';
        $output['message'] = 'Service NOYT ';

        if (isset( $_POST['api_key'])){

            $output['status'] = 'VALID_KEY';
            $output['api_key'] = $_POST['api_key'];

            $chat_msg=$_POST['chat_msg'];
            $service_id=$_POST['service_id'];

            $service_model=Servicecall::model()->findByPk($service_id);
            if ($service_model)
            {

                $chat_array = array();
                $chat_array['date'] = date( 'l jS \of F Y h:i:s A' );
                $chat_array['person'] = 'me';
                $chat_array['message'] = $chat_msg;
                $fullchat = $service_model->communications;
                $full_chat_array = json_decode( $fullchat, true );
                array_push( $full_chat_array['chats'], $chat_array );
                $service_model->communications = json_encode( $full_chat_array );

                $remote_ref_no=$service_model->remote_ref_no;


                if ($service_model->save())
                {

                    $portal_url=$service_model->contract->portal_url;

                    $method = "POST";
                    $data = "&chat_msg=" . $chat_msg . "&service_reference_number=" .$remote_ref_no;
                    $url = $portal_url . "?r=servicecalls/sendmessagetoamica";

                    $e=$service_model->contract->portal_login_email;
                    $p=$service_model->contract->portal_encrypt_pass;

                    $data = "email=" . $e . "&pwd=" . $p . $data;

                    echo "<br>".$data;
                    echo "<br>".$url;



                    $result = Setup::model()->callportal($url, $data, $method);


                    echo $result;
                    $json_response = json_decode($result);




                }///end of if ($service_model->save())

            }///end of if ($service_model)

        }///end of if (isset( $_POST[api_key]))

        echo json_encode($output);

    }///end of public function postjobtotheportal($brand_id, $product_type_id, $model_no)





    public function processservicecall_recieved($data)
    {

        $data=trim($data);
        $json_response = json_decode($data,true);


        if ($json_response['status'] == "OK") {
            $servicecalls = $json_response['details'];



            echo json_encode($servicecalls[0]['service_reference_number']);

            foreach ($servicecalls as $servicecall) {

                $json_string=json_encode($servicecall);
                $servicecall=json_decode($json_string);





                echo "<hr>" . $servicecall->service_reference_number;
                echo $servicecall->type;
                var_dump($servicecall);
                switch ($servicecall->type) {
                    case "servicecall_data":
                        $this->save_the_job($servicecall);
                        break;

                    case "chat_message":
                        $this->save_the_recieved_chat_msg($servicecall);
                        break;


                }



                //$this->save_the_job($servicecall);

            }////end of foreach ($servicecalls as $servicecall) {


        }////end of if ($json_response->status="OK")




    }//end of actionRaiseServicecall().


    ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// //////////////////////////
    ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// //////////////////////////
    ////////////////////////////////////////////////////Manufacturer Remote call Booking  ////////////////////////// ////////////////////////// //////////////////////////
    ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// //////////////////////////
    ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// ////////////////////////// //////////////////////////

public function save_the_job($job)
    {

        $api_key = $job->gomobile_account_id;

        $job_exists = $this->check_if_job_exists($job->service_reference_number, $api_key);

        if ($job_exists) {
            ///////Update the servicecall
            echo "<hr> UPDATE PROCEDURE NEEDS TO BE WRITTEN";

        } else {
            ///////Raise a new servicecall

            //echo $job->allchatmessage;

            $this->save_as_new_job($job);

        }

    }///end of public function save_the_chat_response()

public function check_if_job_exists($remote_ref_no, $api_key)
    {

        $servicecall_model = $this->findservicecallmodelbyremoterefnoandapikey($remote_ref_no, $api_key);

        if ($servicecall_model)
            return true;
        else
            return false;
    }

    public function findservicecallmodelbyremoterefnoandapikey($remote_ref_no, $api_key)
    {
        echo $api_key;
        echo $remote_ref_no;
        $contract = Contract::model()->getcontractbyapikey($api_key);
        if ($contract) {
            $servicecall_model = Servicecall::model()->findByAttributes(array('remote_ref_no' => $remote_ref_no, 'contract_id' => $contract->id));
            return $servicecall_model;
        } else {
            return null;
        }

    }////    public function check_if_job_exists($remote_ref_no, $contract_id)

/**
     * @param $remote_ref_no
     * @param $contract_id
     * @return CActiveRecord
     *
     * We are choosing remote ref no & contract id together to identify if job exists or not.
     * There are no chances that a contract can have same two job nos
     *
     */

    public function save_the_recieved_chat_msg($job)
    {
        echo "SAVE CHAT MSG NEEDS TO BE WRITTEN";
        echo "<br><br>" . json_encode($job);

        $api_key = $job->gomobile_account_id;

        $servicemodel = $this->findservicecallmodelbyremoterefnoandapikey($job->service_reference_number, $api_key);

        if ($servicemodel) {

            echo "<br>NEW CHATS in :".json_encode($job->communications);
            echo "<br>OLD CHATS in :".$servicemodel->communications;

            $chat_array = array();
            $chat_array['date'] = $job->communications->date;
            $chat_array['person'] = $job->communications->person;
            $chat_array['message'] = $job->communications->message;

            $fullchat = $servicemodel->communications;
            $full_chat_array = json_decode( $fullchat, true );
            array_push( $full_chat_array['chats'], $chat_array );

            $servicemodel->communications = json_encode($full_chat_array);


            if ($servicemodel->save()) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;

        }
        //json_encode($job->communications);

        /*

                if ($servicemodel->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }
       */

    }////end of   public function save_the_job($job)

public function save_as_new_job($job)
    {

        $api_key = $job->gomobile_account_id;
        $contract = Contract::model()->getcontractbyapikey($api_key);

        $contract_ref_no = $contract->short_name . $job->service_reference_number;
        // $data=json_decode($job->data);


        $data_string = json_encode($job->data);
        $data_array = json_decode($data_string, true);


        $brand_name = $this->extract_from_data_for_key('Brand', $data_array);
        $product_type = $this->extract_from_data_for_key('Type', $data_array);

        $brand_id = Brand::model()->get_brand_id_by_brandname($brand_name);
        $product_type_id = ProductType::model()->get_product_type_id_by_producttype($product_type);
        $model_number = $this->extract_from_data_for_key('Model', $data_array);

        $product_model = $this->saveproduct($brand_id, $product_type_id, $model_number);


        if ($product_model) {
            $customer_name = $this->extract_from_data_for_key('Customer', $data_array);
            $address_line1 = $this->extract_from_data_for_key('address_line_1', $data_array);
            $town = $this->extract_from_data_for_key('town', $data_array);
            $postcode = $this->extract_from_data_for_key('postcode', $data_array);
            $telephone = $this->extract_from_data_for_key('telephone', $data_array);
            $email = $this->extract_from_data_for_key('email', $data_array);

            $customer_model = $this->savecustomer($product_model->id, $customer_name, $address_line1, $town, $postcode, $telephone, $email);

            if ($customer_model) {
                $fault = $this->extract_from_data_for_key('Fault', $data_array);


                $servicecall_model = $this->saveservicecall($job, $data_string, $fault, $product_model->id, $customer_model->id, $contract->id, $contract_ref_no);

                if ($servicecall_model) {

                    return 'Saved';
                }


            }///end of if ($customer_model)

        }///end of if ($product_model)


        //$this->saveproduct($data)


    }//end of 	 save_as_new_job($job)


    public function extract_from_data_for_key($attribute, $data)
    {
        /*
         * DATA SHOULD BE OF FOLLOWING FORMAT
        data: {
                Customer: " wickcomb",
                Postcode: "CO2 8LS",
                Brand: "Amica",
                Model: "ZIM466UK",
                Type: "Dishwasher",
                Fault: "dishwasher has stopped mid cycle. is aware call is chargeable if not a manufacturing fault",
                Telephone: "07798700138",
                Mobile: ""
               }
         */

        foreach ($data as $key => $value) {
            $formatted_key = $this->takespacesoff_and_convert_tolowercase($key);
            $attribute = $this->takespacesoff_and_convert_tolowercase($attribute);
            if ($formatted_key === $attribute) {
                return $value;
            }

        }///end of foreach ($data as $key=>$value)


        switch ($attribute) {
            case 'email':
                return "";
                break;

            default:
                return "UNKNOWN ATTRIBUTE " . $attribute;

        }


    }/////public function  actionGetservicecallsfrommanufacturer()

    public function takespacesoff_and_convert_tolowercase($string)
    {
        $formatted_string = preg_replace('/\s+/', '', $string);
        $formatted_string = strtolower($formatted_string);

        return $formatted_string;

    }////end of public function processservicecall_recieved()

    public function saveproduct($brand_id, $product_type_id, $model_no)
    {
        $newRemoteProductModel = new Product;
        $newRemoteProductModel->customer_id = '99999999';
        $newRemoteProductModel->brand_id = $brand_id;
        $newRemoteProductModel->product_type_id = $product_type_id;
        $newRemoteProductModel->model_number = $model_no;

        if ($newRemoteProductModel->save()) {
            return $newRemoteProductModel;
        } else {
            var_dump($newRemoteProductModel->getErrors());
            return false;
        }
    }///end of public function saveservicecall($service_data)

    public function savecustomer($product_id, $name, $address_line1, $town, $postcode, $telephone, $email)
    {

        $newRemoteCustomerModel = new Customer();
        $newRemoteCustomerModel->product_id = $product_id;
        $newRemoteCustomerModel->last_name = $name;
        $newRemoteCustomerModel->address_line_1 = $address_line1;
        $newRemoteCustomerModel->town = $town;
        $newRemoteCustomerModel->postcode = $postcode;
        $newRemoteCustomerModel->telephone = $telephone;
        $newRemoteCustomerModel->email = $email;

        if ($newRemoteCustomerModel->save()) {
            return $newRemoteCustomerModel;
        } else {
            var_dump($newRemoteCustomerModel->getErrors());
            return false;
        }
    }///end of     public function saveservicecall(){

    public function saveservicecall($job, $data, $fault, $product_id, $customer_id, $contact_id, $contract_ref_no)
    {

        $remotely_booked_status_id = 2;
        $engineer_id = "90000000"; ///This is default Engineer Id

        $newRemoteServicecall = new Servicecall;
        $newRemoteServicecall->customer_id = $customer_id;
        $newRemoteServicecall->product_id = $product_id;
        $newRemoteServicecall->fault_description = $fault;
        $newRemoteServicecall->fault_date = date('d-M-Y');
        $newRemoteServicecall->recalled_job = '0';
        $newRemoteServicecall->job_status_id = $remotely_booked_status_id;
        $newRemoteServicecall->contract_id = $contact_id;
        $newRemoteServicecall->engineer_id = $engineer_id;
        $newRemoteServicecall->insurer_reference_number = $contract_ref_no;
        $newRemoteServicecall->remote_data_recieved = $data;
        $newRemoteServicecall->remote_ref_no = $job->service_reference_number;


        /*This is the first msg so initiated this way*/
        $full_chat_array = array();
        $chat_array=$job->allchatmessage->chats;
        $full_chat_array['chats']=array();
        array_push( $full_chat_array['chats'], $chat_array );
        $newRemoteServicecall->communications = json_encode($full_chat_array);



        //$newRemoteServicecall->communications = json_encode($job->allchatmessage);


        if ($newRemoteServicecall->save()) {
            return $newRemoteServicecall;
        } else {
            var_dump($newRemoteServicecall->getErrors());
            return false;
        }

    }///end of public function savecustomer($brand_id, $product_type_id, $model_no)












    private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (!(isset($_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME']) and isset($_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD']))) {
            // Error: Unauthorized

            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME'];
        $password = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD'];
        // Find the user
        $user = User::model()->find('LOWER(username)=?', array(strtolower($username)));
        if ($user === null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if (!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }/////end of public function postjobtotheportal()

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
            exit;
        } // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
    		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    		<html>
    		<head>
    		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    		<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
    		</head>
    		<body>
    		<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    		<p>' . $message . '</p>
    		<hr />
    		<address>' . $signature . '</address>
    </body>
    </html>';

            echo $body;
            exit;
        }
    }///end of     public function extract_from_data_for_key($key, $data)

    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }


}///end of class