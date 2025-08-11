<?php
include('conn/koneksi.php');

if(isset($_POST['nik'])){
    $nik = $_POST['nik'];
    $query = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik='$nik'");
    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data);
    } else {
        echo json_encode(null);
    }
} else {
    echo json_encode(null);
}
?>
