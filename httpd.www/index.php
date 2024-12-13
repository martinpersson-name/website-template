<!DOCTYPE html>
<html>
    <?php include '/customers/6/6/d/example.com/httpd.private/settings.php'; ?>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="/basic.css">
        <title>Page Title</title>
    </head>
    <body>
        <header>
            <h1>Page Title</h1>
        </header>
        <main>
            <h2>Testing database connection</h2>
            <?php
                $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                if ($connection === false)
                {
                    echo "<p>Database is not working somehow...</p>";
                }
                else
                {
                    echo "<p>Connected to database!!!</p>";
                }
            ?>
            <h2>Messages</h2>
            <?php
                $query = "SELECT message FROM messages";
                $result = mysqli_query($connection, $query);
                foreach ($result as $row)
                {
                    echo "<p>" . htmlspecialchars($row["message"]) . "</p>";
                }
                mysqli_close($connection);
            ?>
        </main>
        <footer>
            <hr>
            <h3>Footer</h3>
        </footer>
    </body>
</html>