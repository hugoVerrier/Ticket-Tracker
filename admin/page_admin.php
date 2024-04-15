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
  <link rel="stylesheet" href="bg.css">
  <title>Ticket Tracker</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inconsolata:wght@500&family=Kurale&display=swap" rel="stylesheet">
</head>
<body id="texte" class=" bg-[#E8BCB9] text-[#E8BCB9] ">
    <header class=" body-font bg-[#451952] ">
        <div class="container mx-auto flex p-5 flex-col md:flex-row items-center">
            <a class="flex  items-center  mb-4 mr-96">
            <span class="ml-3 text-5xl">Ticket Tracker</span>
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


    <nav class="flex justify-center items-center space-x-40 text-base p-8 m-64">
    <a class="bg-[#451952] p-8 rounded-full text-5xl hover:underline" href="dashboard.php?&prenom=<?php echo $prenom; ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo ($profil_id); ?>">Dash Board</a>
    <a class="bg-[#451952] p-8 rounded-full text-5xl hover:underline" href="client.php?&prenom=<?php echo ($prenom); ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo ($profil_id); ?>">Client</a>
</nav>

    </div>
</body>
</html>