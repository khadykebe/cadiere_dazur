<!DOCTYPE html>
<html>
<head>
    <title>Planning Espace Santé La cadiére d'Azur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

          .table-container {
    margin: 20px auto;
    max-width: 80%;
    overflow-x: auto;
}

/* Table */
.table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
}

/* Table Header */
.table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

/* Table Body Rows */
.table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

/* Table Cells */
.table th, .table td {
    padding: 12px 15px;
}
    </style>
</head>
<body>
    <div class="container mt-5">

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                <strong> {{session('message')}}</strong>
            </div>
        @endif
        @if (session('success1'))
            <div class="alert alert-success" role="alert">
                <strong> {{session('success1')}}</strong>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong> {{session('success')}}</strong>
            </div>
        @endif
        <a name="" id="" class="btn btn-danger m-2" href="{{route('index')}}" role="button"style="float: right"style="float: right">Déconnexion</a>
        <button class="btn btn-success m-2 " data-toggle="modal" data-target="#addModal" style="float: right">Ajouter un Planning</button>
        <h1> Liste des Plannings</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure Début</th>
                    <th>Heure Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pls as $planning)
                    <tr>
                        <td>{{ $planning->JourDispo }}</td>
                        <td>{{ $planning->PDebut }}</td>
                        <td>{{ $planning->PFin }}</td>
                        <td>
                            <button class="btn btn-primary edit-btn"  data-id="{{ $planning->id }}" data-date="{{ $planning->JourDispo }}" data-Hdebut="{{ $planning->PDebut }}" data-HFin="{{ $planning->PFin }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger delete-btn" data-id="{{ $planning->id }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal d'Ajout -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('add.planning') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Ajouter un Planning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addDate">Date</label>
                            <input type="date" class="form-control" id="addDate" name="JourDispo" required>
                        </div>
                        <div class="form-group">
                            <label for="addHdebut">Heure Début</label>
                            <input type="time" class="form-control" id="addHdebut" name="PDebut" required>
                        </div>
                        <div class="form-group">
                            <label for="addHFin">Heure Fin</label>
                            <input type="time" class="form-control" id="addHFin" name="PFin" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Modification -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modifier le Planning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editDate">Date</label>
                            <input type="date" class="form-control" id="editDate" name="JourDispo" required>
                        </div>
                        <div class="form-group">
                            <label for="editHdebut">Heure Début</label>
                            <input type="time" class="form-control" id="editHdebut" name="PDebut" required>
                        </div>
                        <div class="form-group">
                            <label for="editHFin">Heure Fin</label>
                            <input type="time" class="form-control" id="editHFin" name="PFin" required>
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
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Supprimer le Planning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer ce planning ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

        // Script pour préremplir et gérer le formulaire de modification
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let date = $(this).data('date');
            let Hdebut = $(this).data('Hdebut');
            let HFin = $(this).data('HFin');
            $('#editDate').val(date);
            $('#editHdebut').val(Hdebut);
            $('#editHFin').val(HFin);
            $('#editForm').attr('action', '/plannings/' + id);
        });

        // Script pour gérer le formulaire de suppression
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            $('#deleteForm').attr('action', '/plannings/' + id);
        });
    </script>
</body>
</html>
