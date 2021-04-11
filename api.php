<?php
  header('Content-Type: application/json');

  // get variables from request
  $filename = $_GET['filename'] ?: 'default.json';
  $json_str = file_get_contents('php://input');

  // validate file extension
  if (pathinfo($filename)['extension'] != 'json') {
    $result = array('err' => "support json file only");
    echo json_encode($result);
    exit();
  }

  // prepare data path
  $data_path = "./data/$filename";

  // api#1 write data
  // [POST] /api.php?filename=default.json
  if ($json_str) {

    $fp = fopen($data_path, 'w');
    fwrite($fp, $json_str);
    fclose($fp);

    $result = array('data' => json_decode($json_str));
    echo json_encode($result);
  }

  // api#2 read data
  // [GET] /api.php?filename=default.json
  else {
    $result = array();
    if (file_exists($data_path)) {
      $result['data'] = json_decode(file_get_contents($data_path));
    }
    else {
      $result['err'] = "$filename not found";
    }
    echo json_encode($result);
  }

  exit;
?>
