<?php


header("Access-Control-Allow-Origin: *");

require_once '../util/util.php';
require_once '../model/flight.php';

dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     
     $idToGet = (int) r('id');

     if ($idToGet) {
        $flight = getPlaneById($idToGet);
        echo json_encode($flight);
     } else {
        $flights = getFlights();
        echo json_encode($flights);
     }

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $idToUpdate = (int)$_REQUEST['id'];

    // Read the JSON we got in the req 
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
    updateFlight($entity);

} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {   
     //dd($_REQUEST['id']);
     $idToRemove = (int)$_REQUEST['id'];
     //dd($idToRemove);
     deleteFlighteById($idToRemove);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entity = file_get_contents('php://input');
    $entity = json_decode($entity);
   
    insertFlight($entity);
}

$conn->close();


?>