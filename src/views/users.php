<?php
require_once '../functions/users.php';

$users = getUsers();

include("../includes/head.php");
include("../includes/navbar.php");
?>

<h2>Lista de Usuarios</h2>
<table>
  <tr>
    <th>ID</th>
    <th>Avatar</th>
    <th>Nombre</th>
    <th>Puntos</th>
    <th>Acciones</th>
  </tr>

  <?php foreach ($users as $user): ?>
    <tr>
      <td><?= htmlspecialchars($user["id"]) ?></td>
      <td><img src="<?= htmlspecialchars($user["image_url"]) ?>" width="50" height="50"></td>
      <td><?= htmlspecialchars($user["name"]) ?></td>
      <td><?= htmlspecialchars($user["points"]) ?></td>
      <td>
        <a href="edit_user.php?id=<?= $user['id'] ?>">Editar</a> |
        <a href="../functions/delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('¿Eliminar usuario?');">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php include("../includes/footer.php") ?>