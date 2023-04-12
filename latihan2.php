<?php
$url = 'https://tifupb.id/tugas1';
$data = file_get_contents($url);
$absensi = json_decode($data, true);
$total_absensi = count($absensi);
$data_per_halaman = 7;
$total_halaman = ceil($total_absensi / $data_per_halaman);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_index = ($page - 1) * $data_per_halaman;
$end_index = $start_index + $data_per_halaman - 1;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
  <div>
    <nav class="navbar bg-primary">
      <div class="container-fluid">
        <a href="" class="text-white" style="text-decoration: none; font-size: 23px;"><img src="img/upb.png" alt="" style="width: 58px; height: 50px;"> Universitas Pelita Bangsa</a>
      </div>
    </nav>
  </div>
  <table class="table caption-top">
  <caption class="my-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg> Data Mahasiswa</caption>
  <thead class="table-primary">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">P1</th>
      <th scope="col">P2</th>
      <th scope="col">P3</th>
      <th scope="col">P4</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="table-secondary">
  <?php
      for ($i = $start_index; $i <= $end_index && $i < $total_absensi; $i++) {
        echo '<tr>';
        echo '<td>' . ($i + 1) . '</td>';
        echo '<td>' . $absensi[$i]['NIM'] . '</td>';
        echo '<td>' . $absensi[$i]['Nama'] . '</td>';
        echo '<td>' . ($absensi[$i]['1'] == 'S' ? 'Sakit' : ($absensi[$i]['1'] == 'I' ? 'Izin' : ($absensi[$i]['1'] == '-' ? 'Tidak Masuk' : 'Masuk'))) . '</td>';
        echo '<td>' . ($absensi[$i]['2'] == 'S' ? 'Sakit' : ($absensi[$i]['2'] == 'I' ? 'Izin' : ($absensi[$i]['2'] == '-' ? 'Tidak Masuk' : 'Masuk'))) . '</td>';
        echo '<td>' . ($absensi[$i]['3'] == 'S' ? 'Sakit' : ($absensi[$i]['3'] == 'I' ? 'Izin' : ($absensi[$i]['3'] == '-' ? 'Tidak Masuk' : 'Masuk'))) . '</td>';
        echo '<td>' . ($absensi[$i]['4'] == 'S' ? 'Sakit' : ($absensi[$i]['4'] == 'I' ? 'Izin' : ($absensi[$i]['4'] == '-' ? 'Tidak Masuk' : 'Masuk'))) . '</td>';
        echo '<td><button type="button" class="btn btn-primary" onclick="showModal('.$absensi[$i]['NO'].')" data-no="'.$absensi[$i]['NO'].'">Lihat Detail</button></td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    ?>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
    echo '<li class="page-item"><a class="page-link" href="?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span></a>
          </li>';
    for ($i = 1; $i <= $total_halaman; $i++) {
      echo '<link class="page-item"><a class="page-link" href="?page=' . $i . '"';
       if ($i == $page) {
         echo ' class="active"';
          }
          echo '> ' . $i . '  </a>';
        }
      echo'<li class="page-item"><a class="page-link" href="?page=' . $total_halaman. '" aria-label="Next">
          <span aria-hidden="true">&raquo;</span></a>
      </li>
    </ul>'
    ?>
</nav>
<div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<footer class="bg-primary" style="text-align: center; padding: 10px; color: white; position: fixed; left: 0; bottom: 0; width: 100%;">
  <h6>&copy; 2023, Universitas Pelita Bangsa</h6>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script>
      const modal = document.querySelector('.modal');
      const showModal = (no) => {
        modal.style.display = 'block';
        const userData = <?php echo json_encode($absensi); ?>;
        const absensiData = userData.find(user => user.NO == no);
        userData.forEach(user => {
          for (const key in user) {
            if (user[key] === 'M') {
              user[key] = 'Masuk';
            }
          }
        });
        const modalHeader = document.querySelector('.modal-header');
        const modalBody = document.querySelector('.modal-body');
        modalHeader.innerHTML = `<h2>Absensi ${absensiData.NIM}</h2>`;
        modalBody.innerHTML = `
          <p><strong>NIM:</strong> ${absensiData.NIM}</p>
          <p><strong>Nama:</strong> ${absensiData.Nama}</p>
          <p><strong>Pertemuan 1:</strong> ${absensiData['1']}</p>
          <p><strong>Pertemuan 2:</strong> ${absensiData['2']}</p>
          <p><strong>Pertemuan 3:</strong> ${absensiData['3']}</p>
          <p><strong>Pertemuan 4:</strong> ${absensiData['4']}</p>`;
      }

      window.addEventListener('click', (event) => {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    </script>
  </body>
</html>