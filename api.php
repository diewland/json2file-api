<?php
  header('Content-Type: application/json');
  echo json_encode(
    array(
      'int' => 99,
      'float' => 765.433,
      's' => 'helloworld',
      'bool1' => true,
      'bool2' => false,
    )
  );
  exit;
?>
