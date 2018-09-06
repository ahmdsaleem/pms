<?php


namespace App\Classes;
class Response{

   var $status,$code,$message;

   public function setResponse($status,$code,$message)
   {
        $this->status=$status;
        $this->code=$code;
        $this->message=$message;
   }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return trans($this->message);
    }

    public function test()
    {
        echo 'hey';
    }


}










?>
