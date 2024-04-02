<?php
// Check if form is submitted to avoid undefined variable errors
if (isset($_POST['submit'])) {

    // Sanitize form data to prevent SQL injection vulnerabilities (consider prepared statements)
    $date = mysqli_real_escape_string($con, trim($_POST['date']));
    $meal = mysqli_real_escape_string($con, trim($_POST['meal']));
    $food_item = mysqli_real_escape_string($con, trim($_POST['food_item']));
    $quantity = (float) trim($_POST['quantity']); // Cast to float for numerical values
    $calories = (int) trim($_POST['calories']);   // Cast to integer
    $protein = (float) trim($_POST['protein']);
    $carbohydrates = (float) trim($_POST['carbohydrates']);
    $fats = (float) trim($_POST['fats']);

    // Establish a secure database connection (consider PDO for improved security and error handling)
    $host = "localhost";
    $username = "root";
    $password = ""; // Replace with your actual password
    $dbname = "calories";

    try {
        $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error handling mode

        // Prepare a safer SQL statement using placeholders for data binding
        $sql = "INSERT INTO 1 ( date, meal, food_item, quantity, calories, protein, carbohydrates, fats) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind values safely using prepared statement
        $stmt->bindParam(1, $date);
        $stmt->bindParam(2, $meal);
        $stmt->bindParam(3, $food_item);
        $stmt->bindParam(4, $quantity);
        $stmt->bindParam(5, $calories);
        $stmt->bindParam(6, $protein);
        $stmt->bindParam(7, $carbohydrates);
        $stmt->bindParam(8, $fats);

        // Execute the prepared statement with bound values
        $stmt->execute();

        echo "Entries added successfully!";

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection (if using PDO, closing should be handled automatically)
    mysqli_close($con); // If you're using mysqli instead of PDO

}
?>
