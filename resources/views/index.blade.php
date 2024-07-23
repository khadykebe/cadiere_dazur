<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Santé La cadiére d'Azur</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('style/style.css')}}">
  <style>
    body {
      padding-top: 56px; /* Height of the navbar */
    }
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0px;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      padding-top: 60px;
    }
    .modal-content {
      background-color: #fefefe;
       margin: 5% auto; /*15% from the top and centered */
      /* padding: 20px; */
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    .alert{
        background-color: wheat;
        padding: 15px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <button class="btn btn-primary" id="loginBtn">Se connecter</button>
        </li>
        <li class="nav-item">
          <button class="btn btn-secondary" id="signupBtn">S'inscrire</button>
        </li>
      </ul>
    </div>
  </nav>



<div class="container mt-5">
    @if (session('alert'))
            <div class="alert alert-danger" role="alert">
                <strong>{{session('alert')}}</strong>
            </div>
    @endif
    @if (session('alert1'))
            <div class="alert alert-danger" role="alert">
                <strong>{{session('alert1')}}</strong>
            </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    <strong> {{session('message')}}</strong>
                </div>
            @endif
            @if (session('message1'))
                 <div class="alert alert-danger" role="alert">
                    <strong>{{session('message1')}}</strong>
                </div>
            @endif

            <h4>Prenez votre rendez-vous en ligne</h4>
            <h6>Cliquer sur un catégorie pour choisir consultation</h6>
            <div class="card text-left">
              <div class="card-body">
                <ul class="vertical-list">
                    @if ($categories ?? false)
                        @foreach ($categories as $categorie )
                           <a href="{{route('rv.creat',$categorie->nom)}}"><li name="">{{$categorie->nom}}</li></a>
                        @endforeach
                    @endif
                </ul>
                @if ($message ?? false)
                <div class="alert">
                    {{$message}}
                </div>
                @endif
              </div>
            </div>
        </div>

    </div>
</div>


  <!-- Login Modal -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeLogin">&times;</span>
      <h2>Se connecter</h2>
      <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="loginEmail">Email</label>
          <input type="email" name="email" class="form-control" id="loginEmail" required>
        </div>
        <div class="form-group">
          <label for="loginPassword">Mot de passe</label>
          <input type="password" name="password" class="form-control" id="loginPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
      </form>
    </div>
  </div>

  <!-- Signup Modal -->
  <div id="signupModal" class="modal">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="modal-content">
      <span class="close" id="closeSignup">&times;</span>
      <h2>S'inscrire</h2>
      <form action="{{route('add.user')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="signupEmail">Nom Complet</label>
                    <input type="text"  name="NomComplet" class="form-control" id="signupEmail" required>
                  </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="signupPassword">Numéro SS</label>
                    <input type="text" name="NSS"  class="form-control" id="signupPassword" required>
                  </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="signupPassword">Email</label>
                    <input type="email" name="email" id="email" class="form-control" id="signupPassword" required>
                    {{-- <span id="email-error" style="color: red; display: none;">Cet email est déjà pris.</span> --}}

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="signupPassword">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="signupPassword" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="signupPassword">Tel</label>
                    <input type="text" name="tel" class="form-control" id="signupPassword" required>
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Role</label>
                      <select class="form-control" name="role" id="">
                        <option></option>
                        <option>Medecin</option>
                        <option>Assistant</option>
                      </select>
                    </div>
            </div>
            <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Spécialité</label>
                      <select class="form-control" name="specialité" id="">
                        <option value=""></option>
                        @if ($categories ?? false)
                                @foreach ($categories as $categorie )
                                    <option value="{{$categorie->nom}}" label="{{$categorie->nom}}"></option>
                                @endforeach
                                @endif
                      </select>
                    </div>
            </div>
        </div>
        <button type="submit" class="btn btn-secondary">Inscription</button>
      </form>
    </div>
  </div>

  <script>

    
    // Get the modals
    var loginModal = document.getElementById("loginModal");
    var signupModal = document.getElementById("signupModal");

    // Get the buttons that open the modals
    var loginBtn = document.getElementById("loginBtn");
    var signupBtn = document.getElementById("signupBtn");

    // Get the <span> elements that close the modals
    var closeLogin = document.getElementById("closeLogin");
    var closeSignup = document.getElementById("closeSignup");

    // When the user clicks the button, open the modal
    loginBtn.onclick = function() {
      loginModal.style.display = "block";
    }

    signupBtn.onclick = function() {
      signupModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    closeLogin.onclick = function() {
      loginModal.style.display = "none";
    }

    closeSignup.onclick = function() {
      signupModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == loginModal) {
        loginModal.style.display = "none";
      }
      if (event.target == signupModal) {
        signupModal.style.display = "none";
      }
    }


  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
