<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Santé La cadiére d'Azur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styles personnalisés */
        body {
            /* background-color: #f8f9fa; */
        }
        .table-container {
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        .table thead {
            background-color:#4CAF50;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    @if (session('success1'))
            <div class="alert alert-success" role="alert">
                <strong> {{session('success1')}}</strong>
            </div>
        @endif
    <div class="container table-container">
        <a name="" id="" class="btn btn-danger m-2" href="{{route('index')}}" role="button"style="float: right">Déconnexion</a>
        <h1 class="text-center">Liste des Médecins et leurs Rendez-vous</h1>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Médecin</th>
                    <th>Rendez-vous</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rvs as $rv)
                    <tr>
                        <td rowspan="{{ $rv->rv->count() + 1 }}" @if ($rv->role == "Assistant") style="display: none"

                            @endif>
                            <strong >{{ $rv->NomComplet }}</strong>

                        </td>
                    </tr>
                    @foreach($rv->rv as $r)
                        <tr>
                            <td>
                               <strong>Consultation</strong>  : {{ $r->motif }} <br>
                                <strong>Nom Patient</strong>  : {{ $r->NomPatient }} <br>
                              <strong>Date</strong>   : {{ $r->jour }} <br>
                               <strong>Heure</strong>   : {{  $r->heure }}
                            </td>
                            <td>
                                <button class="btn btn-primary " data-toggle="modal" data-target="#editModal-{{ $r->id }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger delete-btn" data-id="{{ $r->id }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                {{-- edit --}}

                        <div class="modal fade" id="editModal-{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $r->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="editForm" method="POST" action="{{route('rv.update',$r->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{ $r->id }}">Modifier le Rendez-vous</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="editdate">Date</label>
                                                <input type="date" class="form-control" id="jour" name="jour" value="{{$r->jour}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editHFin">Heure</label>
                                                <input type="time" class="form-control" id="heure" name="heure" value="{{$r->heure}}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                         <!-- Modal de Suppression -->
     <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteForm" method="POST" action="{{route('rv.destroy',$r->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Supprimer le Rendez-vous</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer ce Rendez-vous ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                    @endforeach


                @endforeach
            </tbody>
        </table>

    </div>






    <script>
        // Script pour préremplir et gérer le formulaire de modification
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let date = $(this).data('date');
            let heure = $(this).data('heure');
            $('#editdate').val(date);
            $('#editHeure').val(heure);
            $('#editForm').attr('action', '/rendez-vous/' + id);
        });

        // Script pour gérer le formulaire de suppression
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            $('#deleteForm').attr('action', '/rendez-vous/' + id);
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
