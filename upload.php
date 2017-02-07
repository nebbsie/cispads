<?php

echo "yo";

if(!empty($_POST['img_val2'])){
    $data = $_POST['img_val2'];
    $fname = "test.pdf"; // name the file
    $file = fopen($fname, 'w'); // open the file path
    fwrite($file, $data); //save data
    fclose($file);
} else {
    echo "No Data Sent";
}


?>