<?php
try {
    $pdo = new PDO("mysql:host=db;dbname=contact_form;charset=utf8", "root", "verysecurepassword");
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

    $errors = [];

    // Validation email
    if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-z]{2,}$/i", $email)) {
        $errors[] = "Email invalide.";
    }

    // Validation téléphone
    if (!empty($telephone) && !preg_match("/^(\+?\d{1,3})?[0-9\s\-\.]{6,20}$/", $telephone)) {
        $errors[] = "Téléphone invalide.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO formulaire (genre, nom, prenom, email, telephone, objet, message) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$genre, $nom, $prenom, $email, $telephone, $objet, $message]);
        echo "Message envoyé.";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
