<p>В процессе пока</p>
<br/>
<div class="name">
<div class="Main_container" >
<h1>Добро пожаловать в Интернет-магазин шин и дисков  Shina24.com.ua</h1>
	<h2>Шина 24 предлагает Вашему вниманию автошины лидирующих мировых производителей.</h2>
</div>  
</div>

<div class="name" >
<div class="container" >
		<form method="POST" action ="viewpost_brend.php" >
		<fieldset>
		<legend>Фильтры</legend>
		<table border = 0 width = 100%><tr>
			<td>Наименование</td><td>Ширина</td><td>Профиль</td><td>Диаметр</td><td>Сезонность</td></tr>
			<tr><td><input type = 'text' name = 'Custom_name' size = 50></td><td><input type = 'text' name = 'nomer_zakaz'></td>
			<td><input type = 'text' name = 'date_zakaz'></td>
			<td>
				<select name = 'Select_RIM' title = 'Диаметр' size = 1>
				<option></option>
				<option>R12</option>				
				<option>R13</option>
				<option>R14</option>
				<option>R15</option>
				<option>R16</option>
				<option>R17</option>
				<option>R18</option>
				<option>R19</option>
				<option>R20</option>
				<option>R21</option>
				<option>R22</option>
				<option>R23</option>				
				</select>
			</td>
			<td>
				<select name = 'Select_Cond' title = 'Сезонность'>
				<option></option>
				<option>Зима</option>
				<option>Лето</option>
				<option>Всесезонное</option>
				</select>
			</td>
			</tr>
		   </table>		
		
		<select id="select1" name="Select1" wight ="22" size="1" title="Подбор шины по бренду"
		style="HEIGHT: 22px; WIDTH: 200px"  >
		<OPTION></OPTION>	
		<?php 
		include_once("connect_db.php");
		@mysql_query('SET names "utf8"'); 
		@mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
		@mysql_select_db($sdd_db_name); // выбор бд
		$result=mysql_query('SELECT * FROM `tyre` GROUP BY brend ASC'); // запрос на выборку
		while($row=mysql_fetch_array($result))
		{
			$brend = $row['brend'];	
		?>
		
		<OPTION value="<?php print ($brend) ?>">
		<?php print ($brend)?>
		</OPTION>
		<?php } ?>
		</select >	
		<button type="submit" name="find_brend" >Выполнить поиск</button>
		</fieldset>	
		</form>		
</div>
<div class="name">
<div class="container">
<?php 
		$kol_row = 0;
		@mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
		@mysql_select_db($sdd_db_name); // выбор бд
		$sql = "SELECT price, name, size, id FROM tyre ORDER BY ID ASC";
		$result = mysql_query($sql);
		$kol_row = mysql_num_rows($result); // количество строк в запросе
				
		$kol_per_page=10; // количество записей на странице
		
		 // если страницы не существует, выводим первую страницу
		if(!isset($_GET['str']))
		{
		 $str = 0;
		}
		else
		{
		 $str = $_GET['str'];
		}
		// получем номер начальной записи страницы
		$start = $str * $kol_per_page; 
		
		// запрос  
		$r = mysql_query("SELECT price, name, size, id FROM tyre ORDER BY ID ASC");
		$kol_row = mysql_num_rows($r);
		@mysql_query('SET names "utf8"'); 
		$r = mysql_query("SELECT price, name, size, id FROM tyre  ORDER BY ID ASC LIMIT $start, $kol_per_page ");
		$n = mysql_num_rows($r); // возвращаем число рядов результата запроса	

		// если страница не первая, выводим ссылку НАЗАД
		if ($str > 0)
		{
		 $p = $str - 1;
		 echo "<a href=viewpost.php?str=$p>НАЗАД</a>";
		}
		
		$str++;  // увеличиваем переменную $str на единицу;
		// выводим ссылку на следующие n записей, если она есть, 
		// то есть число записей, которые нужно вывести,
		// и смещение не превышает общего числа записей		
		if($start + $n < $kol_row)
		{
		  echo "<a href = viewpost.php?str=$str>ДАЛЕЕ</a>"; 
		} 

		echo "<table width = 100% cellspacing='1' cellpadding='5' border='1' align = 'left' >";
        echo "<tr><td width = 5% align = 'center'></td><td width = 60%>Наименование</td><td>Цена</td><td align = 'left'>Количество</td></tr>";		
		// выводим записи
		for ($i = 0; $i < $n; $i++)
		{
		 $row = mysql_fetch_array($r);
		 $price = $row[0];
		 $Brend = $row[1];
		 $Name = $row[2];
		 $ID = $row[3];	 
		 echo "<form  name='form' method='POST' action='checkbox-form.php' ><td width = 5% align = 'center'>
				<input type='checkbox' name='check_tyre_id[]' value='$ID'/></td><td width = 60%>$row[1]  $row[2]</td><td>$row[0]</td><td >
				<input type = 'text' name = 'text[]' value = ''/></td></tr>";		 
		}			 
	  echo "</table>";
	  echo "<br/>";
	  echo "<input type='submit' name='formSubmit' value='Оформить заказ' />";
	  echo "</form>"; 
?>	
</div>  
</div> 
<br/> 
