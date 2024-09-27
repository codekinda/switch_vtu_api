<?php
include_once("../includes/db.php");

//Fetch the current API
$apis = $pdo->query("SELECT * FROM apis ORDER BY priority ASC");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $api_id = htmlspecialchars($_POST["api_id"]);
    $status = htmlspecialchars($_POST["status"]);

    //Toggle API Status
    $stmt = $pdo->prepare("UPDATE apis SET status = ? WHERE id = ?");
    if($stmt->execute([$status, $api_id])){
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin API Management</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .api-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .api-item:last-child {
            border-bottom: none;
        }
        .api-item p {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }
        .buttons {
            margin-top: 10px;
        }
        .buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }
        .buttons button[type='submit'] {
            background-color: #28a745;
            color: #fff;
        }
        .buttons button[type='submit']:hover {
            background-color: #218838;
        }
        .buttons button[type='submit'][value='disabled'] {
            background-color: #dc3545;
        }
        .buttons button[type='submit'][value='disabled']:hover {
            background-color: #c82333;
        }
    </style>

</head>
<body>
<h2>API Management</h2>
<?php while($api = $apis->fetch()): ?>
    <div class="container">
    <div class="api-item">
    <p><?php echo "{$api['name']} - Status: " . ucfirst($api['status']); ?></p>
    <form method="POST">
        <input type="hidden" name="api_id" value="<?php echo $api['id']; ?>">
        <div class="buttons">
            <button type="submit" name="status" value="enabled">Enabled</button>
            <button type="submit" name="status" value="disabled">Disabled</button>
        </div>
    </form>
    </div>
    <?php endwhile; ?>
    </div>
</body>
</html>