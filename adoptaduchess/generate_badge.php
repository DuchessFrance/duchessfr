<html>
<head>
	<title>Duchess France | Génération de badge pour les marraines</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container" style="width:60%">
  <h2>Génération du badge</h2>
  <form role="form" action="generate_badge.php" method="post">
    <div class="form-group" style="width:50%">
      <label for="name">Prénom et Nom :</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Prénom et Nom" required>
    </div>
    <div class="form-group" style="width:50%">
      <label for="email">E-mail :</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
    </div>
    <button type="submit" class="btn btn-success">Générer le badge</button>
  </form>

<?php
if(isset($_POST['email']) && isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        echo "Génération de badge pour " . $name . " ( " . $email . ") :<br/><br/>";

        $stripName = strtolower($name);
        $stripName = str_replace(" ", "_", $stripName);

        $badgeDate = date("Y-m-d");

        //1. Generer le fichier json
        $content = '{ "recipient": "' . $email . '", "evidence": "http://www.duchess-france.org/marrainage-adoptaduchess/", "issued_on": "' . $badgeDate . '", "badge": { "version": "1.0.0", "name": "Marraine #AdoptADuchess", "image": "http://www.duchess-france.org/wp-content/uploads/2015/12/Badge2.png", "description": "Ce badge gratifie l\'expertise en tant que marraine Duchess : coaching de femmes qui entrent dans une profession technique de l\'informatique", "criteria": "http://www.duchess-france.org/marrainage-adoptaduchess/", "issuer": { "origin": "http://www.duchess-france.org", "name": "Duchess France", "org": "Duchess France, 2015", "contact": "duchessfr@mail.com" } } }';

        $jsonName = 'json/' . $stripName . '_duchessfr_badge.json';
        $jsonFile = fopen($jsonName, 'x+');
        fputs($jsonFile, $content);
        fclose($jsonFile);

        //2. Appeler cette URL http://backpack.openbadges.org/baker?assertion=http://url.com/blabla.json
        $url = "http://backpack.openbadges.org/baker?assertion=http://www.scraly.com/duchessfr/$jsonName";
        echo "<br/><img src='$url'/></br>";
}
?>

<br/><br/>
Lorsque le badge s'affiche ci-dessus, vous pouvez l'enregistrer sous et l'envoyer dans le mail de bienvenue de la Marraine ! :-).
</div>

</body>
</html>
