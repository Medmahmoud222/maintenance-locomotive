<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Liste des Trains</title>
</head>
<body>
<center>

<?php
include ("header.php");
echo "<br><br>";
include ("connectdatabase.php");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué: " . $conn->connect_error);
}
$sql = "SELECT * FROM train";
$result = $conn->query($sql);
$rowIndex = 1; 
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Nom du Train</th><th>Numéro du Train</th><th>Date</th><th>Distance</th></tr></thead>";
    echo "<tbody>";
    // Afficher les données dans le tableau
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td onclick=AfficheIndex($rowIndex,0)>" . $row["nom"] . "  <span id='sp'> [Edit]</span> </td>"; 
        echo "<td onclick=AfficheIndex($rowIndex,1)>" . $row["numero"] . " <span> [Edit]</span> </td>";
        echo "<td onclick=AfficheIndex($rowIndex,2)>" . $row["date"] . "   <span>[Edit]</span> </td>";
        echo "<td onclick=AfficheIndex($rowIndex,3)>" . $row["distance"] ."  <span>[Edit]</span> </td>";
        echo "</tr>";
        $rowIndex++;
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucune donnée trouvée.";
}

$conn->close();
?>
</center>

</body>
</html>
<script>
    let titre=document.getElementById('titrehead');
    titre.innerHTML='Les Trains';


    function AfficheIndex(ligne,cellule) {
        window.location.href = 'update.php?ligne=' + ligne + '&cellule=' + cellule;
    }

</script>