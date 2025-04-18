<?php
include '../../../main_db.php';
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$campus = isset($_GET['campus']) ? $mysqli->real_escape_string($_GET['campus']) : '';
$course = isset($_GET['course']) ? $mysqli->real_escape_string($_GET['course']) : '';
$employmentStatus = isset($_GET['employmentStatus']) ? $mysqli->real_escape_string($_GET['employmentStatus']) : '';

$campusCondition = ($campus === '') ? "" : "AND eb.college_university = '$campus'";
$courseCondition = ($course === '') ? "" : "AND eb.degree_specialization = '$course'";
$employmentStatusCondition = ($employmentStatus === '') ? "" : "AND ed.present_employment_status = '$employmentStatus'";


$query = "SELECT je.course_related, COUNT(je.user_id) AS total 
          FROM job_experience je
          LEFT JOIN educational_background eb 
            ON eb.user_id = je.user_id
          LEFT JOIN employment_data ed 
            ON ed.user_id = je.user_id
          WHERE 1=1
          $campusCondition
          $courseCondition
          $employmentStatusCondition
          GROUP BY je.course_related";


$result = $mysqli->query($query);

if (!$result) {
  die(json_encode(["error" => "SQL Error: " . $mysqli->error]));
}

$courseRelevanceData = ["related" => 0, "not_related" => 0];

while ($row = $result->fetch_assoc()) {
  if (strtolower($row['course_related']) === 'yes') {
    $courseRelevanceData["related"] = (int) $row['total'];
  } elseif (strtolower($row['course_related']) === 'no') {
    $courseRelevanceData["not_related"] = (int) $row['total'];
  }
}

echo json_encode($courseRelevanceData);
