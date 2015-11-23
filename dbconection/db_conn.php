<?php

require_once('dbData_conn.php');


class Db_conn extends DbData_conn {

    protected $conexio;


    function __construct(){

        $this->conexio = mysqli_connect( $this->dbdata()[0],
                                         $this->dbdata()[1],
                                         $this->dbdata()[2],
                                         $this->dbdata()[3] ) or DIE ("Error database connection") ;

        //utf8 compatible database
        $this->conexio->set_charset('utf8');

    }

    function __destruct(){
        mysqli_close($this->conexio);
    }



}