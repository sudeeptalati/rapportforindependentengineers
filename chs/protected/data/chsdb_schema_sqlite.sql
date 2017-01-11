Columns Added in TABLE notification_rules

frequency	TEXT	No	None	No
email_template	TEXT	No	None	No
sms_template	TEXT	No	None	No

CREATE TABLE "notification_rules" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , "job_status_id" INTEGER, "active" BLOB, "customer_notification_code" INTEGER, "engineer_notification_code" INTEGER, "warranty_provider_notification_code" INTEGER, "notify_others" BLOB, "created" DATETIME, "modified" DATETIME, "delete" DATETIME, 'frequency' TEXT, 'email_template' TEXT, 'sms_template' TEXT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (customer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (engineer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT sFK_notification_rules_notification_code FOREIGN KEY (warranty_provider_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_job_status FOREIGN KEY (job_status_id) REFERENCES job_status (id) ON DELETE CASCADE ON UPDATE RESTRICT )

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Columns Added in TABLE tasks_to_do
frequency_type	TEXT	No	None	No
CREATE TABLE tasks_to_do(id INTEGER PRIMARY KEY NOT NULL, task TEXT, status TEXT, msgbody TEXT, subject TEXT, send_to TEXT, created DATETIME, scheduled DATETIME, executed DATETIME, finished DATETIME, 'frequency_type' TEXT)


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Columns Added in TABLE engineer
color	TEXT
include_in_diary_route_planning	INTEGER

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Columns Added in TABLE job_status

backgroundcolor	TEXT

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Columns Added in TABLE spares_used

notes TEXT
used Integer

 
INSERT INTO "job_status" ("id","name","information","published","view_order","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor") VALUES ('21','Scheduled','This is a system status scheduled. This status is automatically changed one day before the job is about to be executed','1','12','12','','1',NULL,'')


ALTER TABLE 'spares_used' ADD COLUMN 'used ' INETEGER;
ALTER TABLE 'spares_used' ADD COLUMN 'notes ' TEXT;

UPDATE "servicecall" SET "activity_log"='' WHERE 1



------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


CREATE TABLE 'documents_manuals' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'document_type_id' INTEGER, 'name' TEXT, 'description' TEXT, 'brand_id' INTEGER, 'product_type_id' INTEGER, 'model_nos' TEXT, 'created' DATETIME, 'created_by_user_id' INTEGER,'filename' TEXT, 'version' TEXT, 'active' INTEGER);


----
-- Table structure for document_type
----
CREATE TABLE 'document_type' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'name' TEXT, 'info' TEXT, 'category' TEXT);
----
-- Data dump for document_type, a total of 3 rows
----
INSERT INTO "document_type" ("id","name","info","category") VALUES ('1','Customer Signature','','SIGNATURE');
INSERT INTO "document_type" ("id","name","info","category") VALUES ('2','Engineer''s Signature ','','SIGNATURE');
INSERT INTO "document_type" ("id","name","info","category") VALUES ('3','Other Image','This is teh signature of customer','IMAGE');
INSERT INTO "document_type" ("id","name","info","category") VALUES ('4','Product Image','','IMAGE');
INSERT INTO "document_type" ("id","name","info","category") VALUES ('5','Rating Plate Image','Rating Plate Image','IMAGE');
INSERT INTO "document_type" ("id","name","info","category") VALUES ('7','Manufacturer Manual','','MANUAL');




CREATE TABLE "servicecalls_docs_manuals" ('servicecall_id' INTEGER NOT NULL, 'document_id' INTEGER NOT NULL, PRIMARY KEY (document_id, servicecall_id));




CREATE TABLE 'engineer_login' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,'username' TEXT, 'auth_key' TEXT, 'password_hash' TEXT, 'password_reset_token' TEXT, 'status' INTEGER, 'created_at' DATETIME, 'updated_at' DATETIME, 'name' TEXT,'email' TEXT, 'engineer_id' INTEGER);


INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor") VALUES ('24','Job Completed by Engineer','','1','1','1','1',NULL,'','1',NULL,'');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor") VALUES ('23','Engineer Working','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E3FFEE" >Job Completed by Engineer</div>','1','1477319251','#E3FFEE');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor") VALUES ('22','Engineer On the Way','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E3FFEE" >Job Completed by Engineer</div>','1','1477319251','#E3FFEE');


