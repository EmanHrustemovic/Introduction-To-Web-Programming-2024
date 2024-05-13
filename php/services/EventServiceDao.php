<?php

require_once __DIR__ ."/../dao/EventDaoClass.php";

class EventService{
    private $event_dao;
    public function __construct(){
        $this->event_dao = new EventDao();
    }
    public function add_event($event){
        return $this->event_dao ->add_event($event);
    
    }
}