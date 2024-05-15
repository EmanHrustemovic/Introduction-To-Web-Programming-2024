<?php

require_once __DIR__ ."/BaseDaoClass.php";

class EventDao extends BaseDao{
    public function __construct(){
        parent:: construct('event');   
    }
    public function add_event($event){
        return $event;
    }
}