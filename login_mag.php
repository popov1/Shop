<?php 
 include ("header.php");
?>

<?php
	session_start();
	?>

	<?php
	
	if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: admin.php");
	}

	if(isset($_POST["login"]))
	{

	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
     include_once("connect_db.php");
	 @mysql_connect($sdd_db_host,$sdd_db_user,$sdd_db_pass); // коннект с сервером бд
	 @mysql_select_db($sdd_db_name); // выбор бд	 
	 @mysql_query('SET names "utf8"'); 
	 $username=htmlspecialchars($_POST['username']);
	 $password=htmlspecialchars($_POST['password']);
	 @mysql_query('SET names "utf8"'); 
	 $query =mysql_query("SELECT * FROM user WHERE Login='".$username."' AND Password='".$password."'");
	 $numrows=mysql_num_rows($query);
	 if($numrows!=0)
	 {
      while($row=mysql_fetch_assoc($query))
      {
	   $dbusername=$row['Login'];
       $dbpassword=$row['Password'];
	   $dbuseropis=$row['Name']; 
      }
       if($username == $dbusername && $password == $dbpassword)
        {
	     $_SESSION['session_username']=$username;	
	     $_SESSION['useropis']=$dbuseropis;
	     header("Location: admin.php");
        }
    }
    else
    {
 	//  $message = "Invalid username or password!"; 
	
	 echo  "Введено неверное имя или пароль!";
    }
  }
   else
   {
    $message = "Все поля должні біть заполнены!";
   }
  }
?>

<div class='container mlogin'>
<div id='login'>
<h1>Вход</h1>
<form id='loginform' method='post' name='loginform' align = 'center'>
<p><label for="user_login">Имя пользователя<br>
<input class='input' id='username' name='username' size='20'
type='text' value=''></label></p>
<p><label for='user_pass'>Пароль<br>
 <input class='input' id='password' name='password' size='20'
  type='password' value=''></label></p> 
	<p class='submit'><input class='button' name='login' type= 'submit' value='Войти' align = 'center'></p>
	<p class='regtext'>Еще не зарегистрированы?<a href= 'register.php'>Регистрация</a>!</p>
   </form>
 </div>
 </div>
<br/>
  
<?php include("footer.php"); ?>  