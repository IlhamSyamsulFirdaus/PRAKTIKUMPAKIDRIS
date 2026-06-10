<?php
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../users.php';

$db = new Database();
$conn = $db->connect();
$users_obj = new Users($conn);
$daftar_users = $users_obj->getAllUsers();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar User</h1>
          </div>
          <div class="table-responsive small">
            <table class="table table-striped table-sm align-middle">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Asal</th>
                  <th scope="col" style="width: 150px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($daftar_users)): ?>
                  <?php foreach ($daftar_users as $row): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['id'] ?? ''); ?></td>
                      <td><strong><?php echo htmlspecialchars($row['username'] ?? ''); ?></strong></td>
                      <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
                      <td><?php echo htmlspecialchars($row['asal'] ?? ''); ?></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary me-1" title="Edit User">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" title="Hapus User">Hapus</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center py-3 text-muted">Belum ada data user. Silakan lakukan pendaftaran terlebih dahulu.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </main>