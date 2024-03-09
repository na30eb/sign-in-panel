<?php
include("config.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css"> 

</head>
<body>
   
<div class="container">
	<table>
		<thead>
			<tr>
				<th>name</th>
				<th>family</th>
				<th>password</th>
				<th>Email</th>
				<th>avatar</th>
                <th>file</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $username; ?></td>
				<td><?php echo $family; ?></td>
				<td><?php echo $password; ?></td>
				<td><?php echo $email; ?></td>
				<td><img src="<?php echo $targetfile;?>" width="40px" height="60px" alt="<?php echo $username," avartar" ?>" ></td>
                <td>
                <form action="infofile.php" method="post">
                    <input type="submit" value="user log">
                </form>
                </td>

			</tr>




		</tbody>
	</table>
</div>
    
</body>
</html>