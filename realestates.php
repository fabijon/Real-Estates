<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="css/realestates.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        .profile{
    float: right;
    width: 180px;
    height:60px;
}

.profile i {
    float:left;
    padding-right: 12%;
    padding-top: 20px;
    font-size: 40px;
}

.editprofile{
    line-height:5px;
    display:flex;
    flex-direction:column;
    height:60px;
}

.editprofile h4{
    color:white;
    font-size:20px;
}

.editprofile p{
    margin-top:-4px;
    color:white;
    font-size:14px;
}

    </style>
    <?php
   include_once('config.php');
   $sql = "SELECT company, broker, address, price, finnid FROM `real estates`";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $realEstates = $stmt->fetchAll(PDO::FETCH_ASSOC);
   ?>
       <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>
    <div class="navbar">
        <h1>Fab<span>ijon</span></h1>
        <div class="profile">
            <i class="fa-solid fa-user" style="color: #ffffff;"></i>
            <div class="editprofile">
                <h4><?php echo ($username); ?></h4>
                <p>Editor</p>
            </div>
        </div>
    </div>
    <div class="pages-left">
        <a href="dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
        <a href="companies.php"><i class="fa-solid fa-building"></i>Companies</a>
        <a href="offices.php"><i class="fa-solid fa-building"></i>Offices</a>
        <a href="brokers.php"><i class="fa-solid fa-person"></i>Brokers</a>
        <a href="realestates.php" style=" color: #f6ae3f;"><i class="fa-solid fa-house"></i>Real Estates</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
    </div>
    <div class="realestates">
        <div class="info">
            <a href="dashboard.php">Fabijon</a>
            <p>/</p>
            <a href="realestates.php">Real Estates</a>
            <a href="createrealestates.php" id="buttona"><button><i class="fa-solid fa-plus"></i>Create real estates</button></a>
        </div>
        <table>
            <thead>
                
                <tr>
                    <th>Company</th>
                    <th>Broker</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>   
            </thead> 
            <?php 

	 		foreach ($realEstates as $info) {
			
		?>
			<tr> 
				<td> <?= $info['company'] ?> </td>
				<td> <?= $info['broker'] ?> </td>
				<td> <?= $info['address']  ?> </td> 
				<td> <?= $info['price']  ?> </td> 
                <td><a href="edit.php?finnid=<?= $info['finnid'] ?>"><i id="edit" class="fa-solid fa-pen"></i></a><a href="delete.php?finnid=<?= $info['finnid'] ?>" onclick="return confirmDelete();"><i id="trash" class="fa-solid fa-trash"></i></a></td>
			</tr>
		<?php 

			}

	 	 ?>

         </table>
    </div>
    
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}
</script>
</body>
</html>