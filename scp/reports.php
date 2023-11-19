<?php
/*************************************************************************
    tickets.php
    
    Handles all tickets related actions.
 
    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2012 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/

require('staff.inc.php');
require_once(INCLUDE_DIR.'class.ticket.php');
require_once(INCLUDE_DIR.'class.dept.php');
require_once(INCLUDE_DIR.'class.filter.php');
require_once(INCLUDE_DIR.'class.canned.php');


$page='';

/*... Quick stats ...*/
$stats= $thisstaff->getTicketsStats();

//Navigation
$nav->setTabActive('reports');
$inc = 'reports.inc.php';

if($_REQUEST['a']=='open' && $thisstaff->canCreateTickets())
    $inc = 'ticket-open.inc.php';    
elseif($_REQUEST['a'] == 'export') {
        require_once(INCLUDE_DIR.'class.export.php');
        $ts = strftime('%Y%m%d');
        if (!($token=$_REQUEST['h']))
            $errors['err'] = 'Query token required';
        elseif (!($query=$_SESSION['search_'.$token]))
            $errors['err'] = 'Query token not found';
        elseif (!Export::saveTickets($query, "tickets-$ts.csv", 'csv'))
            $errors['err'] = 'Internal error: Unable to dump query results';
}
else if($_REQUEST['a'] == 'print' && $_REQUEST['hash'] )
{
  $inc = 'reports-print.inc.php';
  require_once(STAFFINC_DIR.$inc);
	exit;
}

require_once(STAFFINC_DIR.'header.inc.php');
require_once(STAFFINC_DIR.$inc);
require_once(STAFFINC_DIR.'footer.inc.php');
?>
