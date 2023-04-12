<?php
$url = 'https://tifupb.id/data';
$data = file_get_contents($url);
$mahasiswa = json_decode($data, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan 1</title>
</head>
<body>
  <h3>Data Mahasiswa</h3>
  <table border="1px">
    <tr>
      <th>No.</th>
      <th>Nama</th>
    </tr>
  <?php 
  $no = 1;
  foreach ($mahasiswa as $item){
    echo "<tr>";
    echo "<td>" . $no. "</td>";
    echo "<td>" . $item['Nama']. "</td>";
    echo "</tr>";
    $no+=1;
  }
  ?>
  </table>
</body>
</html>