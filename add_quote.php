<?php
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!empty($_POST['quote']) && !empty($_POST['source'])){

                  include "../mysqli_connect.php";

                  if(isset($_POST['favorite'])){
                        $favorite = 1;
                  }else {
                        $favorite = 0;
                  }

                  $query = "INSERT INTO quotes (quote, source, favorite) VALUES (?, ?, ?)";
                  $stmt = mysqli_prepare($dbc, $query);
                  mysqli_stmt_bind_param($stmt, "ssi", $_POST['quote'], $_POST['source'], $favorite);

                  mysqli_stmt_execute($stmt);

                  if(mysqli_stmt_affected_rows($stmt) == 1){
                        echo '<p>Trích dẫn của bạn đã được lưu trữ</p>';
                  }else{
                        echo '
                        <p class="error">Không thể lữu trữ trích dẫn vì:<br>
                        ' . mysqli_error($dbc) .
                        '</p><p>Câu truy vấn là:' 
                        . $query .
                         '</p>';
                  }

                  mysqli_close($dbc);
            }else {
                  echo '<p class="error">
                        Hãy gõ câu Trích dẫn và Nguồn của nó!
                  </p>';
            }
      }

?>