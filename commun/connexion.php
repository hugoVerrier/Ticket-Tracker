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

<body class=" bg-[#E8BCB9] text-[#E8BCB9] ">

    <div class="h-48 flex p-8 bg-[#451952] ">
                <p class="text-3xl mx-4 "><a href="page_acceuil.php">Acceuil</a></p>
                <h1 class="text-7xl  mx-auto underline">Ticket Tracker</h1>
                <p class="text-3xl mx-4 "><a href="inscription.php">Sign In</a></p>
    </div>
    <div class="flex justify-center bg-[#E8BCB9]">
        <div class="h-98 grid justify-center items-center m-8 rounded-lg p-8 bg-[#451952] ">
            <form method="POST" action="connecter.php" class="grid grid-cols-1 justify-center items-center">
                <div class="text-[#E8BCB9] text-2xl text-center py-8">
                        <?php
                            if (isset($_GET['erreur'])) {
                                session_start();
                                $erreur = $_GET['erreur']; 
                                echo $erreur ;
                            }
                        ?>
                </div>
                <div class="grid grid-cols-2 ">

                    <div class="mx-4 px-4 col justify-center p-2 order-4">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="identifiant">Identifiant:</h1>
                        <input type="text" id="identifiant" name="identifiant" placeholder="Tom123" class="rounded-lg text-black p-2 text-center" required><br>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-6">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="motDePasse">Mot de passe:</h1>
                        <input type="password" id="mots_de_passe" name="mots_de_passe" placeholder="Tom4862!" class="rounded-lg text-black p-2 text-center"     required><br>
                    </div>
                </div>
                

                <div class="flex justify-center items-center">
                    <div class="text-2xl w-1/3 m-4 mt-8 p-2 rounded-lg flex items-center justify-center bg-[#E8BCB9] text-[#662549] col-span-2 order-7 border-2 border-black ">
                        <input class="flex items-center justify-center " type="submit" value="Connexion" name="connecter">
                    </div>
                </div>
            </form>
            
        </div>  
    </div>
    
</body>
</html>