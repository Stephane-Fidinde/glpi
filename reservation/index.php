<?php
/*
 
  ----------------------------------------------------------------------
GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2004 by the INDEPNET Development Team.
 
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------
 LICENSE

This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ----------------------------------------------------------------------
 Original Author of file:
 Purpose of file:
 ----------------------------------------------------------------------


*/
 

include ("_relpos.php");
include ($phproot . "/glpi/includes.php");
include ($phproot . "/glpi/includes_computers.php");
include ($phproot . "/glpi/includes_printers.php");
include ($phproot . "/glpi/includes_monitors.php");
include ($phproot . "/glpi/includes_peripherals.php");
include ($phproot . "/glpi/includes_networking.php");
include ($phproot . "/glpi/includes_reservation.php");

if(isset($_GET)) $tab = $_GET;
if(empty($tab) && isset($_POST)) $tab = $_POST;
if(!isset($tab["ID"])) $tab["ID"] = "";

if (isset($_GET["add"]))
{
	checkAuthentication("admin");
	addReservationItem($_GET);
	logEvent(0, "software", 4, "inventory", $_SESSION["glpiname"]." added reservation item ".$_GET["device_type"]."-".$_GET["id_device"].".");
	header("Location: $_SERVER[HTTP_REFERER]");
} 
else if (isset($_GET["delete"]))
{
	checkAuthentication("admin");
	deleteReservationItem($_GET);
	logEvent(0, "software", 4, "inventory", $_SESSION["glpiname"]." deleted reservation item.");
	header("Location: $_SERVER[HTTP_REFERER]");
}


if(!isset($_GET["start"])) $_GET["start"] = 0;
if (!isset($_GET["order"])) $_GET["order"] = "ASC";
if (!isset($_GET["field"])) $_GET["field"] = "glpi_reservation_item.ID";
if (!isset($_GET["phrasetype"])) $_GET["phrasetype"] = "contains";
if (!isset($_GET["contains"])) $_GET["contains"] = "";
if (!isset($_GET["sort"])) $_GET["sort"] = "glpi_reservation_item.ID";


	if (empty($tab["ID"]))
	checkAuthentication("admin");
	else checkAuthentication("normal");

	commonHeader("Reservation",$_SERVER["PHP_SELF"]);
	titleReservation();

	searchFormReservationItem($_GET["field"],$_GET["phrasetype"],$_GET["contains"],$_GET["sort"]);
	showReservationItemList($_SERVER["PHP_SELF"],$_SESSION["glpiname"],$_GET["field"],$_GET["phrasetype"],$_GET["contains"],$_GET["sort"],$_GET["order"],$_GET["start"]);
	commonFooter();


?>