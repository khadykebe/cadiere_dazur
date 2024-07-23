<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Rendez-vous</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
}

h1, h2 {
    color: #333;
}

.appointment-details p {
    margin: 10px 0;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 8px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Détail du Rendez-vous</h1>
        <div class="appointment-details">
            <p><strong>Consultation :</strong> {{$consult}} </p>
            <p><strong>Medecin :</strong> {{$medecin}}</p>
            <p><strong>Date :</strong> {{$text1}}</p>
            <p><strong>Heure :</strong> {{$text2}}</p>
        </div>

        <h2>Confirmer le Rendez-vous</h2>
        <form action="{{route('rv.radio')}}" method="post">
            @csrf
            <label for="name">Nom complet :</label>
            <input type="text" id="NomPatient" name="NomPatient" required>

            <label for="email">NSS :</label>
            <input type="text" id="NSS" name="NSS" required>

            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" name="tel" required>

            <button type="submit" id="appointmentForm" >Confirmer</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Votre rendez-vous a été confirmé avec succès.</p>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('appointmentForm');
    const modal = document.getElementById('confirmationModal');
    const closeModal = document.getElementsByClassName('close')[0];

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        modal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
});

</script>
</body>
</html>
