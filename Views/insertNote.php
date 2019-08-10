                    <?php
					date_default_timezone_set("Asia/Bangkok");
					include('config.php');
					$con = mysqli_connect($host, $username, $password, $Database);
					mysqli_query($con, "SET NAMES UTF8");
					//session_start();
					$NOTE_TITLE = $_POST['NOTE_TITLE'];
					$NOTE_DETAILTINY = $_POST['NOTE_DETAILTINY'];
					$NOTE_DETAIL = $_POST['NOTE_DETAIL'];
					$Type = $_POST['Type'];
					$NOTE_PASSWORD = $_POST['PASSWORD'];

					//echo $NOTE_DETAIL ;
					//$LockNote= $_POST[''] ;

					$sql = "INSERT INTO F_NOTE (NOTE_TITLE,NOTE_DETAILTINY,NOTE_DETAIL,TYPE,NOTE_PASSWORD) VALUES ('$NOTE_TITLE','$NOTE_DETAILTINY','$NOTE_DETAIL','$Type','$NOTE_PASSWORD')";

					$result = $con->query($sql);
					echo "เพิ่มโน็ตสำเร็จ";

					?>