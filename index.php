<?php
// import de la classe Routing ( pour l'utiliser)
use BWB\Framework\mvc\Routing;
// pour beneficier de l'autoload de composer
include "vendor/autoload.php";

include ("./views/head.php");
//include ("./views/sidebar.php");

// A chaque requete emise nous lançons le mecanisme de routage
(new Routing())->execute();

?>
<<<<<<< HEAD

</body>
=======
>>>>>>> 7fe57cd00f675cf5961447d8f4f035c520391cc2
