<aside class="sidebar" id="sidebar">
  <div class="sidebar-title">MENU</div>

  <div class="menu-group">
    <div class="menu-group-title menu-toggle">
      Campaigns ▼
    </div>

    <div class="menu-submenu">

      <?php if (count($campaigns) > 0) : ?>
        <?php foreach ($campaigns as $campaign) : ?>
          <?php $isSelected = ($selectedCampaignID == $campaign['campaignID']); ?>

          <a
            href="index.php?section=campaigns&campaignID=<?php echo $campaign['campaignID']; ?>"
            class="menu-sub-item<?php echo $isSelected ? ' is-active' : ''; ?>"
          >
            <?php echo htmlspecialchars($campaign['name']); ?>
          </a>
        <?php endforeach; ?>
      <?php else : ?>
        <p>No campaigns found.</p>
      <?php endif; ?>

    </div>

  </div>

  <div class="menu-group">
    <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
      Campain Details ▼ 
    </div>

    <div class="menu-submenu">
      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=locations&campaignID=' . $selectedCampaignID : '#'; ?>"
        class=" menu-sub-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        Locations
      </a>

      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=npcs&campaignID=' . $selectedCampaignID : '#'; ?>"
        class="menu-sub-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        NPCs
      </a>

      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=factions&campaignID=' . $selectedCampaignID : '#'; ?>"
        class="menu-sub-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        Factions
      </a>

      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=enemies&campaignID=' . $selectedCampaignID : '#'; ?>"
        class="menu-sub-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        Enemies
      </a>

      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=worldDetails&campaignID=' . $selectedCampaignID : '#'; ?>"
        class="menu-sub-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        World Details
      </a>
    </div>
  </div>

  <div class="menu-group">
    <div class="menu-group-title<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
      Players Tab ▼
    </div>
  </div>

  <div class="menu-group">
    <a
      href="<?php echo $selectedCampaignID ? 'map_editor.php?campaignID=' . $selectedCampaignID : '#'; ?>"
      class="menu-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
    >
      Map Editor
    </a>
  </div>
</aside>