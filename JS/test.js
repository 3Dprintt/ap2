const outputDiv = document.querySelector('#div_salle');

function call(){
    // Définir les données à envoyer avec la requête POST
    const postData = new FormData();
    postData.append('date', document.querySelector('#date').value); // remplacer 'nom' et 'valeur' par les données souhaitées
    postData.append('heure_debut', document.querySelector('#heure_debut').value);
    postData.append('heure_fin', document.querySelector('#heure_fin').value);

    // Définir les options de la requête
    const options = {
    method: 'POST',
    body: postData
    };

    // Utiliser la méthode fetch() pour envoyer la requête POST
    fetch('/AP2/PHP/verifidispo.php', options)
    .then(response => response.text())
    .then(data => {
        console.log("change");
        // Afficher les données dans la div sélectionnée
        outputDiv.innerHTML = data;
    })
    .catch(error => console.log(error));
}

document.querySelector("#date").addEventListener('change', (event) => call());
document.querySelector("#heure_debut").addEventListener('change', (event) => call());
document.querySelector("#heure_fin").addEventListener('change', (event) => call());