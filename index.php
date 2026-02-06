<?php

    require("database.php");
// Get locations from the database
$query = 'SELECT locationName, locationDescription FROM locations';

  $statement = $db->prepare($query);
  $statement->execute();
  $locations = $statement->fetchAll();
  $statement->closeCursor();

// get campaigns from the database
$query = 'SELECT name, description, campaignEvents, factions FROM campaigns';

  $statement = $db->prepare($query);
  $statement->execute();
  $campaigns = $statement->fetchAll();
  $statement->closeCursor();

// get npcs from the database
$query = 'SELECT npcName, npcDescription, npcNotes FROM npcs';

  $statement = $db->prepare($query);
  $statement->execute();
  $npcs = $statement->fetchAll();
  $statement->closeCursor();

// get enemies from the database
$query = 'SELECT enemyName, enemyDescription, enemyNotes FROM enemies';

  $statement = $db->prepare($query);
  $statement->execute();
  $enemies = $statement->fetchAll();
  $statement->closeCursor();


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
          <h2>Locations</h2>
          <?php foreach ($locations as $location) : ?>
            <section>
              <h3><?php echo htmlspecialchars($location['locationName']); ?></h3>
              <p><?php echo htmlspecialchars($location['locationDescription']); ?></p>
            </section>
          <?php endforeach; ?>

          <h2>Campaigns</h2>
          <?php foreach ($campaigns as $c) : ?>
          <section>
              <h3><?php echo htmlspecialchars($c['name']); ?> (ID: <?php echo (int)$c['campaignID']; ?>)</h3>
              <p><?php echo htmlspecialchars($c['description']); ?></p>
          </section>
          <?php endforeach; ?>

            <h2>NPCs</h2>
            <?php foreach ($npcs as $npc) : ?>
            <section>
              <h3><?php echo htmlspecialchars($npc['npcName']); ?></h3>
              <p><?php echo htmlspecialchars($npc['npcDescription']); ?></p>
            </section>
            <?php endforeach; ?>

            <h2>Enemies</h2>
            <?php foreach ($enemies as $enemy) : ?>
            <section>
              <h3><?php echo htmlspecialchars($enemy['enemyName']); ?></h3>
              <p><?php echo htmlspecialchars($enemy['enemyDescription']); ?></p>
            </section>
            <?php endforeach; ?>

          
        </main>

        <?php include("footer.php"); ?>

    </body>
</html>