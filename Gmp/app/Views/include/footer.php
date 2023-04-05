<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}
?>
<footer class="bgcolor-green-dark text-center noPrint">
	<section>
		<h3 class="font-text-light-extra font-weight-heavy color-white"><?= $titleSite ?> - &copy; <?= date('Y') ?> Todos os direitos reservados.</h3>
		<p class="font-text-light font-weight-heavy color-white">Sistema desenvolvido por: Júnior Marques</p>
	</section>
</footer>



<script src="<?php echo URL; ?>assets/js/bootstrap.js"></script>
</body>

</html>