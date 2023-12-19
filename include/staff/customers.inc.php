<?php
if(!defined('OSTSCPINC') || !$thisstaff || !@$thisstaff->isStaff()) die('Access Denied');

$qwhere = "";

if($_REQUEST['ids'] && !empty($_REQUEST['ids'])&& $_REQUEST['a'] == 'Delete' )
{
   db_query("delete from ".TABLE_PREFIX."customer1 where id in (".join(",",$_REQUEST['ids']).") ");
	 $success  = sizeof($_REQUEST['ids'])." customers successfully deleted";
}

if($_REQUEST['query'] ):

   if(strlen($_REQUEST['query']) > 2)
	 {

        $qstr       .= '&query='.urlencode($_REQUEST['query']);
        $searchTerm  = $_REQUEST['query'];
        $queryterm   = db_real_escape($searchTerm,false); //escape the term ONLY...no quotes.
				
		if(strpos($searchTerm,'@') && Validator::is_email($searchTerm)){ //pulling all tricks!
            $qwhere = " AND ( email='$queryterm' or email2 = '$queryterm' ) ";
        }else{
            $qwhere = " AND ( company like '%$queryterm%' OR trading like '%$queryterm%' OR name like '%$queryterm%' OR address like '%$queryterm%' OR suburb like '%$queryterm%' OR state like '%$queryterm%' ".
											" OR  postcode like '%$queryterm%' or contract like '%$queryterm%' or phone like '%$queryterm%' or mobile like '%$queryterm%' ".										
											" OR  email LIKE '%$queryterm%' or email2 LIKE '%$queryterm%' or acnt_rand_no LIKE '%$queryterm%' or acnt_rand_manager LIKE '%$queryterm%' or abn like '%$queryterm%' or preferredname like '%$queryterm%') ".
                                            " OR  address like '%$queryterm%'";
            
            // added by hong
            if(strlen($_REQUEST['custom_status']) > 0) {
            	$qwhere.= " AND custom_status='".$_REQUEST['custom_status']."'";
            }
            
            if(strlen($_REQUEST['custom_type']) > 0) {
            	$qwhere.= " AND custom_type='".$_REQUEST['custom_type']."'";
            }
            // added end hong

        }
				
				
	 }
	 else {
            $error = "Search term must be 3 characters or more";
	 }

endif;

// added by hong
if(strlen($_REQUEST['custom_status']) > 0) {
	$qwhere.= " AND custom_status='".$_REQUEST['custom_status']."'";
}
            
if(strlen($_REQUEST['custom_type']) > 0) {
  	$qwhere.= " AND custom_type='".$_REQUEST['custom_type']."'";
}
// added end hong

$page    = ($_GET['p'] && is_numeric($_GET['p'])) ? $_GET['p']:1;
$offset  = ($_GET['limit'] && is_numeric($_GET['limit']))?$_GET['limit']:PAGE_LIMIT;

$where   = " where 1 = 1 ";	

$start   = ( $page * $offset ) - $offset; 

if($_GET['limit'])
    $qstr.='&limit='.urlencode($_GET['limit']);
		
$hash    = md5('SELECT * FROM '.TABLE_PREFIX."customer1 $where $qwhere");
$_SESSION['search_'.$hash] = 'SELECT * FROM '.TABLE_PREFIX."customer1 $where $qwhere";

	
		
$res     = db_query('SELECT SQL_CALC_FOUND_ROWS * FROM '.TABLE_PREFIX."customer1 $where $qwhere order by company asc, name asc LIMIT $start, $offset");

$total   = db_count('SELECT FOUND_ROWS()');

$pageNav = new Pagenate($total, $page, $offset);

$pageNav->setURL('customers.php',$qstr);

//YOU BREAK IT YOU FIX IT.
?>
<!-- SEARCH FORM START -->
<div id='basic_search'>
  <form id="customer_search" action="customers.php" method="get">
    <?php csrf_token(); ?>
    <input type="hidden" name="a" value="search">
    <table>
      <tr>
        <td>Search by Name or Acc#</td>
        <td>Search by Customer Status</td>
        <td>Search by Customer Type</td>
        <td></td>
      </tr>
      <tr>
        <td><input type="text" name="query" value="<?php echo Format::htmlchars($_REQUEST['query']); ?>"
            autocomplete="off" autocorrect="off" autocapitalize="off"></td>
        <td>
          <select name="custom_status" id="custom_status" style="width:180px;">
            <option value="">&lt;Select&gt;</option>
            <!--                        <option value="active" --><?php //if(Format::htmlchars($_REQUEST['custom_status'])=="active") echo 'selected="selected"'; ?>
            <!--> Active </option>-->
            <option value="active" selected>Active</option>
            <option value="closed"
              <?php if(Format::htmlchars($_REQUEST['custom_status'])=="closed") echo 'selected="selected"'; ?>>Closed
            </option>
          </select>
        </td>
        <td><select name="custom_type" id="custom_type" style="width:200px;">
            <option value="">&lt;Select&gt;</option>
            <option value="business"
              <?php if(Format::htmlchars($_REQUEST['custom_type'])=="business") echo 'selected="selected"'; ?>>Business
            </option>
            <option value="residential"
              <?php if(Format::htmlchars($_REQUEST['custom_type'])=="residential") echo 'selected="selected"'; ?>>
              Residential</option>
            <option value="government"
              <?php if(Format::htmlchars($_REQUEST['custom_type'])=="government") echo 'selected="selected"'; ?>>
              Government</option>
            <option value="rebl_customer"
              <?php if(Format::htmlchars($_REQUEST['custom_type'])=="rebl_customer") echo 'selected="selected"'; ?>>Rebl
              Customer</option>
            <option value="positive_business_online"
              <?php if(Format::htmlchars($_REQUEST['custom_type'])=="positive_business_online") echo 'selected="selected"'; ?>>
              Positive Business Online</option>
          </select></td>
        <td><input type="submit" value="Search"></td>
      </tr>

      <?php
                        if($error)
                        {
                         ?>
      <tr>
        <td>
          <div id="msg_error"><?php echo $error; ?></div>
        </td>
      </tr>
      <?
                        }
                        if($success)
                        {
                        ?>
      <tr>
        <td>
          <div id="msg_notice"><?php echo $success;  ?></div>
        </td>
      </tr>
      <?php
                        }
                    ?>
    </table>
  </form>
