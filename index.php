<?php

require_once 'Classes/ContactManager.php';
require_once 'Classes/Command.php';

$manager = new ContactManager();
$command = new Command();

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";

    if ($line === "list") {
        $command->list();
    }

    if (str_starts_with($line, "detail")) {
        if (preg_match('/^detail\s+(\d+)$/', trim($line), $matches)) {
            $id = $matches[1];
            $command->detail($id);
        } else {
            echo "Erreur : veuillez saisir la commande sous la forme 'detail [id]'.\n";
        }
    }

    if ($line === "create") {
        $name = readline("Entrez le nom : ");
        $email = readline("Entrez l'email : ");
        $phone_number = readline("Entrez le numéro de téléphone : ");
        try {
            $command->create($name, $email, $phone_number);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if ($line === "modify") {
        $id = readline("Entrez l'id (Non modifiable) : ");
        $name = readline("Entrez le nom à modifier (vide sinon) : ");
        $email = readline("Entrez l'email à modifier (vide sinon) : ");
        $phone_number = readline("Entrez le numéro de téléphone à modifier (vide sinon) : ");
        try {
            $command->modify($id, $name, $email, $phone_number);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if (str_starts_with($line, "delete")) {
        if (preg_match('/^delete\s+(\d+)$/', trim($line), $matches)) {
            $id = $matches[1];
            try {
                $command->delete($id);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Erreur : veuillez saisir la commande sous la forme 'delete [id]'.\n";
        }
    }

    if($line === "help") {
        $command->help();
    }


    if ($line === "exit" || $line === "quit") {
        break;
    }
}
