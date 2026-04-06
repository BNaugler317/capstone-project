<?php
    // campaign list query. displays list of campaigns in the menu
    require("database.php");

    $section = $_GET['section'] ?? 'campaigns';
    $selectedCampaignID = $_GET['campaignID'] ?? null;
    $selectedLocationID = $_GET['locationID'] ?? null;

    $campaigns = [];

    $query = "SELECT campaignID, name, description FROM campaigns ORDER BY name";

    $statement = $db->prepare($query);
    $statement->execute();
    $campaigns = $statement->fetchAll();
    $statement->closeCursor();

    // campaign data query. displays campaign data
    $selectedCampaign = null;

    if ($selectedCampaignID) {
        $query = "SELECT campaignID, name, description, campaignEvents, createdAT
                  FROM campaigns
                  WHERE campaignID = :campaignID";
        $statement = $db->prepare($query);
        $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
        $statement->execute();

        $selectedCampaign = $statement->fetch();
        $statement->closeCursor();
    }

// campaign details Locations will display list of selectable locations than display data on left panel

$locations = [];

if ($selectedCampaignID) {
  $query = "SELECT locationID, locationName FROM Locations WHERE campaignID = :campaignID ORDER BY locationName";

  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $locations = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedLocation = null;

if ($selectedCampaignID && $selectedLocationID) {
  $query = "SELECT * FROM Locations WHERE locationID = :locationID AND campaignID = :campaignID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedLocation = $statement->fetch();
  $statement->closeCursor();
}



?>
<!DOCTYPE html>
<html>

    <head>
        <title>Dungeon Master's Guide - Home</title>
        <link rel="stylesheet" type="text/css" href="css/capstone.css" />
    </head>

    <body class="page-index">
        <?php include("header.php"); ?>

        <main>
          <div class="page" id="layout">
            <!-- left panel area -->
             <section class="content">
              <div class="section-title">
                <?php
                  switch ($section) {
                    case 'locations':
                      echo 'Locations';
                      break;
                    case 'npcs':
                      echo 'NPCs';
                      break;
                    case 'factions':
                      echo 'Factions';
                      break;
                    case 'enemies':
                      echo 'Enemies';
                      break;
                    case 'worldDetails':
                      echo 'World Details';
                      break;
                    default:
                      echo 'Campaigns';
                  }
                ?>
              </div>

              <!-- Left panel display data-->
              <div class="content-grid">
                <div class="panel panel-display">
                  <div class="panel-display-content">
                    <?php if (!$selectedCampaignID) : ?>
                      <p>Select a campaign from the campaign menu.</p>

                    <?php elseif ($section === 'campaigns') : ?>
                      <h3>Campaign Display</h3>

                    <?php if ($selectedCampaign) : ?>
                      <h4><?php echo htmlspecialchars($selectedCampaign['name']);?></h4>

                      <p>
                        <strong>Description:</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedCampaign['description'])); ?>
                      </p>

                      <p>
                        <strong>Campaign Events:</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedCampaign['campaignEvents'])); ?>
                      </p>

                      <p>
                        <strong>Created:</strong><br>
                        <?php echo htmlspecialchars($selectedCampaign['createdAT']); ?>
                      </p>
                    <?php else : ?>
                      <p>Select a campaign from the menu to view details.</p>
                    <?php endif; ?>

                    <!--campaign details displays in left panel-->

                    <?php elseif ($section === 'locations') : ?>
                      <h3>Location Display</h3>

                    <?php if ($selectedLocation) : ?>
                      <h4><?php echo htmlspecialchars($selectedLocation['locationName']); ?></h4>

                      <p>
                        <strong>Description:</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedLocation['locationDescription'])); ?>
                      </p>

                      <p>
                        <strong>NPC Count:</strong><br>
                        <?php echo htmlspecialchars($selectedLocation['npcCount']); ?>
                      </p>

                      <p>
                        <strong>Enemy Count:</strong><br>
                        <?php echo htmlspecialchars($selectedLocation['enemyCount']); ?>
                      </p>

                      <p>
                        <strong>Location Items:</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedLocation['locationItems'])); ?>
                      </p>

                      <p>
                        <strong>Dungeons:</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedLocation['dungeons'])); ?>
                      </p>

                      <p>
                        <strong>Created:</strong><br>
                        <?php echo htmlspecialchars($selectedLocation['createdAT']); ?>
                      </p>

                    <?php else : ?>
                      <p>Select a location from the menu to view its details.</p>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                </div>

              </div>

              <div class="panel panel-editor">
                <!-- Right panel input-->
              </div>
            </div>
            </section>

            <!-- right panel slide out menu-->
            <?php include("menu.php"); ?>

          </div>
          
        </main>

        <?php include("footer.php"); ?>

    </body>
</html>