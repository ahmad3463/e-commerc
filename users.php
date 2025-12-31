<?php
$current_page = 'users';
include 'top.php'
    ?>

<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Users Management</h4>
            <button class="btn btn-light btn-sm">+ Add New User</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <?php
                $stmt = $conn->prepare("SELECT id , name , email , role  FROM users");
                $stmt->execute();

                $users = $stmt->fetchAll(PDO::FETCH_OBJ)

                    ?>
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example row -->
                        <?php if ($users): ?>

                            <?php foreach ($users as $user): ?>




                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <?php if ($user->role === 'admin'): ?>
                                            <span class="badge bg-success">Admin</span>
                                        </td>
                                    <?php elseif ($user->role === 'users'): ?>
                                        <span class="badge bg-info ">User</span>
                                    <?php endif ?>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-warning me-2" href="user_edit.php?id=<?= $user->id?>">Edit</a>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>