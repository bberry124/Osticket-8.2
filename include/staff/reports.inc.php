<?php
if(!defined('OSTSCPINC') || !$thisstaff || !@$thisstaff->isStaff()) die('Access Denied');

$qstr='&'; //Query string collector
if($_REQUEST['status']) { //Query string status has nothing to do with the real status used below; gets overloaded.
    $qstr.='status='.urlencode($_REQUEST['status']);
}


$showoverdue=$showanswered=$showassigned=false;
$staffId=0; 

$showassigned   =(($cfg->showAssignedTickets() || $thisstaff->showAssignedTickets()));
//Get status we are actually going to use on the query...making sure it is clean!
$status=null;

if(!$_REQUEST['status'])
  $_REQUEST['status'] = '1';

switch(strtolower($_REQUEST['status'])){ //Status is overloaded
    case 'open':
		case 'created':
        $status='1';
        break;
    case 'closed':
        $status='3';
        $showassigned=false;
        break;
    case 'overdue':
        $status='1';
        $showoverdue=true;
        $results_type='Overdue Tickets';
        break;
    case 'assigned':
        $status='1';
        $staffId=$thisstaff->getId();
        $results_type='My Tickets';
        break;
    case 'answered':
        $status='1';
        $showanswered=true;
        $results_type='Answered Tickets';
        break;
    default:
        $status='1';
}

$qwhere ='';
/* 
   STRICT DEPARTMENTS BASED PERMISSION!
   User can also see tickets assigned to them regardless of the ticket's dept.
*/

$depts  =  $thisstaff->getDepts();    
$qwhere =  ' WHERE ( '
          .'  ticket.staff_id='.db_input($thisstaff->getId());

if(!$thisstaff->showAssignedOnly())
    $qwhere.=' OR ticket.dept_id IN ('.($depts?implode(',',$depts):0).')';

if(($teams=$thisstaff->getTeams()) && count(array_filter($teams)))
    $qwhere.=' OR ticket.team_id IN('.implode(',',array_filter($teams)).') ';

$qwhere .= ' )';

//STATUS
if($status){
    $qwhere.=' AND status_id='.db_input(strtolower($status));    
}

//Overloaded sub-statuses  - you've got to just have faith!
if($staffId && ($staffId==$thisstaff->getId())) { //Staff's assigned tickets.
    $results_type='Assigned Tickets';
    $qwhere.=' AND ticket.staff_id='.db_input($staffId);
    $showassigned=false; //My tickets...already assigned to the staff.
}
if(1):

    //department
    if($_REQUEST['deptId'] && in_array($_REQUEST['deptId'],$thisstaff->getDepts())) {
        $qwhere.=' AND ticket.dept_id='.db_input($_REQUEST['deptId']);
    }
        
    //Assignee 
    if($_REQUEST['assignee'])  {
        $id=preg_replace("/[^0-9]/", "", $_REQUEST['assignee']);
        $assignee = $_REQUEST['assignee'];
        $qwhere.= ' AND ( ';
                  
        if($assignee[0]=='t')
            $qwhere.='  (ticket.team_id='.db_input($id). ' ) ';
        else
            $qwhere.='  (ticket.staff_id='.db_input($id). ' ) ';
        
            
        $qwhere.= ' ) ';
    } elseif($_REQUEST['staffId']) {
        $qwhere.=' AND (ticket.staff_id='.db_input($_REQUEST['staffId']).' AND ticket.status_id="1") ';
    }


endif;


$qselect = 'SELECT DISTINCT ticket.ticket_id,ticket.*, number as ticketID '
         . ' ,isoverdue,isanswered, datediff(NOW(),ticket.created) as age ';

$qfrom  = ' FROM '.TICKET_TABLE.' ticket '.
          ' LEFT JOIN '.DEPT_TABLE.' dept ON ticket.dept_id=dept.id ';


$qgroup  = ' GROUP BY ticket.ticket_id';

