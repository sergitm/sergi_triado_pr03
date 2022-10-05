<?php
/**
*
* @author: Sergi Triadó <s.triado@sapalomera.cat>
*
*/

// Ens connectem a la base de dades	

$conn = null;

try{
    $conn = new PDO('mysql:host=' . 'localhost' . ';dbname=' . 'pt03_sergi_triado', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch(PDOException $e){
    echo '<p style="color:red">Connection Error: ' . $e->getMessage() . '</p>';
    die();
}

// Establim el numero de pagina en la que l'usuari es troba.
# si no troba cap valor, assignem la pagina 1.
$pagina = (empty($_GET['pagina'])) ? 1 : intval($_GET['pagina']);

// definim quants post per pagina volem carregar.

$post_per_pag = 5;

// Revisem des de quin article anem a carregar, depenent de la pagina on es trobi l'usuari.
# Comprovem si la pagina en la que es troba es més gran d'1, sino carreguem des de l'article 0.
# Si la pagina es més gran que 1, farem un càlcul per saber des de quin post carreguem

$primer_article = ($pagina > 1) ? ($pagina - 1) * $post_per_pag : 0;

// Preparem la consulta SQL

$query = "SELECT * FROM articles LIMIT :primer_article, :num_articles";

try {

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':primer_article', $primer_article, PDO::PARAM_INT);
    $stmt->bindParam(':num_articles', $post_per_pag, PDO::PARAM_INT);

    // Executem la consulta
    $stmt->execute();

    $result = $stmt->fetchAll();

} catch (PDOException $e) {
    echo '<p style="color:red">Hi ha hagut un error amb la petició: ' . $e->getMessage() . '</p>';
    die();
}

$num = count($result);

// Comprovem que hagi articles, en cas contrari, redirigim
if ($num < 1) {
    header("Location: http://localhost/practiques_backend/UF1/practiques/Pt03_Sergi_Triado/");
}

// Calculem el total d'articles per a poder conèixer el número de pàgines de la paginació
$count_query = "SELECT COUNT(id) AS quantitat FROM articles";

$count_stmt = $conn->prepare($count_query);
$count_stmt->execute();

$count_res = $count_stmt->fetch();
$quantitat = intval($count_res['quantitat']);

// Calculem el numero de pagines que tindrà la paginació. Llavors hem de dividir el total d'articles entre els POSTS per pagina

$maxim_pagines = ($quantitat % $post_per_pag > 0) ? floor($quantitat / $post_per_pag + 1) : floor($quantitat / $post_per_pag);

require 'index.vista.php';

?>