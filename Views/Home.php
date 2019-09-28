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

        /* @media(max-width:365px) {.tableSearch tr {display: table;width: 100%;}.tableSearch td:nth-child(even) {display: table-row;}} */
        table#tableNote {
            width: 495px;
        }

        .table-responsive {
            overflow-y: auto;
            height: calc(100vh - 192px);
        }

        @media(min-width:520px) {
            table#tableNote {
                width: 100%;
            }
        }

        h1 {
            margin-left: 30%;
            border-bottom: 2px dashed #DFD36B;
            transition: margin-left 1s
        }

        h1.ready {
            margin-left: 0;
        }

        .title-note {
            cursor: pointer;
            background: #ffef64 !important
        }

        .note-table {
            cursor: pointer;
        }

        .note-table:hover td:first-child{
            text-decoration: underline;
        }
        .note-table:hover .content-note{
            background: #00000015;
        }

        @media(max-width:992px) {
            .col-lg-7 {
                margin-bottom: 3px;
            }

            .table-responsive {
                height: calc(100vh - 235px)
            }
        }
    </style>
    <script>
        function showNote(div_id) {
            var divIdHtml = $("#" + div_id).html();
            TitleNote = document.getElementById("TitleNote").value;
            TypeNote = document.getElementById('TypeNote').value;
            LockNote = document.getElementById('LockNote').checked;
            $.ajax({
                type: "GET",
                url: "getNote",
                data: "TitleNote=" + TitleNote + "&TypeNote=" + TypeNote + "&LockNote=" + LockNote,
                success: function(msg) {
                    $("#" + div_id).html(msg);
                }
            });
        }
        $(document).ready(function(a) {
            $("h1").addClass("ready");
        });
    </script>

    <title>NOTE60</title>
</head>
<?php
date_default_timezone_set("Asia/Bangkok");
include('config.php');
$con = mysqli_connect($host, $username, $password, $Database);
mysqli_query($con, "SET NAMES UTF8");
//session_start();
$sql = "select * from F_NOTE ORDER BY NOTE_DATETIME DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $NoteData[] = $row;
    }
}
?>

<body style='background: #E7E7E7'>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container ">
            <div class="mx-auto col-md-10 px-0" style="position:relative">
                <a href="https://angsila.informatics.buu.ac.th/~60160272/note" class="navbar-brand text-white">หน้าหลัก</a>

                <button style="position:absolute ; right:0" class="btn btn-outline-light" onclick='window.location = "addNote"'>เพิ่มโน็ต</button>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-10 shadow" style="background:#F9F9F9">
                <h1 class="pt-2 pb-3 mb-0"> Note
                    <font style="font-size:12px">
                        (จะโน็ตอะไรก้ได้เขียนๆไปเถอะ)
                    </font>
                </h1>
                <!--
                <table class="table table-hover tableSearch mb-1" style="border-top:0px solid white">
                    <tr>
                        <td style="  width:100px ; border-top:0px solid white">
                            ค้นหาหัวข้อ
                        </td>
                        <td style="; border-top:0px solid white">
                            <input type=" text" onkeyup='showNote("showNote")' id='TitleNote' class="form-control"
                                placeholder="XO">
                        </td>
                        <td style="width:5% ; border-top:0px solid white">
                            ประเภท
                        </td>
                        <td style="; border-top:0px solid white">
                            <select id='TypeNote' onchange='showNote("showNote")' class="form-control ; width:20%">
                                <option value='ALL'>ทั้งหมด</option>
                                <option value='CODE'>CODE</option>
                                <option value='ไร้สาระ'>ไร้สาระ</option>
                                <option value='อัพเดท'>อัพเดท</option>
                            </select>
                        </td>
                        <td style=" width:5% ; border-top:0px solid white">
                            ล็อค
                        </td>
                        <td style="; border-top:0px solid white">
                            <input onclick='showNote("showNote")' id='LockNote' type="checkbox">
                        </td>
                    </tr>
                </table>
-->
                <div class="form-inline row my-3 px-3">
                    <div class="col-lg-7 mb-lg-1">
                        <div class="form-inline row">
                            <div class="col-2 px-1">
                                ค้นหาหัวข้อ
                            </div>
                            <div class="col-10">
                                <input type=" text" onkeyup='showNote("showNote")' id='TitleNote' class="form-control w-100" placeholder="XO">
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-lg-1 px-1">
                        ประเภท
                    </div>
                    <div class="col-5 col-lg-2">
                        <select id='TypeNote' onchange='showNote("showNote")' class="form-control w-100">
                            <option value='ALL'>ทั้งหมด</option>
                            <option value='CODE'>CODE</option>
                            <option value='ไร้สาระ'>ไร้สาระ</option>
                            <option value='อัพเดท'>อัพเดท</option>
                        </select>
                    </div>
                    <div class="col-5 col-lg-2 ">
                        <div class="form-check justify-content-start">
                            <input class="form-check-input" onclick='showNote("showNote")' id='LockNote' type="checkbox">
                            <label class="form-check-label" for="LockNote">ล็อค</label>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">VIEW NOTE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="height: 150px">
                                <div class="alert alert-danger " role="alert">
                                    รหัสผ่าน <strong>ไม่ถูกต้อง!</strong>
                                </div>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    ใส่รหัสผ่านแล้วกด Confirm
                                </div>
                                <input type="password" class="form-control mb-2" placeholder="กรุณากรอกรหัสผ่าน" id="PASSWORD" autocomplete="off">
                                <div>
                                    <input type="checkbox" id="chkShowPass" onchange="showPassword()" style="cursor:pointer" class="ml-1" checked>
                                    <label>เปิด/ปิดแสดงรหัสผ่าน</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" onclick="checkPassword(document.getElementById('PASSWORD').value)" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <span id='showNote'>
                    </span>
                </div>
                <script>
                    var ID_NOTE = "";

                    function havePassword(ID, LOCK) {
                        if (LOCK == "N") {
                            return $(("#form_view" + ID)).submit();
                        }
                        ID_NOTE = ID;
                        $("#PASSWORD").val("");
                        $("#modelId").modal({
                            backdrop: "static"
                        });
                        $(".alert-danger").hide();
                        $(".alert-primary").hide().show("medium");
                        return false;
                    }

                    function checkPassword(Pass) {
                        let chk = null;
                        Password = Pass;
                        $.ajax({
                            'async': false,
                            type: "POST",
                            url: "checkPass",
                            data: "ID_NOTE=" + ID_NOTE + "&PASSWORD=" + Password,
                            success: function(Check) {
                                Check = Check.replace(/(\r\n|\n|\r)/gm, "");
                                chk = Check;
                            }
                        });
                        if (chk == "true") {
                            $("#password" + ID_NOTE).val(Password);
                            $("#form_view" + ID_NOTE).submit();
                        } else {
                            $(".alert-danger").hide().show("medium");
                            $(".alert-primary").hide();
                        }
                    }
                    showNote("showNote");

                    function showPassword() {
                        if (document.getElementById("chkShowPass").checked == true) {
                            document.getElementById("PASSWORD").type = "password";
                        } else {
                            document.getElementById("PASSWORD").type = "text";
                        }
                    }
                </script>

            </div>
        </div>
    </div>

    <script>

    </script>
</body>

</html>