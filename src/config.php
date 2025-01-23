<?php
// src/config.php

$host = 'localhost';
$dbname = 'phpldapgui';
$username = 'phpldapgui';
$password = 'passroot';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}



$ldap_host = 'ldap://localhost'; // Adresse de votre serveur LDAP
$ldap_port = 389;               // Port LDAP (389 ou 636 pour SSL)
$ldap_dn = 'dc=example,dc=com'; // Base DN de votre annuaire LDAP
$ldap_user = 'cn=admin,dc=example,dc=com'; // Utilisateur admin LDAP
$ldap_password = 'adminpassword';          // Mot de passe admin LDAP

try {
    $ldap_connection = ldap_connect($ldap_host, $ldap_port);
    ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);

    if (!@ldap_bind($ldap_connection, $ldap_user, $ldap_password)) {
        throw new Exception("Impossible de se connecter au serveur LDAP.");
    }
} catch (Exception $e) {
    die("Erreur LDAP : " . $e->getMessage());
}
