<?php
function getCourses($dbh) {
  $STH = $dbh->prepare("SELECT * FROM kutsu_courses;");
  if ($STH->execute()) {
    $users = $STH->fetchAll();
    return $users;
  }
  else {
    throw new Exception('{"status": "ERROR, Could not get courses."}');
  }
}

function getCourse($dbh, $cID) {
  $STH = $dbh->prepare("SELECT * FROM kutsu_courses WHERE cID = :cID;");
  $STH->bindParam(':cID', $cID);
  if ($STH->execute()) {
    $user = $STH->fetchAll();
    return $user;
  }
  else {
    throw new Exception('{"status": "ERROR, Could not get course."}');
  }
}

function getCalls($dbh, $cID) {
  $STH = $dbh->prepare("SELECT * FROM kutsu_kutsu WHERE kcID = :cID;");
  $STH->bindParam(':cID', $cID);
  if ($STH->execute()) {
    $calls = $STH->fetchAll();
    return $calls;
  }
  else {
    throw new Exception('{"status": "ERROR, Could not get calls."}');
  }
}

function deleteCall($dbh, $cID) {
  $STH = $dbh->prepare("DELETE FROM kutsu_kutsu WHERE kID = :cID;");
  $STH->bindParam(':cID', $cID);
  if ($STH->execute()) {
    return '{"status": "OK"}';
  }
  else {
    throw new Exception('{"status": "ERROR, Could not get calls."}');
  }
}


function postCall($dbh, $request) {
  $STH = $dbh->prepare("INSERT INTO kutsu_kutsu (kName, kType, kcID) VALUES (:kName, :kType, :kcID);");
  $STH->bindParam(':kName', $request['kName']);
  $STH->bindParam(':kType', $request['kType']);
  $STH->bindParam(':kcID', $request['kcID']);
  if ($STH->execute()) {
    $lastId = $dbh->lastInsertId();
    return '{"status": "OK", "kID": ' . $lastId . '}';
  }
  else {
    throw new Exception('{"status": "ERROR, Could not make new call."}');
  }
}