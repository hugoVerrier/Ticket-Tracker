<?php 

$id = $_GET['id']; 
$prenom = $_GET['prenom']; 
$nom = $_GET['nom']; 
$mail = $_GET['mail']; 
$age = $_GET['age']; 
$profil_id = $_GET['profilD'];
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
    <div>
        <div class="h-48 flex p-8 bg-[#451952] ">
            <p class="text-3xl mx-4 "><a href="page_client.php?prenom=<?php echo ($prenom); ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo $profil_id;?>">Acceuil</a></p>
            <h1 class="text-7xl  mx-auto underline">Ticket Tracker</h1>
            
        </div>
        <div class="flex justify-center my-16 p-6 mx-auto">
            <div class="bg-[#451952] p-6">
                <h2 class="text-3xl mx-4 ">ADDRESS</h2>
                <p class="text-xl mx-4 ">1 bis rue Maryse Bastié ,69008 Lyon, France</p>
            </div>
            <div class="bg-[#451952] p-6">
                <h2 class="text-3xl mx-4 ">EMAIL</h2>
                <a class="text-xl mx-4 ">support-tech@ticketrac.com</a>
                <h2 class="text-3xl mx-4 ">PHONE</h2>
                <p class="text-xl mx-4 ">+33 6 51 82 58 48</p>
            </div>
        </div>
    </div>
</body>
</html>