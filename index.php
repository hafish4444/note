<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/~60160272/css/w3.css">
    <link rel="stylesheet" type="text/css" href="/~60160272/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<style>
		.table td,.table th{
			vertical-align:middle ;
		}
	</style>
	<script>
function showNote(div_id) {
      var divIdHtml = $("#"+div_id).html();
      TitleNote = document.getElementById("TitleNote").value ;
      TypeNote = document.getElementById('TypeNote').value;
      LockNote = document.getElementById('LockNote').checked;
      $.ajax({
           type: "GET",
           url: "getNote.php",
           data: "TitleNote="+TitleNote+"&TypeNote="+TypeNote+"&LockNote="+LockNote,
           success: function(msg) {
              $("#"+div_id).html( msg);
           }
      });
}
	</script>

    <title>NOTE60</title>
</head>
                    <?php
			date_default_timezone_set("Asia/Bangkok");
			include('config.php');	
			$con = mysqli_connect($host,$username,$password,$Database);
			mysqli_query($con,"SET NAMES UTF8");
			//session_start();
                        $sql = "select * from F_NOTE ORDER BY NOTE_DATETIME DESC";

			$result = $con->query($sql);
		
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$NoteData[] = $row;
				}
			}
                    ?>
<body style = 'background:#F9F9F9' >
    <nav class="navbar navbar-dark bg-dark">
        <a href="https://angsila.informatics.buu.ac.th/~60160272/note" class="navbar-brand text-white">หน้าหลัก</a>
        <button class="btn btn-outline-light" onclick = 'window.location = "addNote.php"' >เพิ่มโน็ต</button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-10">
                <table class="table table-hover">
                    <tr  >
                        <td style="  width:100px">
                            ค้นหาหัวข้อ
                        </td>
                        <td >  
                            <input type="text" onkeyup = 'showNote("showNote")' id = 'TitleNote' class="form-control" placeholder="XO">
                        </td>
                        <td style=" ; width:5%">
                            ประเภท
                        </td>
                        <td>
                            <select id = 'TypeNote' onchange = 'showNote("showNote")' class = "form-control ; width:20%" >
                                <option value = 'ALL' >ทั้งหมด</option>
                                <option value = 'CODE' >CODE</option>
                                <option value = 'ไร้สาระ' >ไร้สาระ</option>
                            </select>
                        </td>
                        <td style=" width:5%">
                            ล็อค
                        </td>
			<td style="">
				<input  onclick = 'showNote("showNote")' id = 'LockNote' type = "checkbox" >
			</td>
                    </tr>
                </table>
		<span id = 'showNote' >
		<table style = 'word-break:break-word' class = "table table-hover" >
                    <?php
			foreach ($NoteData as $row){
			
			echo "<tr style ='background:#F7F060' >";
			echo "<td colspan ='2' >".($row['NOTE_TITLE'])."</td>";
			echo "<td colspan = '2' style = 'text-align:right'  >".($row['NOTE_DATETIME'])."</td>";
			echo "</tr>";
			echo "<tr>";
			$NOTE_DETAILTINY = $row['NOTE_DETAILTINY'];
			echo "<td>".substr($NOTE_DETAILTINY,0,60).substr($NOTE_DETAILTINY,60,60)."</td>";
			echo "<td style = 'width:130px'>ประเภท : ".($row['TYPE'])."</td>";
			echo "<td style = 'width:70px' > " ;
			if(empty($row['NOTE_PASSWORD'])){
				echo "ไม่ล็อค</td>" ;
				
			}else{
				echo "ล็อค</td>"  ;
			}
			echo "<td style ='width : 100px ;text-align:center' >" ;
			echo "<form method = 'POST'  action = 'viewNote.php' >";
			$ID_NOTE = $row['ID_NOTE'];
			echo "<input type ='hidden' name = 'ID_NOTE' value = '$ID_NOTE'> ";
			echo "<button class = 'btn btn-warning'>View</button>" ;
			echo "</form  >";
			echo "</td>";
			echo "</tr>";
			}
                    ?>
		</table>
		</span>
            </div>
        </div>
    </div>
</body>

</html>
