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