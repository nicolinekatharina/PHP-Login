
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Login System</title>
<?php echo '<link rel="stylesheet" type="text/css" href="phploginsystem.css">'; ?>
</head>

<body>
<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Mangler/forkert udfyldning af brugernavn.');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Mangler/forkert udfyldning af password.');
	$pw = password_hash($pw, PASSWORD_DEFAULT);
	$submit = filter_input(INPUT_POST, 'submit');
	
	
//	echo 'Opretter bruger<br>'.$un.' : '.$pw;
	
	if($submit == 'Opret') {
	require_once('db_con.php');
	$sql = 'INSERT INTO users (username, pwhash) VALUES (?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute();
	
	if($stmt->affected_rows > 0){
		echo 'Brugeren '.$un.' er nu oprettet i databasen.';
	}
	else {
		echo '<p>Kunne ikke oprette brugeren i databasen, prøv et andet brugernavn.<p>';
	}
	}
}
	
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Mangler/forkert udfyldning af brugernavn.');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Mangler/forkert udfyldning af Password.');
	require_once('db_con.php');
	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	
	while($stmt->fetch()) { }
	
	if (password_verify($pw, $pwhash)){
		echo '<script language="javascript">window.alert("Du er nu logget ind");';
    echo 'top.location.href = "secretcontentpage.php";';
    echo '</script>'; 
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $un;
		
	}
	else{
		echo '<p>Brugernavn og password passer ikke sammen.</p>';
	}
	
}
	
?>
<div class="content">
<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	
    	<input name="un" class="textbox user" type="text"     placeholder=" Brugernavn" required /><br>
    	<input name="pw" class="textbox lock" type="password" placeholder=" Password"   required /><br><br>
    	<input name="submit" class="button" type="submit" value="Opret" />
    	<input name="submit" class="button" type="submit" value="Log på" />
	
</form>
</p>
</div>
</body>
</html>