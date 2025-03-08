<!DOCTYPE html>
<html>
<head>
  <title>Form Validation</title>
  <link rel="stylesheet" href="style.css"> 
</head>
<body>

  <form id="myForm" action="submit.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <span id="nameError"></span><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <span id="emailError"></span><br><br>

    <input type="submit" value="Submit">
  </form>

  <script src="script.js"></script> 
</body>
</html>