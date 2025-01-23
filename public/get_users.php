<?php
require_once '../src/ldap.php';

if (isset($_GET['ou_dn'])) {
    $ou_dn = $_GET['ou_dn'];
    $users = get_users_in_ou($ou_dn);

    header('Content-Type: application/json');
    echo json_encode($users);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Paramètre OU non spécifié.']);
