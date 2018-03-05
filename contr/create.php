<?php
$title = '<h2>Create your voting!</h2>';
error_reporting(0);
require_once('view/template/head.html');
require_once('sys/autoload.php');
require_once('model/class.VotingsData.php');
$votings = new VotingsMethods;
if(isset($_POST['send'])) {
    $votings->setFormData();  // Setting form data      
    try {
        $votings->checkFormData($votings->title, $votings->descr, $votings->quest, $votings->voting_start, $votings->voting_stop, $votings->resp); // Checking obligatory fields
        // Saving form data except responses
        $q = $votings->db->prepare("INSERT INTO votings(stat, title, descr, quest, voting_start, voting_stop, admin_email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $q->execute([$votings->stat, $votings->title, $votings->descr, $votings->quest, $votings->voting_start, $votings->voting_stop, $votings->admin_email]);
        // Getting id of last saved voting
        $q2 = $votings->db->query("SELECT voting_id FROM votings ORDER BY voting_id DESC LIMIT 1");
        $q2->setFetchMode(PDO::FETCH_ASSOC);
        $vid = $q2->fetch();
        $res = $vid['voting_id'];
        // Saving the responses
        foreach($votings->resp as $response) {
            $q3 = $votings->db->prepare("INSERT INTO response(voting_id, resp) VALUES(?, ?)");
            $q3->execute([$res, $response]);
        }        
        echo '<div class="alert alert-success" role="alert"><h2>The voting has been saved!</h2></div>';
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
}
require_once('view/page/create.html');
require_once('view/template/foot.html');
unset($votings);