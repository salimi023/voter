<?php
class SaveVote extends VotingsData {        

    public function setVotingsData($vid, $name, $rid, $vip) { // Setting votings data given by the voter via the voting form
        parent::setVotingId(strip_tags(trim($vid)));
        parent::setVoterName(strip_tags(trim($name)));
        parent::setResponseId(strip_tags(trim($rid)));
        parent::setVoterIp($vip);              
        parent::setVotingDate();        
    }
    public function checkCaptcha($day) {
        parent::setCode(strip_tags(trim($day)));
        parent::setCaptcha();        
    }    
}