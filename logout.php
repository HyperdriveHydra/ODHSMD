<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
?>
<?php
/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>
 */
?>
<?PHP
session_cache_expire(30);
session_start();
?>
<?php if ($_SESSION['system_type'] == 'MedTracker') { ?>
<!-- page generated by the BowdoinRMH software package -->
<html>
    <head>
        <meta HTTP-EQUIV="REFRESH" content="2; url=index.php">

        <?php require('universal.inc') ?>
    </head>
    <body>
        <nav>
            <span id="nav-top">
                <span class="logo">
                    <a class="navbar-brand">
                        <img src="images/odhs.png">
                    </a>
                    <a class="navbar-brand" id="vms-logo"> MedTracker </a>
                </span>
                <img id="menu-toggle" src="images/menu.png">
            </span>
        </nav>
        </nav>
        <main>
                <?PHP
                session_unset();
                session_write_close();
                ?>
                <p class="happy-toast centered">You have been logged out.</p>
        </main>
    </body>
</html>
<?php } else if ($_SESSION['system_type'] == 'VMS') { ?>
<!-- page generated by the BowdoinRMH software package -->
<html>
    <head>
        <meta HTTP-EQUIV="REFRESH" content="2; url=VMS_index.php">

        <?php require('universal.inc') ?>
    </head>
    <body>
        <nav>
            <span id="nav-top">
                <span class="logo">
                    <a class="navbar-brand">
                        <img src="images/odhs.png">
                    </a>
                    <a class="navbar-brand" id="vms-logo"> VMS </a>
                </span>
                <img id="menu-toggle" src="images/menu.png">
            </span>
        </nav>
        <main>
                <?PHP
                session_unset();
                session_write_close();
                ?>
                <p class="happy-toast centered">You have been logged out.</p>
        </main>
    </body>
</html>
<?php } else { ?>
<!-- page generated by the BowdoinRMH software package -->
<html>
    <head>
        <meta HTTP-EQUIV="REFRESH" content="2; url=centralMenu.php">

        <?php require('universal.inc') ?>
    </head>
    <body>
        <nav>
        <span id="nav-top">
                <span class="logo">
                    <a class="navbar-brand">
                        <img src="images/odhs.png">
                    </a>
                    <a class="navbar-brand" id="vms-logo"> ODHS Menu </a>
                </span>
                <img id="menu-toggle" src="images/menu.png">
            </span>
        </nav>
        </nav>
        <main>
                <?PHP
                session_unset();
                session_write_close();
                ?>
                <p class="happy-toast centered">You have been logged out.</p>
        </main>
    </body>
</html>
<?php } ?>