</div>
<!-- SEARCH FORM END -->
<div class="clear"></div>
<div style="margin-bottom:20px">
  <form action="customers.php" method="POST" name='customers'>
    <?php csrf_token(); 
$num=db_num_rows($res);
?>
    <a class="refresh" href="<?php echo $_SERVER['REQUEST_URI']; ?>">Refresh</a>
    <?php
    if($num>0){ //if we actually had any tickets returned.
        echo '<br/><div>&nbsp;Page:'.$pageNav->getPageLinks().'&nbsp;</div><br/>';
	 }
?>
    <table class="list" border="0" cellspacing="1" cellpadding="3" width="940">
      <thead>
        <tr>
          <th width="8px">
            <?php
                if( $total > 0 && $thisstaff->canManageTickets()) {
            ?>
            <input type="submit" name="a" value="Delete" style="padding-left:8px; padding-right:8px;" />
            <?php
            }
            ?>
          </th>
          <th width="5"> </th>
          <!-- <th width="270">Company Name</th> -->
          <th width="50">Status</th>
          <th width="450">Trading Name</th>
          <th width="300">Account Number</th>
          <th nowrap>Mobile</th>
          <th nowrap>Contact Number</th>
        </tr>
      </thead>


      <tbody>
        <?php
        $class = "row1";
        $total=0;
        if($res && $num):
				?>
        <tr>
          <td align="center">
            <?php if ($thisstaff->canManageTickets() ) { ?> <input type="checkbox" onclick="checkAll(this.checked)" />
            <?php }?>
          </td>
          <td colspan="6"> </td>
        </tr>
        <?php
				
            $ids=($errors && $_POST['ids'] && is_array($_POST['ids']))?$_POST['ids']:null;
            while ($row = db_fetch_array($res)) {
                ?>
        <tr>
          <?php if($thisstaff->canManageTickets()) { ?>
          <td align="center"> <input type="checkbox" name="ids[]" id="ids<?php echo ++$z; ?>" ;
              value="<?php echo $row['id']; ?>"></th>
            <?php } ?>
          <td> <a title="New Ticket" href="tickets.php?a=open&cid=<?php echo $row['id'] ?>"><img title="New Ticket"
                src="../images/new_ticket.gif" border="0" /></a></td>
          <td>
            <?php if($row['custom_status']=='active') echo '<span style="color:green;">Active</span>'; else if($row['custom_status']=='closed') echo '<span style="color:red;">Closed</span>';  ?>
          </td>
          <td nowrap>&nbsp;<?php echo $row['trading']; ?>&nbsp;</td>
          <td><a
              href="?id=<?php echo $row['id']; ?>"><?php echo Format::truncate($row['acnt_rand_no'],22,strpos($row['acnt_rand_no'],'@')); ?></a>&nbsp;
          </td>
          <td nowrap width="100"> <?php echo $row['mobile']; ?> </td>
          <td nowrap width="100"><?php echo  $row['phone'].' '.$row['phone_ext']; ?> </td>
        </tr>
        <?php
            } //end of while.
					  print "<tr><td colspan=\"7\"> &nbsp; &nbsp; <a class=\"export-csv\" href=\"?a=export&h=".$hash."\" >Export</a></td></tr>";
        else: //not tickets found!! set fetch error.
          print "<tr><td colspan=\"7\"> <i>query produced no results</i></td></tr>";  
        endif; ?>
      </tbody>
      <tfoot>
        <tr>
          <td align="center">
            <?php if($res && $num && $thisstaff->canManageTickets()){ 
						  echo "<input type=\"checkbox\" onclick=\"checkAll(this.checked)\" />\n";
							?>
            <br /><input type="submit" name="a" value="Delete" style="padding-left:8px; padding-right:8px;" />
            <?php
            }
						?>

          </td>
          <td colspan="7"> </td>
        </tr>
      </tfoot>
    </table>
    <?php
    if($num>0){ //if we actually had any tickets returned.
        echo '<div>&nbsp;Page:'.$pageNav->getPageLinks().'&nbsp;</div>';
	 }
	 ?>

  </form>
</div>

</div>
<script type="text/javascript">
// $(document).ready(function(){
//     $("#customer_search").submit();
// });

var z = 0;
<?php 
if($z > 0)
  print "z = $z;\n\n";
?>

function checkAll(checked) {

  for (i = 1; i <= z; i++) {
    var c = document.getElementById('ids' + i);
    c.checked = checked;
  }
}
</script>