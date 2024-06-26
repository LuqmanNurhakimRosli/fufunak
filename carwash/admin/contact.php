<?php
include 'db.php';

// Delete message if delete parameter is set
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM contact_us WHERE id = $id";
    mysqli_query($con, $deleteQuery);
    header("Location: contact.php");
    exit();
}

$query = "SELECT * FROM contact_us";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css"> <!-- Ensure this path is correct -->
  <style>
      
.table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: rgba(50, 44, 241, 0.8);
  color: white;
}

tr:hover {
  background-color: #f5f5f5;
}

.btn-danger {
  background-color: #ff4d4d;
  border: none;
  color: white;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px 1px;
  cursor: pointer;
  border-radius: 5px;
}

.btn-danger:hover {
  background-color: #ff1a1a;
}

  </style>
</head>
<body>

<div class="sidebar">
  <a href="admin.html">Home</a>
  <a href="booking.html">Booking</a>
  <a class="active" href="contact.php">Contact</a>
  <a href="#about">About</a>
</div>

<div class="header">
    <h2>Admin Page</h2>
</div>

<div class="container">

  <div class="content">
    <h2>Customer Feedback</h2>
      
              <table class="table"> <!-- Added class "table" -->
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Message</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>
                              <td><?php echo htmlspecialchars($row['name']); ?></td>
                              <td><?php echo htmlspecialchars($row['email']); ?></td>
                              <td><?php echo htmlspecialchars($row['subject']); ?></td>
                              <td><?php echo htmlspecialchars($row['message']); ?></td>
                              <td>
                                  <a href="contact.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
            
  </div>

</div>

</body>
</html>
