<?php

require_once 'Classes/DBConnect.php';
require_once 'Classes/Contact.php';

class ContactManager
{

    public function findAll()
    {
        try {
            $db = new DBConnect();
            $pdo = $db->getPDO();
            $req = $pdo->query('SELECT * FROM contact');
            $rows = $req->fetchAll(PDO::FETCH_OBJ);

            $contacts = [];
            foreach ($rows as $row) {
                $contacts[] = new Contact($row->id, $row->name, $row->email, $row->phone_number);
            }
            return $contacts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findById($id)
    {
        try {
            $db = new DBConnect();
            $pdo = $db->getPDO();
            $req = $pdo->prepare('SELECT * FROM contact WHERE id = :id');
            $req->execute(['id' => $id]);
            $row = $req->fetch(PDO::FETCH_OBJ);
            if($row) {
                return new Contact($row->id, $row->name, $row->email, $row->phone_number);
            } else {
                throw new Exception("Erreur : Le contact $id n'existe pas" . "\n");

            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function add($name, $email, $phone_number)
    {
        try {
            $db = new DBConnect();
            $pdo = $db->getPDO();
            $req = $pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)');
            if(empty($name) || empty($email) || empty($phone_number)) {
                throw new Exception("Tous les champs doivent être remplis" . "\n");
            }
            $req->execute(['name' => $name, 'email' => $email, 'phone_number' => $phone_number]);
            echo "Le contact $name a bien été ajouté.\n";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {

            $name = $this->findById($id)->getName();

            $db = new DBConnect();
            $pdo = $db->getPDO();
            $req = $pdo->prepare('DELETE FROM contact WHERE id = :id');
            $req->execute(['id' => $id]);
            if($req->rowCount() == 0) {
                throw new Exception("Erreur : Le contact $id n'existe pas" . "\n");
            } else {
                echo "Le contact $id - $name a bien été supprimé.\n";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function modify($id, $name, $email, $phone_number)
    {
        try {

            $old = $this->findById($id);

            if(empty($name)) {
                $name = $old->getName();
            }
            if(empty($email)) {
                $email = $old->getEmail();
            }
            if(empty($phone_number)) {
                $phone_number = $old->getPhoneNumber();
            }

            $db = new DBConnect();
            $pdo = $db->getPDO();
            $req = $pdo->prepare('UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id');
            $req->execute(['id' => $id, 'name' => $name, 'email' => $email, 'phone_number' => $phone_number]);
            echo "Le contact $id a bien été modifié.\n";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
