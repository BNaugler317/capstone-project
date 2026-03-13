<?php
  require("database.php");

  $section = $_GET['section'] ?? 'campaigns';
  $selectedCampaignID = $_GET['campaignID'] ?? null;

  $campaigns = [];

  $query = "SELECT campaignID, name, description FROM campaigns ORDER BY name";

  $statement = $db->prepare($query);
  $statement->execute();
  $campaigns = $statement->fetchAll();
  $statement->closeCursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dungeon Master's Guide - Map Editor</title>
        <link rel="stylesheet" type="text/css" href="css/capstone.css" />
    </head>

    <body class="page-map">
        <?php include("header.php"); ?>

        <main>
            <div class="page">
              <!-- Left: main editor area -->
               <section class="editor">
                <div class="editor-title">Map Editor</div>

                <div class="map-stage">
                  <canvas id="mapCanvas" width="1200" height="520"></canvas>
                </div>

                <div class="editor-bottom">
                  <!-- bottom left: saved room info -->
                   <div class="panel panel-saved">
                    <h3>Room Description</h3>
                    <div class="panel-scroll">
                      <p><strong>Hallway:</strong> A narrow stone corridor...</p>
                      <p><strong>Great Chamber:</strong> A vast room with pillars...</p>
                    </div>
                   </div>
                    <!-- bottom right: form -->
                    <div class="panel panel-editor">
                      <h3>Room Editor</h3>

                      <div class="panel-form">
                        <label for="roomDescription">Room Description:</label>
                        <textarea id="roomDescription" rows="5"></textarea>

                        <label for="roomName">Room Name</label>
                        <input type="text" id="roomName" />

                        <label for="roomNpcs">NPC's</label>
                        <input type="text" id="roomNpcs" />

                        <label for="roomEnemies">Enemies</label>
                        <input type="text" id="roomEnemies" />

                        <label for="roomTreasures">Treasures</label>
                        <input type="text" id="roomTreasures" />

                        <button type="button" id="saveRoomBtn">Save</button>
                      </div>
                    </div>
                </div>
               </section>

               <!-- RIGHT: Sidebar menu -->
                <?php include("menu.php"); ?>

            </div>
        </main>

        <?php include("footer.php"); ?>
        
    </body>
</html>