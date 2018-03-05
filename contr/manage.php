<?php
error_reporting();
$title = '<h2>Manage your voting</h2>';
require_once('model/class.VotingsData.php');
require_once('sys/autoload.php');
require_once('view/template/head.html');
$man = new VotingsMethods;
// Getting data of selected voting from database
if(isset($_GET['voting_id'])) {
    $man->setVotingId($_GET['voting_id']);
    // Getting data of voting
    $q = $man->db->prepare("SELECT * FROM votings WHERE voting_id = ?");
    $q->execute([$man->voting_id]);
    $q->setFetchMode(PDO::FETCH_CLASS, 'VotingsData');
    $vote = $q->fetch();
    // Getting data of responses    
    $q2 = $man->db->prepare("SELECT response_id, resp FROM response WHERE voting_id = ?");
    $q2->execute([$man->voting_id]);
    $q2->setFetchMode(PDO::FETCH_ASSOC);
    // Saving of modifications
    if(isset($_POST['save'])) {
        $man->setFormData();
        $man->checkFormData($man->title, $man->descr, $man->quest, $man->voting_id, $man->voting_stop, $man->resp);
        $q3 = $man->db->prepare("UPDATE votings SET stat = ?, title = ?, descr = ?, quest = ?, voting_start = ?, voting_stop = ?, admin_email = ? WHERE voting_id = ?");
        $q3->execute([$man->stat, $man->title, $man->descr, $man->quest, $man->voting_start, $man->voting_stop, $man->admin_email, $man->voting_id]);
        //Updating responses
        $q4 = $man->db->query("DELETE FROM response WHERE voting_id = '$man->voting_id'");        
        foreach($man->resp as $response) {
            $q5 = $man->db->prepare("INSERT INTO response(voting_id, resp) VALUES(?, ?)");
            $q5->execute([$man->voting_id, $response]);            
        }
        echo '<div class="alert alert-success" role="alert"><h3>The voting has been updated successfully!</h3></div>';                       
    }
}
require_once('view/page/manage.html');
require_once('view/template/foot.html');
unset($man);