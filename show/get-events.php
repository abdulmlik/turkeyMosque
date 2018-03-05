<?php
	require_once ("../connect.php");
	$sql = "SELECT r_date AS rdate,DATE_ADD(r_date,INTERVAL 1 DAY) AS edate,type FROM resv_info WHERE r_date>CURDATE()";
	// DATE_ADD(r_date,INTERVAL 1 DAY) return r_date + one Day  && CURDATE() return now date
    $stmt = $conn->prepare($sql);
	$stmt->execute();

    // Returning array
    $events = array();

    // Fetch results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $e = array();
        $e['start'] = $row['rdate'];
        $e['end'] = $row['edate'];
        $e['allDay'] = true;
        $e['overlap'] =false;
		$e['rendering']='background';
		if($row['type'] == 0){
			$e['color']='#ff9f00';
		}else{
			$e['color']='#ff5500';
		}

        // Merge the event array into the return array
        array_push($events, $e);

    }

    // Output json for our calendar
    echo json_encode($events);
    exit();
?>