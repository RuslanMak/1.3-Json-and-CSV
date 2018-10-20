<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Учот расходов</title>
</head>
<body>
 <h1>Учот расходов</h1>
  <form method="post">
      <fieldset>
          <p>Введите данные о покупке</p>
              <input type="date" name="date-add">
              <input type="number" name="price" step="0.01" placeholder="сумма в формате 256.55">
              <input type="text" name="description" placeholder="описание">
              <input type="submit" name="add" value="Внести данные">   
      </fieldset>
  </form>
  
  <?php
    if(isset($_POST['add'])) {
      if( empty($_POST['date-add']) || empty($_POST['price']) || empty($_POST['description']) ) {
        echo 'Заполните все поля формы!';
      } else {

        $result[] = $_POST['date-add'];
        $result[] = trim($_POST['price']);
        $result[] = trim($_POST['description']);

        $file = fopen('money.csv', 'ab');
        
        if($file !== false) {
          fputcsv($file, $result);
          echo '<h3>Новая записи добавлена успешно!</h3>';
        }
      
        fclose($file);
      }
    }
  ?>
  
<!-- get sum -->
  <form method="post">
      <fieldset>
          <p>Затраты дня</p>
              <input type="date" name="date-from" required>
              <input type="date" name="date-to" required>
              <input type="submit" name="total-price" value="Получить затраты">
      </fieldset>
  </form>
  
  <?php
    if(isset($_POST['total-price'])) {

      $dataFrom = $_POST['date-from'];
      $dataTo = $_POST['date-to'];

      $file = fopen('money.csv', "r");
      while ($data = fgetcsv($file, 0, ",")) {
        $list[] = $data;
      }

      fclose($file);
      
      if(isset($list)) {
        foreach($list as $item) {
          if($item[0] >= $dataFrom && $item[0] <= $dataTo) {
            $totalPrice += $item[1];
          }
        }
        
        if($totalPrice > 0) {
          echo "<h4>За период с $dataFrom по $dataTo затрачено на суму $totalPrice</h4>";
        } else {
          echo "<h4>За период с $dataFrom по $dataTo покупки отсутствуют!</h4>";
        }

      } else {
        echo "Записи отсутствуют!";
      }
      
    }
  ?>
  
</body>
</html>