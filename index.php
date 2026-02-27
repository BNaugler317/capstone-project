<?php

    require("database.php");

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
            <!-- left main content -->
             <section class="content">
              <div class="section-title">Locations</div>

              <div class="content-grid">
                <div class="panel panel-display">
                  <!-- saved info appears here -->
                </div>

                <div class="panel panel-editor">
                  <!-- form inputs appear here -->
                </div>
              </div>
            </section>

            <!-- right menu -->
            <aside class="sidebar" id="sidebar">
              <div class="sidebar-title">MENU</div>

              <div class="menu-group">
                <div class="menu-group-title">WORLD DETAILS</div>
                <button class="menu-item is-active">Locations</button>
                <button class="menu-item">FACTIONS</button>
                <button class="menu-item">NPC'S</button>
                <button class="menu-item">ENEMIES</button>
                <button class="menu-item">TREASURES</button>
                <button class="menu-item">MAP EDITOR</button>
              </div>

              <div class="menu-group">
                <div class="menu-group_title">PLAYERS TAB</div>
              </div>
            </aside>
          </div>
          
        </main>

        <?php include("footer.php"); ?>

    </body>
</html>