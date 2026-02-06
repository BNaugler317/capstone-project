<?php
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Dungeon Master's Guide - Home</title>
        <link rel="stylesheet" type="text/css" href="css/capstone.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
          <h1>Database Connection Error</h1>
          <p>There was an error connecting to the database. Please try again later.</p>
          <p>Error details: <?php echo $_SESSION["database_error"]; ?></p>
        </main>

        <?php include("footer.php"); ?>

    </body>
</html>