ALTER TABLE 'servicecall' ADD COLUMN 'admintime ' INETEGER;
ALTER TABLE 'enggdiary' ADD COLUMN 'duration_of_call' INETEGER;




------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------MANUFACTURER SYSTEM-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


ALTER TABLE 'contract' ADD COLUMN 'api_key' TEXT;
ALTER TABLE 'contract' ADD COLUMN 'portal_url' TEXT;
ALTER TABLE 'contract' ADD COLUMN 'portal_login_email' TEXT;
ALTER TABLE 'contract' ADD COLUMN 'portal_encrypt_pass' TEXT;
ALTER TABLE 'contract' ADD COLUMN 'max_spend_limit_without_authorisation' REAL;


ALTER TABLE 'servicecall' ADD COLUMN 'remote_ref_no' TEXT;
ALTER TABLE 'servicecall' ADD COLUMN 'remote_data_recieved' TEXT;
ALTER TABLE 'servicecall' ADD COLUMN 'communications' TEXT;
ALTER TABLE 'servicecall' ADD COLUMN 'remote_data_sent' TEXT;
ALTER TABLE 'servicecall' ADD COLUMN 'test_results' TEXT;
ALTER TABLE 'servicecall' ADD COLUMN 'received_remote_data_status' INT;









----
-- Table structure for job_status
----
CREATE TABLE 'job_status' ( "id" INTEGER PRIMARY KEY NOT NULL , "name" TEXT  , "information" TEXT, "published" INTEGER  , "dropdown_display" INTEGER DEFAULT (0) , "view_order" INTEGER  , "dashboard_display" INTEGER DEFAULT (0) , "dashboard_prority_order" INTEGER , "html_name" TEXT, "updated_by_user_id" INTEGER, "updated" DATETIME , backgroundcolor TEXT, 'mobile_display' INTEGER,'keyword' TEXT);

