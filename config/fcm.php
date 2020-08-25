<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAZ9EMobQ:APA91bGMvsTAFIblTuSlKEU75hpVBpfjV43TP0MAsyOYCRi1c_XYNKa3B4IRO3eNo3XwXWH1i2B2-WUGBpkqaGs__66T6Qd0NX2KGyPhmM0M41nTyY9RFo4AGMf84RLoUTyTPeP8Fdaw'),
        'sender_id' => env('FCM_SENDER_ID', '445888897460'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
