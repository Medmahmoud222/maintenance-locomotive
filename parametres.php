<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Style/Style.css">
    <title>Les Parametres</title>
</head>
<body>
<?php 
    include ("header.php");
    include("connectdatabase.php");



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $noveauVR = $_POST["vr"];
    $noveauVC = $_POST["vc"];
    $nouveauFS = $_POST["fs"];
    $noveauFI = $_POST["fi"];

    $message="Erreur lors de l'enregistrement des données";
    if(!empty($noveauVR)){
        mysqli_query($conn,"UPDATE prametres SET VR='$noveauVR'");
        $message="l'opération a été terminer avec  succès.";
    }
    if(!empty($noveauVC) ){
        mysqli_query($conn,"UPDATE prametres SET VC='$noveauVC'");
        $message="l'opération a été terminer avec  succès.";
    }
    if(!empty($nouveauFS)){
        mysqli_query($conn,"UPDATE prametres SET FS='$nouveauFS'");
        $message="l'opération a été terminer avec  succès.";
    } 
    if(!empty($noveauFI)){
        mysqli_query($conn,"UPDATE prametres SET FI='$noveauFI'");
        $message="l'opération a été terminer avec  succès.";
    }
}

$result=mysqli_query($conn,"SELECT * FROM prametres");
$data=mysqli_fetch_array($result);
$vr=$data['VR'];
$vc= $data['VC'];
$fs= $data['FS'];
$fi=$data['FI'];

?>

<br><br><br>
<center>
<table>
        <thead>
            <tr>
                <th>Les Parametres</th>
                <th>Les Vlaeurs</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>VR</td>
                <td><?php echo $vr; ?></td>
            </tr>
            <tr>
                <td>VC</td>
                <td><?php echo $vc; ?></td>
            </tr>
            <tr>
                <td>FS</td>
                <td><?php echo $fs; ?></td>
            </tr>
            <tr>
                <td>FI</td>
                <td><?php echo $fi; ?></td>
            </tr>
        </tbody>
    </table><br><br><br>
    <center><span id="message"><?php echo @$message;?></span> </center>
    <div class="form-container">
        <form action="#" method="post">
            <label for="vr" id="pr_vr">Pour modifier La valeur de VR:</label>
            <input type="text" id="vr" name="vr" placeholder="Entrez la valeur de vr" >

            <label for="vc" id="pr_vc">Pour modifer la valeur de  VC:</label>
            <input type="text" id="vc" name="vc" placeholder="Entrez la valeur de vc" >
            <label for="vc" id="pr_vc">Pour modifier la durée de  FS:</label>
            <input type="text" id="fs" name="fs" placeholder="Entrez la valeur de vc" >
            <label for="vc" id="pr_vc">Pour modifier la durée de  FI:</label>
            <input type="text" id="fi" name="fi" placeholder="Entrez la valeur de vc" >
            <button id='btnpr' type="submit">Valider</button>
        </form>
    </div>
</center>
</body>
</html>
<script>

    let titre=document.getElementById('titrehead');
    titre.innerHTML='Paramétres des locomotives';

    document.forms[0].onsubmit=function (e){
        var VR = document.getElementById("vr");
        var VC = document.getElementById("vc");
        var FS = document.getElementById("fs");
        var FI = document.getElementById("fi");
        let message=document.getElementById("message");

        if (VR.value === "" && VC.value === "" && FS.value === "" && FI.value === "" ) {
                // console.log(message.innerHTML+"hhh");
                message.innerHTML="Erreur: Vous n'avez pas rempli les champs";
                message.style.color = "red";
                // Mettre en surbrillance les champs vides en rouge
                if (VR.value === "") {
                    VR.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (VC.value === "") {
                    VC.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (FS.value === "") {
                    FS.style.border = "1px solid red";
                    // span.value=" ";
                }
                if (FI.value === "") {
                    FI.style.border = "1px solid red";
                    // span.value=" ";
                }
                e.preventDefault(); // Empêcher la soumission du formulaire
                // span.value=" ";
            }
    }

</script>