<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=projet_php", $username, $password);
}catch(PDOException $e){
    echo"Erreur : ".$e->getMessage();
}

$id = $_GET['id']; 
$prenom = $_GET['prenom']; 
$nom = $_GET['nom']; 
$mail = $_GET['mail']; 
$age = $_GET['age']; 
$profil_id = $_GET['profilD'];

$recupUser = $bdd->prepare("SELECT * from intervention where client_id = ?");
$recupUser->execute(array($id));    
$row = $recupUser->fetch(PDO::FETCH_ASSOC);

$durgence = $bdd->prepare("SELECT * from intervention,urgence where intervention.urgences = urgence.valeur  and client_id = ?");
$durgence->execute(array($id));
$rows = $durgence->fetch(PDO::FETCH_ASSOC);

$id = $_GET['id']; 
$tickets = $bdd->prepare ("SELECT titre,date,description,urgences,etat FROM intervention,urgence where client_id = ? and urgences = valeur");
$tickets->execute(array($id));


if (isset($_POST['deconnexion'])) {
    // Détruire les données de session et rediriger l'utilisateur vers la page de connexion
    session_destroy();
    header('Location: ../commun/connexion.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Ticket Tracker</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inconsolata:wght@500&family=Kurale&display=swap" rel="stylesheet">
  <style>
    .cercle-vert {
        width: 15px;
        height: 15px;
        background-color: #FF0000 ; /* Couleur de fond (facultatif) */
        border-radius: 50%; /* 50% de la largeur ou de la hauteur */
    }

    .cercle-jaune {
        width: 15px;
        height: 15px;
        background-color: #adff2f ; /* Couleur de fond (facultatif) */
        border-radius: 50%; /* 50% de la largeur ou de la hauteur */
    }

    .cercle-orange {
        width: 15px;
        height: 15px;
        background-color: #ff8000 ; /* Couleur de fond (facultatif) */
        border-radius: 50%; /* 50% de la largeur ou de la hauteur */
    }


    .cercle-rouge {
        width: 15px;
        height: 15px;
        background-color: #FF0000 ; /* Couleur de fond (facultatif) */
        border-radius: 50%; /* 50% de la largeur ou de la hauteur */
    }


    .cercle-violet {
        width: 15px;
        height: 15px;
        background-color: #9400D3 ; /* Couleur de fond (facultatif) */
        border-radius: 50%; /* 50% de la largeur ou de la hauteur */
    }
 </style>
</head>
<body id="texte" class=" bg-[#E8BCB9] text-[#E8BCB9] ">
    <header class=" body-font bg-[#451952] ">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex  items-center  mb-4 md:mb-0">
            <span class="ml-3 text-5xl">Ticket Tracker</span>
            </a>
            <nav class="md:ml-auto md:mr-auto flex space-x-40 flex-wrap items-center text-base justify-center">
            <a href="Aide.php?prenom=<?php echo ($prenom); ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo $profil_id;?>" class="text-2xl mr-5 hover:scale-125">Créer un ticket</a>
            <a href="contacter.php?prenom=<?php echo ($prenom); ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo $profil_id;?>" class="text-2xl mr-5 hover:scale-125">Contacter Conseiller</a>
            </nav>
            <form method="post" class="px-4 pr-16 text-2xl">
                <input type="submit" name="deconnexion" value="Déconnexion">
            </form>
            <div class="flex text-xl">
                <p class=" mx-2"> <?php 
                        if(isset($_GET['prenom'])){
                                session_start();
                                $prenom = $_GET['prenom']; 
                                echo $prenom ;
                            }
                    ?></p>
                <p> <?php 
                        if(isset($_GET['nom'])){
                                $nom = $_GET['nom']; 
                                    echo $nom ;
                            }
                    ?></p>
            </div>
            
        </div>
    </header>

    <div>
        <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Tableau de bord</h1>
            <div class="grid grid-cols-4 gap-4">
                <div class="text-[#E8BCB9] bg-[#451952] p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-2">En Attente</h2>
                    <p>
                        <?php
                        $id = $_GET['id']; 
                        $tickets = $bdd->prepare ("SELECT titre,date,description,urgences,etat FROM intervention,urgence where client_id = ? and urgences = valeur");
                        $tickets->execute(array($id));
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                if($row['etat']==1){
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-2  mx-6'> </div>";
                                    }
                                    echo "<p>Date: " . $row["date"] . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "</div>";
                                }
                            }
                        } else {
                            echo "Aucun résultat trouvé";
                        }
                        ?>
                    </p>
                </div>
                <div class="text-[#E8BCB9] bg-[#451952] p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-2">En Cours</h2>
                    <?php
                    $id = $_GET['id']; 
                    $tickets = $bdd->prepare ("SELECT titre,date,description,urgences,etat FROM intervention,urgence where client_id = ? and urgences = valeur");
                    $tickets->execute(array($id));
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                if($row['etat']==2){
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-2  mx-6'> </div>";
                                    }
                                    echo "<p>Date: " . $row["date"] . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "</div>";
                                }
                            }
                        } else {
                            echo "Aucun résultat trouvé";
                        }
                        ?>
                </div>
                <div class="text-[#E8BCB9] bg-[#451952] p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-2">Terminé</h2>
                    <?php
                    $id = $_GET['id']; 
                    $tickets = $bdd->prepare ("SELECT titre,date,description,urgences,etat FROM intervention,urgence where client_id = ? and urgences = valeur");
                    $tickets->execute(array($id));
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                if($row['etat']==3){
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-2  mx-6'> </div>";
                                    }
                                    echo "<p>Date: " . $row["date"] . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "</div>";
                                }
                            }
                        } else {
                            echo "Aucun résultat trouvé";
                        }
                        ?>
                </div>
                <div class="text-[#E8BCB9] bg-[#451952] p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-2">Historique</h2>
                    <?php
                    $id = $_GET['id']; 
                    $tickets = $bdd->prepare ("SELECT titre,date,description,urgences,etat FROM intervention,urgence where client_id = ? and urgences = valeur");
                    $tickets->execute(array($id));
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                if($row['etat']==4){
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-2  mx-6'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-2  mx-6'> </div>";
                                    }
                                    echo "<p>Date: " . $row["date"] . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "";
                                    echo "</div>";
                                }
                            }
                        } else {
                            echo "Aucun résultat trouvé";
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>