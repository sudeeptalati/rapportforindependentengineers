<?php
return [
    'components' => [


        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:/Applications/XAMPP/xamppfiles/htdocs//rapport/call-handling-engineers/chs/protected/data/chs.db', // SQLite


            /*
            'dsn' => 'mysql:host=localhost;dbname=findmyengineer',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            */
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.laser.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'stalati',
                'password' => '#rev1s1on!',
                'port' => '25', // Port 25 is a very common port too
                //'encryption' => 'none', // It is often used, check your provider or mail server specs
            ],

        ],

        'clickatell' => [
            'class' => 'albertborsos\clickatell\ClickatellHttp',
            'username' => '00',
            'password' => '00',
            'apiID' => '00',
            'from' => '00', // optional parameter,
            'mo' => 1 // optional parameter
        ],







    ],
];
