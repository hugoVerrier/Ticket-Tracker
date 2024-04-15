<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=projet_php", $username, $password);
}catch(PDOException $e){
    echo"Erreur : ".$e->getMessage();
}
if(isset($_POST['MAJ'])){
    $description = $_POST['description'];
    $titre = $_GET['nom'];
    $ticket_id = $_GET['id'];
    $date = $_POST['date'];
    $client_id = $_GET['client_id'];
    $standardiste_id = $_GET['standardiste_id'];
    $intervenant_id = $_GET['intervenant_id'];
    $urgence = $_POST['urgence'];
    $etat = $_POST['etat'];
    $profil_id=$_GET['profilD'];
    $requete = $bdd->prepare("UPDATE intervention SET nom = :nom, date = :date, standardiste_id = :standardiste_id, intervenant_id = :intervenant_id, description = :description, urgences = :urgence, etat = :etat WHERE id = :ticket_id");
    $requete->execute(
        array(
            "ticket_id" => $ticket_id,
            "nom" => $titre,
            "date" => $date,
            "standardiste_id" => $standardiste_id,
            "intervenant_id" => $intervenant_id,
            "description" => $description,
            "urgence" => $urgence,
            "etat" => $etat
        )
    );


    if(isset($_POST['update_ticket'])){
        $description = $_POST['description'];
        $titre = $_POST['titre'];
        $date = $_POST['date'];
    
        // Mettre à jour le ticket dans la base de données
        $requete = $bdd->prepare("UPDATE intervention SET nom = :nom, date = :date, description = :description WHERE id = :id");
        $requete->execute(array(
            "nom" => $titre,
            "date" => $date,
            "description" => $description,
            "id" => $ticket_id
        ));
    
        // Rediriger vers la page du client
    }
    switch($profil_id){
        case 2:
            header('Location: ../intervenant/page_intervenant.php?prenom='.$ticket['prenom'].'&nom='.$ticket['nom'].'&age='.$ticket['age'].'&mail='.$ticket['mail'].'&id='.$ticket['client_id'].'&profilD='.$profil_id);
        case 3:

        case 4:
            header('Location: ../admin/dashboard.php?prenom='.$ticket['prenom'].'&nom='.$ticket['nom'].'&age='.$ticket['age'].'&mail='.$ticket['mail'].'&id='.$ticket['client_id'].'&profilD='.$profil_id);
    }
    
    
    
}
?>