$total   = db_count("SELECT count(DISTINCT ticket.ticket_id) $qfrom $sjoin $qwhere");

$avg     = db_count("SELECT avg( datediff(NOW(),ticket.created)) $qfrom $sjoin $qwhere");

$qselect .=  ' ,CONCAT_WS(" ", staff.firstname, staff.lastname) as staff, team.name as team '
         .   ' ,IF(staff.staff_id IS NULL,team.name,CONCAT_WS(" ", staff.lastname, staff.firstname)) as assigned ';

$qfrom  .=   ' LEFT JOIN '.STAFF_TABLE.' staff ON (ticket.staff_id=staff.staff_id) '
       		  .' LEFT JOIN '.TEAM_TABLE.' team ON (ticket.team_id=team.team_id) ';

$query   =   "$qselect $qfrom $qwhere $qgroup ORDER BY ticket.created DESC ";

$hash    = md5($query);
$_SESSION['search_'.$hash] = $query;

$res          = db_query($query);
$showing      = db_num_rows($res);

$results_type = ucfirst($status).' Tickets';

//YOU BREAK IT YOU FIX IT.
?>
<!-- SEARCH FORM START -->
<div id='basic_search'>
    <form action="reports.php" method="get">
    <?php csrf_token(); ?>
    <input type="hidden" name="a" value="search">
    <table width="100%" border="0">
        <tr>
            <td width="25%" align="center">
						<select name="status" >
						  <?php
						     $statuses = array("open"   => "Active" ,
								 					 	 			 "closed"	   => "Completed",
																	 "reopened"  => "Reopened", 
																	 "overdue"	 => "Overdue", 
																	 "assigned"  => "Assigned");
							
							foreach($statuses as $key => $value)
							{
							   $sel = $_REQUEST['status'] == $key ? "selected=\"selected\"":"";
							   print "<option value=\"$key\" $sel>$value Tickets</option>\n";
							}
							?>
						</select>
						<br/><br/><strong>Reports</strong>
						</td>
            <td width="25%" align="center">
						<select name="deptId">
						  <option value=""></option>
						  <?php
                if(($mydepts = $thisstaff->getDepts()) && ($depts=Dept::getDepartments())) {
                    foreach($depts as $id =>$name) {
                        echo $depts;
                        if(!in_array($id, $mydepts)) continue; 
												$sel = ($_REQUEST['deptId'] == $id ) ? "selected=\"selected\"":"";
                        echo sprintf('<option value="%d" '.$sel.'>%s</option>', $id, $name);
                    }
                }
							?>
						</select>
						<br/><br/><strong>Department</strong>
						</td>
            <td width="25%" align="center">
            <select id="assignee" name="assignee">
                <option value="0"></option>
                <?php
                if(($users=Staff::getStaffMembers())) {
                    echo '<OPTGROUP label="Staff Members ('.count($users).')">';
                    foreach($users as $id => $name) {
                        $k="s$id";
												
												$sel = ( $k == $assignee  )?"selected=\"selected\"":"";
                        echo sprintf('<option value="%s" '.$sel.'>%s</option>', $k, $name);
                    }
                    echo '</OPTGROUP>';
                }
                
                if(($teams=Team::getTeams())) {
                    echo '<OPTGROUP label="Teams ('.count($teams).')">';
                    foreach($teams as $id => $name) {
                        $k="t$id";
												$sel = ( $k == $assignee )?"selected=\"selected\"":"";
                        echo sprintf('<option value="%s" '.$sel.'>%s</option>', $k, $name);
                    }
                    echo '</OPTGROUP>';
                }
                ?>
            </select>
						<br/><br/><strong>Assignee</strong>
						</td>					
						<td width="25%" rowspan="2" bgcolor="#e4ebf1" align="center" valign="middle"  style="border-radius:8px;">
							  <input type="button" onclick="window.open('reports.php?a=print&hash=<?php echo $hash; ?>','_blank','scrollbars=0,resizable=0');" value="Print Report" /><br/><br/>			
						</td>							
        </tr>
				<tr><td colspan="3" align="center"> <br/><input type="submit" /> </td></tr>
    </table>
    </form>
