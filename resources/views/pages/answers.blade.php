<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/answers.css">
    <title>Les réponses au message </title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark">
    <img src="https://i.imgur.com/CFpa3nK.jpg" width="20" height="20" class="d-inline-block align-top rounded-circle" alt="">
    <a class="navbar-brand ml-2" href="#" data-abc="true">{{ $message->name }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--<div class="end">
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" href="#" data-abc="true">Work</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#" data-abc="true">Capabilities</a> </li>
                <li class="nav-item "> <a class="nav-link" href="#" data-abc="true">Articles</a> </li>
                <li class="nav-item active"> <a class="nav-link mt-2" href="#" data-abc="true" id="clicked">Contact<span class="sr-only">(current)</span></a> </li>
            </ul>
        </div>
    </div>-->
</nav>
<!-- Main Body -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4" id="responseList" >
                <h1>Réponses</h1>
                @foreach($message->answers as $key => $answer)
                    @if($key % 2 == 0)
                        <div class="comment mt-4 text-justify float-left">
                            @else
                                <div class="darker mt-4 text-justify float-left">
                                    @endif
                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>{{ $answer->name }}</h4>
                    <span>- {{ \Carbon\Carbon::parse($answer->created_at)->formatLocalized('%d-%m-%Y à %H:%M') }}</span>
                    <br>
                    <p>{{ $answer->content }}</p>
                </div>
                @endforeach
            </div>

            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="algin-form">
                    <div class="form-group">
                        <h4>Ajouter une réponse</h4>
                        <label for="message">Message</label>
                        <textarea name="msg" id="response" cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom et prénoms</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="button" id="post" onclick="submitResponse({{ $message->id }})" class="btn">Envoyer</button>
                    </div>
                </form>
                <!-- Message de succès -->
                <div id="successMessage" style="display: none; font-family: Grand Hotel, 'serif'">
                    <p class="text-success">Réponse ajoutée avec succès !</p>
                    <a href="/" class="btn btn-primary">Créer votre lien</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
                $('#algin-form').hide();
                $('#successMessage').show();

                // Ajouter la nouvelle réponse à la liste existante
                var newResponse = `
                    <div class="comment mt-4 text-justify float-left">
                        <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                        <h4>${name}</h4>
                        <span>- </span>
                        <br>
                        <p>${response}</p>
                    </div>
                `;
                $('#responseList').append(newResponse);
            },
            error: function (error) {
                console.error('Erreur lors de l\'envoi de la réponse : ', error);
            }
        });
    }
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
