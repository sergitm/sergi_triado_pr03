<!-- 
/**
*
* @author: Sergi Triadó <s.triado@sapalomera.cat>
*
*/
 -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="estils.css"> <!-- feu referència al vostre fitxer d'estils -->
	<title>Paginació</title>
</head>
<body>
	<div class="contenidor">
		<h1>Articles</h1>
		<section class="articles"> <!--aqui guardem els articles-->
			<ul>
					<?php foreach ($result as $article) { ?>
						<li><?php echo $article['id'] . ".- " . $article['article'] ?></li>
					<?php } ?>
			</ul>
		</section>

		<section class="paginacio">
			<ul>
					<li <?php echo ($pagina === 1) ? "class=disabled" : "" ?>><a href="<?php echo ($pagina !== 1) ? '?pagina=' . $pagina-1 : '#' ?>">&laquo;</a></li> <!-- Decidim quan el botó "Anterior" estarà deshabilitat -->
					<?php for ($i=1; $i <= $maxim_pagines; $i++) { ?>
						<li <?php echo ($i===$pagina) ? "class='active'" : "" ?>><a href="<?php echo '?pagina=' . $i ?>"><?php echo $i ?></a></li>
					<?php } ?>
					<li <?php echo ($pagina == $maxim_pagines) ? "class=disabled" : "" ?>><a href="<?php echo ($pagina != $maxim_pagines) ? '?pagina=' . $pagina+1 : '#' ?>">&raquo;</a></li> <!-- Decidim quan el botó "Seguent" estarà deshabilitat -->	
			</ul>
		</section>
	</div>
</body>
</html>