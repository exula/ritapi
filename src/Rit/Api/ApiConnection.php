<?php
namespace Rit\Api;


/**
 * Class ApiConnection
 * @package Rit\Api
 */
class ApiConnection {

    /**
     * @var string
     */
    private $key;
    /**
     * @var \GuzzleHttp\Client
     */
    private $GuzzleClient;
    /**
     * @var string
     */
    private $authorizationKey;
    /**
     * @var string
     */
    private $version;
    /**
     * @var string
     */
    private $apiUrl;

    private $map;

    /**
     *
     */
    function __construct() {

        try {
            $this->key = (string)\Config::get('api::config.key');
            $this->authorizationKey = (string)\Config::get('api::config.authorizationKey');
            $this->apiUrl = (string)\Config::get('api::config.url');
            $this->version = (string)\Config::get('api::config.version');

            $this->map = \Config::get('api::map');
        } catch(\Exception $e) {
            throw new Exception('Application config is not correct!');
        }
        $this->GuzzleClient = new \GuzzleHttp\Client(array('base_url' => $this->apiUrl, 'headers' => array($this->authorizationKey => $this->key)));

    }

    public function getMap($key) {

        if(isset($this->map[$key])) {
            return $this->map[$key];
        } else {
            return false;
        }

    }

    function doQuery($url,$options = array()) {

        $res = $this->GuzzleClient->get($this->version."/".$url."/",
            array('query' =>
                array($this->authorizationKey => $this->key)
            )
        );

        if($res->getStatusCode() == 200) {

            return $res->json();

        } else {
            throw new Exception('API Error');
        }
    }


    /**
     * @param $username
     * @param array $expand
     * @return bool|User
     */
    public function getUser($username) {

        if(is_string($username)) {

            $json = $this->doQuery('faculty/'.$username);
            $user = new User($json);

            return $user;
        }

    }

    public function getRoom($building,$room) {

        if(is_string($building) && is_string($room)) {
            $json = $this->doQuery('rooms/'.$building."-".$room);
            $room = new Room($json);

            return $room;

        }
    }

    public function getRoomMeetings($building,$room) {

        if(is_string($building) && is_string($room)) {
            $json = $this->doQuery('rooms/'.$building."-".$room."/meetings");

            $meetings = array();
            foreach($json['data'] as $m) {

                $meetings[] = new Meeting(array("data" => $m));

            }

            return $meetings;

        }
    }


}
