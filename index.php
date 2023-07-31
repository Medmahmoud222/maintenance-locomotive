<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un train</title>
    <link rel="stylesheet" href="Style/Style.css">
</head>
<body>

<?php include("header.php"); 
$message="Ajouter un nouvelle train";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nomTrain = $_POST["nom_train"];
    $numeroTrain = $_POST["numero_train"];
    $date = $_POST["date"];
    $distance = $_POST["distance"];
   
    if (!empty($nomTrain) && !empty($numeroTrain) && !empty($date) && !empty($distance)) {
        include('connectdatabase.php');
        $resulttest=mysqli_query($conn,"SELECT numero FROM locomotive WHERE numero=$numeroTrain");
        if(mysqli_num_rows($resulttest)>0){
            // Préparer et exécuter la requête d'insertion
            $sql = "INSERT INTO train (nom, numero, date, distance) VALUES ('$nomTrain', '$numeroTrain', '$date', '$distance')";
            $sql2="UPDATE locomotive set parcour_total=parcour_total+$distance WHERE numero=$numeroTrain";
            if (mysqli_query($conn, $sql)) {
                $message= "Ajouter un nouvelle train.";
                mysqli_query($conn,$sql2);
            }
        }else{
            $message= "Le numero de locomotive n'est pas enregitré dans La base de données ";
        }

 
    }
}
?>

<br><br><br>

    <center><span id="message"><?php echo $message;?></span> </center>

    <form action="" method="post" >
            <label for="nom_train">Nom du Train :</label>
            <input type="text" id="nom_train" name="nom_train" >

            <label for="numero_train">Numéro du Locomotive :</label>
            <input type="number" id="numero_train" name="numero_train" >

            <label for="date">Date :</label>
            <input type="date" id="date" name="date" >

            <label for="distance">Distance :</label>
            <input type="number" id="distance" name="distance" value="1350">

            <button type="submit">Valider</button>
    </form>


    </body>
</html>
<script>
    document.forms[0].onsubmit=function (e){
            // Récupérer tous les champs du formulaire
            var nomTrainInput = document.getElementById("nom_train");
            var numeroTrainInput = document.getElementById("numero_train");
            var dateInput = document.getElementById("date");
            var distanceInput = document.getElementById("distance");
            let message=document.getElementById("message");

            // Réinitialiser les bordures de tous les champs
            nomTrainInput.style.border = "1px solid #ccc";
            numeroTrainInput.style.border = "1px solid #ccc";
            dateInput.style.border = "1px solid #ccc";
            distanceInput.style.border = "1px solid #ccc";

            if (nomTrainInput.value === "" || numeroTrainInput.value === "" || dateInput.value === "" || distanceInput.value === "") {
                console.log(message.innerHTML+"hhh");
                message.innerHTML="Erreur: Vous n'avez pas rempli les champs";
                message.style.color = "red";
                // Mettre en surbrillance les champs vides en rouge
                if (nomTrainInput.value === "") {
                    nomTrainInput.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (numeroTrainInput.value === "") {
                    numeroTrainInput.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (dateInput.value === "") {
                    dateInput.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (distanceInput.value === "") {
                    distanceInput.style.border = "1px solid red";
                    // span.value=" ";
                }
                
                e.preventDefault(); // Empêcher la soumission du formulaire
                // span.value=" ";
            }

        }

    </script>