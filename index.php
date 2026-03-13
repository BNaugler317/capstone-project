<?php
    // campaign list query. displays list of campaigns in the menu
    require("database.php");

    $section = $_GET['section'] ?? 'campaigns';
    $selectedCampaignID = $_GET['campaignID'] ?? null;

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
              <div class="section-title">Campaigns</div>

              <!-- Left panel display data-->
              <div class="content-grid">
                <div class="panel panel-display">
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
                      <?php echo nl2br(htmlspecialchars($selectedCampaign['createdAT'])); ?>
                    </p>
                  <?php else : ?>
                    <p>Select a campaign from the menu to view details.</p>
                  <?php endif; ?>
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