----
-- Data dump for job_status, a total of 46 rows
----
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('1','Logged - Not Assigned','Initial State of all servicecalls. Similar to Draft.','1','1','0','1','0','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#1CFFC2" >Logged - Not Assigned</div>','1','1483471310','#1CFFC2',NULL,'LOGGED_-_NOT_ASSIGNED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('2','Remotely Logged','','0','0','4','0','6','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFDE0A" >Remotely Logged</div>','1','1483471368','#FFDE0A',NULL,'REMOTELY_LOGGED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('3','Booked','Status changed after engineer is assigned.','1','0','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#9CA9FF" >Booked</div>','1','1483471372','#9CA9FF',NULL,'BOOKED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('4','Parts to be Ordered','','1','0','2','1','4','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF596F" >Parts to be Ordered</div>','1','1483471374','#FF596F',NULL,'PARTS_TO_BE_ORDERED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('5','Waiting for parts','','1','0','2','1','2','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#55FF3B" >Waiting for parts</div>','1','1483471377','#55FF3B','1','WAITING_FOR_PARTS');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('6','Awaiting Rebooking','','1','0','2','1','2','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#9378FF" >Awaiting Rebooking</div>','1000003','1483471531','#9378FF',NULL,'AWAITING_REBOOKING');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('7','Waiting for Technical Information','','1','0','3','1','10','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFF67D" >Waiting for Technical Information</div>','1000003','1483471383','#FFF67D',NULL,'WAITING_FOR_TECHNICAL_INFORMATION');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('8','Awaiting Invoicing','','0','0','9','1','7','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF9854" >Awaiting Invoicing</div>','1','1483471386','#FF9854',NULL,'AWAITING_INVOICING');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('9','No Access','','1','0','4','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF0303" >No Access</div>','1000003','1483471388','#FF0303','1','NO_ACCESS');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('10','Recalled','','0','0','7','0','5','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF9F75" >Recalled</div>','1','1483471389','#FF9F75',NULL,'RECALLED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('11','Complete and waiting to be Invoiced','','1','0','9','1','2','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#A1E9FF" >Complete and waiting to be Invoiced</div>','1','1483471395','#A1E9FF','1','COMPLETE_AND_WAITING_TO_BE_INVOICED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('12','Advice given on phone','','0','0','2','0','0','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#F959FF" >Advice given on phone</div>','1000003','1483471399','#F959FF',NULL,'ADVICE_GIVEN_ON_PHONE');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('13','Awaiting customer response','','1','0','4','1','8','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFE042" >Awaiting customer response</div>','1000003','1483471419','#FFE042',NULL,'AWAITING_CUSTOMER_RESPONSE');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('14','Call avoided by call center','','0','0','6','0','5','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#9C9C9C" >Call avoided by call center</div>','1','1483471426','#9C9C9C',NULL,'CALL_AVOIDED_BY_CALL_CENTER');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('15','Call avoided by engineer','','0','0','5','0','14','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#ABABAB" >Call avoided by engineer</div>','1','1483471470','#ABABAB',NULL,'CALL_AVOIDED_BY_ENGINEER');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('16','Replaced','Appliance replaced with new one.','0','0','8','0','16','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#B3FFEB" >Replaced</div>','1','1483471475','#B3FFEB',NULL,'REPLACED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('21','Scheduled','This is a system status scheduled. This status is automatically changed one day before the job is about to be executed','1','0','12','1','12','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFA694" >Scheduled</div>','1','1483471479','#FFA694',NULL,'SCHEDULED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('22','Engineer On the Way','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFAD33" >Engineer On the Way</div>','1','1483471486','#FFAD33',NULL,'ENGINEER_ON_THE_WAY');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('23','Engineer Working','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#00FF08" >Engineer Working</div>','1','1483471492','#00FF08',NULL,'ENGINEER_WORKING');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('24','Job Completed by Engineer','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E7FFC2" >Job Completed by Engineer</div>','1','1483471496','#E7FFC2','1','JOB_COMPLETED_BY_ENGINEER');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('25','Job Incompleted by The Engineer','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF0808" >Job Incompleted by The Engineer</div>','1','1483471507','#FF0808','1','JOB_INCOMPLETED_BY_THE_ENGINEER');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('33','Job Details Updated Remotely','Job Details Updated Remotely','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF05DE" >Job Details Updated Remotely</div>',NULL,'1483471510','#FF05DE',NULL,'JOB_DETAILS_UPDATED_REMOTELY');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('34','Claim Approved','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#2BFF0A" >Claim Approved</div>','1','1483471517','#2BFF0A',NULL,'CLAIM_APPROVED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('35','Claim Submitted','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E3FFEE" >Claim Submitted</div>','1','1483471520','#E3FFEE',NULL,'CLAIM_SUBMITTED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('36','Message Recieved ','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#3068FF" >Message Recieved </div>','1','1483471527','#3068FF',NULL,'MESSAGE_RECIEVED_');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('37','Message Sent','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E3FFEE" >Message Sent</div>','1','1483471538','#E3FFEE',NULL,'MESSAGE_SENT');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('38','Message Delivered','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E3FFEE" >Message Delivered</div>','1','1483471585','#E3FFEE',NULL,'MESSAGE_DELIVERED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('39','Pending More Info','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFC247" >Pending More Info</div>','1','1483471543','#FFC247',NULL,'PENDING_MORE_INFO');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('40','Claim Rejected','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF0A3B" >Claim Rejected</div>','1','1483471546','#FF0A3B',NULL,'CLAIM_REJECTED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('41','Read','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#DBDBDB" >Read</div>','1','1483471549','#DBDBDB',NULL,'READ');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('42','Unread','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#CCB439" >Unread</div>','1','1483471609','#CCB439',NULL,'UNREAD');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('43','Archived','','1','1','1','1',NULL,'<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#BABABA" >Archived</div>','1','1483471612','#BABABA',NULL,'ARCHIVED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('51','Lawrence''s Query Jobs','','1','0','4','1','101','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#A1FF85" >Lawrence''s Query Jobs</div>','1','1483471616','#A1FF85',NULL,'LAWRENCE''S_QUERY_JOBS');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('52','Parts pre ordered','','0','0','3','0','3','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#F1FF26" >Parts pre ordered</div>','1','1483471619','#F1FF26',NULL,'PARTS_PRE_ORDERED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('53','Referred back to Manufacturer','','1','0','2','1','103','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E2FF85" >Referred back to Manufacturer</div>','5','1483471622','#E2FF85',NULL,'REFERRED_BACK_TO_MANUFACTURER');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('54','Unable to contact','','1','0','3','1','104','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF82F3" >Unable to contact</div>','5','1483471654','#FF82F3',NULL,'UNABLE_TO_CONTACT');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('55','Quoted to repair - awaiting result','','1','0','2','1','4','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FF8D29" >Quoted to repair - awaiting result</div>','5','1483471657','#FF8D29',NULL,'QUOTED_TO_REPAIR_-_AWAITING_RESULT');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('56','Customer Testing Appliance','CUSTOM STATUS 1','1','0','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFDF0F" >Customer Testing Appliance</div>','1','1483471660','#FFDF0F',NULL,'CUSTOMER_TESTING_APPLIANCE');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('57','DEB''S TO DEAL WITH','Anything for Debs to sort','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#CFE8FF" >DEB''S TO DEAL WITH</div>','1','1483471664','#CFE8FF',NULL,'DEB''S_TO_DEAL_WITH');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('58','Invoice Still TO PAY','CUSTOM STATUS 2','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#FFABBC" >Invoice Still TO PAY</div>','1','1483471667','#FFABBC',NULL,'INVOICE_STILL_TO_PAY');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('59','CUSTOM STATUS 3','CUSTOM STATUS 3','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#F0F0F0" >CUSTOM STATUS 3</div>','1','1483471673','#F0F0F0',NULL,'CUSTOM_STATUS_3');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('60','CUSTOM STATUS 4','CUSTOM STATUS 4','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#DEDCDC" >CUSTOM STATUS 4</div>','1','1483471677','#DEDCDC',NULL,'CUSTOM_STATUS_4');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('61','CUSTOM STATUS 5','CUSTOM STATUS 5','1','1','1','1','1','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#EBEBEB" >CUSTOM STATUS 5</div>','1','1483471680','#EBEBEB',NULL,'CUSTOM_STATUS_5');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('101','Invoiced','','1','0','10','0','6','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#E0E0E0" >Invoiced</div>','1','1483471684','#E0E0E0',NULL,'INVOICED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('102','Cancelled','','1','0','11','0','15','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#697A63" >Cancelled</div>','1','1483471687','#697A63',NULL,'CANCELLED');
INSERT INTO "job_status" ("id","name","information","published","dropdown_display","view_order","dashboard_display","dashboard_prority_order","html_name","updated_by_user_id","updated","backgroundcolor","mobile_display","keyword") VALUES ('103','Customer Invoiced','Customer is charged for the call','0','0','105','0','105','<div style="padding: 5px 5px 5px 30px; border-radius: 10px;background:#9E9595" >Customer Invoiced</div>','1','1483471690','#9E9595',NULL,'CUSTOMER_INVOICED');
COMMIT;


CREATE TABLE 'business_running_cost' ('id' INTEGER PRIMARY KEY NOT NULL, 'cost_of' TEXT, 'weekly_cost' REAL, 'monthly_cost' REAL, 'yearly_cost' REAL, 'daily_cost' REAL);

----
-- Data dump for business_running_cost, a total of 21 rows
----
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('3','Salaries','40.0','310.0','3720.0','10.0');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('4','Rent','64.52','500.0','6000.0','16.13');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('5','Van ','38.71','300.0','3600.0','9.68');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('6','Fuel (Petrol/Disel)','64.52','500.0','6000.0','16.13');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('7','Insurance (Liability)','10.32','80.0','960.0','2.58');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('8','Insurance (Vehicle/s)','10.32','80.0','960.0','2.58');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('9','Insurance (Building)','4.61','20.0','240.0','0.65');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('10','Mobile Telecoms','11.52','50.0','600.0','1.61');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('11','Telecoms (Fixed)','11.52','50.0','600.0','1.61');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('12','Internet','4.61','20.0','240.0','0.65');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('13','Vehicle Maintenance','23.04','100.0','1200.0','3.23');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('14','Printing','9.22','40.0','480.0','1.29');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('15','Printing Supplies','4.61','20.0','240.0','0.65');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('16','IT Systems','9.22','40.0','480.0','1.29');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('17','IT Software','23.04','100.0','1200.0','3.23');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('18','Office Equipment','4.61','20.0','240.0','0.65');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('19','Office Sundries','6.91','30.0','360.0','0.97');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('20','Advertising','23.04','100.0','1200.0','3.23');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('21','Tools','3.46','15.0','180.0','0.48');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('22','Subscriptions','1.15','5.0','60.0','0.16');
INSERT INTO "business_running_cost" ("id","cost_of","weekly_cost","monthly_cost","yearly_cost","daily_cost") VALUES ('23','Website','5.76','25.0','300.0','0.81');
COMMIT;




/*RE-INSERT JOB STATUS TABLE AS NEEDS SEVERAL NEW STATUS*/