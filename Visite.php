<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Visite Locomotive</title>
</head>
<body>
<?php
    include("header.php");

    @$ligne=$_GET['ligne'];
    include ("connectdatabase.php");
    $result=mysqli_query($conn,"SELECT numero,type,date_dernier_changement_fs,date_dernier_changement_fi FROM locomotive WHERE id='$ligne'");
    $data=mysqli_fetch_array($result);
    @$numerolocomotive=$data['numero'];
    @$typelocomotive=$data['type'];

    $result_parametres = mysqli_query($conn, "SELECT * FROM prametres");
    $data_parametres = mysqli_fetch_array($result_parametres);
    $resultvr = $data_parametres['VR'];
    $resultvc = $data_parametres['VC'];
    $resultfs=$data_parametres['FS'];
    $resultfi=$data_parametres['FI'];

    function filterNombre($nombre) {
        return preg_replace("/[^0-9]/", "", $nombre);
    }
    $VisiteVR = filterNombre($resultvr);
    $VisiteVC = filterNombre($resultvc);
    $visiteFS=filterNombre($resultfs);
    $visiteFI=filterNombre($resultfi);

    @$datedernierchangementfs=$dat['date_dernier_changement_fs'];
    @$datedernierchangementfi=$date['date_dernier_changement_fi'];
    $date_aujourd_hui = date("Y-m-d");
    // @$datedernierchangementfi="2023-08-24";

    // Convertir les dates en objets DateTime
    $date1_obj = new DateTime(@$datedernierchangementfi);
    $date2_obj = new DateTime($date_aujourd_hui);

    // Calculer la différence entre les deux dates
    $interval = $date1_obj->diff($date2_obj);

    // Extraire le nombre d'années de l'intervalle
    $difference_in_years = $interval->y;
    $difference_in_months = $difference_in_years * 12 + $interval->m;

?>
<br><br>
<form action="" method="post">

    <label for="numero">Numéro de locomotive:</label>
    <input type="text" name="numero" id="numero" value="<?php echo @$numerolocomotive;?>">

    <label for="type">Type de locomotive:</label>
    <input type="text" name="type" id="type"  value="<?php echo @$typelocomotive;?>">

    <label for="type">Date Visite:</label>
    <input type="date" name="date" id="type"  value="<?php echo @$typelocomotive;?>">

    <label for="select_vr_vc">Sélectionnez VR ou VC :</label>

    <select name="selecttypevisite" id="Selectvisite">
        <option value="Pour ajuster le moteur">Pour ajuster le moteur</option>
        <?php
            if($numerolocomotive>="$VisiteVR" && $numerolocomotive<$VisiteVC){
                echo "<option value='VR'>VR</option>";
            }
            if($numerolocomotive>="$VisiteVC"){
                echo "<option value='VC'>VC</option>";
            }
            if($difference_in_years>=$visiteFI){
                echo "<option value='fi'>Changement FI</option>";
            }
            if($difference_in_months>=$visiteFS){
                echo "<option value='fs'>Changement FS</option>";
            }
        ?>
    </select><br><br>
    <button type="submit">Valider</button>
    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $numerolocomotive= $_POST["numero"];
            $typelocomotive= $_POST["type"];
            $selectedlocomotive=$_POST['selecttypevisite'];
            $dateVisite=$_POST['date'];
            
            if (!empty($numerolocomotive) && !empty($typelocomotive)&& !empty($selectedlocomotive) && !empty($dateVisite)) {
                include('connectdatabase.php');
                // Préparer et exécuter la requête d'insertion
                if($selectedlocomotive=='VR'){
                    $sql1 = "UPDATE locomotive SET parcour_apres_derniere_visite_vr=0,parcour_total=0 WHERE numero='$numerolocomotive'";
                    if (mysqli_query($conn, $sql1)) {
                        $message= "Ajouter un nouvelle train.";
                        mysqli_query($conn,$sql2);
                    } 
                }
                if($selectedlocomotive=='VC'){
                    $sql1 = "UPDATE locomotive SET parcour_apres_derniere_visite_vc=0,parcour_total=0 WHERE numero='$numerolocomotive'";
                    if (mysqli_query($conn, $sql1)) {
                        $message= "Ajouter un nouvelle train.";
                        mysqli_query($conn,$sql2);
                    } 
                }
                if($selectedlocomotive=='fi'){
                    $sql1 = "UPDATE locomotive SET date_dernier_changement_fs='$date_aujourd_hui' WHERE numero='$numerolocomotive'";
                    if (mysqli_query($conn, $sql1)) {
                        $message= "Ajouter un nouvelle train.";
                        mysqli_query($conn,$sql2);
                    } 
                }
                if($selectedlocomotive=='fs'){
                    $sql1 = "UPDATE locomotive SET date_dernier_changement_fi='$date_aujourd_hui' WHERE numero='$numerolocomotive'";
                    if (mysqli_query($conn, $sql1)) {
                        $message= "Ajouter un nouvelle train.";
                        mysqli_query($conn,$sql2);
                    } 
                }
            }

        }

    ?>




</body>
</html>
<script>

let titre=document.getElementById('titrehead');
titre.innerHTML='Visite';
</script>