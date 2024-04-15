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
$ticket_id = $_GET['idT'];
$date = $_GET['date'];
$profil_id = $_GET['profilD'];

$tickets = $bdd->prepare ("SELECT *,intervention.nom as N FROM intervention,urgence,users where urgences = valeur AND client_id = users.id AND ? = intervention.id");
$ticket = $bdd->prepare ("SELECT intervention.id FROM users,intervention,urgence where urgences = valeur AND client_id = users.id date = ?");
$standardiste = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4) ");
$intervenant = $bdd->prepare ("SELECT nom FROM users where id = :id and (profil_id = :pid OR profil_id = 4)");

$tickets->execute(array($ticket_id));
$row = $tickets->fetch(PDO::FETCH_ASSOC);
$standardiste_id = $row["standardiste_id"];
$intervenant_id = $row["intervenant_id"];

$standardiste->execute(array("id"=>$standardiste_id,"pid"=>3));
$intervenant->execute(array("id"=>$intervenant_id,"pid"=>2));
$rows = $standardiste->fetch(PDO::FETCH_ASSOC);
$rowi = $intervenant->fetch(PDO::FETCH_ASSOC);

if($rows==0){$standardistes = "Personne";}else{$standardistes = $rows['nom'];};
if($rowi==0){$intervenants = "Personne";}else{$intervenants = $rowi['nom'];};

$dates = explode("-", $row['date']);
//array_reverse($dates);
//$date = implode("-", $dates);
$date_sortie = DateTime::createFromFormat('Y-m-d', $row['date']);
$date = $date_sortie->format('d/m/Y');
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
    <div class="h-32 flex p-8 bg-[#451952] ">
    <a href="../admin/dashboard.php?prenom=<?php echo ($prenom); ?>&nom=<?php echo ($nom); ?>&age=<?php echo ($age); ?>&mail=<?php echo ($mail); ?>&id=<?php echo ($id); ?>&profilD=<?php echo$profil_id;?>" class="text-2xl mr-5 hover:scale-125">Retour</a>
            <h1 class="text-7xl text-center mx-auto underline">Ticket Tracker</h1>
            
        </div>
    
    <section class="text-gray-600 body-font relative">
        
        <div class="container px-5 py-16 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Contact Us</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Décrivez votre soucis en quelque mots. Donner un titre et une date a votre soucis.</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
                <form method="POST" action="MAJ.php?nom=<?php echo$row['N']; ?>&id=<?php echo $ticket_id ?>&client_id=<?php echo $id;?>&standardiste_id=<?php echo $standardiste_id;?>&intervenant_id=<?php echo $intervenant_id;?>&urgences=<?php echo $row['urgences'];?>&etat=<?php echo $row['etat'];?>&profilD=<?php echo$profil_id;?>" class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="titre" class="leading-7 text-sm text-gray-600">Titre</label>
                        <input type="text" id="titre" name="titre" value="<?php echo $row['N'] ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="date" class="leading-7 text-sm text-gray-600">Date</label>
                        <input type="date" id="date" name="date" value="<?php echo $date; ?>" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                    </div>
                    </div>
                    <div class="p-2 w-full">
                    <div class="relative">
                        <label for="description " class="leading-7 text-sm text-gray-600">Description du problème</label>
                        <textarea id="description" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" required><?php echo $row['description'] ?></textarea>
                    </div>
                    </div>
                    <div id="urgence">
                    <?php 
                        $tickets = $bdd->prepare ("SELECT * FROM urgence;");
                        $tickets->execute(array());
                        echo "<select name='urgence'>";
                        while ($rowx = $tickets->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $rowx['valeur'] . "'>" . $rowx['titre'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                    <script>
                        document.getElementById("mySelect").addEventListener("change", function() {
                        var result = this.value;
                        document.getElementById("result").innerHTML = result;
                        });
                    </script>
                    </div>
                    <div id="etat">
                        <?php
                            $etats = $bdd->prepare("SELECT * FROM etat;");
                            $etats->execute(array());
                            echo "<select name='etat'>";
                            while ($rowe = $etats->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $rowe['valeur'] . "'>" . $rowe['nom'] . "</option>";
                            }
                            echo "</select>";
                        ?>
                        <script>
                            document.getElementById("mySelect2").addEventListener("change", function() {
                                var result = this.value;
                                document.getElementById("result2").innerHTML = result;
                            });
                        </script>
                    </div>
                    <div class="p-2 w-full">
                    <button type="submit" name="MAJ" class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Envoie</button>                    </div>
                </form> 
                <div class="p-2 w-full pt-6 mt-8 border-t border-gray-200 text-center">
                <a class="text-blue-500">support-technique@ticketT.com</a>
                <p class="leading-normal my-5">49 Smith St.
                    <br>Saint Cloud, MN 56301
                </p>
                <span class="inline-flex">
                    <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                    </a>
                    <a class="ml-4 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                    </a>
                    <a class="ml-4 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                    </a>
                    <a class="ml-4 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                    </svg>
                    </a>
                </span>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>
</html>

