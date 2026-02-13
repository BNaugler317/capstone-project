<?php
// map_editor.php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dungeon Master's Guide - Map Editor</title>
        <link rel="stylesheet" type="text/css" href="css/capstone.css" />
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Dungeon Map Editor</h2>

            <div class="map-editor">
              <!-- top / main canvas area -->
               <div class="map-canvas">
                <canvas id="mapCanvas" width="900" height="500"></canvas>
               </div>

               <!-- right panel Room list -->
                <aside class="map-side-panel">
                  <h3>Room Details</h3>
                  <div id="roomDets">
                    <p>No Rooms yet.</p>
                  </div>
                </aside>

                <!-- bottom panel Room Form -->
                 <section class="map-details">
                    <h3>Room Editor</h3>
                    <form id="roomForm">
                      <label for="roomName">Room Name:</label><br />
                      <input type="text" id="roomName" name="roomName" /><br />

                      <label for="roomDescription">Description</label><br />
                      <textarea id="roomDescription" name="roomDescription" rows="4" cols="50"></textarea><br />

                      <button type="button" id="saveRoomBtn">Save Room Details</button>
                    </form>
                 </section>
            </div>
        </main>

        <?php include("footer.php"); ?>
        
    </body>
</html>