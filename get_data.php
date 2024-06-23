<?php
header("Content-Type: application/json; charset=UTF-8");
include 'db.php';

  if(isset($_GET['query'])){
    $keyword = $_GET['query'];
    $query = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_status = 1 AND product_name LIKE '%".$keyword."%' ORDER BY product_id LIMIT 10");
 
    while ($data = mysqli_fetch_array($query)) {
        $output['suggestions'][] = [
            'value' => $data['product_name'],
            'nama'  => $data['product_name']
        ];
    }
 
    if (! empty($output)) {
        echo json_encode($output);
    }
  }
