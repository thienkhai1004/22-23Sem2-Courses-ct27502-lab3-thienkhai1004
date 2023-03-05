<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0))
{
      $query = "SELECT quote, source, favorite FROM quotes WHERE id={$_GET['id']}";
      if($result = mysqli_query($dbc, $query))
      {
            $row = mysqli_fetch_array($result);

            echo '<form action="delete_quote.php" method="POST">
            <p>Bạn có chắc là muốn xóa trích dẫn này?</p>
            <div><blockquote>' 
            . htmlspecialchars($row['quote']) .
                  '</blockquote> -' 
                  . htmlspecialchars($row['source']);

            if($row['favorite'] == 1)
            {
                  echo '<strong>Yêu thích!</strong>';
            }

            echo '</div><br>
            <input type="hidden" name="id" value="' . $_GET['id']. '">
            <p><input type="submit" name="submit" value="Xóa Trích dẫn này!"></p>
            </form>';
      }else {
            echo '<p class="error">Không thể lấy dữ liệu vì:<br>' 
            . mysqli_error($dbc) .
            '</p><p>Câu truy vấn là:' . $query . '</p>';
      }
}elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0))
{
            $query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
            $result = mysqli_query($dbc, $query);

            if(mysqli_affected_rows($dbc) == 1){
                  echo '<p>Trích dẫn này đã bị xóa</p>';
            }else{
                  echo '
                  <p class="error">Không thể xóa trích dẫn vì:<br>' 
                  . mysqli_error($dbc) .
                  '</p><p>Câu truy vấn là:' . $query . '</p>';
            }
}else {
      echo '<p class="error">Đã có lỗi xảy ra!</p>'; 
}
?>
