
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/w3.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<style>
		.table td,.table th{
			vertical-align:middle ;
		}
	</style>

    <title>NOTE60</title>
</head>

                    <?php
			date_default_timezone_set("Asia/Bangkok");
			include('config.php');	
			$con = mysqli_connect($host,$username,$password,$Database);
			mysqli_query($con,"SET NAMES UTF8");
			//session_start();

			if(!(empty($_POST['DELETE']))){
                        	$sql = "delete from F_NOTE where ID_NOTE =".$_POST['DELETE'];
				$result = $con->query($sql);
				echo "<script>window.location = '/~60160272/note/' </script>";
				
			}else{
                        	$sql = "select * from F_NOTE where ID_NOTE = ". $_POST['ID_NOTE'] ;
			}
			$result = $con->query($sql);
		
			if ($result->num_rows > 0) {
				$NoteData = $result->fetch_assoc() ;
			}else{
				echo "<script>window.location = '/~60160272/note/' </script>";
			}
                    ?>
<body style = 'background:#F9F9F9'>
    <nav class="navbar navbar-dark bg-dark">
        <a href="https://angsila.informatics.buu.ac.th/~60160272/note" class="navbar-brand text-white">หน้าหลัก</a>
        <button class="btn btn-outline-light" onclick = 'window.location = "addNote.php"'>เพิ่มโน็ต</button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="mx-auto col-sm-10">
		<h2>หัวข้อ : <?php echo $NoteData['NOTE_TITLE'] ?> </h2>
		<p><textarea class = 'form-control' style = 'width : -webkit-fill-available; height : 84vh'> <?php echo $NoteData['NOTE_DETAIL'] ?></textarea> </p>
		<div>
		<br>
		<form action = 'viewNote.php'  method = 'POST' >
		<button  onclick = 'return confirm("คุณต้องการลบใช่หรือไม่")'  class = 'btn btn-danger'>
			Delete 
		</button>
		<input type = 'hidden' name = 'DELETE'  value = '<?php echo $NoteData['ID_NOTE'] ?>' > 
		</form>

		</div>
	    </div>
	</div>
    </div>
</body>
