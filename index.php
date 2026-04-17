<?php
    // campaign list query. displays list of campaigns in the menu
    require("database.php");

    $section = $_GET['section'] ?? 'campaigns';
    $selectedCampaignID = $_GET['campaignID'] ?? null;
    $selectedLocationID = $_GET['locationID'] ?? null;
    $selectedNpcID = $_GET['npcID'] ?? null;
    $selectedEnemyID = $_GET['enemyID'] ?? null;
    $selectedFactionID = $_GET['factionID'] ?? null;
    $selectedReligionID = $_GET['religionID'] ?? null;
    $selectedLanguageID = $_GET['languageID'] ?? null;

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

// campaign details NPC's will display list of selectable npc's than display data on left panel

$npcs = [];

if ($selectedCampaignID) {
  $query = "SELECT npcID, npcName FROM npcs WHERE campaignID = :campaignID ORDER BY npcName";

  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $npcs = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedNpc = null;

if ($selectedCampaignID && $selectedNpcID) {
  $query = "SELECT * FROM npcs WHERE npcID = :npcID AND campaignID = :campaignID";

  $statement = $db->prepare($query);
  $statement->bindValue(':npcID', $selectedNpcID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedNpc = $statement->fetch();
  $statement->closeCursor();
}

// campaign details Enemies will display list of selectable enemies than display data on left panel

$enemies = [];

if ($selectedCampaignID) {
  $query = "SELECT enemyID, enemyName FROM Enemies WHERE campaignID = :campaignID ORDER BY enemyName";

  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $enemies = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedEnemy = null;

if ($selectedCampaignID && $selectedEnemyID) {
  $query = "SELECT * FROM Enemies WHERE enemyID = :enemyID AND campaignID = :campaignID";

  $statement = $db->prepare($query);
  $statement->bindValue(':enemyID', $selectedEnemyID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedEnemy = $statement->fetch();
  $statement->closeCursor();
}

// campaign details Factions will display list of selectable factions than display data on left panel

$factions = [];

if ($selectedCampaignID) {
  $query = "SELECT factionID, name FROM Factions WHERE campaignID = :campaignID ORDER BY name";

  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $factions = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedFaction = null;

if ($selectedCampaignID && $selectedFactionID) {
  $query = "SELECT * FROM Factions WHERE factionID = :factionID AND campaignID = :campaignID";

  $statement = $db->prepare($query);
  $statement->bindValue(':factionID', $selectedFactionID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedFaction = $statement->fetch();
  $statement->closeCursor();
}

// world description query
$selectedWorldDescription = null;

if ($selectedCampaignID) {
  $query = "SELECT * FROM worldDescription WHERE campaignID = :campaignID";
  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedWorldDescription = $statement->fetch();
  $statement->closeCursor();
}

// world Religion query
$religions = [];

if ($selectedCampaignID) {
  $query = "SELECT religionID, religionName FROM worldReligions WHERE campaignID = :campaignID ORDER BY religionName";
  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $religions = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedReligion = null;

if ($selectedCampaignID && $selectedReligionID) {
  $query = "SELECT * FROM worldReligions WHERE religionID = :religionID AND campaignID = :campaignID";
  $statement = $db->prepare($query);
  $statement->bindValue(':religionID', $selectedReligionID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedReligion = $statement->fetch();
  $statement->closeCursor();
}

// world languages query
$languages = [];

if ($selectedCampaignID) {
  $query = "SELECT languageID, languageName FROM worldLanguages WHERE campaignID = :campaignID ORDER BY languageName";
  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $languages = $statement->fetchAll();
  $statement->closeCursor();
}

$selectedLanguage = null;

if ($selectedCampaignID && $selectedLanguageID) {
  $query = "SELECT * FROM worldLanguages WHERE languageID = :languageID AND campaignID = :campaignID";
  $statement = $db->prepare($query);
  $statement->bindValue(':languageID', $selectedLanguageID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedLanguage = $statement->fetch();
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
                    case 'worldDescription':
                      echo 'World Description';
                      break;
                    case 'worldReligions':
                      echo 'World Religions';
                      break;
                    case 'worldLanguages':
                      echo 'World Languages';
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

                    <!--campaign details displays in left panel (Location)-->

                    <?php elseif ($section === 'locations') : ?>
                      <h3>Location Data</h3>

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
                    

                    <!--campaign details displays in left panel (NPC's)-->

                    <?php elseif ($section === 'npcs') : ?>
                      <h3>NPC Data</h3>

                      <?php if ($selectedNpc) : ?>
                        <h4><?php echo htmlspecialchars($selectedNpc['npcName']); ?></h4>

                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedNpc['npcDescription'])); ?>
                        </p>

                        <p>
                          <strong>Notes:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedNpc['npcNotes'])); ?>
                        </p>

                        <p>
                          <strong>Created:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedNpc['createdAT'])); ?>
                        </p>
                      <?php else : ?>
                        <p>Select an NPC from the menu to view details.</p>
                      <?php endif; ?>
                      
                      <!--campaign details displays in left panel (Enemies)-->

                      <?php elseif ($section === 'enemies') : ?>
                      <h3>Enemy Data</h3>

                      <?php if ($selectedEnemy) : ?>
                        <h4><?php echo htmlspecialchars($selectedEnemy['enemyName']); ?></h4>

                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedEnemy['enemyDescription'])); ?>
                        </p>

                        <p>
                          <strong>Notes:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedEnemy['enemyNotes'])); ?>
                        </p>

                        <p>
                          <strong>Created:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedEnemy['createdAT'])); ?>
                        </p>
                      <?php else : ?>
                        <p>Select an Enemy from the menu to view details.</p>
                      <?php endif; ?>
                      
                      <!--campaign details displays in left panel (Factions)-->

                      <?php elseif ($section === 'factions') : ?>
                      <h3>Faction Data</h3>

                      <?php if ($selectedFaction) : ?>
                        <h4><?php echo htmlspecialchars($selectedFaction['name']); ?></h4>

                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedFaction['description'])); ?>
                        </p>

                        <p>
                          <strong>Leader:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedFaction['leader'])); ?>
                        </p>

                        <p>
                          <strong>Created:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedFaction['createdAt'])); ?>
                        </p>
                      <?php else : ?>
                        <p>Select a Faction from the menu to view details.</p>
                      <?php endif; ?>
                      
                      <!--world details displays in left panel (world description)-->

                      <?php elseif ($section === 'worldDescription') : ?>
                        <h3>World Description</h3>

                        <?php if ($selectedWorldDescription) : ?>
                          <h4><?php echo htmlspecialchars($selectedWorldDescription['worldName']); ?></h4>
                        
                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedWorldDescription['worldDescription'])); ?>
                        </p>
                      <?php else : ?>
                        <p> no world description found for this campaign.</p>
                      <?php endif; ?>
                      
                      <!--world details displays in left panel (world Religions)-->

                      <?php elseif ($section === 'worldReligions') : ?>
                        <h3>World Religion Data</h3>

                        <?php if ($selectedReligion) : ?>
                          <h4><?php echo htmlspecialchars($selectedReligion['religionName']); ?></h4>

                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedReligion['religionDescription'])); ?>
                        </p>
                      <?php else : ?>
                        <p>Select a religion from the menu to view its details.</p>
                      <?php endif; ?>
                      
                      <!--world details displays in left panel (world Languages)-->

                      <?php elseif ($section === 'worldLanguages') : ?>
                        <h3>World Language Data</h3>

                        <?php if ($selectedLanguage) : ?>
                          <h4><?php echo htmlspecialchars($selectedLanguage['languageName']); ?></h4>

                        <p>
                          <strong>Description:</strong><br>
                          <?php echo nl2br(htmlspecialchars($selectedLanguage['languageDescription'])); ?>
                        </p>
                      <?php else : ?>
                        <p>Select a language from the menu to view its details.</p>
                      <?php endif; ?>
                      <?php endif; ?>



                  </div>  
                </div>

                <div class="panel panel-editor">
                  <!-- Right panel input-->
                </div>

              </div>

            </section>

            <!-- slide out menu-->
            <?php include("menu.php"); ?>

          </div>
          
        </main>

        <?php include("footer.php"); ?>

    </body>
</html>