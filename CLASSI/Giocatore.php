<?php

include 'PHP/db_config.php';
$connessione = mysql_connect($host, $user, $password);
mysql_select_db($db, $connessione);

class Giocatore{
    public $idGiocatore = "guest";
    public $listPartite = array();
    public $listCampionati = array();
    
    
    public function __construct($idUser) {
        if($idUser !== NULL){
            
        }else{
            $this->idGiocatore = $idUser;
            $this->listPartite[0] = $this->getPartite();
            $this->listCampionati[0] = $this->getCanpionati();
        }
        
    }
    
    private function getPartite(){
        return $this->idGiocatore;
    }
    
    private function getCanpionati(){
        return $this->idGiocatore;
    }
    
    public function getGiocatore(){
        return $this->idGiocatore;
    }
     
}




class Guest{
    
}
