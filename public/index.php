<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['user']['username']) . "!";
?>
<a href="logout.php">Déconnexion</a>
