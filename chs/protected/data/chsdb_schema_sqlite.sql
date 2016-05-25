Columns Added in TABLE notification_rules

frequency	TEXT	No	None	No
email_template	TEXT	No	None	No
sms_template	TEXT	No	None	No

CREATE TABLE "notification_rules" ("id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , "job_status_id" INTEGER, "active" BLOB, "customer_notification_code" INTEGER, "engineer_notification_code" INTEGER, "warranty_provider_notification_code" INTEGER, "notify_others" BLOB, "created" DATETIME, "modified" DATETIME, "delete" DATETIME, 'frequency' TEXT, 'email_template' TEXT, 'sms_template' TEXT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (customer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (engineer_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_notification_code FOREIGN KEY (warranty_provider_notification_code) REFERENCES notification_code(id) ON DELETE CASCADE ON UPDATE RESTRICT, CONSTRAINT FK_notification_rules_job_status FOREIGN KEY (job_status_id) REFERENCES job_status (id) ON DELETE CASCADE ON UPDATE RESTRICT )

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Columns Added in TABLE tasks_to_do
frequency_type	TEXT	No	None	No
CREATE TABLE tasks_to_do(id INTEGER PRIMARY KEY NOT NULL, task TEXT, status TEXT, msgbody TEXT, subject TEXT, send_to TEXT, created DATETIME, scheduled DATETIME, executed DATETIME, finished DATETIME, 'frequency_type' TEXT)

