<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Formulaire de contact</title>
</head>
<body>

    <main class="form-container">
        <h1 class="form-title">Contactez l’agence</h1>

        <form class="form-layout" method="POST" action="process_form.php">

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
                        <select name="jour">
                            <option value="">Jour</option>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>

                        <select name="heure">
                            <option value="">Heure</option>
                            <?php for ($h = 7; $h <= 20; $h++): ?>
                                <option value="<?= $h ?>"><?= $h ?>h</option>
                            <?php endfor; ?>
                        </select>

                        <select name="minute">
                            <option value="">Minute</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>

                        <button type="button" class="button button-secondary">AJOUTER <br>DISPO</button>
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

                <button type="submit" class="button button-primary">ENVOYER</button>
            </div>

        </form>
    </main>

    <!-- Script JS pour gérer les dispo + effet apparition formulaire -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const formContainer = document.querySelector('.form-container');
                formContainer.classList.add('visible');

            const btn = document.querySelector('.button-secondary');
            const list = document.querySelector('.availability-list');
            const form = document.querySelector('form');

            btn.addEventListener('click', () => {
                const jour = form.querySelector('[name="jour"]').value;
                const heure = form.querySelector('[name="heure"]').value;
                const minute = form.querySelector('[name="minute"]').value;

                if (!jour || !heure || !minute) return;

                const text = `${jour} à ${heure.padStart(2, '0')}h${minute.padStart(2, '0')}`;

                const li = document.createElement('li');
                li.textContent = text;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = '×';
                removeBtn.style.marginLeft = '10px';
                removeBtn.onclick = () => li.remove();

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'dispos[]';
                input.value = text;

                li.appendChild(removeBtn);
                li.appendChild(input);
                list.appendChild(li);
            });
        });
    </script>

    <!-- affichage popup via get -->
    <div class="popup" id="popup-message"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            const message = params.get('feedback');
            const type = params.get('type');

            if (message && type) {
                const popup = document.getElementById('popup-message');
                popup.textContent = message;
                popup.classList.add('show', type);
                setTimeout(() => {
                    popup.classList.remove('show', type);
                    history.replaceState({}, document.title, window.location.pathname);
                }, 4000);
            }
        });
        </script>

</body>
</html>