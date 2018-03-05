<?php
class VotingsMethods extends VotingsData {
    public $db = null;
    public $count = [];    
    public function __construct() { // Connect to database
        require_once('sys/class.Dbc.php');
        $link = new Dbc;
        $this->db = $link->dbc;
        return $this->db;
    }
    public function setFormData() { // Setting information written in form fields (create.html)
        parent::setTitle(strip_tags(trim($_POST['title'])));
        parent::setDescr(strip_tags(trim($_POST['desc'])));
        parent::setQuest(strip_tags(trim($_POST['quest'])));
        parent::setVotingStart(strip_tags(trim($_POST['start'])));
        parent::setVotingStop(strip_tags(trim($_POST['stop'])));
        parent::setAdminEmail(filter_var(strip_tags(trim($_POST['admin_email'])), FILTER_VALIDATE_EMAIL));
        parent::setResp($_POST['respo']);
        parent::setStat();        
    }
    public function checkFormData($title, $descr, $quest, $start, $stop, $res) { // Backend checking of obligatory data
        $data = [
            'title' => $title,
            'description' => $descr,
            'question' => $quest,
            'starting date' => $start,
            'closing date' => $stop,
            'response' => $res
        ];
        foreach($data as $key => $value) {
            if(empty($value)) {
                throw new Exception("<div class=\"alert alert-danger\" role=\"alert\"><h2>Error!</h2><strong>The voting does not have a {$key}! Please add a {$key}!</strong></div>");
            }
        }        
    }
    public function countVotes($id) {
        $q = $this->db->prepare("SELECT r.resp, COUNT(*) FROM response AS r, voter AS v WHERE r.response_id = v.response_id AND r.voting_id = ? GROUP BY r.response_id ORDER BY COUNT(*) DESC");
        $q->execute([$id]);    
        $this->count = $q->fetchAll();
        return $this->count;
    }    
}