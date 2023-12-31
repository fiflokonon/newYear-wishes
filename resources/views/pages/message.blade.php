<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel An 2024 - Voeux spéciaux</title>
    <script src="https://cdn.jsdelivr.net/npm/fireworks-js/dist/fireworks.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background:
                linear-gradient(#0007, #0000),
                #123;
            color: white;
        }
        #fireworks {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        #greeting-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 2;
        }

        #message {
            font-family: 'cursive-font', cursive;
            font-size: 24px;
            margin-bottom: 20px;
        }

        #buttons-container {
            display: flex;
            justify-content: center;
            z-index: 2;
        }

        .btn-waoh {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-family: 'cursive-font', cursive;
            font-size: 18px;
        }

        .message-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(60deg, red, green);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>
<!-- Fireworks animation -->
<div id="fireworks"></div>

<!-- Greeting container -->
<div id="greeting-container" class="container-fluid">
    <div id="message">
        En cette occasion spéciale du nouvel an, <span class="text-light fw-bolder" style="font-weight: bolder!important; background-color: red">{{ $message->name }}</span> a un message pour vous!
        <div class="message-container">
            {{ $message->message }}
        </div>
    </div>

    <!-- Boutons -->
    <div id="buttons-container">
        <button class="btn btn-waoh" onclick="reply()" data-toggle="modal" data-target="#myModal">Répondre</button>
        <button class="btn-waoh bg-secondary" onclick="redirectToResponses()">Voir les réponses</button>
        <a href="/" class="btn btn-waoh bg-info" onclick="createLink()">Créer votre lien</a>
    </div>
</div>

<div class="modal fade text-dark" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: Grand Hotel, 'serif'">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Répondre au message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire -->
                <form id="responseForm">
                    <div class="form-group">
                        <label for="name">Nom et prénoms</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="response">Réponse</label>
                        <textarea class="form-control" id="response" rows="4" required></textarea>
                    </div>
                    <button type="button" class="btn btn-success" onclick="submitResponse({{ $message->id }})">Envoyer</button>
                </form>
                <!-- Message de succès -->
                <div id="successMessage" style="display: none;">
                    <p class="text-success">Réponse envoyée avec succès !</p>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    <a href="/" class="btn btn-primary">Créer votre lien</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour la visibilité restreinte -->
<div class="modal fade text-dark" id="visibilityModal" tabindex="-1" aria-labelledby="visibilityModalLabel" aria-hidden="true" style="font-family: Grand Hotel, 'serif'">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visibilityModalLabel">Note : Seul le créateur du lien peut voir les réponses.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="visibilityCode" class="form-label">Code de visibilité :</label>
                        <input type="text" class="form-control" id="visibilityCode">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="checkVisibilityCode()">Vérifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialisez les feux d'artifice ici
        var container = document.getElementById('fireworks');
        var fireworks = new Fireworks(container, {});
        fireworks.start();
    });
</script>
<script>
    function submitResponse(messageId) {
        var name = $('#name').val();
        var response = $('#response').val();

        // Envoyer la requête AJAX au backend
        $.ajax({
            type: 'POST',
            url: '/add-answer',
            data: {message_id: messageId, name: name, content: response, _token: '{{ csrf_token() }}' },
            success: function (data) {
                // Masquer le formulaire, afficher le message de succès
                $('#responseForm').hide();
                $('#successMessage').show();
            },
            error: function (error) {
                console.error('Erreur lors de l\'envoi de la réponse : ', error);
            }
        });
    }
    // Script pour afficher le modal
    function showModal() {
        $('#visibilityModal').modal('show');
    }

    // Script pour cacher le modal
    function hideModal() {
        $('#visibilityModal').modal('hide');
    }

    // Script pour gérer la redirection
    function redirectToResponses() {
        var visibility = '{{ $message->visibility }}';
        if (visibility === 'only user') {
            showModal();
        } else {
            // Redirection directe vers la route des réponses
            window.location.href = '/messages/{{ $message->id }}/answers';
        }
    }

    // Script pour vérifier le code de visibilité et rediriger si nécessaire
    function checkVisibilityCode() {
        var enteredCode = $('#visibilityCode').val();
        var correctCode = '{{ $message->access_code }}';

        if (enteredCode === correctCode) {
            // Redirection vers la route des réponses
            window.location.href = '/messages/{{ $message->id }}/answers';
        } else {
            // Afficher un message d'erreur, ou vous pouvez ajuster cette logique selon vos besoins
            alert('Code incorrect. Veuillez réessayer.');
        }

        // Cacher le modal
        hideModal();
    }

</script>
<script>
    // Ajoutez vos animations de feux d'artifice ici (par exemple, bibliothèque Fireworks.js)
    // Assurez-vous d'ajuster le style et la mise en page selon vos préférences.

    function reply() {
        // Logique pour répondre
        // Par exemple, ouvrir un formulaire de réponse dans un modal
        showToast("Vous avez choisi de répondre!");
    }

    function viewResponses() {
        // Logique pour voir les réponses
        showToast("Vous avez choisi de voir les réponses!");
    }

    function showToast(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "center",
            backgroundColor: "#28a745",
            stopOnFocus: true
        }).showToast();
    }
</script>
</body>
</html>
