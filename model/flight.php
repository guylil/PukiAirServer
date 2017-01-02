<?php
function getFlights() {
    global $conn;
    $flights = array();
    $sql = "SELECT * FROM flight";
    $result = $conn->query($sql);

    while($flight = $result->fetch_object()) {
        $flights[] = $flight;
    }
    
    return $flights;
}

function getFlightById($id) {
    global $conn;
    $sql = "SELECT * FROM flight WHERE id=".$id;
    $result = $conn->query($sql);
    $flight = $result->fetch_object();
    return $flight;
}

function deleteFlightById($id) {
    //dd($id); 
    global $conn;
    $sql = "DELETE FROM flight WHERE id=".$id;
    //dd($sql);   
    $result = $conn->query($sql);
}

function insertFlight($flight) {
    global $conn;
    $newId = null;
    $sql = 'INSERT INTO flight (model, seat_count) VALUES ' . 
           ' ("' . $flight->model . '", ' . $flight->seat_count .')';

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        $newId = $conn->insert_id;
    }
    return $newId;
}

function updateFlight($flight) {
    global $conn;
    $sql = 'UPDATE flight SET model="' .$flight->model .'" , seat_count='.$flight->seat_count.' WHERE id=' . $flight->id;
    $conn->query($sql);
}

?>