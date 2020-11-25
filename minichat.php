<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MiniChat</title>
</head>
<header>

    <h1>MiniChat</h1>
</header>
<body>
    <form action="minichat_post.php" method="post">
        <p>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" maxlength="255" value="<?php if(isset($_COOKIE['pseudo'])) { echo $_COOKIE['pseudo']; } else { echo 'Entrez votre pseudo'; } ?>" size="20" />
            <br/>
            <label for="message">Message :</label>
            <textarea type="text" name="message" id="message"rows="1" cols ="20">
            </textarea>
            <br/>
            <input type="submit" value="Envoyer">
        </p>
    </form>
    <fieldset>
        <legend> MiniChat</legend>
        <div id="chat">
            <?php
                try
                {
                    // On se connecte à MySQL
                        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }
                catch(Exception $e)
                {
                    // En cas d'erreur, on affiche un message et on arrête tout
                        die('Erreur : '.$e->getMessage());
                }
                $reponse = $bdd->query('SELECT * FROM minichat ORDER BY ID DESC ');
                while($donnees = $reponse->fetch())
                {
                    ?>
                    <p style="border-bottom: 2px black dotted;">
                    <?php
                    echo'<strong>'.$donnees['date_creation'].'&nbsp'.htmlspecialchars($donnees['pseudo']).'</strong> :'.htmlspecialchars($donnees['message']);
                    ?>
                    </p>
                    <?php
                }
                $reponse->closeCursor();
            ?>
        </div>
    </fieldset>
    <p>Pour voir les nouveaux messages :<a href="minichat.php" >Rafraichir</a>.</p>
</body>
<footer>
</footer>
</html>