<?php
try {
    $pdo = new PDO("mysql:host=db;dbname=contact_form;charset=utf8", "root", "verysecurepassword");
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["email"])) {
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $genre = $_POST["genre"] ?? '';
    $nom = clean($_POST["nom"] ?? '');
    $prenom = clean($_POST["prenom"] ?? '');
    $email = clean($_POST["email"] ?? '');
    $telephone = clean($_POST["telephone"] ?? '');
    $objet = $_POST["objet"] ?? '';
    $message = clean($_POST["message"] ?? '');
    $disponibilites = $_POST["dispos"] ?? [];
    $disponibilite = implode(', ', array_map('clean', $disponibilites));

    $errors = [];
    // Validations via regexx
    if (!empty($email) && !preg_match("/^[\w\.-]+@[\w\.-]+\.[a-z]{2,}$/i", $email)) {
        $errors[] = "Email invalide.";
    }

    if (!empty($telephone) && !preg_match("/^(\+?\d{1,3})?[0-9\s\-\.]{6,20}$/", $telephone)) {
        $errors[] = "Téléphone invalide.";
    }

    $feedback = '';
    $type = '';

    // affiche erreurs si présentes
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO formulaire 
            (genre, nom, prenom, email, telephone, objet, message, disponibilite) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $genre, $nom, $prenom, $email, $telephone, $objet, $message, $disponibilite
        ]);
        $feedback = "Votre message a bien été envoyé.";
        $type = "success";
    } else {
        $feedback = implode(' ', $errors);
        $type = "error";
    }

    // Redirection vers index.php avec les infos en GET
    header("Location: index.php?feedback=" . urlencode($feedback) . "&type=" . $type);
    exit;
}
