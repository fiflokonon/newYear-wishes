<!DOCTYPE html>
<html lang="fr">
<?php
$currentProtocol = request()->secure() ? 'https://' : 'http://';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lien du message</title>
    <style>
        body {
            font-family: Grand Hotel, 'serif';
            margin: 0;
            padding: 0;
            background-color: transparent;
            color: whitesmoke;
            background-image: url("/assets/images/background.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .link-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .link-box {
            flex: 1;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        #copyLinkButton {
            background-color: #28a745;
            color: #fff;
            padding: 10px 12px;
            border: none;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }

        #copyLinkButton:hover {
            background-color: #218838;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

<main>
    <h1 style="color: red">Votre message a été enregistré avec succès ! </h1>
    <p> Cliquez sur le bouton </p>
    <div class="link-container">
        <div class="link-box" id="linkBox">{{ $currentProtocol }}{{ request()->getHttpHost()  }}/messages/{{ $message->link }}</div>
        <button id="copyLinkButton" onclick="copyToClipboard()">Copier</button>
    </div>

    <p>Un peu de texte au milieu de la page.</p>

    <form>
        <h2>Abonnez-vous à notre newsletter</h2>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">S'abonner</button>
    </form>
</main>

<footer>
    <p>Ceci est le footer de ma page.</p>
</footer>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById("linkBox");
        navigator.clipboard.writeText(copyText.innerText).then(function () {
            alert("Lien copié avec succès !");
        }).catch(function (err) {
            console.error('Erreur lors de la copie du lien : ', err);
        });
    }
</script>

</body>

</html>
