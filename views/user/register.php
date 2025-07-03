<form method="POST" action="<?= BASE_URL ?>/register">
  <input type="text" name="first_name" placeholder="Prénom" required>
  <input type="text" name="last_name" placeholder="Nom" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">S'inscrire</button>
</form>

<?php if (isset($error)) : ?>
  <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>