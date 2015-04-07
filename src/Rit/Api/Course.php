<?php

namespace Rit\Api;

class Course extends ApiConnection {

    public function __construct($json) {
        if(is_array($json))
        {
            foreach ($json as $attribute => $value) {

                        $this->$attribute = $value;


            }
        } else {
            throw new \Exception('Invalid Courses');
        }


        parent::__construct();
    }

}