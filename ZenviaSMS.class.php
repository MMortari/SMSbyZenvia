<?php
class ZenviaSMS {

    private $link;
    private $password;
    private $from;
    private $to;
    private $schedule;
    private $msg;
    private $id;
    private $aggregateId;
    private $callbackOption;
    private $flashSms;

    public function setPassword($account, $password) {
        $this->password = base64_encode($account . ":" . $password);
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function setSchedule($schedule) {
        $this->schedule = $schedule;
    }

    public function setMessage($msg) {
        $this->msg = $msg;
    }

    public function setIdentification($id) {
        $this->id = $id;
    }

    public function setAggregateId($aggregateId) {
        $this->aggregateId = $aggregateId;
    }

    public function setCallbackOption($callbackOption) {
        $this->callbackOption = $callbackOption;
    }

    public function setFlashSMS($flashSms) {
        $this->flashSms = $flashSms;
    }

    public function testeSMS() {
        if($this->link != null && $this->password != null && $this->from != null && $this->to != null && $this->schedule != null && $this->msg != null && $this->id != null && $this->aggregateId != null && $this->callbackOption != null && $this->flashSms != null) {
            return true;
        } else {
            return false;
        }
    }

    public function sendSMS() {

        if($this->link != null && $this->password != null && $this->from != null && $this->to != null && $this->schedule != null && $this->msg != null && $this->id != null) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
          \"sendSmsRequest\": {
            \"from\": \"" . $this->from . "\",
            \"to\": \"" . $this->to . "\",
            \"schedule\": \"" . $this->schedule . "\",
            \"msg\": \"" . $this->msg . "\",
            \"callbackOption\": \"" . $this->callbackOption . "\",
            \"id\": \"" . $this->id . "\",
            \"aggregateId\": \"" . $this->aggregateId . "\",
            \"flashSms\": " . $this->flashSms . "
          }
        }");

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: Basic " . $this->password,
                "Accept: application/json"
            ));

            $response = curl_exec($ch);

            curl_close($ch);

            $final = json_decode($response);

            return $final;
        } else {
            return false;
        }

    }

}
?>