</div>
<!-- SEARCH FORM END -->
<div class="clear"></div>
<div style="margin-bottom:10px">
   <?php
	 ob_start();
	 ?> 
 <table cellspacing="2" cellpadding="1" border="0" width="500" style="margin:5px" >
   <tr><td colspan="2" nowrap align="Center"> <h1><?php echo $statuses[$_REQUEST['status']] ?> Tickets Report </h1> </td></tr>
   <tr><td width="100"> <strong>Department</strong> </td><td><?php echo($depts[$_REQUEST['deptId']]); ?></td></tr>
	 <tr><td><strong> Asignee</strong> </td>
	 		 <td>
			   <?php 
				   if( $assignee && $assignee[0] == 's' ) {
					    $tid = preg_replace("/[^0-9]/","",$assignee);
					    $tes = db_query("select firstname, lastname from ".STAFF_TABLE." where staff_id = ".$tid);
							if(db_num_rows($tes))
							{
							    $row = db_fetch_array($tes);
								print $row['firstname'].' '.$row['lastname'];
							}
					 }
				 ?> 
			 </td>
	 </tr>
	 <tr><td> <strong>Report Date</strong></td><td> <?php echo date("l j F Y"); ?> </td></tr>
	 <tr><td nowrap> <strong><?php echo $statuses[$_REQUEST['status']] ?> Jobs</strong> </td><td> <?php echo $total; ?></td></tr>
	 <tr><td> <strong>Average Days </strong></td><td id="avgid"><?php echo (int)$avg; ?></td></tr>
 </table>
   <?php
	 $_SESSION['print_'.$hash] = ob_get_contents();
	 ob_end_flush();
	 ?>  
 <br/><br/>
 <table class="list" border="0" cellspacing="1" cellpadding="2" width="940">

    <thead>
        <tr>
	        <th width="70">Ticket</th>
	        <th width="60">Source </th>
	        <th width="270">Trading Name </th>
	        <th width="100" align="left">Department</th>
          <th width="100" align="left">Asignee</th>					
					<th>Aging</th>
          </th>
        </tr>
     </thead>
     <tbody>
        <?php
        $class = "row1";
        $total=0;
		$days=0;
                
        if($res && ($num=db_num_rows($res))):
            $ids=($errors && $_POST['tids'] && is_array($_POST['tids']))?$_POST['tids']:null;
            while ($row = db_fetch_array($res)) {
						
                $tid=$row['number'];
                $subject = Format::truncate($row['subject'],40);
                ?>
            <tr id="<?php echo $row['ticket_id']; ?>">
                <td title="<?php echo $row['email']; ?>" nowrap> 
                  <a class="Icon <?php echo strtolower($row['source']); ?>Ticket ticketPreview" title="Preview Ticket" 
                    href="tickets.php?id=<?php echo $row['ticket_id']; ?>"><?php echo $tid; ?></a>
                </td>
                <td nowrap ><?php if ($row['source'] == "Web") echo '<span style="color:red;">Web</span>'; else echo '<span>'.$row["source"].'</span>'; ?></td>
                <td nowrap ><?php echo $row['company']; ?></td>
                <td ><?php echo $depts[$row['dept_id']]; ?> </td>
                <td ><?php echo $row['staff']; ?> </td>
                <td nowrap width="5" bgcolor="#ffffff"> <?php echo $row['age']; ?> </td>
            </tr>
            <?php
            } //end of while.
					print "<tr><td colspan=\"6\"> &nbsp; &nbsp; <a class=\"export-csv\" href=\"?a=export&h=".$hash."\" >Export</a></td></tr>";
        else: //not tickets found!! set fetch error.
          print "<tr><td colspan=\"6\"> There are no tickets here. (Leave a little early today)</td></tr>";  
        endif; ?>
    </tbody>
    </table>
   
    </form>
</div>