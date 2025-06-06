<?php

// CS0043L Source code template for 3T SY 2024-2025
/*
	Program: Computation of Grades using function
	Programmer: Arianne Beverly Marquez
	Section: AN21
	Start Date: June, 3, 2025
	End Date: June 6, 2025
*/

function renderHeader() {
  echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <title>Grade Results</title>
  <style>
    :root {
      --pastel-pink: #FFD1DC;
      --pastel-green: #D4F4DD;
      --pastel-yellow: #FFF7C0;
      --pastel-blue: #D0E8FF;
      --text-gray: #333;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fffdfc;
      color: var(--text-gray);
      padding: 20px;
      max-width: 900px;
      margin: auto;
    }

    h2 {
      text-align: center;
      color: #5b4c4c;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 30px;
      background-color: var(--pastel-yellow);
      border: 2px solid #d8b8b8;
    }

    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: var(--pastel-pink);
      color: #5b4c4c;
    }

    tr:nth-child(even) {
      background-color: var(--pastel-blue);
    }

    tr:hover {
      background-color: #ffe8f0;
    }
  </style>
</head>
<body>
  <h2>📊 Grade Calculation Results (Sorted by Final Grade) 📊</h2>
HTML;
}

function getAverage($array) {
  return array_sum($array) / count($array);
}

function getLetterGrade($grade) {
  if ($grade >= 90) return 'A';
  elseif ($grade >= 80) return 'B';
  elseif ($grade >= 70) return 'C';
  elseif ($grade >= 60) return 'D';
  else return 'F';
}

function calculateAndRenderResults() {
  $students = [];

  for ($i = 1; $i <= 5; $i++) {
    $name = $_POST["name$i"] ?? "Student $i";

    $ea = [];
    for ($j = 1; $j <= 5; $j++) {
      $ea[] = isset($_POST["ea{$i}_$j"]) ? (float)$_POST["ea{$i}_$j"] : 0;
    }

    $sa = [];
    for ($j = 1; $j <= 3; $j++) {
      $sa[] = isset($_POST["sa{$i}_$j"]) ? (float)$_POST["sa{$i}_$j"] : 0;
    }

    $fe = isset($_POST["fe$i"]) ? (float)$_POST["fe$i"] : 0;

    $classPart = getAverage($ea);
    $summative = getAverage($sa);
    $finalGrade = ($classPart * 0.3) + ($summative * 0.3) + ($fe * 0.4);
    $letter = getLetterGrade($finalGrade);

    $students[] = [
      'name' => $name,
      'classPart' => $classPart,
      'summative' => $summative,
      'fe' => $fe,
      'finalGrade' => $finalGrade,
      'letter' => $letter
    ];
  }

  usort($students, function($a, $b) {
    return $b['finalGrade'] <=> $a['finalGrade']; 
  });


  echo "<table>";
  echo "<tr><th>Name</th><th>Class Participation</th><th>Summative Grade</th><th>Final Exam</th><th>Final Grade</th><th>Letter Grade</th></tr>";

  foreach ($students as $student) {
    echo "<tr>";
    echo "<td>{$student['name']}</td>";
    echo "<td>" . number_format($student['classPart'], 2) . "</td>";
    echo "<td>" . number_format($student['summative'], 2) . "</td>";
    echo "<td>" . number_format($student['fe'], 2) . "</td>";
    echo "<td>" . number_format($student['finalGrade'], 2) . "</td>";
    echo "<td>{$student['letter']}</td>";
    echo "</tr>";
  }

  echo "</table>";
}

function renderFooter() {
  echo "</body></html>";
}

renderHeader();
calculateAndRenderResults();
renderFooter();