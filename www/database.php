<?php

require 'vendor/autoload.php'; // include Composer's autoloader
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;



define('DB_URL' , 'http://bcappdata.graunephar.lol');


class DatabaseConnetor{

  function addMessage() {

      $factory = (new Factory)->withServiceAccount('/secret/JSON NAME');


  }



}
