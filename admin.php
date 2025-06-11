<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Payments Management</h2>
    <a href="index.html">Back</a>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry Month</th>
            <th>Expiry Year</th>
            <th>CVV</th>
            <th>Actions</th> <!-- Added Actions column -->
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clothingshop";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // DELETE function
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $delete_sql = "DELETE FROM payments WHERE id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
            header("Location: admin.php"); // Redirect after deletion
            exit;
        }

        // EDIT function
        if (isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $card_number = $_POST['card_number'];
            $expiry_month = $_POST['expiry_month'];
            $expiry_year = $_POST['expiry_year'];
            $cvv = $_POST['cvv'];

            $edit_sql = "UPDATE payments SET name=?, phone=?, address=?, card_number=?, expiry_month=?, expiry_year=?, cvv=? WHERE id=?";
            $stmt = $conn->prepare($edit_sql);
            $stmt->bind_param("ssssiisi", $name, $phone, $address, $card_number, $expiry_month, $expiry_year, $cvv, $edit_id);
            $stmt->execute();
            $stmt->close();
            header("Location: admin.php"); // Redirect after editing
            exit;
        }

        $sql = "SELECT id, name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $serialNumber = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["card_number"]."</td>";
                echo "<td>".$row["expiry_month"]."</td>";
                echo "<td>".$row["expiry_year"]."</td>";
                echo "<td>".$row["cvv"]."</td>";
                echo "<td>
                    <form style='display:inline;' method='post'>
                        <input type='hidden' name='edit_id' value='".$row['id']."'>
                        <input type='text' name='name' placeholder='Name' value='".$row['name']."' required>
                        <input type='text' name='phone' placeholder='Phone' value='".$row['phone']."' required>
                        <input type='text' name='address' placeholder='Address' value='".$row['address']."' required>
                        <input type='text' name='card_number' placeholder='Card Number' value='".$row['card_number']."' required>
                        <input type='text' name='expiry_month' placeholder='MM' value='".$row['expiry_month']."' required>
                        <input type='text' name='expiry_year' placeholder='YYYY' value='".$row['expiry_year']."' required>
                        <input type='text' name='cvv' placeholder='CVV' value='".$row['cvv']."' required>
                        <input type='submit' value='Edit'>
                    </form>
                    <a href='?delete_id=".$row['id']."' onclick=\"return confirm('Are you sure you want to delete this payment?');\">Delete</a>
                </td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='9'>No payments found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
