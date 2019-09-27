<?php
/**
 * render('articles/show')
 */

function render($path, $variables){
	//extrait le tableau sous forme de variables
	extract($variables);
	ob_start();
	require('templates/'.$path.'.html.php');
	$pageContent = ob_get_clean();

	require('templates/layout.html.php');
}