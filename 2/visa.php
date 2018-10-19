<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Учот расходов</title>
</head>
<body>
 
  <form method="post">
      <fieldset>
          <p>Затраты дня</p>
              <input type="text" name="country" required>
              <input type="submit" name="countries" value="Получить">
      </fieldset>
  </form>
  
  <?php
    if(isset($_POST['countries'])) {

      $country = $_POST['country'];
      
      $file = fopen('money.csv', "r");
      
      if($file !== false) {
        while ($data = fgetcsv($file, 0, ",")) {
          $list[] = $data;
        }
        fclose($file);
      } else {
        echo 'Ошибка соединения!';
        exit;
      }
      
      echo 'is it ok';
      if(isset($list)) {
          foreach($list as $item) {
            if($item[0] >= $dataFrom && $item[0] <= $dataTo) {
              $totalPrice += $item[1];
            }
          }

        } else {
          echo "Записи отсутствуют!";
        }

    }
  ?>
  
</body>
</html>