<?php
class VotingsData {
    public $voting_id = null;
    public $stat = null;
    public $title =null;
    public $descr = null;
    public $quest = null;
    public $voting_start = null;
    public $voting_stop = null;
    public $admin_email = null;
    public $response_id = null;
    public $resp = [];
    public $voter_id = null;
    public $voter_name = null;
    public $voting_date = null;
    public $voter_ip = null;
    public $code = null;
    public $captcha = null;
    public $cron_start = null;
    public $cron_stop = null;
    
    // Getters

    public function getVotingId() {
        return $this->voting_id;
    }
    public function getStat() {
        return $this->stat;
    }
    public function getTitle() {
        return $this->title;
    } 
    public function getDescr() {
        return $this->descr;
    }
    public function getQuest() {
        return $this->quest;
    }
    public function getVotingStart() {
        return $this->voting_start;
    }
    public function getVotingStop() {
        return $this->voting_stop;
    }
    public function getAdminEmail() {
        return $this->admin_email;
    }
    public function getResponseId() {
        return $this->response_id;
    }
    public function getResp() {
        return $this->resp;
    }
    public function getVoterId() {
        return $this->voter_id;
    }
    public function getVoterName() {
        return $this->voter_name;
    }
    public function getVotingDate() {
        return $this->voting_date;
    }
    public function getVoterIp() {
        return $this->voter_ip;
    }

    // Setters

    
    public function setVotingId($voting_id) {
        $this->voting_id = $voting_id;
        return $this->voting_id;
    }
    public function setStat() {
        $day = date('Y-m-d');
        if(($day >= date('Y-m-d', strtotime($this->voting_start))) && ($day <= date('Y-m-d', strtotime($this->voting_stop)))) {
            $this->stat = 0;
        }
        elseif ($day < date('Y-m-d', strtotime($this->voting_start))) {
            $this->stat = 1;
        }
        elseif($day > date('Y-m-d', strtotime($this->voting_stop))) {
            $this->stat = 2;
        }        
        return $this->stat;
    }    
    public function setTitle($title) {
        $this->title = $title;
        return $this->title;    
    }
    public function setDescr($descr) {
        $this->descr = $descr;
        return $this->descr;
    }
    public function setQuest($quest) {
        $this->quest = $quest;
        return $this->quest;
    }
    public function setVotingStart($voting_start) {
        $this->voting_start = $voting_start;
        return $this->voting_start;
    }
    public function setVotingStop($voting_stop) {
        $this->voting_stop = $voting_stop;
        return $this->voting_stop;
    }
    public function setAdminEmail($admin_email) {
        $this->admin_email = $admin_email;
        return $this->admin_email;
    }    
    public function setResponseId($response_id) {
        $this->response_id = $response_id;
        return $this->response_id;
    }
    public function setResp($respn) {        
        $this->resp = $respn;
        return $this->resp;        
    }
    public function setVoterId($voter_id) {
        $this->voter_id = $voter_id;
        return $this->voter_id;
    }
    public function setVoterName($voter_name) {
        $this->voter_name = $voter_name;
        return $this->voter_name;
    }
    public function setVotingDate() {
        $this->voting_date = date('Y-m-d H:i:s');
        return $this->voting_date;
    }
    public function setVoterIp($voter_ip) {
        $this->voter_ip = $voter_ip;
        return $this->voter_ip;
    }
    public function setCode($code) {
        $this->code = strtolower($code);
        return $this->code;
    }
    public function setCaptcha() {
        $this->captcha = strtolower(date('l'));
        return $this->captcha;
    }
    public function setCronStart() {
        $this->cron_start = date('Y-m-d');
        return $this->cron_start;        
    }
    public function setCronStop() {
        $this->cron_stop = date('Y-m-d', strtotime("-1 day"));
        return $this->cron_stop;
    }
}