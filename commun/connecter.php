<?php
$servername = "localhost";
$username = "root";
$password = "";

$id = $_GET['id']; 
$prenom = $_GET['prenom']; 
$nom = $_GET['nom']; 
$mail = $_GET['mail']; 
$age = $_GET['age']; 
$profil_id = $_GET['profilD'];
try{
    $bdd = new PDO("mysql:host=$servername;dbname=projet_php", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo"Erreur : ".$e->getMessage();
}

if(isset($_POST['connecter'])){
    if(!empty($_POST['identifiant']) AND !empty($_POST['mots_de_passe'])){
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mots_de_passe = $_POST['mots_de_passe'];
        $recupUser = $bdd->prepare("SELECT * from users where identifiant = ? and mots_de_passe = ?");
        $recupUser->execute(array($identifiant,$mots_de_passe));    

        if($recupUser->rowCount() > 0){
            session_start();
            $row = $recupUser->fetch(PDO::FETCH_ASSOC);
            $profil_id = $row['profil_id'];
            $id = $row['id'];
            $prenom = $row['prenom'];
            $nom = $row['nom'];
            $mail = $row['prenom'];
            $age = $row['age'];
            $profil_id = $row['profil_id'];
            $_SESSION['identifiant'] = $identifiant;
            $_SESSION['mots_de_passe'] = $mots_de_passe;
            if($profil_id==1){
                header('Location:../client/page_client.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
            } elseif($profil_id==2){
                header('Location:../intervenant/page_intervenant.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
            }elseif($profil_id==3){
                header('Location:../standardiste/page_standardiste.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
            }elseif($profil_id==4){
                header('Location:../admin/page_admin.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
            }
        }else{
            $erreur = "Votre mots de passe ou votre identifiant est incorrecte";
            header('Location:connexion.php?erreur=' . $erreur);   
        };
    }
    
}
if($profil_id==1){
    //header('Location:../client/page_client.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
} elseif($profil_id==2){
    header('Location:../intervenant/page_intervenant.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
}elseif($profil_id==3){
    header('Location:../standardiste/page_standardiste.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
}elseif($profil_id==4){
    header('Location:../admin/page_admin.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="widh=device-widh, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="bg.css">
  <title>Ticket Tracker</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inconsolata:wght@500&family=Kurale&display=swap" rel="stylesheet">
</head>
<body id="texte" class=" bg-[#E8BCB9]  ">
    <div>
        <div class="h-48 flex p-8 bg-[#451952] ">
            <h1 class="text-7xl  mx-auto underline">Ticket Tracker</h1>
            <div class="flex">
                <p class="text-2xl mx-4 "><a href="inscription.php">/a></p>
                <p class="text-2xl mx-4 "><a href="connexion.php"><?php echo $nom ?></a></p>
            </div>
        </div>
    </div>
</body>
</html>