<?php

	if (!isset($_POST['signup']))
	{
		$username = filter_input(INPUT_POST, 'uname');
		$Phone = filter_input(INPUT_POST, 'Phonenumber');
		$useremail = filter_input(INPUT_POST, 'Emailid');
		$address = filter_input(INPUT_POST, 'Address');
		$password = filter_input(INPUT_POST, 'Password');
		$repassword = filter_input(INPUT_POST, 'ConfirmpasswordS');


		/*$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		$repassword = filter_input(INPUT_POST, 'repassword');*/
		if (Empty($username) /*or Empty($Phone) or Empty($useremail) or Empty($address) */or Empty($password ) )
		{
			echo "Fields can not be empty";
			die();
		}
		elseif (!($password == $repassword))
		{
			header("Location: ../html/signup.html?error=Passwordnotmatched&=".$username);
			exit();
		}
		else
		{
			$host = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "iwp";

			$conn = new mysqli($host,$dbuser, $dbpass, $dbname);

			if(mysqli_connect_error())
			{
				die('Connect Error('.mysqli_connect_errno().')'
				.mysqli_connect_error());
			}
			else
			{
				$user = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
				$results = mysqli_num_rows($user);
				if ($results>0)
				{
					header("Location: ../html/signup.html?error=usernamealreadyexists");
					exit();
				}
				else {
					$hashcode = password_hash($password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO iwp (username, phno, useremail, address, password) values ('$username','$Phone','$useremail',	'$address','$hashcode')";
					if($conn->query($sql))
					{
						define('signup',TRUE);
						header("Location: ../html/signup.html");
						/*
						require('header.php');
						header("header.php");*/
						exit();
					}
					else
					{
						echo "Error: ". $sql ."
						". $conn->error;
					}
					$conn->close();
				}
			}
		}
	}
	else
  {
    header("Location: ../html/signup.html");
    exit();
  }
?>
