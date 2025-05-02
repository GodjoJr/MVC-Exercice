<?php

class Contact
{
    public $id;
    public $name;
    public $email;
    public $phone_number;

    public function __construct($id, $name, $email, $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return "ID : $this->id\nNom : $this->name\nEmail : $this->email\nNuméro de téléphone : $this->phone_number\n";
    }
}