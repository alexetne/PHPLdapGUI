<?php
// Démarrage de la session
session_start();

// Vérification de la connexion utilisateur
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Inclusion des fichiers nécessaires
require_once '../src/ldap.php';

// Récupération de l'arborescence des OUs
$ous = get_ou_tree($ldap_dn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion LDAP</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
            <a href="logout.php" class="logout-button">Déconnexion</a>
        </div>
    </header>

    <div class="container">
        <!-- Barre latérale -->
        <aside class="sidebar">
            <h3>Arborescence</h3>
            <ul id="ou-list">
                <?php foreach ($ous as $ou): ?>
                    <li>
                        <a href="#" class="ou-link" data-dn="<?= htmlspecialchars($ou['dn']) ?>">
                            <?= htmlspecialchars($ou['ou']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- Contenu principal -->
        <main class="content">
            <h3>Utilisateurs</h3>
            <div id="user-list">
                <p>Sélectionnez une OU pour afficher les utilisateurs.</p>
            </div>
        </main>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>
