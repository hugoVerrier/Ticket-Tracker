<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $bdd = new PDO("mysql:host=$servername;dbname=projet_php", $username, $password);
}catch(PDOException $e){
    echo"Erreur : ".$e->getMessage();
}
if(isset($_POST['ticket'])){
    $description = $_POST['description'];
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $client_id = $_GET['id'];
    $prenom = $_GET['prenom'];
    $nom = $_GET['nom'];
    $mail = $_GET['mail'];
    $age = $_GET['age'];
    $profil_id = $_GET['profilD'];
    $id = $_GET['id'];

    $requete2 = $bdd->prepare("SELECT  count(*) FROM intervention
                            WHERE
                                nom = ? 
                                AND date = ? 
                                AND client_id = ?  
                                AND description = ? 
                            ");
    $requete2->execute(
        array(
            $titre,
            $description,
            $date,
            $client_id
        )
        );
    $ligne = $requete2->fetchAll(PDO::FETCH_ASSOC);
    if($requete2->rowCount()!=0){
    $requete = $bdd->prepare("INSERT INTO intervention VALUES (0, :nom, :date, :id, 0, 0, :description ,3, 1)");
    $requete->execute(
        array(
            "nom" => $titre,
            "date" => $date,
            "id" => $client_id,
            "description" => $description,
        )
    );
    if($profil_id==1){
        header('Location:../client/page_client.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
    } elseif($profil_id==2){
        header('Location:../intervenant/page_intervenant.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
    }elseif($profil_id==3){
        header('Location:../standardiste/page_standardiste.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
    }elseif($profil_id==4){
        header('Location:../admin/page_admin.php?prenom='.$prenom.'&nom='.$nom.'&age='.$age.'&mail='.$mail.'&id='.$id.'&profilD='.$profil_id);  
    }    }
    
    
}
?>