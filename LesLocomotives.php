<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Style.css">
    <title>information Locomotive</title>
</head>
<body>


<?php include("header.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = $_POST["numero"];
    $type = $_POST["type"];
    $parcour_total = $_POST["parcour_total"];
    $parcour_apres_derniere_visite_vr = $_POST["parcour_apres_derniere_visite_vr"];
    $parcour_apres_derniere_visite_vc = $_POST["parcour_apres_derniere_visite_vc"];
    $date_derniere_vc = $_POST["date_derniere_vc"];
    $date_dernier_vr = $_POST["date_dernier_vr"];
    $date_dernier_changement_fs = $_POST["date_dernier_changement_fs"];
    $date_dernier_changement_fi = $_POST["date_dernier_changement_fi"];

    $message="Erreur lors de l'enregistrement des données";
    if(!empty($numero) && !empty($type) && !empty($parcour_total) && !empty($parcour_apres_derniere_visite_vr) && !empty($parcour_apres_derniere_visite_vc) && !empty($date_derniere_vc) && !empty( $date_dernier_vr) && !empty($date_dernier_changement_fs) && !empty($date_dernier_changement_fi)){
        include ("connectdatabase.php");
        $sql = "INSERT INTO locomotive (numero, type, parcour_total, parcour_apres_derniere_visite_vr, parcour_apres_derniere_visite_vc, date_derniere_vc, date_derniere_vr, date_dernier_changement_fs, date_dernier_changement_fi) 
                VALUES ('$numero', '$type', '$parcour_total', '$parcour_apres_derniere_visite_vr', '$parcour_apres_derniere_visite_vc', '$date_derniere_vc', '$date_dernier_vr', '$date_dernier_changement_fs', '$date_dernier_changement_fi')";
    
        if ($conn->query($sql) === TRUE) {
            $message="les Données enregistrées avec succès.";
        } else {
            $message="Erreur lors de l'enregistrement des données : " . $conn->error;
        }
    }

}
?><br><br>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Saisie des informations de locomotive</title>

</head>
<body>
    <center><span id="message"><?php echo @$message;?></span> </center>
    <form class="locomotiveform" action="" method="post">
        <label for="numero">Numéro de locomotive:</label>
        <input type="text" name="numero" id="numero" >

        <label for="type">Type de locomotive:</label>
        <input type="text" name="type" id="type" >

        <label for="parcour_total">Parcours total:</label>
        <input type="text" name="parcour_total" id="parcour_total" >

        <label for="parcour_apres_derniere_visite_vr">Parcours après dernière visite VR:</label>
        <input type="text" name="parcour_apres_derniere_visite_vr" id="parcour_apres_derniere_visite_vr"  >

        <label for="parcour_apres_derniere_visite_vc">Parcours après dernière visite VC:</label>
        <input type="text" name="parcour_apres_derniere_visite_vc" id="parcour_apres_derniere_visite_vc"  >

        <label for="date_derniere_vc">Date de dernière visite VC:</label>
        <input type="date" name="date_derniere_vc" id="date_derniere_vc" >

        <label for="date_dernier_vr">Date du dernier changement VR:</label>
        <input type="date" name="date_dernier_vr" id="date_dernier_vr" >

        <label for="date_dernier_changement_fs">Date du dernier changement FS:</label>
        <input type="date" name="date_dernier_changement_fs" id="date_dernier_changement_fs"  >

        <label for="date_dernier_changement_fi">Date du dernier changement FI:</label>
        <input type="date" name="date_dernier_changement_fi" id="date_dernier_changement_fi"  >

        <button type="submit" class="buttonlocomotive">Valider</button>
    </form>
</body>
</html>
<br>

<center>
<h2>Voici les Locomotives</h2>
<?php
    include ("connectdatabase.php");
    $sqllocomotive = "SELECT * FROM locomotive";
    $resultlocomotive = $conn->query($sqllocomotive);
    $rowIndex = 1; 
    if ($resultlocomotive->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr><th>Numero du Locomotive</th><th>Type Locomotive</th><th>Parcours Total</th></tr></thead>";
        echo "<tbody>";
        // Afficher les données dans le tableau
        while ($row = $resultlocomotive->fetch_assoc()) {
            echo "<tr>";
            echo "<td onclick=AfficheIndex($rowIndex,0)>" . $row["numero"] . "  <span id='sp'> [Visite]</span> </td>"; 
            echo "<td onclick=AfficheIndex($rowIndex,1)>" . $row["type"] . " <span> [Visite]</span> </td>";
            echo "<td onclick=AfficheIndex($rowIndex,2)>" . $row["parcour_total"] . "   <span>[Visite]</span> </td>";
            echo "</tr>";
            $rowIndex++;
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Aucune donnée trouvée.";
    }
?>
</center>
</body>
</html>


<script>
    let titre=document.getElementById('titrehead');
    titre.innerHTML='Informations de locomotive';

    document.forms[0].onsubmit=function (e){
        var numerolocomotive = document.getElementById("numero");
        var typelocomotive = document.getElementById("type");
        var Parcourstotal = document.getElementById("parcour_total");
        var Parcoursaprèsvr = document.getElementById("parcour_apres_derniere_visite_vr");
        var Parcoursaprèsvc= document.getElementById("parcour_apres_derniere_visite_vc");
        var Datevc = document.getElementById("date_derniere_vc");
        var Datevr = document.getElementById("date_dernier_vr");
        var changementfs = document.getElementById("date_dernier_changement_fs");
        var changementfi = document.getElementById("date_dernier_changement_fi");
        let message=document.getElementById("message");

        if (numerolocomotive.value === "" || typelocomotive.value === "" || Parcourstotal.value === "" || Parcoursaprèsvr.value === "" || Parcoursaprèsvc.value === "" || Datevc.value === "" || Datevr.value === "" || changementfs.value === "" || changementfi.value === "") {
                console.log(message.innerHTML+"hhh");
                message.innerHTML="Erreur: Vous n'avez pas rempli les champs";
                message.style.color = "red";
                // Mettre en surbrillance les champs vides en rouge
                if (numerolocomotive.value === "") {
                    numerolocomotive.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (typelocomotive.value === "") {
                    typelocomotive.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (Parcourstotal.value === "") {
                    Parcourstotal.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (Parcoursaprèsvr.value === "") {
                    Parcoursaprèsvr.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (Parcoursaprèsvc.value === "") {
                    Parcoursaprèsvc.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (Datevc.value === "") {
                    Datevc.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (Datevr.value === "") {
                    Datevr.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (changementfs.value === "") {
                    changementfs.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (changementfi.value === "") {
                    changementfi.style.border = "1px solid red";
                    // span.value=" ";
                }
                
                e.preventDefault(); // Empêcher la soumission du formulaire
                // span.value=" ";
            }
    }

    function AfficheIndex(ligne,cellule) {
        window.location.href = 'Visite.php?ligne=' + ligne + '&cellule=' + cellule;
    }

</script>