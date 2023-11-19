<?php
if(!defined('OSTSCPINC') || !$thisstaff ) die('Access Denied');

$hash  = $_REQUEST['hash'];
$query = $_SESSION['search_'.$hash];
$res   = db_query($query);

if(db_num_rows($res) < 1)
  exit('Query produced 0 results');

print $_SESSION['print_'.$hash];
$depts=Dept::getDepartments();
?>
 <br/><br/>
 <table  bgcolor="black" cellspacing="1" cellpadding="4" width="940">

    <thead>
        <tr bgcolor="white">
	        <th width="70" align="left">Ticket </th>
	        <th width="270" align="left">Company </th>
	        <th width="100" align="left">Department</th>
          <th width="170" align="left">Asignee</th>
					<th align="left">Aging</th>
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
						
                $tid=$row['ticketID'];
                $subject = Format::truncate($row['subject'],40);
                ?>
            <tr bgcolor="white">
                <td><?php echo $tid; ?></td>
                <td nowrap width="200"><?php echo $row['company']; ?></td>
								<td ><?php echo $depts[$row['dept_id']]; ?> </td>
								<td ><?php echo $row['staff']; ?> </td>
                <td nowrap width="5"><?php echo $row['age']; ?> </td>
            </tr>
            <?php
            } //end of while.
        else: //not tickets found!! set fetch error.
          print "<tr bgcolor=\"white\"><td colspan=\"6\"> query produced no results</td></tr>";  
        endif; ?>
    </tbody>
    </table>
