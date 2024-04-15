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
  
</head>
<body id="texte" class=" bg-[#E8BCB9] text-[#E8BCB9] ">
    <header class=" body-font bg-[#451952] ">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex  items-center  mb-4 md:mb-0">
            <span class="ml-3 text-5xl">Ticket Tracker</span>
            </a>
            <nav class="md:ml-auto md:mr-auto flex space-x-40 flex-wrap items-center text-base justify-center">
            <a href="page_admin.php?prenom=<?php echo urlencode($prenom); ?>&nom=<?php echo urlencode($nom); ?>&age=<?php echo urlencode($age); ?>&mail=<?php echo urlencode($mail); ?>&id=<?php echo urlencode($id); ?>" class="text-2xl mr-5 hover:scale-125">Retour</a>
            </nav>
            
        </div>
    </header>
    <div class="flex justify-center m-8">
    <form action="" method="get" class="flex items-center">
        <input type="hidden" name="id" value="<?php echo urlencode($id); ?>">
        <input type="hidden" name="prenom" value="<?php echo urlencode($prenom); ?>">
        <input type="hidden" name="nom" value="<?php echo urlencode($nom); ?>">
        <input type="hidden" name="mail" value="<?php echo urlencode($mail); ?>">
        <input type="hidden" name="age" value="<?php echo urlencode($age); ?>">
        <label for="search" class="sr-only">Rechercher un utilisateur</label>
        <input type="text" id="search" name="search" placeholder="Rechercher un utilisateur..." class="w-full p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none">Rechercher</button>
    </form>
    </div>
    <div class="grid grid-cols-4 justify-center items-center text-[#E8BCB9] p-4">
        <?php
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $recupUser = $bdd->prepare("SELECT * FROM users WHERE nom LIKE :search OR prenom LIKE :search OR mail LIKE :search");
            $recupUser->execute(array(':search' => '%' . $search . '%'));
        } else {
            $recupUser = $bdd->prepare("SELECT * FROM users");
            $recupUser->execute(array());
        }
        if ($recupUser->rowCount() > 0) {
            while ($row = $recupUser->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='bg-[#451952] w-auto h-36 p-6 grid grid-cols-2 justify-center rounded rounded-full my-8 mx-2'>";
                echo "<p>Nom: " . $row['nom'] . "</p>";
                echo "<p class='flex justify-center'>Prenom: " . $row['prenom'] . "</p>";
                echo "<p>Mail: " . $row['mail'] . "</p>";
                echo "<p class='flex justify-center'>Age: " . $row['age'] . "</p>";
                echo "<p>Role: " . $row['profil_id'] . "</p>";
                echo "<p class='flex justify-center'>ID: " . $row['id'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "Aucun résultat trouvé";
        }
        ?>
    </div>
</body>
</html>