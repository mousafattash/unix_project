<?php

$servername = "db"; 
$username = "root"; 
$password = "123"; 
$dbname = "dictionary";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$definition = "";
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST['word'];

    $sql = "SELECT definition FROM words WHERE word = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $word);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $definition = $row["definition"];
    } else {
        $definition = "No definition found for the word: " . htmlspecialchars($word);
        $error = true;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Dictionary App test</h1>
        <form method="post" action="">
            <div class="search-box">
                <input type="text" name="word" id="searchInput" placeholder="Enter a word..." required>
                <button type="submit">Search</button>
            </div>
        </form>
        <div class="loading" id="loading" style="display: none;">Searching...</div>

        <?php if (!empty($definition)): ?>
            <div class="result" id="result" style="display: block;">
                <div class="word-title">
                    <span id="word"><?php echo htmlspecialchars($_POST['word']); ?></span>
                </div>
                <div class="meaning" id="meaning"><?php echo htmlspecialchars($definition); ?></div>
            </div>
        <?php elseif ($error): ?>
            <div class="error" id="error" style="display: block;">
                <?php echo htmlspecialchars($definition); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>