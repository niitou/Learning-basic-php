<?php
if (isset($_COOKIE['active'])) {

    include("./header.php");
    require("./safe.php");
    headerDecor();
    date_default_timezone_set("Asia/Jakarta");
    // $bil = rand(0, 100);
    
    $score = 0;
    $bil = intval(decryption($_COOKIE['random']));
    echo ('
        <p>
            <strong>
                Hallo, nama saya Mr. PHP. Saya telah memilih secara random sebuah bilangan bulat. Silakan Anda menebak ya!
                Hallo, nama saya Mr. PHP. Saya telah memilih secara random sebuah bilangan bulat. Silakan Anda menebak ya!
            </strong>
        </p>
        <form  method="get">
            Tebakan Anda <input type="text" name="tebak"> <input type="submit" value="Submit">
        </form>    
        ');


    if (isset($_GET['tebak'])) {
        $guess = $_GET['tebak'];
        if ($guess > $bil) {
            echo ("
                Waaah… masih salah ya, bilangan tebakan Anda terlalu tinggi.
                ");
        } else if ($guess < $bil) {
            echo ("
                Waaah… masih salah ya, bilangan tebakan Anda terlalu rendah.
                    ");
        } else {
            setcookie('random', "", time() - 24 * 3600);
            echo "Selamat ya… Anda benar, saya telah memilih bilangan $bil.";

            echo '<a href="game.php">Restart</a>';
            setcookie('random', encryption(strval(rand(0, 100))), time() + 24 * 3600);
        }
    }
} else {
    echo ('<script>alert("Silahkan Login Terlebih Dahulu");
            window.location.href=(\'login.php\')
        </script>');
}