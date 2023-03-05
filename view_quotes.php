<?php
$query = "SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC";

if($result = mysqli_query($dbc, $query)){
	while($row = mysqli_fetch_array(($result))){
		$htmlspecialchars = "htmlspecialchars";
		echo "<div>
			<blockquote>
				{$htmlspecialchars($row['quote'])}
			</blockquote>-{$htmlspecialchars($row['source'])}
		<br>";

		if($row['favorite'] == 1)
		{
			echo ' <strong>Yêu thích!</strong>';
		}

		echo "<p>
		<b>Quản trị Trích dẫn:</b> 
		<a href=\"edit_quote.php?id={$row['id']}\">Sửa</a> 
		<=> <a href=\"delete_quote.php?id={$row['id']}\">Xóa</a>
		</p></div><br>";
	}
}else {
	echo '<p class="error">Không thể lấy dữ liệu vì: <br>' 
	. mysqli_error($dbc) . 
	'</p><p>Câu truy vấn là:' . $query . '</p>;';
}

mysqli_close($dbc)
?>