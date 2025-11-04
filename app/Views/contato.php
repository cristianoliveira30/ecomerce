<?php
ob_start();
?>
<h2>Fale conosco</h2>
<form>
    <label>Nome:</label><br>
    <input type="text" name="nome"><br>
    <label>Mensagem:</label><br>
    <textarea name="mensagem"></textarea><br>
    <button>Enviar</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';
