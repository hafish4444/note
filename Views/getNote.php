                    <?php
					date_default_timezone_set("Asia/Bangkok");
					include('config.php');
					$con = mysqli_connect($host, $username, $password, $Database);
					mysqli_query($con, "SET NAMES UTF8");
					//session_start();
					$TitleNote = $_REQUEST['TitleNote'];
					$TypeNote = $_REQUEST['TypeNote'];
					$LockNote = $_REQUEST['LockNote'];
					if ($LockNote == 'false') {
						$LockNote = " NOTE_PASSWORD like '%%'";
					} else {
						$LockNote = "NOT NOTE_PASSWORD = ''";
					}
					if ($TypeNote == "ALL") {
						$sql = "select * from F_NOTE where NOTE_TITLE LIKE '%$TitleNote%' AND $LockNote ORDER BY NOTE_DATETIME DESC";
					} else {
						$sql = "select * from F_NOTE where NOTE_TITLE LIKE '%$TitleNote%' AND TYPE = '$TypeNote' AND $LockNote ORDER BY NOTE_DATETIME DESC";
					}

					$result = $con->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {
							$NoteData[] = $row;
						}
					}
					?>
                    <div class="table-responsive">

                        <table style='word-break:break-word' id="tableNote" class="table table-hover">
                            <?php
							foreach ($NoteData as $row) {

								echo "<tr style ='background:#ffef64' >";
								echo "<td colspan ='2' >" . ($row['NOTE_TITLE']) . "</td>";
								echo "<td colspan = '2' style = 'text-align:right'  >" . ($row['NOTE_DATETIME']) . "</td>";
								echo "</tr>";
								echo "<tr>";
								$NOTE_DETAILTINY = $row['NOTE_DETAILTINY'];
								echo "<td>" . substr($NOTE_DETAILTINY, 0, 60) . substr($NOTE_DETAILTINY, 60, 60) . "</td>";
								echo "<td style = 'width:130px'>ประเภท : " . ($row['TYPE']) . "</td>";
								echo "<td style = 'width:70px' > ";
								if (empty($row['NOTE_PASSWORD'])) {
									echo "ไม่ล็อค</td>";
									$LOCK = "N";
								} else {
									echo "ล็อค</td>";
									$LOCK = "L";
								}
								echo "<td style ='width : 100px ;text-align:center' >";
								$ID_NOTE = $row['ID_NOTE'];
								echo "<form id = 'form_view$ID_NOTE' method = 'POST'  action = 'viewNote' >";
								echo "<input type ='hidden' name = 'ID_NOTE' value = '$ID_NOTE'> ";
								echo "<input type ='hidden' id = 'password$ID_NOTE' name = 'password'> ";
								echo "<button onclick = 'return (havePassword(\"$ID_NOTE\",\"$LOCK\" ) == \"true\")' class = 'btn btn-warning'>View</button>";
								echo "</form>";
								echo "</td>";
								echo "</tr>";
							}
							?>
                        </table>
                    </div>