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
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex  items-center  mb-4 md:mb-0">
            <span class="ml-3 text-5xl">Ticket Tracker</span>
            </a>
            <nav class="md:ml-auto md:mr-auto flex space-x-40 flex-wrap items-center text-base justify-center">
            <a class="text-2xl mr-5 hover:">Choix Interface</a>
            <a class="text-2xl mr-5 hover:">Dash Board</a>
            <a class="text-2xl mr-5 hover:">Client</a>
            </nav>
            <div class="flex">
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

    </div>
</body>
</html>