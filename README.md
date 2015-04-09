This is a pet project for the RIT API at http://api.rit.edu

This requires Laravel 4.2, it has not been tested on anything else.

**Documentation**

ApiConnection->getUser($username);

ApiConnection->getRoom($building, $room);

ApiConnection->getRoomMeetings($building, $room);

ApiConnection->getCourse($section, $term);

ApiConnection->getCurrentTerm();