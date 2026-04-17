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
      Campaign Details ▼ 
    </div>

    <div class="menu-submenu<?php echo $selectedCampaignID ? '' : ' closed'; ?>">
      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
            Locations ▼ 
        </div>

        <div class="menu-submenu<?php echo $section === 'locations' ? '' : ' closed'; ?>">
          <?php if ($selectedCampaignID && count($locations) > 0) : ?>
            <?php foreach ($locations as $location) : ?>
              <?php $isSelectedLocation = ($selectedLocationID == $location['locationID']); ?>

              <a href="index.php?section=locations&campaignID=<?php echo $selectedCampaignID; ?>&locationID=<?php echo $location['locationID']; ?>"
                class="menu-sub-item<?php echo $isSelectedLocation ? ' is-active' : ''; ?>">
                <?php echo htmlspecialchars($location['locationName']); ?>
              </a>
            <?php endforeach; ?>
          <?php elseif ($selectedCampaignID) : ?>
            <p class="menu-sub-item">No locations found</p>
          <?php endif; ?>
        </div>
      </div>
 
      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
            NPC's ▼ 
        </div>

        <div class="menu-submenu<?php echo $section === 'npcs' ? '' : ' closed'; ?>">
          <?php if ($selectedCampaignID && count($npcs) > 0) : ?>
            <?php foreach ($npcs as $npc) : ?>
              <?php $isSelectedNpc = ($selectedNpcID == $npc['npcID']); ?>

              <a href="index.php?section=npcs&campaignID=<?php echo $selectedCampaignID; ?>&npcID=<?php echo $npc['npcID']; ?>"
                class="menu-sub-item<?php echo $isSelectedNpc ? ' is-active' : ''; ?>">
                <?php echo htmlspecialchars($npc['npcName']); ?>
              </a>
            <?php endforeach; ?>
          <?php elseif ($selectedCampaignID) : ?>
            <p class="menu-sub-item">No NPC's found</p>
          <?php endif; ?>
        </div>
      </div>

      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
            Enemies ▼ 
        </div>

        <div class="menu-submenu<?php echo $section === 'enemies' ? '' : ' closed'; ?>">
          <?php if ($selectedCampaignID && count($enemies) > 0) : ?>
            <?php foreach ($enemies as $enemy) : ?>
              <?php $isSelectedEnemy = ($selectedEnemyID == $enemy['enemyID']); ?>

              <a href="index.php?section=enemies&campaignID=<?php echo $selectedCampaignID; ?>&enemyID=<?php echo $enemy['enemyID']; ?>"
                class="menu-sub-item<?php echo $isSelectedEnemy ? ' is-active' : ''; ?>">
                <?php echo htmlspecialchars($enemy['enemyName']); ?>
              </a>
            <?php endforeach; ?>
          <?php elseif ($selectedCampaignID) : ?>
            <p class="menu-sub-item">No Enemies found</p>
          <?php endif; ?>
        </div>
      </div>

      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
            Factions ▼ 
        </div>

        <div class="menu-submenu<?php echo $section === 'factions' ? '' : ' closed'; ?>">
          <?php if ($selectedCampaignID && count($factions) > 0) : ?>
            <?php foreach ($factions as $faction) : ?>
              <?php $isSelectedFaction = ($selectedFactionID == $faction['factionID']); ?>

              <a href="index.php?section=factions&campaignID=<?php echo $selectedCampaignID; ?>&factionID=<?php echo $faction['factionID']; ?>"
                class="menu-sub-item<?php echo $isSelectedFaction ? ' is-active' : ''; ?>">
                <?php echo htmlspecialchars($faction['name']); ?>
              </a>
            <?php endforeach; ?>
          <?php elseif ($selectedCampaignID) : ?>
            <p class="menu-sub-item">No Factions found</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="menu-group">
    <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
      World Details ▼
    </div>

    <div class="menu-submenu<?php echo $selectedCampaignID ? '' : ' closed'; ?>">
      <a
        href="<?php echo $selectedCampaignID ? 'index.php?section=worldDescription&campaignID=' . $selectedCampaignID : '#'; ?>"
        class="menu-sub-item<?php echo ($section === 'worldDescription') ? ' is-active' : ''; ?><?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>"
      >
        World Description
      </a>

      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
          World Religions ▼
      </div>

      <div class="menu-submenu<?php echo $section === 'worldReligions' ? '' : ' closed'; ?>">
        <?php if ($selectedCampaignID && count($religions) > 0) : ?>
          <?php foreach ($religions as $religion) : ?>
                <?php $isSelectedReligion = ($selectedReligionID == $religion['religionID']); ?>

            <a
              href="index.php?section=worldReligions&campaignID=<?php echo $selectedCampaignID; ?>&religionID=<?php echo $religion['religionID']; ?>"
              class="menu-sub-item<?php echo $isSelectedReligion ? ' is-active' : ''; ?>"
            >
              <?php echo htmlspecialchars($religion['religionName']); ?>
            </a>
          <?php endforeach; ?>
        <?php elseif ($selectedCampaignID) : ?>
          <p class="menu-sub-item">No religions found.</p>
        <?php endif; ?>
      </div>  

      <div class="menu-group">
        <div class="menu-group-title menu-toggle<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?>">
          World Languages ▼
        </div>

        <div class="menu-submenu<?php echo $section === 'worldLanguages' ? '' : ' closed'; ?>">
          <?php if ($selectedCampaignID && count($languages) > 0) : ?>
            <?php foreach ($languages as $language) : ?>
              <?php $isSelectedLanguage = ($selectedLanguageID == $language['languageID']); ?>

            <a
                 href="index.php?section=worldLanguages&campaignID=<?php echo $selectedCampaignID; ?>&languageID=<?php echo $language['languageID']; ?>"
                class="menu-sub-item<?php echo $isSelectedLanguage ? ' is-active' : ''; ?>"
              >
                <?php echo htmlspecialchars($language['languageName']); ?>
              </a>
            <?php endforeach; ?>
          ?php elseif ($selectedCampaignID) : ?>
            <p class="menu-sub-item">No languages found.</p>
              <?php endif; ?>
        </div>
      </div>
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
      class="menu-item<?php echo $selectedCampaignID ? '' : ' is-disabled'; ?><?php echo $section === 'mapEditor' ? ' is-active' : ''; ?>"
    >
      Map Editor
    </a>
  </div>
</aside>