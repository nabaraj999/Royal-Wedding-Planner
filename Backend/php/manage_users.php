            <?php
            session_start();
            include '../../connection/config.php';

            // Ensure only admins can access
            if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
            die("Access Denied: You must be an admin.");
            }

            // Messages for feedback
            $message = "";

            // Handle Add User
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $role = trim($_POST['role']);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $role);

            if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>User added successfully.</div>";
            } else {
            $message = "<div class='alert alert-danger'>Error adding user: " . $stmt->error . "</div>";
            }
            $stmt->close();
            }

            // Handle Edit User
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_user'])) {
            $id = intval($_POST['user_id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $role = trim($_POST['role']);

            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $email, $role, $id);

            if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>User updated successfully.</div>";
            } else {
            $message = "<div class='alert alert-danger'>Error updating user: " . $stmt->error . "</div>";
            }
            $stmt->close();
            }

            // Handle Delete User
            if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);

            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>User deleted successfully.</div>";
            } else {
            $message = "<div class='alert alert-danger'>Error deleting user: " . $stmt->error . "</div>";
            }
            $stmt->close();
            }

            // Fetch all users
            $result = $conn->query("SELECT id, username, email, role FROM users");

            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin Dashboard - User Management</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../css/index.css">
            </head>
            <body>
            <div class="sidebar">
                <div class="admin-profile">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Profile" class="profile-icon">
                    <p><?php echo $_SESSION['username']; ?></p>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin_contact.php">Contact Us</a></li>
                    <li><a href="admin_booking.php">View Bookings</a></li>
                    <li><a href="manage_users.php">Manage_user</a></li>
                </ul>
                <button class="logout" onclick="location.href='logout.php'">Logout</button>
            </div>



            <div class="admin-container" style="margin-left: 300px;">

            <div class="container mt-5">
            <h2>User Management</h2>
            <?= $message ?>

                </style>
            <!-- Add User Form -->
            <form action="" method="POST" class="border p-3 rounded shadow-sm bg-light">
                <h4>Add New User</h4>
                <input type="text" name="username" placeholder="Username" required class="form-control mb-2">
                <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
                <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
                <select name="role" required class="form-control mb-2">
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                </select>
                <button type="submit" name="add_user" class="btn btn-success">Add User</button>
            </form>

            <!-- User List -->
            <h3 class="mt-4">Existing Users</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['role']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editUser('<?= $row['id'] ?>', '<?= $row['username'] ?>', '<?= $row['email'] ?>', '<?= $row['role'] ?>')">Edit</button>
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Edit User Modal -->
            <div id="editUserModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="user_id" id="editUserId">
                                <div class="mb-2">
                                    <label>Username</label>
                                    <input type="text" name="username" id="editUsername" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Email</label>
                                    <input type="email" name="email" id="editEmail" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Role</label>
                                    <select name="role" id="editRole" class="form-control" required>
                                        <option value="User">User</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit_user" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>

            <!-- Bootstrap & jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <!-- JavaScript to Handle Edit -->
            <script>
            function editUser(id, username, email, role) {
                $('#editUserId').val(id);
                $('#editUsername').val(username);
                $('#editEmail').val(email);
                $('#editRole').val(role);
                $('#editUserModal').modal('show');
            }
            </script>
            </body>
            </html>
