<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Ujian CRUD</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: #;
      }
    table {
      border: solid 1px #FFF8DC;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #F3E8FF;
        border: solid 1px #DBDFEA;
        color: #2A2F4F;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DBDFEA;
        color: #282A3A;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: #393053;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    </style>
  </head>
  <body>
    <center><h1>Rangkaian skincare</h1><center>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah</a><center>
    <br/>
    <table>
      <thead>
      <form action="" method="POST">
			<input type="text" name="query" placeholder="Cari Data" />
			<input type="submit" name="cari" value="Search" />
		</form>
        <tr>
          <th>No</th>
          <th>Nama Skincare</th>
          <th>Dekripsi</th>
          <th>Pemakaian</th>
          <th>Harga</th>
          <th>Foto</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td><?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
          <td><?php echo $row['harga_jual']; ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
          <td>
              <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a> |
              <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
  </body>
</html>