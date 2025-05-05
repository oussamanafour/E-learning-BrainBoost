<?php 

class dbConn {

    function connection(){
        return new PDO("mysql:host=localhost;dbname=brainboost_academy", 'root', '');
    }

}