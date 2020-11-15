<?php

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";
$userAdded = false;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $registerError = false;

    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $passwordConfirm = test_input($_POST['passwordConfirm']);

    $verifFirstname = verifFirstname($firstname);
    $verifLastname = verifLastname($lastname);
    $verifEmail = verifEmail($email);
    $verifPassword = verifPassword($password, $passwordConfirm);

    $valid = true;
    
    if ($verifLastname != "valid") {
        $lastnameErr = $verifLastname;
        $valid = false;
    }
    if ($verifFirstname != "valid") {
        $firstnameErr = $verifFirstname;
        $valid = false;
    }
    if ($verifEmail != "valid") {
        $emailErr = $verifEmail;
        $valid = false;
    }else if (emailExist($email)) {
        $emailErr = "Cet E-mail est déjà utilisé!";
        $valid = false;
    }
    if ($verifPassword != "valid") {
        $passwordErr = $verifPassword;
        $valid = false;
    }
    if (!isset($_POST['pro'])) {
        $proErr = "Veuillez selectioner un status.";
        $valid = false;
    }
    if (!isset($_POST['cgu'])) {
        $cguErr = "Veuillez lire et accepter les conditions d'utilisation.";
        $valid = false;
    }

    if ($valid) {
        $userAdded = addUser($lastname, $firstname, $email, $_POST['pro'], $password);
        if ($userAdded) {
            echo "<script>alert(\"Création du compte réussi!\")</script>";
        } else {
            echo "<script>alert(\"Erreur!\\nIl  y a eu un problème lors de la création du compte.\\nVeuillez rééssayer.\\nSi le problème persiste, veuillez nous contacter.\")</script>";
        }
    }else{
        $registerError = true;
    }
}