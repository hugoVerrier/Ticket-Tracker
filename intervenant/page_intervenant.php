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
            <span class="ml-3 text-5xl mr-96">Ticket Tracker</span>
            </a>
            <div class="flex text-xl mr-96">
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
            <form method="post" class="px-4 pr-16 text-2xl">
                <input type="submit" name="deconnexion" value="Déconnexion">
            </form>
            
        </div>
    </header>

    <div>
        <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Tableau de bord</h1>
            <div class="grid grid-cols-4 gap-4">
                <div class="text-[#E8BCB9] bg-[#451952] p-4 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-2">En Attente</h2>
                    <?php
                        $tickets = $bdd->prepare ("SELECT *,intervention.nom as T FROM intervention,urgence,users where urgences = valeur AND client_id = users.id AND intervenant_id = $id");
                        $ticket = $bdd->prepare ("SELECT * from intervention where client_id = ? and nom = ? and date = ?");
                        $standardiste = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4) ");
                        $intervenant = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4)");
                        $tickets->execute(array());
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                $standardiste_id = $row["standardiste_id"];
                                $intervenant_id = $row["intervenant_id"];
                                $standardiste->execute(array("id"=>$standardiste_id,"pid"=>3));
                                $rows = $standardiste->fetch(PDO::FETCH_ASSOC);
                                $intervenant->execute(array("id"=>$intervenant_id,"pid"=>2));
                                $rowi = $intervenant->fetch(PDO::FETCH_ASSOC);
                                $ticket->execute(array($row['id'],$row['T'],$row['date']));
                                $rowt = $ticket->fetch(PDO::FETCH_ASSOC);
                                if($rows==0){$standardistes = "Personne";}else{$standardistes = $rows['nom'];};
                                if($rowi==0){$intervenants = "Personne";}else{$intervenants = $rowi['nom'];};
                                $ticket_id = $rowt['id'];
                                $date = $row['date'];
                                if($row['etat']==1){
                                    
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4 grid grid-cols-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-6  mx-8'> </div>";
                                    }
                                    echo "<div class='col-span-3'>";
                                    echo "<a href='../commun/update.php?&prenom=<?php echo $prenom; ?>&nom=<?php echo $nom; ?>&age=<?php echo $age; ?>&mail=<?php echo $mail; ?>&id=<?php echo $id;  ?>&idT=$ticket_id&date=$date&profilD=$profil_id'>Titre: " . $row["T"] . "</a>";
                                    echo "<p>Date: " . $date . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "<p>Client: " . $row["nom"] . "</p>";
                                    echo "<p>Standardiste: " . $standardistes .  "</p>";
                                    echo "<p>intervenant: " . $intervenants . "</p>";
                                    echo "</div>";
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
                        $tickets = $bdd->prepare ("SELECT *,intervention.nom as T FROM intervention,urgence,users where urgences = valeur AND client_id = users.id AND intervenant_id = $id");
                        $ticket = $bdd->prepare ("SELECT * from intervention where client_id = ? and nom = ? and date = ?");
                        $standardiste = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4) ");
                        $intervenant = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4)");
                        $tickets->execute(array());
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                $standardiste_id = $row["standardiste_id"];
                                $intervenant_id = $row["intervenant_id"];
                                $standardiste->execute(array("id"=>$standardiste_id,"pid"=>3));
                                $rows = $standardiste->fetch(PDO::FETCH_ASSOC);
                                $intervenant->execute(array("id"=>$intervenant_id,"pid"=>2));
                                $rowi = $intervenant->fetch(PDO::FETCH_ASSOC);
                                $ticket->execute(array($row['id'],$row['T'],$row['date']));
                                $rowt = $ticket->fetch(PDO::FETCH_ASSOC);
                                if($rows==0){$standardistes = "Personne";}else{$standardistes = $rows['nom'];};
                                if($rowi==0){$intervenants = "Personne";}else{$intervenants = $rowi['nom'];};
                                $ticket_id = $rowt['id'];
                                $date = $row['date'];
                                if($row['etat']==2){
                                    
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4 grid grid-cols-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-6  mx-8'> </div>";
                                    }
                                    echo "<div class='col-span-3'>";
                                    echo "<a href='../commun/update.php?&prenom=<?php echo $prenom; ?>&nom=<?php echo $nom; ?>&age=<?php echo $age; ?>&mail=<?php echo $mail; ?>&id=<?php echo $id;  ?>&idT=$ticket_id&date=$date&profilD=$profil_id'>Titre: " . $row["T"] . "</a>";
                                    echo "<p>Date: " . $date . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "<p>Client: " . $row["nom"] . "</p>";
                                    echo "<p>Standardiste: " . $standardistes .  "</p>";
                                    echo "<p>intervenant: " . $intervenants . "</p>";
                                    echo "</div>";
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
                        $tickets = $bdd->prepare ("SELECT *,intervention.nom as T FROM intervention,urgence,users where urgences = valeur AND client_id = users.id AND intervenant_id = $id");
                        $ticket = $bdd->prepare ("SELECT * from intervention where client_id = ? and nom = ? and date = ?");
                        $standardiste = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4) ");
                        $intervenant = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4)");
                        $tickets->execute(array());
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                $standardiste_id = $row["standardiste_id"];
                                $intervenant_id = $row["intervenant_id"];
                                $standardiste->execute(array("id"=>$standardiste_id,"pid"=>3));
                                $rows = $standardiste->fetch(PDO::FETCH_ASSOC);
                                $intervenant->execute(array("id"=>$intervenant_id,"pid"=>2));
                                $rowi = $intervenant->fetch(PDO::FETCH_ASSOC);
                                $ticket->execute(array($row['id'],$row['T'],$row['date']));
                                $rowt = $ticket->fetch(PDO::FETCH_ASSOC);
                                if($rows==0){$standardistes = "Personne";}else{$standardistes = $rows['nom'];};
                                if($rowi==0){$intervenants = "Personne";}else{$intervenants = $rowi['nom'];};
                                $ticket_id = $rowt['id'];
                                $date = $row['date'];
                                if($row['etat']==3){
                                    
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4 grid grid-cols-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-6  mx-8'> </div>";
                                    }
                                    echo "<div class='col-span-3'>";
                                    echo "<a href='../commun/update.php?&prenom=<?php echo $prenom; ?>&nom=<?php echo $nom; ?>&age=<?php echo $age; ?>&mail=<?php echo $mail; ?>&id=<?php echo $id;  ?>&idT=$ticket_id&date=$date&profilD=$profil_id'>Titre: " . $row["T"] . "</a>";
                                    echo "<p>Date: " . $date . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "<p>Client: " . $row["nom"] . "</p>";
                                    echo "<p>Standardiste: " . $standardistes .  "</p>";
                                    echo "<p>intervenant: " . $intervenants . "</p>";
                                    echo "</div>";
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
                        $tickets = $bdd->prepare ("SELECT *,intervention.nom as T FROM intervention,urgence,users where urgences = valeur AND client_id = users.id AND intervenant_id = $id");
                        $ticket = $bdd->prepare ("SELECT * from intervention where client_id = ? and nom = ? and date = ?");
                        $standardiste = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4) ");
                        $intervenant = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4)");
                        $tickets->execute(array());
                        if ($tickets->rowCount() > 0) {
                            while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                $standardiste_id = $row["standardiste_id"];
                                $intervenant_id = $row["intervenant_id"];
                                $standardiste->execute(array("id"=>$standardiste_id,"pid"=>3));
                                $rows = $standardiste->fetch(PDO::FETCH_ASSOC);
                                $intervenant->execute(array("id"=>$intervenant_id,"pid"=>2));
                                $rowi = $intervenant->fetch(PDO::FETCH_ASSOC);
                                $ticket->execute(array($row['id'],$row['T'],$row['date']));
                                $rowt = $ticket->fetch(PDO::FETCH_ASSOC);
                                if($rows==0){$standardistes = "Personne";}else{$standardistes = $rows['nom'];};
                                if($rowi==0){$intervenants = "Personne";}else{$intervenants = $rowi['nom'];};
                                $ticket_id = $rowt['id'];
                                $date = $row['date'];
                                if($row['etat']==4){
                                    
                                    echo "<div class=' border-2 border-[#E8BCB9] rounded rounded-full my-4 grid grid-cols-4'>";
                                    if($row["titre"]=='faible'){
                                        echo "<div class='cercle-jaune mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très faible'){
                                        echo "<div class='cercle-vert mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='moyen'){
                                        echo "<div class='cercle-orange mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='eleve'){
                                        echo "<div class='cercle-rouge mt-6  mx-8'> </div>";
                                    }
                                    else if($row["titre"]=='très eleve'){
                                        echo "<div class='cercle-violet mt-6  mx-8'> </div>";
                                    }
                                    echo "<div class='col-span-3'>";
                                    echo "<a href='../commun/update.php?&prenom=<?php echo $prenom; ?>&nom=<?php echo $nom; ?>&age=<?php echo $age; ?>&mail=<?php echo $mail; ?>&id=<?php echo $id;  ?>&idT=$ticket_id&date=$date&profilD=$profil_id'>Titre: " . $row["T"] . "</a>";
                                    echo "<p>Date: " . $date . "</p>";
                                    echo "<p>Description: " . $row["description"] . "</p>";
                                    echo "<p>Client: " . $row["nom"] . "</p>";
                                    echo "<p>Standardiste: " . $standardistes .  "</p>";
                                    echo "<p>intervenant: " . $intervenants . "</p>";
                                    echo "</div>";
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