
        <?php
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
        $ms = time();

        // notification title
        $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : 'AutoMatic';
        
        // notification message
        $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : 'Cron Job Auto per min '.$ms;
        
        // push type - single user / topic
        $push_type = isset($_REQUEST['push_type']) ? $_REQUEST['push_type'] : 'topic';
        
        // whether to include to image or not
        $include_image = isset($_REQUEST['include_image']) ? $_REQUEST['include_image'] : FALSE;

//$include_image = 'http://www.planwallpaper.com/static/images/desktop-year-of-the-tiger-images-wallpaper.jpg';
        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage($include_image);
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_REQUEST['regId']) ? $_REQUEST['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
        ?>
      
                <?php if ($json != '') { ?>
            <?php echo json_encode($json) ?>
                  
                <?php } ?>
                <br/>
                <?php if ($response != '') { ?>
                    <?php echo json_encode($response) ?>
                <?php } ?>

          