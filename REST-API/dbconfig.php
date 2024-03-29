<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'universitas';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$conn){
        die("Connection Error   : ".mysqli_connect_error($conn));
    }


    function getMahasiswa($id="0"){
        global $conn;
        $respon = array();
        $respon['Kode'] = 200;
        http_response_code(200);
        $respon['Status'] = 'Sukses';
        $respon['Data'] = array();
        if($id === "0"){
            $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE 1 ORDER BY nim");
            $index = 0;
            while($data = mysqli_fetch_array($result)){
                $mhs_data = array(
                    'NIM' => $data['nim'],
                    'Nama' => $data['nama'],
                    'Angkatan' => $data['angkatan'],
                    'Semester' => $data['semester'],
                    'IPK' => $data['ipk']
                );
                $respon['Data'][$index] = $mhs_data;
                $index++;
                // array_push($respon['Data'], $mhs_data);
            }
        }else{
            $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = $id");
            if(!$result || mysqli_num_rows($result) === 0){
                http_response_code(404);
                $respon['Kode'] = 404;
                $respon['Status'] = 'Gagal, Data Tidak Ditemukan';
                $respon['Message'] = (mysqli_error($conn)  === "")? "Data tidak ada dalam database" : mysqli_error($conn);
            }else{
                $data = mysqli_fetch_assoc($result);
                $mhs_data = array(
                    'NIM' => $data['nim'],
                    'Nama' => $data['nama'],
                    'Angkatan' => $data['angkatan'],
                    'Semester' => $data['semester'],
                    'IPK' => $data['ipk']
                );

                array_push($respon['Data'], $mhs_data);
            }

        }
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($respon);
    }


    function insertMahasiswa(){
        $respon = array();
        global $conn;
        $data = json_decode(file_get_contents("php://input"), true);
        $nim = $data['nim'];
        $nama = $data['nama'];
        $angkatan = $data['angkatan'];
        $semester = $data['semester'];
        $ipk = $data['ipk']; 

        $result = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, angkatan, semester, ipk) VALUES ('$nim', '$nama', '$angkatan', '$semester', '$ipk')");
        if($result){
            http_response_code(200);
            $respon['Kode'] = 200;
            $respon['Status'] = "Sukses, Memasukkan Data";
            $respon['Data'] = [
                "Nim" => $nim,
                "Nama" => $nama,
                "Angkatan" => $angkatan,
                "Semester" => $semester,
                "Ipk" => $ipk
            ];
        }else{
            http_response_code(400);
            $respon['Kode'] = 400;
            $respon['Status'] = "Gagal, Memasukkan Data";
            $respon['Message'] = (mysqli_error($conn)  === "")? "Data tidak ada dalam database" : mysqli_error($conn);
        }

        header("Accept: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($respon);
    }

    function updateMahasiswa($id){
        global $conn;
        $respon = array();
        if(empty($id)){
            http_response_code(404);
            $respon['Kode'] = 404;
            $respon['Status'] = "Gagal, Data Tidak Ditemukan";
        }else{
            if(checkMahasiswa($id) === true){
                $data = json_decode(file_get_contents("php://input"), true);
                $nim = $data['nim'];
                $nama = $data['nama'];
                $angkatan = $data['angkatan'];
                $semester = $data['semester'];
                $ipk = $data['ipk']; 
                $result = mysqli_query($conn, "UPDATE mahasiswa SET nim='{$nim}', nama='{$nama}', angkatan='{$angkatan}', semester='{$semester}', ipk='{$ipk}' WHERE mahasiswa.nim = $id");
                if($result){
                    http_response_code(200);
                    $respon['Kode'] = 200;
                    $respon['Status'] = "Sukses, Data Telah Diupdate";
                    $respon['Data'] = [
                        "Nim" => $nim,
                        "Nama" => $nama,
                        "Angkatan" => $angkatan,
                        "Semester" => $semester,
                        "Ipk" => $ipk
                    ];
                }else{
                    http_response_code(400);
                    $respon['Kode'] = 400;
                    $respon['Status'] = "Gagal, Data Gagal Diupdate";
                    $respon['Message'] = mysqli_error($conn) === "" ? "Data tidak ditemukan di database" : mysqli_error($conn);
                }
            }else{
                $respon = checkMahasiswa($id);
            }
        }
        header("Accept: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($respon);
    }

    function deleteMahasiswa($id){
        global $conn;
        $respon = array();
        if(checkMahasiswa($id) === true){
            $result = mysqli_query($conn, "DELETE FROM mahasiswa WHERE mahasiswa.nim = $id");
            if($result){
                http_response_code(200);
                $respon['Kode'] = 200;
                $respon['Status'] = "Sukses, Data Telah Dihapus";
            }else{
                http_response_code(400);
                $respon['Kode'] = 400;
                $respon['Status'] = "Gagal, Data Gagal Dihapus";
                $respon['Message'] = mysqli_error($conn) === "" ? "Data tidak ditemukan di database" : mysqli_error($conn);
            }
        }else{
            $respon = checkMahasiswa($id);
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($respon);
    }

    function checkMahasiswa($id){
        global $conn;
        $respon = array();

        $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE mahasiswa.nim = $id");
        if(!$result || mysqli_num_rows($result) === 0){
            http_response_code(404);
            $respon['Kode'] = 404;
            $respon['Status'] = "Not Found";
            $respon['Message'] = "Data tidak ditemukan";
            return $respon;
        }else{
            return true;
        }
    }
?>