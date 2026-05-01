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

    $mode = $_GET['mode'] ?? null;

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
$npcCount = 0;
$enemyCount = 0;
$locationNpcs = []; 
$locationEnemies = [];

if ($selectedCampaignID && $selectedLocationID) {
  $query = "SELECT * FROM Locations WHERE locationID = :locationID AND campaignID = :campaignID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->execute();
  $selectedLocation = $statement->fetch();
  $statement->closeCursor();

  // calculates NPC count

  $query = "SELECT COALESCE(SUM(quantity), 0) AS npcCount FROM locationNpcs WHERE locationID = :locationID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->execute();
  $npcCount = $statement->fetchColumn();
  $statement->closeCursor();

  // calculates Enemy count

  $query = "SELECT COALESCE(SUM(quantity), 0) AS enemyCount FROM locationEnemies WHERE locationID = :locationID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->execute();
  $enemyCount = $statement->fetchColumn();
  $statement->closeCursor();

  // gets NPC names and quantities for selected location

  $query = "SELECT n.npcName, ln.quantity FROM locationNpcs ln JOIN npcs n ON ln.npcID = n.npcID WHERE ln.locationID = :locationID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->execute();
  $locationNpcs = $statement->fetchAll();
  $statement->closeCursor();

  // gets Enemy names and quantities for selected location

  $query = "SELECT e.enemyName, le.quantity FROM locationEnemies le JOIN Enemies e ON le.enemyID = e.enemyID WHERE le.locationID = :locationID";

  $statement = $db->prepare($query);
  $statement->bindValue(':locationID', $selectedLocationID, PDO::PARAM_INT);
  $statement->execute();
  $locationEnemies = $statement->fetchAll();
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

// campaign data input query 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCampaign'])) {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);
  $campaignEvents = trim($_POST['campaignEvents']);

  $query = "INSERT INTO campaigns (name, description, campaignEvents) 
  VALUES (:name, :description, :campaignEvents)";

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':description', $description);
  $statement->bindValue(':campaignEvents', $campaignEvents);
  $statement->execute();
  $statement->closeCursor();

  header("Location: index.php?section=campaigns");
  exit();
}

// location data input query 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addLocation'])) {
  $locationName = trim($_POST['locationName']);
  $locationDescription = trim($_POST['locationDescription']);
  $locationItems = trim($_POST['locationItems']);
  $dungeons = trim($_POST['dungeons']);

  $query = "INSERT INTO Locations (campaignID, locationName, locationDescription, locationItems, dungeons)
  VALUES (:campaignID, :locationName, :locationDescription, :locationItems, :dungeons)";

  $statement = $db->prepare($query);
  $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
  $statement->bindValue(':locationName', $locationName);
  $statement->bindValue(':locationDescription', $locationDescription);
  $statement->bindValue(':locationItems', $locationItems);
  $statement->bindValue(':dungeons', $dungeons);
  $statement->execute();
  $locationID = $db->lastInsertId();
  $statement->closeCursor();

  $npcIDs = $_POST['npcID'] ?? [];
  $npcQuantities = $_POST['npcQuantity'] ?? [];

  for ($i = 0; $i < count($npcIDs); $i++) {
    if (!empty($npcIDs[$i]) && !empty($npcQuantities[$i])) {
      $query = "INSERT INTO locationNpcs (locationID, npcID, quantity) VALUES (:locationID, :npcID, :quantity)";

      $statement = $db->prepare($query);
      $statement->bindValue(':locationID', $locationID, PDO::PARAM_INT);
      $statement->bindValue(':npcID', $npcIDs[$i], PDO::PARAM_INT);
      $statement->bindValue(':quantity', $npcQuantities[$i], PDO::PARAM_INT);
      $statement->execute();
      $statement->closeCursor();
      
    }
  }

  $enemyIDs = $_POST['enemyID'] ?? [];
  $enemyQuantities = $_POST['enemyQuantity'] ?? [];

  for ($i = 0; $i < count($enemyIDs); $i++) {
    if (!empty($enemyIDs[$i]) && !empty($enemyQuantities[$i])) {
      $query = "INSERT INTO locationEnemies (locationID, enemyID, quantity) VALUES (:locationID, :enemyID, :quantity)";

      $statement = $db->prepare($query);
      $statement->bindValue(':locationID', $locationID, PDO::PARAM_INT);
      $statement->bindValue(':enemyID', $enemyIDs[$i], PDO::PARAM_INT);
      $statement->bindValue(':quantity', $enemyQuantities[$i], PDO::PARAM_INT);
      $statement->execute();
      $statement->closeCursor();
    }
  }

  header("Location: index.php?section=locations&campaignID=$selectedCampaignID");
  exit();
}

