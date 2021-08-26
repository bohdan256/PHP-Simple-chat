<?php
require("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>SimpleChat</title>
	<meta charset="utf-8">
	<style type="text/css">
		.chat {
			height: 300px;
			width: 415px;
			border: 1px solid black;
			overflow: auto;
		}
		.nick {
			width: 415px;
			color: green;
		}
		.date {
			color: blue;
		}
		.message {
			width: 415px;
			height: 100px;
		}
	</style>
</head>
<body>
	<div>
		<div class="chat">
			<?php
			$table = mysqli_query($link, "SELECT * FROM chat"); // SELECT * FROM you table in database"
			while ($row = mysqli_fetch_array($table)) {
				echo "<span class=\"date\">" . $row["date"] . "</span>" . " " . "<span class=\"nick\">" . valid($row["nick"]) . "</span>" . " " . valid($row["message"]) . "<br>";
			}
			?>
		</div>
		<div class="submess">
			<form method="post">
				<input type="text" name="nickname" class="nick" placeholder="You nick"><br>
				<textarea name="message" class="message" placeholder="You message"></textarea> <br>
				<input type="submit">
			</form>
		</div>
	<div>
</body>
</html>
<?php

function valid($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = strip_tags($data);
	return $data;
}

$nick = "";
$mess = "";
$date = date("Y-m-d H:i:s");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (empty($_POST["nickname"])) {
		$nick = "annon";
	} else {
		$nick = valid($_POST["nickname"]);
	}
	if (empty($_POST["message"])) {
		$mess = "empty message";
	} else {
		$mess = valid($_POST["message"]);
	}

	$insert = "INSERT INTO chat (nick, message, date)
						VALUES(\"$nick\" , \"$mess\", \"$date\")";

	mysqli_query($link, $insert);
	header("refresh:0");
}
