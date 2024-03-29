<?php  include('server.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM products WHERE id=$id");

		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$detail = $n['detail'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <?php $results = mysqli_query($db, "SELECT * FROM products"); ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Detail</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['detail']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                    </td>
                    <td>
                        <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

	<form method="post" action="server.php" >
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Detail</label>
			<input type="text" name="detail" value="<?php echo $detail; ?>">
		</div>
		<div class="input-group">
        <?php if ($update == true): ?>
	        <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
	        <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>
		</div>
        <!-- newly added field -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">
	</form>

</body>
</html>