// npc data input query

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addNpc'])) {
    $npcName = trim($_POST['npcName']);
    $npcDescription = trim($_POST['npcDescription']);
    $npcNotes = trim($_POST['npcNotes']);
    
    $query = "INSERT INTO npcs (campaignID, npcName, npcDescription, npcNotes)
    VALUES (:campaignID, :npcName, :npcDescription, :npcNotes)";

    $statement = $db->prepare($query);
    $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
    $statement->bindValue(':npcName', $npcName);
    $statement->bindValue(':npcDescription', $npcDescription);
    $statement->bindValue(':npcNotes', $npcNotes);
    $statement->execute();
    $statement->closeCursor();

    header("Location: index.php?section=npcs&campaignID=$selectedCampaignID");
    exit();
  }

  // enemies data input query

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addEnemy'])) {
    $enemyName = trim($_POST['enemyName']);
    $enemyDescription = trim($_POST['enemyDescription']);
    $enemyNotes = trim($_POST['enemyNotes']);
    
    $query = "INSERT INTO Enemies (campaignID, enemyName, enemyDescription, enemyNotes)
    VALUES (:campaignID, :enemyName, :enemyDescription, :enemyNotes)";

    $statement = $db->prepare($query);
    $statement->bindValue(':campaignID', $selectedCampaignID, PDO::PARAM_INT);
    $statement->bindValue(':enemyName', $enemyName);
    $statement->bindValue(':enemyDescription', $enemyDescription);
    $statement->bindValue(':enemyNotes', $enemyNotes);
    $statement->execute();
    $statement->closeCursor();

    header("Location: index.php?section=enemies&campaignID=$selectedCampaignID");
    exit();
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
                      </p>

                      <?php foreach ($locationNpcs as $locationNpc): ?>
                        <p>
                          <?php echo htmlspecialchars($locationNpc['npcName']); ?>
                          x<?php echo htmlspecialchars($locationNpc['quantity']); ?>
                        </p>
                      <?php endforeach; ?>

                      <p>
                        <strong>Enemy Count:</strong><br>
                      </p>

                      <?php foreach ($locationEnemies as $locationEnemy): ?>
                        <p>
                          <?php echo htmlspecialchars($locationEnemy['enemyName']); ?>
                          x<?php echo htmlspecialchars($locationEnemy['quantity']); ?>
                        </p>
                      <?php endforeach; ?>

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

                <!-- Right panel input-->

                <!--campaign data input-->
                <div class="panel panel-editor">
                  <?php if ($section !== 'campaigns' && !$selectedCampaignID) : ?>

                    <p>Select a campaign first.</p>

                  <?php elseif ($section === 'campaigns' && $mode !== 'add') : ?>

                    <a href="index.php?section=campaigns&mode=add" class="menu-item">
                      Add New Campaign
                   </a>
                  <?php elseif ($section === 'campaigns' && $mode === 'add') : ?>
                    <h3>Add New Campaign</h3>

                    <form method="post">
                      <div class="form-group">
                        <label for="name">Campaign Name</label>
                        <input type="text" id="name" name="name" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="campaignEvents">Campaign Events</label>
                        <textarea id="campaignEvents" name="campaignEvents"></textarea>
                      </div>

                      <button type="submit" name="addCampaign">Submit</button>
                    </form>

                    <!--location data input-->

                  <?php elseif ($section === 'locations' && $mode !== 'add') : ?>

                        <a href="index.php?section=locations&campaignID=<?php echo $selectedCampaignID; ?>&mode=add" class="menu-item">
                          Add New Location
                        </a>
                      
                  <?php elseif ($section === 'locations' && $mode === 'add') : ?>

                    <h3>Add New Location</h3>

                    <form method="post">
                      <div class="form-group">
                        <label for="locationName">Location Name</label>
                        <input type="text" id="locationName" name="locationName" required>
                      </div>

                      <div class="form-group">
                        <label for="locationDescription">Description</label>
                        <textarea id="locationDescription" name="locationDescription"></textarea>
                      </div>

                      <h4>NPCs</h4>

                      <div class="npc-row">
                        <select name="npcID[]">
                          <option value="">Select NPC</option>
                          <?php foreach ($npcs as $npc): ?>
                            <option value="<?php echo $npc['npcID']; ?>">
                              <?php echo $npc['npcName']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>

                        <input type="number" name="npcQuantity[]" min="1" placeholder="Quantity">
                      </div>

                      <h4>Enemies</h4>

                      <div class="enemy-row">
                        <select name="enemyID[]">
                          <option value="">Select Enemy</option>
                          <?php foreach ($enemies as $enemy): ?>
                            <option value="<?php echo $enemy['enemyID']; ?>">
                              <?php echo $enemy['enemyName']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>

                        <input type="number" name="enemyQuantity[]" min="1" placeholder="Quantity">
                      </div>

                      <div class="form-group">
                        <label for="locationItems">Location Items</label>
                        <textarea id="locationItems" name="locationItems"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="dungeons">Dungeons</label>
                        <textarea id="dungeons" name="dungeons"></textarea>
                      </div>

                      <button type="submit" name="addLocation">Submit</button>
                    </form>


                    <!--NPC data input-->

                  <?php elseif ($section === 'npcs' && $mode !== 'add') : ?>

                    <a href="index.php?section=npcs&campaignID=<?php echo $selectedCampaignID; ?>&mode=add" class="menu-item">
                      Add New NPC
                    </a>
                      
                  <?php elseif ($section === 'npcs' && $mode === 'add') : ?>

                    <h3>Add New NPC</h3>

                    <form method="post">
                      <div class="form-group">
                        <label for="npcName">NPC Name</label>
                        <input type="text" id="npcName" name="npcName" required>
                      </div>

                      <div class="form-group">
                        <label for="npcDescription">Description</label>
                        <textarea id="npcDescription" name="npcDescription"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="npcNotes">Notes</label>
                        <textarea id="npcNotes" name="npcNotes"></textarea>
                      </div>
                      <button type="submit" name="addNpc">Submit</button>
                    </form>

                    <!--Enemy data input-->

                  <?php elseif ($section === 'enemies' && $mode !== 'add') : ?>

                    <a href="index.php?section=enemies&campaignID=<?php echo $selectedCampaignID; ?>&mode=add" class="menu-item">
                      Add New Enemy
                    </a>
                      
                  <?php elseif ($section === 'enemies' && $mode === 'add') : ?>

                    <h3>Add New Enemy</h3>

                    <form method="post">
                      <div class="form-group">
                        <label for="enemyName">Enemy Name</label>
                        <input type="text" id="enemyName" name="enemyName" required>
                      </div>

                      <div class="form-group">
                        <label for="enemyDescription">Description</label>
                        <textarea id="enemyDescription" name="enemyDescription"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="enemyNotes">Notes</label>
                        <textarea id="enemyNotes" name="enemyNotes"></textarea>
                      </div>
                      <button type="submit" name="addEnemy">Submit</button>
                    </form>
                  <?php endif; ?>
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