<?php


Class DbData_conn {

    private $host;
    private $user;
    private $pass;
    private $dbname;

    function dbdata(){

        $this->host = 'you_hostname';
        $this->user = 'your_username';
        $this->pass = 'your_password';
        $this->dbname = 'your_dbname';

        $array_dbdata = [$this->host, $this->user, $this->pass, $this->dbname];

        return $array_dbdata;
    }

}
