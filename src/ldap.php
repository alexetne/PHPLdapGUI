<?php
require_once 'config.php';

// Fonction pour obtenir l'arborescence des OUs
function get_ou_tree($base_dn) {
    global $ldap_connection;

    $search = ldap_search($ldap_connection, $base_dn, '(objectClass=organizationalUnit)', ['ou']);
    $entries = ldap_get_entries($ldap_connection, $search);

    $ous = [];
    foreach ($entries as $entry) {
        if (isset($entry['ou'][0])) {
            $ous[] = [
                'ou' => $entry['ou'][0],
                'dn' => $entry['dn'],
            ];
        }
    }
    return $ous;
}

// Fonction pour obtenir les utilisateurs d'une OU
function get_users_in_ou($ou_dn) {
    global $ldap_connection;

    $search = ldap_search($ldap_connection, $ou_dn, '(objectClass=inetOrgPerson)', ['cn', 'mail']);
    $entries = ldap_get_entries($ldap_connection, $search);

    $users = [];
    foreach ($entries as $entry) {
        if (isset($entry['cn'][0])) {
            $users[] = [
                'cn' => $entry['cn'][0],
                'mail' => $entry['mail'][0] ?? 'N/A',
            ];
        }
    }
    return $users;
}
