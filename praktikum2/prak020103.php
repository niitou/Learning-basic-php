<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Basic PHP</title>
</head>
<body>
    <header class="container-fluid" style="background-color: black;height:100px;display:flex;align-items:center;flex-direction:column;justify-content:center;margin-bottom:25px;">
        <h1 style="color:green;font-size:calc(10px+2vmin);">Learning Basic PHP</h1>
    </header>
    <?php
        for ($i=01; $i <= 6 ; $i++) { 
            if ($i % 2 == 0){
                echo ("<h${i} style=color:red;>Heading ${i}</h${i}>");
            }
            else{
                echo ("<h${i}>Heading ${i}</h${i}>");
            }
            
        }
 	?>
</body>
</html>