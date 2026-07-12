<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: #212529;
            width: 240px;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #ced4da;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #343a40;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        /* Main Content Adjustment */
        main {
            margin-left: 240px;
            padding: 40px;
        }
        /* Custom Cards */
        .stat-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        /* Avatar Placeholder */
        .avatar-circle {
            width: 40px;
            height: 40px;
            background-color: #e9ecef;
            color: #495057;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="px-4 mb-4 text-center">
            <h4 class="text-white fw-bold"><i class="fa-solid fa-layer-group me-2 text-primary"></i>DevPanel</h4>
            <small class="text-muted">v1.0.0</small>
        </div>
        <hr class="text-secondary">
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">
                    <i class="fa-solid fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-users"></i> Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-gear"></i> Pengaturan
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <main>
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="h3 fw-bold mb-1">Manajemen Pengguna</h1>
                <p class="text-muted mb-0">Kelola hak akses dan data pengguna aplikasi Anda di sini.</p>
            </div>
            <a href="tambah.php" class="btn btn-primary px-4 py-2 shadow-sm fw-medium">
                <i class="fa-solid fa-user-plus me-2"></i> Tambah Pengguna
            </a>
        </div>

        <!-- STATISTIK RINGKASAN (Mengambil data dinamis dari DB) -->
        <?php
        // Hitung Total User
        $total_res = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users");
        $total_data = mysqli_fetch_assoc($total_res);
        
        // Hitung Admin
        $admin_res = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE peran='Admin'");
        $admin_data = mysqli_fetch_assoc($admin_res);
        ?>
        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card stat-card shadow-sm bg-white p-3">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3 me-3">
                            <i class="fa-solid fa-users fa-2x"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Total Pengguna</small>
                            <h3 class="mb-0 fw-bold mt-1"><?= $total_data['total'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card stat-card shadow-sm bg-white p-3">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-danger-subtle text-danger rounded-3 me-3">
                            <i class="fa-solid fa-user-shield fa-2x"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Administrator</small>
                            <h3 class="mb-0 fw-bold mt-1"><?= $admin_data['total'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card stat-card shadow-sm bg-white p-3">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-success-subtle text-success rounded-3 me-3">
                            <i class="fa-solid fa-circle-check fa-2x"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Sistem Status</small>
                            <h3 class="mb-0 fw-bold mt-1 text-success">Aktif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL UTAMA -->
        <div class="table-container shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="py-3 px-4">Pengguna</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">No. HP</th>
                            <th class="py-3">Peran</th>
                            <th class="py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM users ORDER BY id DESC";
                        $result = mysqli_query($koneksi, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Mengambil inisial nama untuk avatar bulatan
                                $inisial = strtoupper(substr($row['nama'], 0, 1));
                                
                                echo "<tr>";
                                echo "<td class='px-4'>";
                                echo "  <div class='d-flex align-items-center'>";
                                echo "    <div class='avatar-circle'>$inisial</div>";
                                echo "    <div class='fw-semibold'>" . htmlspecialchars($row['nama']) . "</div>";
                                echo "  </div>";
                                echo "</td>";
                                echo "<td class='text-muted'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td class='text-muted'>" . ($row['no_hp'] ? htmlspecialchars($row['no_hp']) : '-') . "</td>";
                                
                                // Badge Peran yang lebih modern
                                if ($row['peran'] == 'Admin') {
                                    echo "<td><span class='badge bg-danger-subtle text-danger px-3 py-2 rounded-pill'>Admin</span></td>";
                                } else {
                                    echo "<td><span class='badge bg-info-subtle text-info px-3 py-2 rounded-pill'>User</span></td>";
                                }
                                
                                // Tombol aksi menggunakan ikon saja agar clean
                                echo "<td class='text-end px-4'>
                                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-light btn-sm text-warning me-1 shadow-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                                        <a href='hapus.php?id=" . $row['id'] . "' class='btn btn-light btn-sm text-danger shadow-sm' onclick='return confirm(\"Yakin ingin menghapus?\")' title='Hapus'><i class='fa-solid fa-trash'></i></a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-5 text-muted'><i class='fa-regular fa-folder-open fa-2x mb-3 d-block'></i>Belum ada data pengguna.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>