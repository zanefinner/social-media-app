<?php
class Database{
    protected $host = 'localhost';
    protected $dbname = 'sms';
    protected $user = 'zane';
    protected $password = '$PCSxd5224';

    public function openDbConnection()
    {
        $link = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
        return $link;
    }

    public function closeDbConnection(&$link)
    {
        $link = null;
    }
}
