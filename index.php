<?php
$server = "localhost";
$user = "root";
$pass = "";
$database   = "akademik";

$koneksi = mysqli_connect($server, $user, $pass, $database);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}


//Jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {

    //Pengujian data diedit atau disimpan baru
    if ($_GET['hal'] == "edit") {

        //Data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE mahasiswa set
                                        nim = '$_POST[tnim]',
                                        nama = '$_POST[tnama]',
                                        gender = '$_POST[tgender]',
                                        alamat = '$_POST[talamat]',
                                        prodi = '$_POST[tprodi]',
                                        ukm = '$_POST[tukm]'
                                        WHERE id_mhs = '$_GET[id]'");
        if ($edit) { //Jika edit Sukses
            echo "<script>
                    alert('Edit data suksess!');
                    document.location='index.php';
                 </script>";
        } else { //Jika edit gagal
            echo "<script>
                    alert('Edit data gagal!');
                    document.location='index.php';
                 </script>";
        }

    } else {

        //Data akan disimpan baru
        $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, gender, alamat, prodi, ukm)
                                          VALUES ('$_POST[tnim]',
                                                 '$_POST[tnama]',
                                                 '$_POST[tgender]',
                                                 '$_POST[talamat]',
                                                 '$_POST[tprodi]',
                                                 '$_POST[tukm]')");
        if ($simpan) { //Jika simpan Sukses
            echo "<script>
                    alert('Simpan data suksess!');
                    document.location='index.php';
                 </script>";
        } else { //Jika simpan gagal
            echo "<script>
                    alert('Simpan data gagal!');
                    document.location='index.php';
                 </script>";
        }
    }
}

//Pengujian Jika tombol Edit/Hapus diklik
if (isset($_GET['hal'])) {

    //Pengujian Edit Data
    if ($_GET['hal'] == "edit") {

        //Tampilkan Data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mhs = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {

            //Jika data ditemukan, maka data ditampung  ke dalam variabel
            $vnim = $data['nim'];
            $vnama = $data['nama'];
            $vgender = $data['gender'];
            $valamat = $data['alamat'];
            $vprodi = $data['prodi'];
            $vukm = $data['ukm'];
        }
    } else if ($_GET['hal'] == "hapus"){

        //Persiapan Hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa where id_mhs = '$_GET[id]'");
        if($hapus){
            echo "<script>
                    alert('Hapus data Success!');
                    document.location='index.php';
                 </script>";
        }

    }
}

        // Pencarian data
    if(isset($_POST['bcari'])){
        $keyword = $_POST['tcari'];
        $q = "SELECT * FROM mahasiswa WHERE nim like '%$keyword%'
                or nama like'%$keyword%' or gender like'%$keyword%'
                or alamat like'%$keyword%' or prodi like'%$keyword%'
                or ukm like'%$keyword%' order by id_mhs desc ";
    }else {
        $q = "SELECT * from mahasiswa order by id_mhs desc";
    }
?>
    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background-color: #37306B;">
    <div class="container">
        <!-- Awal Card Form -->

        <!-- Memasukkan Data -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Form Input Data Mahasiswa
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="tnim" value="<?= @$vnim ?>" class="form-control" placeholder="Input NIM anda disini!" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="tnama" value="<?= @$vnama ?>" class="form-control" placeholder="Input Nama anda disini!" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="tgender">
                            <option value="<?= @$vgender?>"><?= @$vgender ?></option>
                            <option values="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="talamat" placeholder="Input Alamat anda disini"><?= @$valamat ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select class="form-control" name="tprodi">
                            <option value="<?= @$vprodi ?>"><?= @$vprodi ?></option>
                            <option values="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            <option value="Teknik Sipil">Teknik Sipil</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>UKM</label>
                        <input type="text" name="tukm" value="<?= @$vukm ?>" class="form-control" placeholder="Input UKM anda disini!" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="breset">Kosongkan</button>
                </form>
            </div>
        </div>
        <!-- Akhir Card Form -->

        <!-- Awal Card table -->

        <!-- Memasukkan Data -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                Data Mahasiswa
                <form action="" method="POST">
                    <input type="text"  name="tcari" class="form-control-sm" size="40" autofocus
                    placeholder="Masukkan keyword yang dicari" autocomplete="off">
                    <button type="submit" class="btn btn-primary" name="bcari"><ion-icon name="search-outline"></ion-icon></button>
                    <button type="submit" class="btn btn-danger" name="breset">Reset</button>
                </form>
            </div>
            
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nomor</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Program Studi</th>
                        <th>UKM</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, $q);
                    while ($data = mysqli_fetch_array($tampil)) :

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nim'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['gender']?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['prodi'] ?></td>
                            <td><?= $data['ukm']?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?=$data['id_mhs'] ?>" class="btn btn-warning"> Edit </a>
                                <a href="index.php?hal=hapus&id=<?=$data['id_mhs'] ?>" 
                                onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                            </td>
                        </tr>
                    <?php endwhile; //penutup perulangan while 
                    ?>
                </table>

            </div>
        </div>
        <!-- Akhir Card Table-->
        <div style="padding-right: 100px;">
                <a class="btn btn-danger" aria-current="page" href="login.php?logout=1">Logout</a>
        </div>


    </div>
    <script src="css/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>