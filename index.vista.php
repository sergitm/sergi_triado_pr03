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
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<input type="number" name="post_x_pag" placeholder="Posts per pàgina" min=1 value="<?php echo (!empty($_GET['post_x_pag'])) ? htmlspecialchars(stripslashes(trim($_GET['post_x_pag']))) : '' ?>">
		</form>
		<section class="articles"> <!--aqui guardem els articles-->
			<ul>
					<?php foreach ($result as $article) { ?>
						<li><?php echo $article['id'] . ".- " . $article['article'] ?></li>
					<?php } ?>
			</ul>
		</section>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<textarea name='article' rows='10' cols='50' placeholder="Escriu un nou article"></textarea><br>
			<input class="insertar" type="submit" name="insertArticle" value="Publicar">
			<?php if (isset($insert) && $insert) { ?>
				<p style="color:red"></p>
			<?php } ?>
		</form>

		<section class="paginacio">
			<ul>
					<li <?php echo ($pagina === 1) ? "class=disabled" : "" ?>>
						<a href="<?php echo ($pagina !== 1) ? '?pagina=' . $pagina-1 . '&post_x_pag=' . $post_per_pag : '#' ?>">&laquo;</a>
					</li> <!-- Decidim quan el botó "Anterior" estarà deshabilitat -->
					<?php for ($i=1; $i <= $maxim_pagines; $i++) { ?>
						<li <?php echo ($i===$pagina) ? "class=active" : "" ?>>
							<a href="<?php echo '?pagina=' . $i . '&post_x_pag=' . $post_per_pag ?>"><?php echo $i ?></a>
						</li>
					<?php } ?>
					<li <?php echo ($pagina == $maxim_pagines) ? "class=disabled" : "" ?>>
						<a href="<?php echo ($pagina != $maxim_pagines) ? '?pagina=' . $pagina+1 . '&post_x_pag=' . $post_per_pag : '#' ?>">&raquo;</a>
					</li> <!-- Decidim quan el botó "Seguent" estarà deshabilitat -->	
			</ul>
		</section>
	</div>
</body>
</html>