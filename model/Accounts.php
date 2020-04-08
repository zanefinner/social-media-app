<?php namespace Model; use PDO;
class Accounts{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAllUsers()
    {
        $link = $this->db->openDbConnection();

        $result = $link->query('SELECT alias, name FROM accounts ORDER BY id');

        $music = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $music[] = $row;
        }
        $this->db->closeDbConnection($link);


		return $music;
    }

    public function getUserById($id)
    {
        $link = $this->db->openDbConnection();

        $query = 'SELECT * FROM accounts WHERE  id=:id';
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->db->closeDbConnection($link);
        return $row;
    }
    public function getIdByEmail($email)
    {
        $link = $this->db->openDbConnection();

        $query = 'SELECT * FROM accounts WHERE  email=:email';
        $statement = $link->prepare($query);
        $statement->bindValue(':email', $email, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->db->closeDbConnection($link);
        return $row;
    }
    public function authenticate($input){
      $link = $this->db->openDbConnection();

      $query = "SELECT * FROM accounts WHERE email=:email AND password=:password";

      $statement = $link->prepare($query);

      $statement->bindValue(':email', $input['email']);
      $statement->bindValue(':password',  $input['password']);

      $statement->execute();
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $this->db->closeDbConnection($link);
      return $row;
    }
    public function insert($input)
    {
        $link = $this->db->openDbConnection($input);

        $query = 'INSERT INTO accounts (name, alias, email, password) VALUES (:name, :alias, :email, :password)';
        $statement = $link->prepare($query);
        $statement->bindValue(':name', $input['name'], PDO::PARAM_STR);
        $statement->bindValue(':alias', $input['alias'], PDO::PARAM_STR);
        $statement->bindValue(':email', $input['email'], PDO::PARAM_STR);
        $statement->bindValue(':password', $input['password'], PDO::PARAM_STR);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }

    public function update($id)
    {
        $link = $this->db->openDbConnection();

        $query = "UPDATE music SET nama = :nama, judul = :judul, album = :album, tahun = :tahun WHERE id = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':nama', $_POST['nama'], PDO::PARAM_STR);
        $statement->bindValue(':judul', $_POST['judul'], PDO::PARAM_STR);
        $statement->bindValue(':album', $_POST['album'], PDO::PARAM_STR);
        $statement->bindValue(':tahun', $_POST['tahun'], PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }

    public function deleteById($id)
    {
        $link = $this->db->openDbConnection();

        $query = "DELETE FROM accounts WHERE id = :id";
        $statement = $link->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $this->db->closeDbConnection($link);
    }
}
