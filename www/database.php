<?php

require 'vendor/autoload.php'; // include Composer's autoloader
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;

/**
 * Best fiorebase docas evaar! https://buildmedia.readthedocs.org/media/pdf/firebase-php/stable/firebase-php.pdf
 */

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


class DatabaseConnector {

    private $database;

    function __construct() {
        $db_name = $_ENV['PATH_TO_FIREBASE_JSON'];

        $factory = (new Factory)->withServiceAccount($db_name);

        $this->database = $factory->createDatabase();
    }

    public function getDeepValue($key) {
        return $this->database->getReference($key)->getValue();
    }


    public function getValue($key) {

        //$reference = $database->getReference('path/to/child/location');
        $data = $this->database->getReference($key)
            ->shallow()
            ->getSnapshot();

        return $data->getValue();

    }


    public function updateValue($key, $new_value) {
        $this->database->getReference($key)->set($new_value);
    }

    public function  COmplexExample() {

        $this->database->getReference($key)
            ->set([
                'name' => 'My Application',
                'emails' => [
                    'support' => 'support@domain.tld',
                    'sales' => 'sales@domain.tld',
                ],
                'website' => 'https://app.domain.tld',
            ]);
    }


}
