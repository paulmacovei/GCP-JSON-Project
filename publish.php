<?php
//Load libraries
require '/home/plmacovei/vendor/autoload.php';
use Google\Cloud\PubSub\PubSubClient;

//Transform JSON
$url = 'URL';
$test_temp = file_get_contents($url);
$pattern = ",{";
$desired = "{";
$test = preg_replace("/".$pattern."/", $desired, $test_temp);
$pattern = "\[";
$desired = "";
$test = preg_replace("/".$pattern."/", $desired, $test);
$pattern = "\]";
$desired = "";
$test = preg_replace("/".$pattern."/", $desired, $test);

//Start publish function
publish_message("PROJECT_ID","TOPIC_NAME", $test);
function publish_message($projectId, $topicName, $message)
{
    //Create PubSub client
    $pubsub = new PubSubClient([
        'projectId' => $projectId,
    ]);
    //Publish to topic
    $topic = $pubsub->topic($topicName);
    $topic->publish(['data' => $message]);
    print('Message published' . PHP_EOL);
}
?>