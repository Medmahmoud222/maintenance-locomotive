<?php
include ("header.php");
echo "<br><br>";

$ligne=$_GET['ligne'];
$cellule=$_GET['cellule'];
$value="";
include ("connectdatabase.php");
$sql="SELECT * FROM train WHERE id='$ligne'";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_array($result);
if($cellule==0){
    $value=$data['nom'];
}
if($cellule==1){
    $value=$data['numero'];
}
if($cellule==2){
    $value=$data['date'];
}
if($cellule==3){
    $value=$data['distance'];
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $value = $_POST['valeur']; 
    
    if (isset($_POST['modifer'])) {
        if($cellule==0){
            mysqli_query($conn, "UPDATE train SET nom = '$value' WHERE id = $ligne");
        }
        if($cellule==1){
            mysqli_query($conn, "UPDATE train SET numero = '$value' WHERE id = $ligne");
        }
        if($cellule==2){
            mysqli_query($conn, "UPDATE train SET date = '$value' WHERE id = $ligne");
        }
        if($cellule==3){
            mysqli_query($conn, "UPDATE train SET distance = '$value' WHERE id = $ligne");
        }
        $message='Valeur à modifer : ' . $value;
    } elseif (isset($_POST['suprimer'])) {
        if($cellule==0){
            mysqli_query($conn, "UPDATE train SET nom = 'Vide' WHERE id = $ligne");
        }
        if($cellule==1){
            mysqli_query($conn, "UPDATE train SET numero = '0' WHERE id = $ligne");
        }
        if($cellule==2){
            mysqli_query($conn, "UPDATE train SET date = '0' WHERE id = $ligne");
        }
        if($cellule==3){
            mysqli_query($conn, "UPDATE train SET distance = '0' WHERE id = $ligne");
        }
        $message= 'Valeur à suprimer : ' . $value;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Modification</title>
</head>
<body>


<center><?php echo @$message; ?></center> 
    <div class="form-container" id="formContainer"> 
        <form  id="editForm" class="edit-form" method="POST">
                <center> <span>Modifier ou <span id="suprimer">suprimer</span> la valeur</span></center><br>
            <input name="valeur" type="text" id="cellValueInput" class="cell-input" value="<?php echo $value;?>" >
            <button type="Submit" name="modifer" id="modifierBtn" class="btn-modifier">Modifier</button>
            <button type="submit" name="suprimer" id="supprimerBtn" class="btn-supprimer">Supprimer</button>
        </form>
    </div>
</body>
</html>



