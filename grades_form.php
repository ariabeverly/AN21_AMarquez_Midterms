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
  <title>Student Grade Calculator</title>
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
      color: #7a5c61;
    }

    fieldset {
      border: 2px solid #f3c5c5;
      border-radius: 10px;
      padding: 20px;
      background-color: var(--pastel-blue);
      margin-bottom: 20px;
    }

    legend {
      background-color: var(--pastel-pink);
      padding: 8px 15px;
      border-radius: 8px;
      font-weight: bold;
      color: #5c3d41;
    }

    label {
      font-weight: bold;
    }

    input[type="text"] {
      padding: 5px;
      margin: 5px;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="number"] {
      padding: 5px;
      margin: 5px;
      width: 60px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      background-color: var(--pastel-green);
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #3d4f3d;
      cursor: pointer;
      margin-top: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #bce6c6;
    }
  </style>
</head>
<body>
  <h2>🌸 Student Grade Input Form 🌸</h2>
  <form method="post" action="grades_result.php">
HTML;
}

function renderStudentForm($studentNumber) {
  echo <<<HTML
    <fieldset>
      <legend>Student {$studentNumber}</legend>
      <label>Name:</label> 
      <input type="text" name="name{$studentNumber}" required><br><br>

      <label>Enabling Assessments (5):</label><br>
HTML;

  for ($j = 1; $j <= 5; $j++) {
    echo "<input type=\"number\" name=\"ea{$studentNumber}_{$j}\" min=\"0\" max=\"100\" required>";
  }

  echo "<br><br><label>Summative Assessments (3):</label><br>";

  for ($j = 1; $j <= 3; $j++) {
    echo "<input type=\"number\" name=\"sa{$studentNumber}_{$j}\" min=\"0\" max=\"100\" required>";
  }

  echo <<<HTML
      <br><br>
      <label>Final Exam:</label>
      <input type="number" name="fe{$studentNumber}" min="0" max="100" required><br><br>
    </fieldset>
HTML;
}

function renderFooter() {
  echo <<<HTML
    <input type="submit" value="🎓 Calculate Grades">
  </form>
</body>
</html>
HTML;
}

renderHeader();

for ($i = 1; $i <= 5; $i++) {
  renderStudentForm($i);
}

renderFooter();
?>