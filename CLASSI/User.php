<?php

//USER
class User {

    public $id_u;
    public $username;
    public $email;
    public $id_profilo;
    public $avatar;

    public function __construct($id_u) {

        $this->id_u = $id_u;



        $query = "SELECT * FROM users WHERE id_user='$this->id_u' ";

        $row = mysql_query($query);

        $res = mysql_fetch_array($row);



        $this->email = $res['email'];

        $this->username = $res['username'];

        $this->id_profilo = $res['profilo'];

        $this->avatar = $res['avatar'];
    }

    static function getUser() {

        return $this;
    }

}