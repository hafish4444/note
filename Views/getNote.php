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
						$sql = "select * from F_NOTE where NOTE_TITLE LIKE '%$TitleNote%' AND $LockNote ORDER BY NOTE_DATETIME DESC LIMIT 50";
					} else {
						$sql = "select * from F_NOTE where NOTE_TITLE LIKE '%$TitleNote%' AND TYPE = '$TypeNote' AND $LockNote ORDER BY NOTE_DATETIME DESC LIMIT 50";
					}

					$result = $con->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while ($row = $result->fetch_assoc()) {
							$NoteData[] = $row;
						}
					}
					?>
                    <table style='word-break:break-word' id="tableNote" class="table table-hover">
                            <?php
							foreach ($NoteData as $row) {
								$ID_NOTE = $row['ID_NOTE'];
								if (empty($row['NOTE_PASSWORD'])) {
									$LOCK = "N";
								} else {
									$LOCK = "L";
								}
								echo "<tbody onclick = 'return (havePassword(\"$ID_NOTE\",\"$LOCK\" ) == \"true\")'  class = 'note-table'> " ;
								echo "<tr class = 'title-note' >";
								echo "<td colspan ='2' style = 'font-size:17px'>" . ($row['NOTE_TITLE']) . "</td>";
								$phpdate = strtotime($row['NOTE_DATETIME']);
								echo "<td colspan = '2' style = 'text-align:right'  >" .date('d-m-Y H:i:s',$phpdate) . "</td>";
								echo "</tr>";
								echo "<tr  class = 'content-note' >";
								$NOTE_DETAILTINY = $row['NOTE_DETAILTINY'];
								echo "<td>" . substr($NOTE_DETAILTINY, 0, 60) . substr($NOTE_DETAILTINY, 60, 60) . "</td>";
								echo "<td style = 'width:130px'>ประเภท : " . ($row['TYPE']) . "</td>";
								echo "<td style = 'width:70px ";
								if (empty($row['NOTE_PASSWORD'])) {
									echo " ; color : green '>ไม่ล็อค</td>";
									$LOCK = "N";
								} else {
									echo " ; color : red ' >ล็อค</td>";
									$LOCK = "L";
								}
								echo "<td style ='width : 100px ;text-align:center' > ";
								echo "<form id = 'form_view$ID_NOTE' method = 'POST'  action = 'viewNote' >";
								echo "<input type ='hidden' name = 'ID_NOTE' value = '$ID_NOTE'> ";
								echo "<input type ='hidden' id = 'password$ID_NOTE' name = 'password'> ";
								echo "<button onclick = 'return (havePassword(\"$ID_NOTE\",\"$LOCK\" ) == \"true\")' class = 'btn btn-warning'>View</button>";
								echo "</form>";
								echo "</td>";
								echo "</tr>";
								echo "</tbody>";
							}
							?>
					</table>
