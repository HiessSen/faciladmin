<?php
$lang = getLanguage();
?>
<form method="POST" action="<?= BASE_URL ?>/login">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">Se connecter</button>
</form>
<p>Vous n'avez pas de compte ? <a href="register">Inscrivez vous !</a></p>

<?php if (isset($error)) : ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>