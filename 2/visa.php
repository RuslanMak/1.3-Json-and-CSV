<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Учот расходов</title>
</head>
<body>
 
  <form method="post">
      <fieldset>
          <p>Выберите страну</p>
              <input type="text" name="country" required>
              <input type="submit" name="countries" value="Получить">
      </fieldset>
  </form>
  
  <?php
    if(isset($_POST['countries'])) {

      $country = $_POST['country'];
      
      $file = fopen('visa.csv', 'r');
      
      if($file !== false) {
        while ($data = fgetcsv($file, 0, ",")) {
          $list[] = $data;
        }
        fclose($file);
      } else {
        echo 'Ошибка соединения!';
        exit;
      }
      
      foreach($list as $key => $value) {
        
        foreach($value as $k => $v) {
          if($v === $country) {
            echo "<h2>$v: $value[4]</h2>";
            exit;
          }
        }
        
      }
    }
  ?>
  
</body>
</html>