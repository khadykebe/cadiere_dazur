<!doctype html>
<html lang="en">
  <head>
    <title>Espace Santé La cadiére d'Azur</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    .container{
        margin-top: 50px;
    }
    /* button{
       background-color: #009879;
       color: white;
       border: none;
       padding: 8px;
       border-radius: 5px;
       float: right;
       margin: 5px;"
    } */


</style>
  <body>

    {{-- <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger" >Déconnexion</button>
    </form> --}}
    <div class="container">
            <a name="" id="" class="btn btn-danger m-2" href="{{route('index')}}" role="button"style="float: right">Déconnexion</a>
            <a name="" id="" class="btn btn-success m-2" href="{{route('planning.allPl')}}" role="button" style="float: right">Liste des plannings</a>
            <h1 class="mb-4">Liste des Rendez-vous</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom Médecin</th>
                        <th>Consultation</th>
                        <th>Jour</th>
                        <th>Heure</th>
                        <th>Nom Patient</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rvs as $rv)
                        <tr>
                            <td>{{ $rv->NomComplet }}</td>
                            <td>{{ $rv->motif }}</td>
                            <td>{{ $rv->jour }}</td>
                            <td>{{ $rv->heure }}</td>
                            <td>{{ $rv->NomPatient }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
