<?php
      if(isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0))
      {
            $query = "SELECT quote, source, favorite FROM quotes WHERE id={$_GET['id']}";
            if($result = mysqli_query($dbc, $query))
            {
                  $row = mysqli_fetch_array($result);

                  echo '
                  <form action="edit_quote.php" method="POST">
                        <p><label>Trích dẫn <textarea type="text" name="quote" row="5" cols="30">' 
                        . htmlspecialchars($row['quote']) .
                         '</textarea></label>
                         </p>
                  <p><label>Nguồn <input type="text" name="source" value="' 
                  . htmlspecialchars($row['quote']) .
                   '"></label>
                   </p>
                  <p><label>
                  Đay là trích dẫn được yêu thích? <input type="checkbox" name="favorite" value="yes"';

                  if($row['favorite'] == 1){
                        echo 'checked="checked';
                  }

                  echo '></label></p>
                  <input type="hidden" name="id" value="' . $_GET['id'] . '">
                  <p><input type="submit" name="submit" value="Cập nhật Trích dẫn này!"></p>
                  </form>';
            }else {
                  echo '<p class="error">Không thể lấy dữ liệu vì:<br>' . mysqli_error($dbc) .
                  '</p><p>Câu truy vấn là:' . $query . '</p>';
            }
      }elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0))
      {
            $problems = FALSE;
            if(!empty($_POST['quote']) && !empty($_POST['source'])){
                  if(isset($_POST['favorite'])){
                        $favorite = 1;
                  }else {
                        $favorite = 0;
                  }
            }else {
                  echo '<p class="error">Hãy gõ câu Trích dẫn và Nguồn của nó!</p>';
                  $problems = TRUE;
            }

            if(!$problems){
                  $queey = "UPDATE quotes SET quote=?, source=?, favorite=? WHERE id=?";
                  $stmt = mysqli_prepare($dbc, $query);
                  mysqli_stmt_bind_param($stmt, "ssi", $_POST['quote'], $_POST['source'], $favorite, $_POST['id']);

                  if($result = mysqli_stmt_execute($stmt)){
                        echo '<p>Trích dẫn này đã được cập nhật</p>';
                  }else{
                        echo '<p class="error">Không thể cập nhật trích dẫn vì:<br>' . mysqli_error($dbc) .
                        '</p><p>Câu truy vấn là:' . $query . '</p>';
                  }
            }else {
                  echo '<p class="error">Đã có lỗi xảy ra!</p>';
            }
      }
?>
