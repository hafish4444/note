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
    .table td,
    .table th {
        vertical-align: middle;
    }

    .button {
        display: inline-block;
        border-radius: 4px;
        background-color: #1EC1F4;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 28px;
        padding: 20px;
        width: 180px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
    }

    .button:hover {
        background: #f4511e;
    }

    .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .button span:after {
        content: '\00bb';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .button:hover span {
        padding-right: 25px;
    }

    .button:hover span:after {
        opacity: 1;
        right: 0;
    }
    </style>

    <script>
    function insertNote() {

        TitleNote = document.getElementById("NOTE_TITLE").value;
        NOTE_DETAILTINY = document.getElementById('NOTE_DETAILTINY').value;
        NOTE_DETAIL = document.getElementById('NOTE_DETAIL').value;
        Type = document.getElementById('Type').value;
        PASSWORD = document.getElementById('password').value;
        if (TitleNote == "" || NOTE_DETAILTINY == "" || NOTE_DETAIL == "" || NOTE_DETAIL == " ") {
            alert("กรุณากรอกข้อมูลให้ครบถ้วนด้วยจร้าา");
            return;
        }
        $.ajax({
            type: "POST",
            url: "insertNote",
            data: "NOTE_TITLE=" + TitleNote + "&Type=" + Type + "&NOTE_DETAILTINY=" + NOTE_DETAILTINY +
                "&NOTE_DETAIL=" + NOTE_DETAIL + "&PASSWORD=" + PASSWORD,
            success: function(msg) {
                alert(msg);
                window.location = './';
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
                    ?>

<body style='background: #E7E7E7'>
    <nav class="navbar navbar-dark bg-dark">
        <a href="https://angsila.informatics.buu.ac.th/~60160272/note" class="navbar-brand text-white">หน้าหลัก</a>
        <button class="btn btn-outline-light" onclick=' window.location="addNote"'>เพิ่มโน็ต</button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="mx-auto col-sm-10" style="background:#F9F9F9">
                <h1>เพิ่มโน็ต</h1>
                <div class=' form-group row'>
                    <div class='col-sm-4'>
                        <input type='text' id='NOTE_TITLE' class='form-control mb-1' placeholder='หัวข้อ' required>
                    </div>
                    <div class='col-sm-8'>
                        <input type='text' id='NOTE_DETAILTINY' class='form-control' placeholder='รายละเอียดย่อย'
                            maxlength='120' required>
                    </div>
                </div>
                <div class='form-group row'>
                    <div class='col-sm-4'>
                        <select id='Type' class='form-control mb-1'>
                            <option value='CODE'>CODE</option>
                            <option value='ไร้สาระ'>ไร้สาระ</option>
                        </select>
                    </div>
                    <div class='col-sm-8'>
                        <input type='text' class='form-control' placeholder='รายละเอียดย่อย'
                            value='<?php echo date("d/m/Y h:i") ?>' disabled>
                    </div>
                </div>

                <div class='form-group row'>
                    <div class='col-sm-12'>
                        <input type='text' id="password" class='form-control'
                            placeholder="รหัสผ่าน (ถ้าใส่จะเป็นการล็อคห้อง)" maxlength='10'>
                    </div>
                </div>

                <p><textarea id='NOTE_DETAIL' class='form-control'
                        style='width : -webkit-fill-available; height: calc(100vh - 375px)'
                        placeholder="อธิบายเกี่ยวกับโน็ตของคุณ.........."></textarea> </p>
                <div style='text-align :center'>
                    <button class='button' onclick='insertNote()'><span>ยืนยัน</span></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>