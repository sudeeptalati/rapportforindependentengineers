# rapportforindependentengineers


Migrating from TESTING TO LIVE


######MAIN SYSTEM#######

0. MAKE SURE ALL FILE PERMISSIONS ARE 755

1. RUN THE SQL SCRIPTS from chs/protected/data folder

2. Open chs/protected/config folder for mail and sms settings diary_parameters.json

3. Change the company_logo from images folder

4. Replace Rapport Cron Jobs location
	-_rapport_cronjobs

	-cronurl_dailybooking.php	

	-cronurl_hourlynotification.php




######MOBILE SYSTEM#######


#####FOR DOCUMENTS UPLOAD LOCATIONS #####
1. Open /rapport-chs-mobile/common/config/params.php & Change all Values for database location


#####FOR SMS & EMAIL GATEWAY#####
2. Open /rapport-chs-mobile/common/config/main-local.php



