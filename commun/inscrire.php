<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=projet_php", $username, $password);
}catch(PDOException $e){
    echo"Erreur : ".$e->getMessage();
}

if(isset($_POST['inscrit'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $mail = $_POST['mail'];
    $identifiant = $_POST['identifiant'];
    $mots_de_passe = $_POST['mots_de_passe'];
    $requete2 = $bdd->prepare("SELECT  count(*) FROM users
                            WHERE (
                                SELECT 1 FROM users 
                                WHERE nom = :nom 
                                AND prenom = :prenom 
                                AND mail = :mail  
                                AND identifiant = :identifiant 
                                AND mots_de_passe = :mots_de_passe
                            )");
    $requete2->execute(
        array(
            "nom" => $nom,
            "prenom" => $prenom,
            "mail" => $mail,
            "identifiant" => $identifiant,
            "mots_de_passe" => $mots_de_passe
        )
        );
    $ligne = $requete2->fetchAll(PDO::FETCH_ASSOC);
    $count = $requete2->fetchColumn();

    if($count == 0){
    $requete = $bdd->prepare("INSERT INTO users VALUES (0, :nom, :prenom, 1, :mail, :age, :identifiant, :mots_de_passe)");
    $requete->execute(
        array(
            "nom" => $nom,
            "prenom" => $prenom,
            "mail" => $mail,
            "age" => $age,
            "identifiant" => $identifiant,
            "mots_de_passe" => $mots_de_passe
        )
    );
    header('Location:../client/page_client.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id);
    }else{
        $messageAlerte = "La condition n'est pas valide.";
        ///header('Location:inscription_rater.php');   
        exit;
    }
    
    
}
?>