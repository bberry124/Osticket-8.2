<?php
/*********************************************************************
    ajax.reports.php

    AJAX interface for reports -- both plot and tabular data are retrievable
    in JSON format from this utility. Please put plumbing in /scp/ajax.php
    pattern rules.

    Jared Hancock <jared@osticket.com>
    Copyright (c)  2006-2012 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/

if(!defined('INCLUDE_DIR')) die('403');

include_once(INCLUDE_DIR.'class.ticket.php');

/**
 * Overview Report
 * 
 * The overview report allows for the display of basic ticket statistics in
 * both graphical and tabular formats.
 */
class OverviewReportAjaxAPI extends AjaxController {
    function enumTabularGroups() {
        return $this->encode(array("dept"=>"Department", "topic"=>"Topics",
            # XXX: This will be relative to permissions based on the
            # logged-in-staff. For basic staff, this will be 'My Stats'
            "staff"=>"Staff"));
    }

    function getData() {
        global $thisstaff;

        if(($start = $this->get('start', 'last month'))) {
            $stop = $this->get('stop', 'now');
            if (substr($stop, 0, 1) == '+')
                $stop = $start . $stop;
        } else {
            $start = 'last month';
            $stop = 'now';
        }

        $start = 'FROM_UNIXTIME('.strtotime($start).')';
        $stop = 'FROM_UNIXTIME('.strtotime($stop).')';

        $groups = array(
            "dept" => array(
                "table" => DEPT_TABLE,
                "pk" => "id",
                "ck" => "dept_id",
                "sort" => 'T1.name',
                "fields" => 'T1.name',
                "headers" => array('Department'),
                "filter" => ('T1.id IN ('.implode(',', db_input($thisstaff->getDepts())).')')
            ),
            "topic" => array(
                "table" => TOPIC_TABLE,
                "pk" => "topic_id",
                "ck" => "topic_id",
                "sort" => 'name',
                "fields" => "CONCAT_WS(' / ',"
                    ."(SELECT P.topic FROM ".TOPIC_TABLE." P WHERE P.topic_id = T1.topic_pid),"
                    ."T1.topic) as name ",
                "headers" => array('Help Topic'),
                "filter" => '1'
            ),
            "staff" => array(
                "table" => STAFF_TABLE,
                "pk" => 'staff_id',
                "ck" => "staff_id",
                "sort" => 'name',
                "fields" => "CONCAT_WS(' ', T1.firstname, T1.lastname) as name",
                "headers" => array('Staff Member'),
                "filter" =>
                    ('T1.staff_id=S1.staff_id
                      AND 
                      (T1.staff_id='.db_input($thisstaff->getId())
                        .(($depts=$thisstaff->getManagedDepartments())?
                            (' OR T1.dept_id IN('.implode(',', db_input($depts)).')'):'')
                        .(($thisstaff->canViewStaffStats())?
                            (' OR T1.dept_id IN('.implode(',', db_input($thisstaff->getDepts())).')'):'')
                     .')'
                     ) 
            )
        );
        $group = $this->get('group', 'dept');
        $info = isset($groups[$group])?$groups[$group]:$groups['dept'];

        # XXX: Die if $group not in $groups

        $queries=array(
            array(6, 'SELECT '.$info['fields'].',
                COUNT(*)-COUNT(NULLIF(A1.state, "created")) AS Opened,
								COUNT(*)-COUNT(NULLIF(A1.state, "closed")) AS Closed,
                COUNT(*)-COUNT(NULLIF(A1.state, "assigned")) AS Assigned,
                COUNT(*)-COUNT(NULLIF(A1.state, "overdue")) AS Overdue,

                COUNT(*)-COUNT(NULLIF(A1.state, "reopened")) AS Reopened
            FROM '.$info['table'].' T1 
                LEFT JOIN '.TICKET_EVENT_TABLE.' A1 
                    ON (A1.'.$info['ck'].'=T1.'.$info['pk'].'
                         AND NOT annulled 
                         AND (A1.timestamp BETWEEN '.$start.' AND '.$stop.'))
                LEFT JOIN '.STAFF_TABLE.' S1 ON (S1.staff_id=A1.staff_id)
            WHERE '.$info['filter'].'
            GROUP BY T1.'.$info['pk'].'
            ORDER BY '.$info['sort']),

            array(1, 'SELECT '.$info['fields'].',
                FORMAT(AVG(DATEDIFF(T2.closed, T2.created)),1) AS ServiceTime
            FROM '.$info['table'].' T1 
                LEFT JOIN '.TICKET_TABLE.' T2 ON (T2.'.$info['ck'].'=T1.'.$info['pk'].')
                LEFT JOIN '.STAFF_TABLE.' S1 ON (S1.staff_id=T2.staff_id)
            WHERE '.$info['filter'].' AND T2.closed BETWEEN '.$start.' AND '.$stop.'
            GROUP BY T1.'.$info['pk'].'
            ORDER BY '.$info['sort']),

            array(1, 'SELECT '.$info['fields'].',
                FORMAT(AVG(DATEDIFF(B2.created, B1.created)),1) AS ResponseTime
            FROM '.$info['table'].' T1 
                LEFT JOIN '.TICKET_TABLE.' T2 ON (T2.'.$info['ck'].'=T1.'.$info['pk'].')
                LEFT JOIN '.TICKET_THREAD_TABLE.' B2 ON (B2.ticket_id = T2.ticket_id
                    AND B2.thread_type="R")
                LEFT JOIN '.TICKET_THREAD_TABLE.' B1 ON (B2.pid = B1.id)
                LEFT JOIN '.STAFF_TABLE.' S1 ON (S1.staff_id=B2.staff_id)
            WHERE '.$info['filter'].' AND B1.created BETWEEN '.$start.' AND '.$stop.'
            GROUP BY T1.'.$info['pk'].'
            ORDER BY '.$info['sort'])
        );
        // var_dump($queries);
        
// --- start coderXO mod --- //
        $res = db_query('SELECT '.$info['fields'].",COUNT(ticket_id) FROM ".TICKET_TABLE." A1 LEFT JOIN ".$info['table']." T1 ON ( A1.".$info['ck']." = T1.".$info['pk']." )  WHERE A1.created >= $start AND  ( A1.closed >= $stop or A1.closed = '' or A1.closed is null ) GROUP BY T1.".$info['pk']." ");    
        while($row = db_fetch_row($res))
							$open[$row[0]] = $row;
// --- end coderXO mod --- //								
				
        $rows = array();
        $cols = 1;
        foreach ($queries as $q) {
            list($c, $sql) = $q;
            $res = db_query($sql);
            $cols += $c;
            while ($row = db_fetch_row($res)) {
                $found = false;
// --- start coderXO mod --- //				
               if($c>1)														
								  if($open[$row[0]])
								  {
									  $row = array_merge($open[$row[0]] ,array_slice($row,-$c+1)); 
								  }
								  else {
								    $row = array_merge( array($row[0] , 0) ,array_slice($row,-$c+1) );
								  }
								// print_r($row);
						//		print $cols;
// --- end coderXO mod --- //									
                foreach ($rows as &$r) {
                    if ($r[0] == $row[0]) {
                        $r = array_merge($r, array_slice($row, -$c));
                        $found = true;
                        break;
                    }
                }
                if (!$found)
                    $rows[] = array_merge(array($row[0]), array_slice($row, -$c));
            }
            # Make sure each row has the same number of items
            foreach ($rows as &$r)
                while (count($r) < $cols)
                    $r[] = null;
        }
// --- start coderXO mod --- //	        
	 		 $total = array();
			 for($y = 0 ;  $y < sizeof($rows); $y++)
			 { 
			    if($y == 0)
				     $total[] = 'Total';
			    $sum = 0;
					for($z = 1; $z < sizeof($rows[$y]) ; $z++ )
				  {
            if($z <=6 )
						  $total[$z] += (int)$rows[$y][$z];
						else
						  $total[$z] = 0;
			    }
					
			 }
			 $rows[] = $total;

	 		 return array("columns" => array_merge($info['headers'],
						
                        array('Active','Completed','Opened','Assigned','Overdue','Reopened',
// --- end coderXO mod --- //															
                              'Service Time','Response Time')),
                     "data" => $rows);
    }

    function getTabularData() {
        return $this->encode($this->getData());
    }

    function downloadTabularData() {
        $data = $this->getData();
        $csv = '"' . implode('","',$data['columns']) . '"';
        foreach ($data['data'] as $row)
            $csv .= "\n" . '"' . implode('","', $row) . '"';
        Http::download(
            sprintf('%s-report.csv', $this->get('group', 'Department')),
            'text/csv', $csv);
    }
    
	function _getDateRange() {
        global $cfg;

        if(($start = $this->get('start', 'last month'))) {
            $stop = $this->get('period', 'now');
        } else {
            $start = 'last month';
            $stop = $this->get('period', 'now');
        }

        if ($start != 'last month')
            $start = DateTime::createFromFormat($cfg->getDateFormat(),
                $start)->format('U');
        else
            $start = strtotime($start);

        if (substr($stop, 0, 1) == '+')
            $stop = strftime('%Y-%m-%d ', $start) . $stop;

        $start = 'FROM_UNIXTIME('.$start.')';
        $stop = 'FROM_UNIXTIME('.strtotime($stop).')';

        return array($start, $stop);
    }

    function getPlotData() {

        list($start, $stop) = $this->_getDateRange();

        # Fetch all types of events over the timeframe
        $res = db_query('SELECT DISTINCT(state) FROM '.TICKET_EVENT_TABLE
            .' WHERE timestamp BETWEEN '.$start.' AND '.$stop
                .' ORDER BY 1');
        $events = array();
        while ($row = db_fetch_row($res)) $events[] = $row[0];

        # TODO: Handle user => db timezone offset
        # XXX: Implement annulled column from the %ticket_event table
        $res = db_query('SELECT state, DATE_FORMAT(timestamp, \'%Y-%m-%d\'), '
                .'COUNT(ticket_id)'
            .' FROM '.TICKET_EVENT_TABLE
            .' WHERE timestamp BETWEEN '.$start.' AND '.$stop
            .' AND NOT annulled'
            .' GROUP BY state, DATE_FORMAT(timestamp, \'%Y-%m-%d\')'
            .' ORDER BY 2, 1');
        # Initialize array of plot values
        $plots = array();
        foreach ($events as $e) { $plots[$e] = array(); }

        $time = null; $times = array();
        # Iterate over result set, adding zeros for missing ticket events
        while ($row = db_fetch_row($res)) {
// --- start coderXO mod --- //
	 		   if($row[0] == 'created' ) $row[0] = 'opened';
// --- end coderXO mod --- //				
            $row_time = strtotime($row[1]);
            if ($time != $row_time) {
                # New time (and not the first), figure out which events did
                # not have any tickets associated for this time slot
                if ($time !== null) {
                    # Not the first record -- add zeros all the arrays that
                    # did not have at least one entry for the timeframe
                    foreach (array_diff($events, $slots) as $slot)
                        $plots[$slot][] = 0;
                }
                $slots = array();
                $times[] = $time = $row_time;
            }
            # Keep track of states for this timeframe
            $slots[] = $row[0];
            $plots[$row[0]][] = (int)$row[2];
        }
// --- start coderXO mod --- //
    $events[] = 'active';
	$events[] = 'completed';
	foreach($times as $end )
	{

//        print date("Y m d H i s",$start)." ".date("Y m d H i s",$end)." -> ";
				
				$res = db_query('SELECT COUNT(ticket_id) FROM '.TICKET_TABLE." WHERE created >= $start AND created <= FROM_UNIXTIME($end) AND  ( closed >= FROM_UNIXTIME($end)  or closed is null ) ");    
				$row = db_fetch_row($res);
				$plots['active'][] = $row[0]; 	
	//			print $row[0]."|";						

				$res = db_query('SELECT COUNT(ticket_id) FROM '.TICKET_TABLE." as a WHERE created >= $start AND created <= FROM_UNIXTIME($end) AND a.status_id = 3 and closed <= FROM_UNIXTIME($end) and closed != '' and closed is not null  ");           
				$row = db_fetch_row($res);
				$plots['completed'][] = $row[0]; 		
		/*		print $row[0]."|";
				
				$res = db_query('SELECT COUNT(ticket_id) FROM '.TICKET_TABLE." WHERE created >= FROM_UNIXTIME($start) AND date(created) =  date(FROM_UNIXTIME($end)) ");           
				$row = db_fetch_row($res);				
		
				$total += $row[0];
				print $row[0]." | $total\n";
			*/	
	}

// --- end coderXO mod --- //		

// this array diff is the issye , need to figure out how these two array are generated and fix 
// Not possible in 30 mins , please seek help help me

        foreach (array_diff($events, $slots) as $slot)
            $plots[$slot][] = 0;
        return $this->encode(array("times" => $times, "plots" => $plots,
            "events"=>$events));
    }
}