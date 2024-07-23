<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Santé La cadiére d'Azur</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: url('/images/home.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .content {
            text-align: center;
            /* color: white; */
            background: rgba(255, 255, 255, 0.8);
            /* background: rgba(0, 0, 0, 0.5); */
             /* Ajouter un fond semi-transparent */
            padding: 50px;
            border-radius: 10px;
        }
        a{
            background: rgba(5, 5, 5, 5.5);
            padding: 15px;
            color: white;
            margin: 10px;
            border-radius: 8px;

        }
    </style>
</head>
<body>
    <div class="content">
        {{-- <h1>Bienvenue</h1>
        <p>Ceci est une page avec une image de fond.</p> --}}
        <h1>Bienvenue Espace Santé La cadiére d'Azur</h1>
        <p>Cliquer sur le lien ci-dessous pour prendre un rendez-vous :</p><br>
        <a href="{{route('index')}}" >Prenez un rendez-vous</a>
    </div>
</body>
</html>
