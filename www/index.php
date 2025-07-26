<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire de contact</title>
</head>
<body>

    <main class="form-container">
        <h1 class="form-title">Contactez l’agence</h1>

        <form class="form-layout" method="POST">

            <div class="column-left">
                <section class="form-section">
                    <h2>Vos coordonnées</h2>

                    <div class="field-group choices">
                        <label><input type="radio" name="genre" value="mme" required> Mme</label>
                        <label><input type="radio" name="genre" value="m" required> M</label>
                    </div>

                    <div class="field-group input-row">
                        <input type="text" name="nom" placeholder="Nom" required>
                        <input type="text" name="prenom" placeholder="Prénom" required>
                    </div>

                    <input type="email" name="email" placeholder="Adresse mail" required>
                    <input type="text" name="telephone" placeholder="Téléphone">
                </section>

                <section class="form-section">
                    <h2>Disponibilités pour une visite</h2>

                    <div class="field-group availability-row">
                        <button type="button" class="button button-secondary">Ajouter dispo</button>
                    </div>

                    <ul class="availability-list"></ul>
                </section>
            </div>

            <div class="column-right">
                <section class="form-section">
                    <h2>Votre message</h2>

                    <div class="field-group choices">
                        <label><input type="radio" name="objet" value="visite" required> Demande de visite</label>
                        <label><input type="radio" name="objet" value="rappel"> Être rappelé.e</label>
                        <label><input type="radio" name="objet" value="photos"> Plus de photos</label>
                    </div>

                    <textarea name="message" placeholder="Votre message" required></textarea>
                </section>

                <button type="submit" class="button button-primary">Envoyer</button>
            </div>

        </form>
    </main>
</body>
</html>