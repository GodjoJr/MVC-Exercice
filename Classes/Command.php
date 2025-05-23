<?php

require_once 'Classes/ContactManager.php';

class Command
{
    private array $commands = [];

    public function __construct()
    {
        $this->commands = [
            'list' => 'Afficher la liste de tous les contacts',
            'detail [id]' => 'Afficher les détails d’un contact spécifique',
            'create' => 'Créer un nouveau contact',
            'modify' => 'Modifier un contact',
            'delete [id]' => 'Supprimer un contact',
            'help' => 'Afficher la liste des commandes disponibles',
            'exit / quit' => 'Quitter l’application'
        ];
    }
    public function list()
    {
        try {
            $manager = new ContactManager();
            $contacts = $manager->findAll();
            foreach ($contacts as $contact) {
                echo (string) $contact . "\n";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function detail($id)
    {
        try {
            $manager = new ContactManager();
            $contact = $manager->findById($id);
            if ($contact) {
                echo $contact . "\n";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create($name, $email, $phone_number)
    {
        try {
            $manager = new ContactManager();
            $manager->add($name, $email, $phone_number);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function modify($id, $name, $email, $phone_number)
    {
        try {
            $manager = new ContactManager();
            $manager->modify($id, $name, $email, $phone_number);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $manager = new ContactManager();
            $manager->delete($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function help()
    {
        echo "Commandes disponibles :\n";
        foreach ($this->commands as $cmd => $desc) {
            echo "  - $cmd : $desc\n";
        }
    }

}