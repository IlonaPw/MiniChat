<?php
if(isset($_POST['pseudo'])) // Si le formulaire a été envoyé...
{
    setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
    header("Location: minichat.php");
}
?>
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
if (isset($_POST['pseudo']) && isset($_POST['message']))
{
    // On ajoute une entrée dans la table minichat
    $req = $bdd->prepare('INSERT INTO minichat(pseudo, message,date_creation) VALUES(?, ?,NOW())');
    $req->execute(array($_POST['pseudo'],$_POST['message']));
    // redirige vers minichat.php
    header('Location: minichat.php');
}
else {
    echo '<a href="minichat.php" >Veuillez entrer des données valides !</a>';
}

?>