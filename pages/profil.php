<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pengguna - Bank Sampah</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php
require "../includes/navbar.php";?>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Profil Pengguna</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil"></i> Edit Profil
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="bg-light p-3 rounded-circle d-inline-block mb-3">
                                    <i class="bi bi-person-fill text-success" style="font-size: 5rem;"></i>
                                </div>
                                <h4>Budi Santoso</h4>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <strong><i class="bi bi-envelope text-success me-2"></i>Email:</strong> 
                                    budi.santoso@example.com
                                </div>
                                <div class="mb-3">
                                    <strong><i class="bi bi-telephone text-success me-2"></i>Telepon:</strong> 
                                    +62 812 3456 7890
                                </div>
                                <div class="mb-3">
                                    <strong><i class="bi bi-geo-alt text-success me-2"></i>Alamat:</strong> 
                                    Jl. Hijau Daun No. 15, Jakarta
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0"><i class="bi bi-recycle me-2"></i>Riwayat Setor Sampah</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Sampah</th>
                                        <th>Berat (kg)</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-02-15</td>
                                        <td>Organik</td>
                                        <td>5.2</td>
                                        <td>Rp 26,000</td>
                                    </tr>
                                    <tr>
                                        <td>2024-03-20</td>
                                        <td>Anorganik</td>
                                        <td>3.8</td>
                                        <td>Rp 19,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="Budi Santoso">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="budi.santoso@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="tel" class="form-control" value="+62 812 3456 7890">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control">Jl. Hijau Daun No. 15, Jakarta</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <?php require "../includes/footer.php";?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>