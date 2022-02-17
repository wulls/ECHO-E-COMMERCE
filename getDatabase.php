<?php

// get product from the database
public function getData(){
    $sql = "SELECT * FROM $this->tablename";

    $result = mysqli_query($this->con, $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}
