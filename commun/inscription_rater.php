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

<body class=" bg-[#E8BCB9] text-[#E8BCB9] ">

    <div class="h-48 flex p-8 bg-[#451952] ">
                <p class="text-3xl mx-4 "><a href="page_acceuil.php">Acceuil</a></p>
                <h1 class="text-7xl  mx-auto underline">Ticket Tracker</h1>
                <p class="text-3xl mx-4 "><a href="connexion.php">Log In</a></p>
    </div>
    <div class=" grid justify-center align-center  text-[#451952] mx-8 mt-4">
                <p class="text-3xl text-center mx-4 ">Erreur inscription impossible.<br> Ce nom et ce prénom sont déjà enregistrer<br><br></p>
                <p class=" flex jsutify-center text-3xl text-center mx-4  border-2 border-[#451952] mx-auto p-4 rounded-full"><a href="connexion.php"> Connectez vous</a><p>
    </div>
    <div class="flex justify-center bg-[#E8BCB9]">
        <div class="h-98 grid justify-center items-center m-8 rounded-lg p-8 bg-[#451952] ">
            <form method="POST" action="inscrire.php" class="grid grid-cols-1 justify-center items-center">
                <div class="grid grid-cols-2 ">
                    <div class="mx-4 px-4 col justify-center p-2 order-1">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="nom">Nom:</h1>
                        <input type="text" id="nom" name="nom" placeholder="Tom" class="rounded-lg text-black p-2 text-center" required><br>
                        <script>
                            const nomInput = document.getElementById('nom');
                            const message_nom = document.getElementById('message_nom');

                            nomInput.addEventListener('input', function() {
                            const nom = nomInput.value;

                            // Regex pour vérifier si le nom contient uniquement des lettres
                            const regex = /^[a-zA-Z]+$/;

                            if (!regex.test(nom)) {
                                message_nom.textContent = 'Le nom ne doit contenir que des lettres.';
                                message_nom.style.color = 'red';
                            }else{
                                message_nom.textContent = '';
                            }
                            });
                            
                        </script>
                        <p id="message_nom"></p>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-3">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="prenom">Prénom:</h1>
                        <input type="text" id="prenom" name="prenom" placeholder="Tom" class="rounded-lg text-black p-2 text-center" required><br>
                        <script>
                            const prenomInput = document.getElementById('prenom');
                            const message_prenom = document.getElementById('message_prenom');

                            prenomInput.addEventListener('input', function() {
                            const prenom = prenomInput.value;

                            // Regex pour vérifier si le nom contient uniquement des lettres
                            const regex = /^[a-zA-Z]+$/;

                            if (!regex.test(prenom)) {
                                message_prenom.textContent = 'Le prenom ne doit contenir que des lettres.';
                                message_prenom.style.color = 'red';
                            }else{
                                message_prenom.textContent = '';
                            }
                            });
                        </script>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-5">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="age">Age:</h1>
                        <input type="number" id="age" name="age" placeholder="18" class="rounded-lg text-black p-2 text-center" required><br>
                        <script>
                            const ageInput = document.getElementById('age');
                            const message_age = document.getElementById('message_age');

                            ageInput.addEventListener('input', function() {
                            const age = ageInput.value;

                            // Regex pour vérifier si le nom contient uniquement des lettres
                            const regexChiffre = /^[0-9]+$/;

                            if (!regexChiffre.test(age)) {
                                message_age.textContent = 'L age ne doit contenir que des chiffres.';
                                message_age.style.color = 'red';
                            }else{
                                message_age.textContent = '';
                            }
                            });
                        </script>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-2">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="mail">Mail:</h1>
                        <input type="text" id="mail" name="mail" placeholder="tom.tom@gmail.com" class="rounded-lg text-black p-2 text-center" required><br>
                        <script>
                            const mailInput = document.getElementById('mail');
                            const message_mail = document.getElementById('message_mail');

                            mailInput.addEventListener('input', function() {
                            const mail = mailInput.value;

                            // Regex pour vérifier si le nom contient uniquement des lettres
                            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                            if (!regexEmail.test(mail)) {
                                message_mail.textContent = 'Le mail ne doit contenir que des lettres.';
                                message_mail.style.color = 'red';
                            }else{
                                message_mail.textContent = '';
                            }
                            });
                        </script>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-4">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="identifiant">Identifiant:</h1>
                        <input type="text" id="identifiant" name="identifiant" placeholder="Tom123" class="rounded-lg text-black p-2 text-center" required><br>
                    </div>

                    <div class="mx-4 px-4 col justify-center p-2 order-6">
                        <h1 class="text-2xl mx-4 px-4 rounded-lg flex justify-center p-2" for="motDePasse">Mot de passe:</h1>
                        <input type="password" id="mots_de_passe" name="mots_de_passe" placeholder="Tom4862!" class="rounded-lg text-black p-2 text-center"     required><br>
                    </div>

                </div>
                
                <div class="text-2xl w-1/3 m-4 mt-8 p-2 rounded-lg flex items-center justify-center bg-[#E8BCB9] text-[#662549] col-span-2 order-7 border-2 border-black ">
                    <input class="flex items-center justify-center " type="submit" value="S'inscrire" name="inscrit">
                </div>
            </form>
            
        </div>  
    </div>
    
</body>
</html>