<!DOCTYPE html>
<html lang="fr" class="notranslate" translate="no">
<head>
    <title>Souhaitez les meilleurs voeux à vos amis et proches</title>
    <!-- meta tag start-->
    <meta charset="utf-8">
    <meta name="google" content="notranslate"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Souhaitez les meiilleurs à vos amis à l'occasion du nouvel an"/>
    <meta name="keywords" content="Nouvel an voeux, souhaits, proches, amis">
    <meta name="author" content="Arnaud Fifonsi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="MobileOptimized" content="320">
    <link rel="stylesheet" href="/assets/css/first.css">
    <!-- Inclusion locale des fichiers Bootstrap -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
<div class="bg"></div>
<main class="new-year-body">
    <h1 class="new-year">Heureuse Année</h1>
    <p class="year">2024</p>
    <p style="font-family: Grand Hotel, 'cursive'">Souhaitez les meilleurs voeux à vos amis et proches en cette occasion spéciale du nouvel an!</p>
    <button type="button" class="btn-f" data-bs-toggle="modal" data-bs-target="#exampleModal">Rédiger votre message</button>
</main>
<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog bg-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez votre message </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="messageForm">
                @csrf
                <div class="modal-body">
                    <div id="errorContainer"></div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nom et prénoms</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Entrez votre nom et prénoms">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Entre vos meilleurs voeux pour vos amis"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="visibilitySelect" class="form-label">Visibilité de réponses</label>
                        <select name="visibility" class="form-select" id="visibilitySelect" aria-label="Default select example" onchange="handleVisibilityChange()">
                            <option selected disabled>Choisir une option</option>
                            <option value="all">Tous ceux qui accèdent au lien</option>
                            <option value="only user">Vous uniquement</option>
                        </select>
                    </div>
                    <div class="mb-3" id="visibilityCodeField" style="display: none;">
                        <label for="visibilityCode" class="form-label">Code de visibilité</label>
                        <input type="text" name="access_code" class="form-control" id="visibilityCode" placeholder="Entrez le code de visibilité">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>
    function handleVisibilityChange() {
        var visibilitySelect = document.getElementById("visibilitySelect");
        var visibilityCodeField = document.getElementById("visibilityCodeField");
        if (visibilitySelect.value === "only user") {
            visibilityCodeField.style.display = "block";
        } else {
            visibilityCodeField.style.display = "none";
        }
    }
</script>
<script>
    function submitForm() {
        var formData = new FormData(document.getElementById('messageForm'));
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log('Submission');
        $.ajax({
            type: 'POST',
            url: '/new-message',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
               if (response.errors){
                   displayErrors(response.errors);
               }else {
                   window.location.href = '/messages/' + response.data.id + '/link';
               }
                $('#exampleModal').modal('hide');
            },
            error: function(errors) {
                console.log(errors.responseText);
                //displayErrors(errors);
            }
        });
    }

    function displayErrors(errors) {
        var errorHtml = '<ul>';
        $.each(errors, function(key, value) {
            errorHtml += '<li>' + value[0] + '</li>';
        });
        errorHtml += '</ul>';

        $('#errorContainer').html(errorHtml);
        $('#errorModal').modal('show');
    }
</script>
<script src="/assets/js/first.js"></script>
<script src="/assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>
