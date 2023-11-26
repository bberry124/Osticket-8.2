<?php
if (!defined('OSTSCPINC') || !$thisstaff
|| !$thisstaff->hasPerm(Ticket::PERM_CREATE, false))
die('Access Denied');
$info=array();
if(!$_REQUEST['id']) {
    $info=Format::htmlchars(($errors && $_POST)?$_POST:$info);
} else {
    $info=Format::htmlchars(($errors && $_POST)?$_POST:$customers_info);
}

    function generateRandom( $len ){
//		$strpattern = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
		$strpattern = "0123456789";
    $result = "";
		for( $i = 0 ; $i < $len; $i ++ ){
			$rand = rand( 0, strlen($strpattern) - 1 );
			$result = $result.$strpattern[$rand];
		}
		return 'INT'.$result;
	};
	
	/* added hong */
   $res2 = db_query('select * from '.TABLE_PREFIX.'customer_siplicense where customer_id =  '.intval($_REQUEST['id']));
   $res3 = db_query('select * from '.TABLE_PREFIX.'customer_siphwd where customer_id =  '.intval($_REQUEST['id']));
   $res4 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res5 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res6 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res18 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res19 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res20 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
   $res21 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");

    $res22 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res23 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res24 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res25 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res26 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res27 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");
    $res28 = db_query("select id, upstream_provname from ".TABLE_PREFIX."supplier where upstream_provname is not null and upstream_provname !='' order by upstream_provname");


//   $res7 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider1']));
//   $up_prov_info1 = db_fetch_array($res7);
//
//   $res8 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider2']));
//   $up_prov_info2 = db_fetch_array($res8);
//
//   $res9 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider3']));
//   $up_prov_info3 = db_fetch_array($res9);
//
//    $res14 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider4']));
//    $up_prov_info4 = db_fetch_array($res14);
//
//    $res15 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider5']));
//    $up_prov_info5 = db_fetch_array($res15);
//
//    $res16 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider6']));
//    $up_prov_info6 = db_fetch_array($res16);
//
//    $res17 = db_query('select id, upstream_provname, upstream_provurl, upstream_username, upstream_pwd, phone from '.TABLE_PREFIX.'supplier where id =  '.intval($info['upstream_provider7']));
//    $up_prov_info7 = db_fetch_array($res17);

   $res10 = db_query('select * from '.TABLE_PREFIX.'customer_wifihwd where customer_id =  '.intval($_REQUEST['id']));
   $res11 = db_query('select * from '.TABLE_PREFIX.'customer_contacts where customer_id =  '.intval($_REQUEST['id']));
   $res12 = db_query('select * from '.TABLE_PREFIX.'customer_pchwd where customer_id =  '.intval($_REQUEST['id']));
   $res13 = db_query('select * from '.TABLE_PREFIX.'customer_notes where customer_id =  '.intval($_REQUEST['id']));
   /* added hong end*/
?>

<script type="text/javascript">
	$(document).on("pageshow","#cust_auth_table",function(){
	  alert("pageshow event fired - pagetwo is now shown");
	});

</script>

<form action="customers.php" method="post" id="save"  enctype="multipart/form-data">
     <?php csrf_token(); ?>
     <h2>Customers</h2>
    <table cellpadding="0" width="940" cellspacing="2" border="0">
    <tr>
     <td width="75%">
     <table class="form_table" style="width:100%" border="0" cellspacing="0" cellpadding="2">
        <thead>
            <tr>
                <th colspan="3">
                    <em><strong><?php if(!$_REQUEST['id']) echo 'New '; ?> Account Details</strong></em>
                </th>
            </tr>
        </thead>
        <tbody>

                  <?php
                        if($error)
                        {
                         ?>
                         <tr><td colspan="3"><div id="msg_error"><?php echo $error; ?></div></td>

                         </tr>
                         <?php
                        }
                        if($success)
                        {
                        ?>
                        <tr><td colspan="3"><div id="msg_notice"><?php echo $success;  ?></div></td></tr>
                        <?php
                        }
                    ?>

            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Status:
                </td>
                <td>
                    <select name="custom_status" style="width: 135px;" id="custom_status" onchange="this.className=this.options[this.selectedIndex].className" >
                      <option value="">&lt;Select&gt;</option>
                      <option value="active" class="greenText" <?php echo $info['custom_status'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                      <option value="closed" class="redText" <?php echo $info['custom_status'] == 'closed' ? "selected=\"selected\"":""; ?>>Closed</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;Customer Type:
                    <select name="custom_type" id="custom_type" style="width: 220px;">
                        <option value="">&lt;Select&gt;</option>
                        <option value="business" <?php echo $info['custom_type'] == 'business' ? "selected=\"selected\"":""; ?>>Business</option>
                        <option value="residential" <?php echo $info['custom_type'] == 'residential' ? "selected=\"selected\"":""; ?>>Residential</option>
                        <option value="government" <?php echo $info['custom_type'] == 'government' ? "selected=\"selected\"":""; ?>>Government</option>
                        <option value="integra_media" <?php echo $info['custom_type'] == 'integra_media' ? "selected=\"selected\"":""; ?>>Integra Media</option>
                        <option value="positive_business_online" <?php echo $info['custom_type'] == 'positive_business_online' ? "selected=\"selected\"":""; ?>>Positive Business Online</option>
                    </select>
                </td>

            </tr>

            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Number:
                </td>
                <td>
                    <input type="text" size="59" name="acnt_rand_no" id="acnt_rand_no" class="typeahead" value="<?php if ($info['acnt_rand_no']!="") echo $info['acnt_rand_no']; else echo generateRandom(8); ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;<?php echo $errors['acnt_rand_no']; if ($info['acnt_rand_no']=="") echo '&nbsp;&nbsp;&nbsp; Please save Random Number.';?></span>
                </td>
            </tr>
            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Manager:
                </td>
                <td>
                    <input type="text" size="59" name="acnt_rand_manager" id="acnt_rand_manager" class="typeahead" value="<?php if ($info['acnt_rand_manager']!="") echo $info['acnt_rand_manager']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;</br><?php  if ($info['acnt_rand_manager']=="") echo '&nbsp;&nbsp;&nbsp; Please save Account Manager.';?></span>
                </td>
            </tr>
            </tbody>
        <thead>
            <tr>
                <th colspan="3">
                    <em><strong><?php if(!$_REQUEST['id']) echo 'New '; ?> Customer Details</strong></em>
                </th>
            </tr>
        </thead>
        <tbody></tbody>
            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Name:
                </td>
                <td>
                    <input type="text" size="59" name="company" id="company" class="typeahead" value="<?php echo $info['company']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;</span>
                </td>
            </tr>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trust Name:
                </td>
                <td>
                    <input type="text" size="59" name="trust" id="trust" class="typeahead" value="<?php echo $info['trust']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                </td>
            </tr>
            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trading Name:
                </td>
                <td>
                    <input type="text" size="59" name="trading" id="trading" class="typeahead" value="<?php echo $info['trading']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;</span>
                </td>
            </tr>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A.B.N. Number:
                </td>
                <td>
                    <input type="text" size="18" name="abn" id="abn" class="typeahead" value="<?php echo $info['abn']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                        &nbsp;<span class="error">&nbsp;<?php echo $errors['fax']; ?></span>

                        A.C.N. Number:
                    <input type="text" size="18" name="acn" id="acn" class="typeahead" value="<?php echo $info['acn']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                </td>
            </tr>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Business Category:
                </td>
                <td>
                    <input type="radio" name="busicat" value="1" <?php echo $info['busicat'] == '1' ? "checked=\"checked\"":""; ?>/>
                    Private (Pty Ltd)
                    <input type="radio" name="busicat" value="2" <?php echo $info['busicat'] == '2' ? "checked=\"checked\"":""; ?>/>
                    Public (Ltd)
                    <input type="radio" name="busicat" value="3" <?php echo $info['busicat'] == '3' ? "checked=\"checked\"":""; ?>/>
                    Sole Trader&nbsp;
                    <input type="radio" name="busicat" value="4" <?php echo $info['busicat'] == '4' ? "checked=\"checked\"":""; ?>/>
                    Trust <br/>
                    <input type="radio" name="busicat" value="5" <?php echo $info['busicat'] == '5' ? "checked=\"checked\"":""; ?>/>
                    Partnership&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="busicat" value="6" <?php echo $info['busicat'] == '6' ? "checked=\"checked\"":""; ?>/>
                    Union&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="busicat" value="7" <?php echo $info['busicat'] == '7' ? "checked=\"checked\"":""; ?>/>
                    Association
                </td>
            </tr>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Website URL :
                </td>
                <td>
                    <input type="text" size="59" name="website" id="website" class="typeahead" value="<?php echo $info['website']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="margin-top:5px" type="button" onclick="gotoCustomerUrl();">Click Here</button>
                </td>
            </tr>
        </tbody>


         <thead>
         <tr>
             <th colspan="3">
                 <em><strong>Site Address</strong></em>
             </th>
         </tr>
         </thead>
         <tbody>
         <tr>
             <td width="160" valign="top">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Site Address:
             </td>
             <td>

                 <input type="text" size="50" name="address" id="address" value="<?php echo $info['address']; ?>" >
                 &nbsp;
                 <input style="margin-top:5px" type="text" size="50" name="address2" id="address2" value="<?php echo $info['address2']; ?>" >
                 &nbsp;
             </td>
         </tr>
         <tr>
             <td width="160">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Suburb:
             </td>
             <td>

                 <input type="text" size="20" name="suburb" id="suburb" value="<?php echo $info['suburb']; ?>" >
                 &nbsp;&nbsp;&nbsp;
                 State:
                 <select name="state" id="state" >
                     <option value=""></option>
                     <option value="ACT" <?php echo $info['state'] == 'ACT' ? "selected=\"selected\"":""; ?>>ACT</option>
                     <option value="NSW" <?php echo $info['state'] == 'NSW' ? "selected=\"selected\"":""; ?>>NSW</option>
                     <option value="NT" <?php echo $info['state'] == 'NT' ? "selected=\"selected\"":""; ?>>NT</option>
                     <option value="SA" <?php echo $info['state'] == 'SA' ? "selected=\"selected\"":""; ?>>SA</option>
                     <option value="TAS" <?php echo $info['state'] == 'TAS' ? "selected=\"selected\"":""; ?>>TAS</option>
                     <option value="VIC" <?php echo $info['state'] == 'VIC' ? "selected=\"selected\"":""; ?>>VIC</option>
                     <option value="QLD" <?php echo $info['state'] == 'QLD' ? "selected=\"selected\"":""; ?>>QLD</option>
                     <option value="WA" <?php echo $info['state'] == 'WA' ? "selected=\"selected\"":""; ?>>WA</option>
                 </select>
                 &nbsp;&nbsp;

                 Postcode: <input type="text" size="5" name="postcode" id="postcode" value="<?php echo $info['postcode']; ?>" >
                 &nbsp;
             </td>
         </tr>
         <tr>
             <td width="160">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City:
             </td>
             <td>
                 <input type="text" size="18" name="city" id="city" class="typeahead" value="<?php echo $info['city']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                 &nbsp;<span class="error">&nbsp;<?php echo $errors['fax']; ?></span>

                 Country:
                 <input type="text" size="18" name="country" id="country" class="typeahead" value="<?php echo $info['country']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
             </td>
         </tr>
         </tbody>

        <thead>
            <tr>
                <th colspan="3">
                    <em><strong>Primary Contact Person</strong></em>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Title :
                </td>
                <td>
                    <select name="title" id="title" style="width:100px;">
                      <option value="">&lt;Select&gt;</option>
                      <option value="mr" <?php echo $info['title'] == 'mr' ? "selected=\"selected\"":""; ?>>Mr</option>
                      <option value="dr"<?php echo $info['title'] == 'dr' ? "selected=\"selected\"":""; ?>>Dr</option>
                      <option value="ms"<?php echo $info['title'] == 'ms' ? "selected=\"selected\"":""; ?>>Ms</option>
                      <option value="mrs"<?php echo $info['title'] == 'mrs' ? "selected=\"selected\"":""; ?>>Mrs</option>
                      <option value="miss"<?php echo $info['title'] == 'miss' ? "selected=\"selected\"":""; ?>>Miss</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="160" class="required">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First Name:
                </td>
                <td>
                    <input type="text" size="15" name="name" id="name" value="<?php echo $info['name']; ?>">
                    &nbsp;<span class="error">*&nbsp;</span>&nbsp;&nbsp;
                    Preferred Name:&nbsp;<input type="text" size="15" name="preferredname" id="preferredname" value="<?php echo $info['preferredname']; ?>">
                </td>
            </tr>
            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Middle Name(s):
                </td>
                <td>
                    <input type="text" size="15" name="middlename" id="middlename" value="<?php echo $info['middlename']; ?>">
                </td>
            </tr>
            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Last Name:
                </td>
                <td>
                    <input type="text" size="15" name="surname" id="surname" value="<?php echo $info['surname']; ?>">
                </td>
            </tr>
            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company Position:
                </td>
                <td>
                    <input type="text" size="50" name="position" id="position" class="typeahead" value="<?php echo $info['position']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                </td>
            </tr>

            <tr>
                <td width="160" class="required">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Drivers License ID:
                </td>
                <td>
                    <input type="text" size="15" name="license_id" id="license_id" value="<?php echo $info['license_id']; ?>">
                    &nbsp;&nbsp;&nbsp; Passport ID:&nbsp;<input type="text" size="15" name="passport_id" id="passport_id" value="<?php echo $info['passport_id']; ?>">
                </td>
            </tr>

            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gender:
                </td>
                <td>
                <select name="gender" id="gender">
                  <option value="">&lt;Select&gt;</option>
                  <option value="male" <?php echo $info['gender'] == 'male' ? "selected=\"selected\"":""; ?>>Male</option>
                  <option value="female" <?php echo $info['gender'] == 'female' ? "selected=\"selected\"":""; ?>>Female</option>
                  <option value="intersex" <?php echo $info['gender'] == 'intersex' ? "selected=\"selected\"":""; ?>>Intersex</option>
                </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth:
                    <input type="date" size="50" name="pri_birth" id="pri_birth" value="<?php echo $info['pri_birth']; ?>">
                </td>
            </tr>
<!--            <tr>-->
<!--                <td width="160">-->
<!--                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth:-->
<!--                </td>-->
<!--                <td>-->
<!--                    <input type="date" size="50" name="pri_birth" id="pri_birth" value="--><?php //echo $info['pri_birth']; ?><!--">-->
<!--                </td>-->
<!--            </tr>-->

            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
                </td>
                <td>
                    <input type="text" size="20" name="phone" id="phone" value="<?php echo $info['phone']; ?>">
                    &nbsp;<span class="error">*&nbsp;<?php echo $errors['phone']; ?></span>
                    Ext: <input type="text" size="5" name="phone_ext" id="phone_ext" value="<?php echo $info['phone_ext']; ?>">
                    &nbsp;<span class="error">&nbsp;<?php echo $errors['phone_ext']; ?></span>
                </td>
            </tr>

            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inbound Tel:
                </td>
                <td>
                    <input type="text" size="18" name="bound_tel" id="bound_tel" value="<?php echo $info['bound_tel'];  ?>">
                    &nbsp;Direct Number:
                    &nbsp;<input type="text" size="18" name="direct_phone" id="direct_phone" value="<?php echo $info['direct_phone']; ?>">
                    &nbsp;EP:
                    &nbsp;<input type="checkbox" name="check1" value="1" <?php echo $info['check1'] == '1' ? "checked=\"checked\"":""; ?>/>
                </td>
            </tr>

            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inbound Fax:
                </td>
                <td>
                    <input type="text" size="18" name="bound_fax" id="bound_fax" value="<?php echo $info['bound_fax'];  ?>">
                    &nbsp;Fax Number:&nbsp;&nbsp;&nbsp;
                    &nbsp;<input type="text" size="18" name="fax" id="fax" class="typeahead" value="<?php echo $info['fax']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;EP:
                    &nbsp;<input type="checkbox" name="check2" value="1" <?php echo $info['check2'] == '1' ? "checked=\"checked\"":""; ?>/>
                        <!--
                        Ext:
                    <input type="text" size="5" name="fax_ext" id="fax_ext" class="typeahead" value="<?php echo $info['fax_ext']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                         -->
                </td>
            </tr>
            <tr>
                <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile:
                </td>
                <td>
                    <input type="text" size="20" name="mobile" id="mobile" value="<?php echo $info['mobile']; ?>">
                </td>
            </tr>
            <tr>
                <td width="160" class="required">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email:
                </td>
                <td>
                    <input type="text" size="50" name="email" id="email" class="typeahead" value="<?php echo $info['email']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;<?php echo $errors['email']; ?></span>
                </td>
            </tr>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email BCC:
                </td>
                <td>
                    <input type="text" size="50" name="email2" id="email2" class="typeahead" value="<?php echo $info['email2']; ?>"
                        autocomplete="off" autocorrect="off" autocapitalize="off">
                    &nbsp;<span class="error">*&nbsp;<?php echo $errors['email2']; ?></span>
                </td>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th colspan="3">
                    <em><strong>Support</strong></em>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIP Support:
                </td>
                <td>

                  <select name="vip" id="vip" >
                      <option value="No">No</option>
                        <option value="Yes" <?php echo $info['vip'] == 'Yes' ? "selected=\"selected\"":""; ?>>Yes</option>
                    </select>
                    Contract Number: <input type="text" size="10" name="contract" id="contract" value="<?php echo $info['contract']; ?>" >
                    Plan Code: <input type="text" size="10" name="plan_code" id="plan_code" value="<?php echo $info['plan_code']; ?>" >
                </td>
            </tr>

            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VIP Club:
                </td>
                <td>
                    <select name="vip_club" id="vip_club" >
                        <option value="No">No</option>
                        <option value="Yes" <?php echo $info['vip_club'] == 'Yes' ? "selected=\"selected\"":""; ?>>Yes</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voice SLA:
                </td>
                <td>

                    <select name="voice_sla" id="voice_sla" >
                        <option value="No">No</option>
                        <option value="Yes" <?php echo $info['voice_sla'] == 'Yes' ? "selected=\"selected\"":""; ?>>Yes</option>
                    </select>
                    Contract Number: <input type="text" size="10" name="voice_contract" id="voice_contract" value="<?php echo $info['voice_contract']; ?>" >
                    Seats: <input type="text" size="10" name="voice_seats" id="voice_seats" value="<?php echo $info['voice_seats']; ?>" >
                </td>
            </tr>

            <tr>
                <td width="160">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Network SLA:
                </td>
                <td>

                    <select name="network_sla" id="network_sla" >
                        <option value="No">No</option>
                        <option value="Yes" <?php echo $info['network_sla'] == 'Yes' ? "selected=\"selected\"":""; ?>>Yes</option>
                    </select>
                    Contract Number: <input type="text" size="10" name="network_contract" id="network_contract" value="<?php echo $info['network_contract']; ?>" >
                    Seats: <input type="text" size="10" name="network_seats" id="network_seats" value="<?php echo $info['network_seats']; ?>" >
                </td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="3">
                    <em><strong>Other Contacts</strong></em>
                </th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td id="contacts" colspan="4">
                <table width="100%" border="0" id="myTable4">
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="4" style="padding-left:25px;">
                <button type="button" onclick="addContact()">Add Contact</button>
            </td>
          </tr>
        </tbody>

    </table>
    </td>

    <td valign ="top" align="center" style="background-color:#e4ebf1; border-radius:6px; position:relative" width="33%" id="quick">
        <table style="width:100%;">
            <thead>
                <tr style="height: 27px; background: #c6d8dc;">
                    <th colspan="3">
                        <em><strong> Quick Launch Menu</strong></em>
                    </th>
                </tr>
            </thead>
            <tbody>
                <form action="customers.php" method="get">
                    <tr style="text-align: center;">
                        <td>
                            <br/>
                            <br/>
                            <input type="button" onclick="document.location='tickets.php?a=open&cid=<?php echo $_REQUEST['id']; ?>';" value="Create New Ticket" style="width:156px;"/><br/><br/>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>
                            <input type="button" onclick="window.open('customers.php?a=label&id=<?php echo $_REQUEST['id']; ?>','_blank','width=280,height=200,scrollbars=0,resizable=0');" value="Print Shipping Label" /><br/><br/>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>
                            <input type="button" onclick="document.location='tickets.php?<?php get_search_Query($info['email']); ?>'" style="width:156px;" value="<?php echo __('View Ticket History'); ?>" >
                        </td>
                    </tr>
                </form>
            </tbody>


            <tbody>
                <tr >
                    <td colspan=2 align='center' >
                        <div style="position:absolute; top:450px; ">

                            <input type="submit" name="do" value="<?php echo ($info['id']) ? "Update":"Add"; ?>" />
                            <input type="reset"  name="reset"  value="Reset" />
                            <input type="button" name="cancel" value="Cancel" onclick='window.location.href="customers.php"'>
                            <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                        </div>
                    </td>
                </tr>
            </tbody>

            <tbody>
            <tr >
                <td colspan=2 align='center' >
                    <div style="position:absolute; bottom:0px;margin-bottom:20px">
                        <input type="submit" name="do" value="<?php echo ($info['id']) ? "Update":"Add"; ?>" />
                        <input type="reset"  name="reset"  value="Reset" />
                        <input type="button" name="cancel" value="Cancel" onclick='window.location.href="customers.php"'>
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
    <tr>
    <!-- wipage code -->

    <tr>
    <td colspan=2 >
    <br>

    <script type="text/javascript">
    function changeTab(tabName, obj) {

        $('#cust_auth_table').find('.custtable').css('display','none');
        $('#cust_auth_table').find('#' + tabName).css('display','table');

        $('#custom_nav').find('li').removeClass('active').addClass('inactive');
        $('#' + 'toggle_' + tabName).removeClass('inactive').addClass('active');
    }
    </script>

    <ul id="custom_nav">
        <li onclick="changeTab('tb_internet');" class="active" id="toggle_tb_internet"><a>Internet</a></li>
        <li onclick="changeTab('tb_sip');" class="inactive" id="toggle_tb_sip"><a>SIP</a></li>
        <li onclick="changeTab('tb_fax');" class="inactive" id="toggle_tb_fax"><a>Fax</a></li>
        <li onclick="changeTab('tb_inbound');" class="inactive" id="toggle_tb_inbound"><a>Inbound</a></li>
        <li onclick="changeTab('tb_router');" class="inactive" id="toggle_tb_router"><a>Mobile</a></li>
        <li onclick="changeTab('tb_wifi');" class="inactive" id="toggle_tb_wifi"><a>Wi-Fi</a></li>
        <li onclick="changeTab('tb_pc');" class="inactive" id="toggle_tb_pc"><a>PC</a></li>
        <li onclick="changeTab('tb_hosting');" class="inactive" id="toggle_tb_hosting"><a>Hosting</a></li>
        <li onclick="changeTab('tb_security');" class="inactive" id="toggle_tb_security"><a>Security</a></li>
        <li onclick="changeTab('tb_notes');" class="inactive" id="toggle_tb_notes"><a>Notes</a></li>
    </ul>
    <div id="cust_auth_table">
        <!-- Hong Coding Start-->
        <table cellspacing="10px" width="100%" border="0" id="tb_internet" style="display:table;" class="custtable">
            <tr>
                <th>&nbsp;</th>
                <th align="center"><div id="img_status_ip1" class="redball"></div></th>
                <th align="center"><div id="img_status_ip2" class="redball"></div></th>
                <th align="center"><div id="img_status_ip3" class="redball"></div></th>
                <th align="center"><div id="img_status_ip4" class="redball"></div></th>
                <th align="center"><div id="img_status_ip5" class="redball"></div></th>
                <th align="center"><div id="img_status_ip6" class="redball"></div></th>
                <th align="center"><div id="img_status_ip7" class="redball"></div></th>
            </tr>
            <tr>
                <th align='left' scope="col" width='12%'>Service</th>
                <th scope="col" width='10%'>1</th>
                <th scope="col" width='10%'>2</th>
                <th scope="col" width='10%'>3</th>
                <th scope="col" width='10%'>4</th>
                <th scope="col" width='10%'>5</th>
                <th scope="col" width='10%'>6</th>
                <th scope="col" width='10%'>7</th>
            </tr>
            <tr>
                <td><b>Service Status</b></td>
                <td align="center"><div id="txt_status_ip1" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip2" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip3" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip4" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip5" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip6" > < Select > </div></td>
                <td align="center"><div id="txt_status_ip7" > < Select > </div></td>
            </tr>

            <tr>
                <td><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider1" id="upstream_provider1" style='width:100%;' onchange="getUpstreamProvider(1, 1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo1 = db_fetch_array($res4)) {
                            echo '<option value="'.$uppinfo1['id'].'" '.($info['upstream_provider1'] == $uppinfo1['id'] ? "selected=\"selected\"":"").'>'.$uppinfo1['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider2" id="upstream_provider2" style='width:100%;'  onchange="getUpstreamProvider(2, 1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo2 = db_fetch_array($res5)) {
                            echo '<option value="'.$uppinfo2['id'].'" '.($info['upstream_provider2'] == $uppinfo2['id'] ? "selected=\"selected\"":"").'>'.$uppinfo2['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider3" id="upstream_provider3" style='width:100%;'  onchange="getUpstreamProvider(3,1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo3 = db_fetch_array($res6)) {
                            echo '<option value="'.$uppinfo3['id'].'" '.($info['upstream_provider3'] == $uppinfo3['id'] ? "selected=\"selected\"":"").'>'.$uppinfo3['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider4" id="upstream_provider4" style='width:100%;'  onchange="getUpstreamProvider(4,1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo4 = db_fetch_array($res18)) {
                            echo '<option value="'.$uppinfo4['id'].'" '.($info['upstream_provider4'] == $uppinfo4['id'] ? "selected=\"selected\"":"").'>'.$uppinfo4['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider5" id="upstream_provider5" style='width:100%;'  onchange="getUpstreamProvider(5,1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo5 = db_fetch_array($res19)) {
                            echo '<option value="'.$uppinfo5['id'].'" '.($info['upstream_provider5'] == $uppinfo5['id'] ? "selected=\"selected\"":"").'>'.$uppinfo5['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider6" id="upstream_provider6" style='width:100%;'  onchange="getUpstreamProvider(6,1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo6 = db_fetch_array($res20)) {
                            echo '<option value="'.$uppinfo6['id'].'" '.($info['upstream_provider6'] == $uppinfo6['id'] ? "selected=\"selected\"":"").'>'.$uppinfo6['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='left'>
                    <select name="upstream_provider7" id="upstream_provider7" style='width:100%;'  onchange="getUpstreamProvider(7,1);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo7 = db_fetch_array($res21)) {
                            echo '<option value="'.$uppinfo7['id'].'" '.($info['upstream_provider7'] == $uppinfo7['id'] ? "selected=\"selected\"":"").'>'.$uppinfo7['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Service Type</b></td>
                <td><select name="service_type1" id="service_type1" width='100%' style='width:100%;' onchange="getServiceType(1,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type1'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type1'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type1'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type1'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type1'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type1'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type1'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type1'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type1'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type1'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type1'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type1'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type1'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type1'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type1'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type1'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type1'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type1'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type1'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select></td>
                <td><select name="service_type2" id="service_type2" width='100%' style='width:100%;' onchange="getServiceType(2,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type2'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type2'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type2'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type2'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type2'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type2'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type2'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type2'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type2'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type2'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type2'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type2'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type2'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type2'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type2'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type2'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type2'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type2'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type2'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select></td>
                <td><select name="service_type3" id="service_type3" width='100%' style='width:100%;' onchange="getServiceType(3,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type3'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type3'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type3'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type3'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type3'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type3'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type3'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type3'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type3'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type3'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type3'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type3'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type3'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type3'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type3'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type3'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type3'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type3'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type3'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>

                <td><select name="service_type4" id="service_type4" width='100%' style='width:100%;' onchange="getServiceType(4,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type4'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type4'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type4'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type4'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type4'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type4'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type4'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type4'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type4'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type4'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type4'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type4'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type4'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type4'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type4'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type4'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type4'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type4'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type4'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>

                <td><select name="service_type5" id="service_type5" width='100%' style='width:100%;' onchange="getServiceType(5,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type5'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type5'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type5'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type5'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type5'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type5'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type5'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type5'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type5'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type5'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type5'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type5'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type5'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type5'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type5'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type5'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type5'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type5'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type5'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>

                <td><select name="service_type6" id="service_type6" width='100%' style='width:100%;' onchange="getServiceType(6,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type6'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type6'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type6'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type6'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type6'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type6'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type6'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type6'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type6'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type6'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type6'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type6'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type6'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type6'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type6'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type6'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type6'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type6'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type6'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>

                <td><select name="service_type7" id="service_type7" width='100%' style='width:100%;' onchange="getServiceType(7,1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type7'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type7'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type7'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type7'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type7'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type7'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type7'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type7'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type7'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type7'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type7'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type7'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type7'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type7'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type7'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type7'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type7'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type7'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type7'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Service Use</b></td>
                <td><select name="service_use1" id="service_use1" width='100%' style='width:100%;' onchange="getServiceUse(1, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use1'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use1'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use1'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use1'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use1'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use1'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use2" id="service_use2" width='100%' style='width:100%;' onchange="getServiceUse(2, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use2'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use2'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use2'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use2'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use2'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use2'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use3" id="service_use3" width='100%' style='width:100%;' onchange="getServiceUse(3, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use3'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use3'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use3'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use3'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use3'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use3'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use4" id="service_use4" width='100%' style='width:100%;' onchange="getServiceUse(4, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use4'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use4'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use4'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use4'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use4'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use4'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use5" id="service_use5" width='100%' style='width:100%;' onchange="getServiceUse(5, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use5'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use5'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use5'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use5'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use5'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use5'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use6" id="service_use6" width='100%' style='width:100%;' onchange="getServiceUse(6, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use6'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use6'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use6'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use6'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use6'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use6'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td><select name="service_use7" id="service_use7" width='100%' style='width:100%;' onchange="getServiceUse(7, 1)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use7'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use7'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use7'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use7'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use7'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use7'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><b>IP Address</b></td>
                <td><input name="ip_address1" id="ip_address1" type="text" style='width:100%;' value="<?php echo $info['ip_address1']; ?>" onchange="interact(1, 1)"></td>
                <td><input name="ip_address2" id="ip_address2" type="text" style='width:100%;' value="<?php echo $info['ip_address2']; ?>" onchange="interact(2, 1)"></td>
                <td><input name="ip_address3" id="ip_address3" type="text" style='width:100%;' value="<?php echo $info['ip_address3']; ?>" onchange="interact(3, 1)"></td>
                <td><input name="ip_address4" id="ip_address4" type="text" style='width:100%;' value="<?php echo $info['ip_address4']; ?>" onchange="interact(4, 1)"></td>
                <td><input name="ip_address5" id="ip_address5" type="text" style='width:100%;' value="<?php echo $info['ip_address5']; ?>" onchange="interact(5, 1)"></td>
                <td><input name="ip_address6" id="ip_address6" type="text" style='width:100%;' value="<?php echo $info['ip_address6']; ?>" onchange="interact(6, 1)"></td>
                <td><input name="ip_address7" id="ip_address7" type="text" style='width:100%;' value="<?php echo $info['ip_address7']; ?>" onchange="interact(7, 1)"></td>
            </tr>
            <tr>
                <td><b>Details</b></td>
                <td align='center'><button type="button" onclick="showDetails(1);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(2);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(3);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(4);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(5);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(6);">Details</button></td>
                <td align='center'><button type="button" onclick="showDetails(7);">Details</button></td>
            </tr>
        </table>

        <hr/>

        <table cellspacing="10px" width="100%" border="0" id="details1" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 1</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service1" id="service1" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service1'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service1'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service1'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address1" id="public_ip1" type="text" style='width:80%;' value="<?php echo $info['ip_address1']; ?>" onchange="interact(1, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider1" id="upstream_provider_other1" style='width:80%;' onchange="getUpstreamProvider(1,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo1 = db_fetch_array($res22)) {
                            echo '<option value="'.$uppinfo1['id'].'" '.($info['upstream_provider1'] == $uppinfo1['id'] ? "selected=\"selected\"":"").'>'.$uppinfo1['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password1" id="auth_password1" type="text" style='width:80%;' value="<?php echo $info['auth_password1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone1" id="provider_phone1" type="text" style='width:78%;' value="<?php echo $info['provider_phone1']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route1" id="primary_route1" type="text" style='width:80%;' value="<?php echo $info['primary_route1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip1" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status1" id="service_status1" type="text" style='width:67%;' value="<?php echo $info['service_status1']; ?>">
                </td>

                <td align='left'>
                    
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username1" id="auth_username1" type="text" style='width:128%; margin-left:-48%' value="<?php echo $info['auth_username1']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id1" id="service_id1" type="text" style='width:80%;' value="<?php echo $info['service_id1']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type1" id="device_type1" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id1" id="loc_id1" type="text" style='width:80%;' value="<?php echo $info['loc_id1']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand1" id="hardware_brand1" type="text" style='width:80%;' value="<?php echo $info['hardware_brand1']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type1" id="service2_type1" style='width:81%;'  onchange="getServiceType(1,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type1'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type1'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type1'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type1'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type1'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type1'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type1'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type1'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type1'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type1'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type1'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type1'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type1'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type1'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type1'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type1'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type1'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type1'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type1'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model1" id="hardware_model1" type="text" style='width:80%;' value="<?php echo $info['hardware_model1']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier1" id="internet_underlining_carrier1" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier1'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier1'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier1'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier1'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier1'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip1" id="hardware_device_ip1" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service2_use1" id="service2_use1" type="text" style='width:80%;' value="--><?php //echo $info['service2_use1']; ?><!--">-->
                    <select name="service_use1" id="service2_use1" style='width:81%;' onchange="getServiceUse(1,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use1'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use1'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use1'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use1'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use1'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use1'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username1" id="device_username1" type="text" style='width:80%;' value="<?php echo $info['device_username1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum1" id="service_telnum1" type="text" style='width:80%;' value="<?php echo $info['service_telnum1']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password1" id="device_password1" type="text" style='width:80%;' value="<?php echo $info['device_password1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed1" id="profile_or_speed1" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed1']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id1" id="mac_id1" type="text" style='width:80%;' value="<?php echo $info['mac_id1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type1" id="technology_type1" type="text" style='width:80%;' value="<?php echo $info['technology_type1']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id1" id="ull_id1" type="text" style='width:80%;' value="<?php echo $info['ull_id1']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed1" id="mdf_pair_detailed1" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed1']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="contact_term1" id="contact_term1" type="text" style='width:80%;' value="<?php echo $info['contact_term1']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled1" id="wireless_enabled1" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract1" id="balance_contract1" type="text" style='width:80%;' value="<?php echo $info['balance_contract1']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd1" id="wireless_ssd1" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc1" id="mrc1" type="text" style='width:80%;' value="<?php echo $info['mrc1']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password1" id="wireless_password1" type="text" style='width:80%;' value="<?php echo $info['wireless_password1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf1" id="etf1" type="text" style='width:80%;' value="<?php echo $info['etf1']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments1" id="wireless_comments1" type="text" style='width:80%;' value="<?php echo $info['wireless_comments1']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date1" id="order_date1" type="date" style='width:40%;' value="<?php echo $info['order_date1']; ?>">
                    By
                    <input name="order_by1" id="order_by1" type="text" style='width:50%;' value="<?php echo $info['order_by1']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref1" id="order_ref1" type="text" style='width:80%;' value="<?php echo $info['order_ref1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date1" id="activation_date1" type="date" style='width:40%;' value="<?php echo $info['activation_date1']; ?>">
                    By
                    <input name="activation_by1" id="activation_by1" type="text" style='width:50%;' value="<?php echo $info['activation_by1']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref1" id="activation_ref1" type="text" style='width:80%;' value="<?php echo $info['activation_ref1']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date1" id="cancellation_date1" type="date" style='width:40%;' value="<?php echo $info['cancellation_date1']; ?>">
                    By
                    <input name="cancellation_by1" id="cancellation_by1" type="text" style='width:50%;' value="<?php echo $info['cancellation_by1']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref1" id="cancellation_ref1" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref1']; ?>">
                </td>
            </tr>
        </table>

        <table cellspacing="10px" width="100%" border="0" id="details2" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 2</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service2" id="service2" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service2'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service2'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service2'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address2" id="public_ip2" type="text" style='width:80%;' value="<?php echo $info['ip_address2']; ?>" onchange="interact(2, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider2" id="upstream_provider_other2" style='width:80%;' onchange="getUpstreamProvider(2,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo2 = db_fetch_array($res23)) {
                            echo '<option value="'.$uppinfo2['id'].'" '.($info['upstream_provider2'] == $uppinfo2['id'] ? "selected=\"selected\"":"").'>'.$uppinfo2['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password2" id="auth_password2" type="text" style='width:80%;' value="<?php echo $info['auth_password2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone2" id="provider_phone2" type="text" style='width:78%;' value="<?php echo $info['provider_phone2']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route2" id="primary_route2" type="text" style='width:80%;' value="<?php echo $info['primary_route2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip2" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status2" id="service_status2" type="text" style='width:67%;' value="<?php echo $info['service_status2']; ?>">
                </td>

                <td align='left'>
                    
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username2" id="auth_username2" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username2']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id2" id="service_id2" type="text" style='width:80%;' value="<?php echo $info['service_id2']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type2" id="device_type2" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id2" id="loc_id2" type="text" style='width:80%;' value="<?php echo $info['loc_id2']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand2" id="hardware_brand2" type="text" style='width:80%;' value="<?php echo $info['hardware_brand2']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type2" id="service2_type2" style='width:81%;'  onchange="getServiceType(2,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type2'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type2'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type2'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type2'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type2'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type2'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type2'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type2'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type2'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type2'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type2'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type2'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type2'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type2'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type2'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type2'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type2'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type2'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type2'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model2" id="hardware_model2" type="text" style='width:80%;' value="<?php echo $info['hardware_model2']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier2" id="internet_underlining_carrier2" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier2'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier2'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier2'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier2'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier2'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip2" id="hardware_device_ip2" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service2_use2" id="service2_use2" type="text" style='width:80%;' value="--><?php //echo $info['service_use2']; ?><!--">-->
                    <select name="service_use2" id="service2_use2" style='width:81%;' onchange="getServiceUse(2,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use2'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use2'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use2'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use2'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use2'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use2'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username2" id="device_username2" type="text" style='width:80%;' value="<?php echo $info['device_username2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum2" id="service_telnum2" type="text" style='width:80%;' value="<?php echo $info['service_telnum2']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password2" id="device_password2" type="text" style='width:80%;' value="<?php echo $info['device_password2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed2" id="profile_or_speed2" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed2']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id2" id="mac_id2" type="text" style='width:80%;' value="<?php echo $info['mac_id2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type2" id="technology_type2" type="text" style='width:80%;' value="<?php echo $info['technology_type2']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id2" id="ull_id2" type="text" style='width:80%;' value="<?php echo $info['ull_id2']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed2" id="mdf_pair_detailed2" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed2']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="contact_term2" id="contact_term2" type="text" style='width:80%;' value="<?php echo $info['contact_term2']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled2" id="wireless_enabled2" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract2" id="balance_contract2" type="text" style='width:80%;' value="<?php echo $info['balance_contract2']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd2" id="wireless_ssd2" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc2" id="mrc2" type="text" style='width:80%;' value="<?php echo $info['mrc2']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password2" id="wireless_password2" type="text" style='width:80%;' value="<?php echo $info['wireless_password2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf2" id="etf2" type="text" style='width:80%;' value="<?php echo $info['etf2']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments2" id="wireless_comments2" type="text" style='width:80%;' value="<?php echo $info['wireless_comments2']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date2" id="order_date2" type="date" style='width:40%;' value="<?php echo $info['order_date2']; ?>">
                    By
                    <input name="order_by2" id="order_by2" type="text" style='width:50%;' value="<?php echo $info['order_by2']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref2" id="order_ref2" type="text" style='width:80%;' value="<?php echo $info['order_ref2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date2" id="activation_date2" type="date" style='width:40%;' value="<?php echo $info['activation_date2']; ?>">
                    By
                    <input name="activation_by2" id="activation_by2" type="text" style='width:50%;' value="<?php echo $info['activation_by2']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref2" id="activation_ref2" type="text" style='width:80%;' value="<?php echo $info['activation_ref2']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date2" id="cancellation_date2" type="date" style='width:40%;' value="<?php echo $info['cancellation_date2']; ?>">
                    By
                    <input name="cancellation_by2" id="cancellation_by2" type="text" style='width:50%;' value="<?php echo $info['cancellation_by2']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref2" id="cancellation_ref2" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref2']; ?>">
                </td>
            </tr>
        </table>

        <table cellspacing="10px" width="100%" border="0" id="details3" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 3</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service3" id="service3" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service3'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service3'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service3'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address3" id="public_ip3" type="text" style='width:80%;' value="<?php echo $info['ip_address3']; ?>" onchange="interact(3, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider3" id="upstream_provider_other3" style='width:80%;' onchange="getUpstreamProvider(3,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo3 = db_fetch_array($res24)) {
                            echo '<option value="'.$uppinfo3['id'].'" '.($info['upstream_provider3'] == $uppinfo3['id'] ? "selected=\"selected\"":"").'>'.$uppinfo3['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password3" id="auth_password3" type="text" style='width:80%;' value="<?php echo $info['auth_password3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone3" id="provider_phone3" type="text" style='width:78%;' value="<?php echo $info['provider_phone3']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route3" id="primary_route3" type="text" style='width:80%;' value="<?php echo $info['primary_route3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip3" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status3" id="service_status3" type="text" style='width:67%;' value="<?php echo $info['service_status3']; ?>">
                </td>

                <td align='left'>
                
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username3" id="auth_username3" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username3']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id3" id="service_id3" type="text" style='width:80%;' value="<?php echo $info['service_id3']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type3" id="device_type3" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id3" id="loc_id3" type="text" style='width:80%;' value="<?php echo $info['loc_id3']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand3" id="hardware_brand3" type="text" style='width:80%;' value="<?php echo $info['hardware_brand1']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type3" id="service2_type3" style='width:81%;' onchange="getServiceType(3,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type3'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type3'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type3'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type3'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type3'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type3'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type3'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type3'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type3'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type3'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type3'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type3'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type3'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type3'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type3'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type3'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type3'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type3'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type3'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model3" id="hardware_model3" type="text" style='width:80%;' value="<?php echo $info['hardware_model3']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier3" id="internet_underlining_carrier3" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier3'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier3'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier3'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier3'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier3'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip3" id="hardware_device_ip3" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service_use3" id="service_use3" type="text" style='width:80%;' value="--><?php //echo $info['service_use3']; ?><!--">-->
                    <select name="service_use3" id="service2_use3" style='width:81%;' onchange="getServiceUse(3,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use3'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use3'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use3'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use3'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use3'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use3'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username3" id="device_username3" type="text" style='width:80%;' value="<?php echo $info['device_username3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum3" id="service_telnum3" type="text" style='width:80%;' value="<?php echo $info['service_telnum3']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password3" id="device_password3" type="text" style='width:80%;' value="<?php echo $info['device_password3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed3" id="profile_or_speed3" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed3']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id3" id="mac_id3" type="text" style='width:80%;' value="<?php echo $info['mac_id3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type3" id="technology_type3" type="text" style='width:80%;' value="<?php echo $info['technology_type3']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id3" id="ull_id3" type="text" style='width:80%;' value="<?php echo $info['ull_id3']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed3" id="mdf_pair_detailed3" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed3']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="contact_term3" id="contact_term3" type="text" style='width:80%;' value="<?php echo $info['contact_term3']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled3" id="wireless_enabled3" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract3" id="balance_contract3" type="text" style='width:80%;' value="<?php echo $info['balance_contract3']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd3" id="wireless_ssd3" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc3" id="mrc3" type="text" style='width:80%;' value="<?php echo $info['mrc3']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password3" id="wireless_password3" type="text" style='width:80%;' value="<?php echo $info['wireless_password3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf3" id="etf3" type="text" style='width:80%;' value="<?php echo $info['etf3']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments3" id="wireless_comments3" type="text" style='width:80%;' value="<?php echo $info['wireless_comments3']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date3" id="order_date3" type="date" style='width:40%;' value="<?php echo $info['order_date3']; ?>">
                    By
                    <input name="order_by3" id="order_by3" type="text" style='width:50%;' value="<?php echo $info['order_by3']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref3" id="order_ref3" type="text" style='width:80%;' value="<?php echo $info['order_ref3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date3" id="activation_date3" type="date" style='width:40%;' value="<?php echo $info['activation_date3']; ?>">
                    By
                    <input name="activation_by3" id="activation_by3" type="text" style='width:50%;' value="<?php echo $info['activation_by3']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref3" id="activation_ref3" type="text" style='width:80%;' value="<?php echo $info['activation_ref3']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date3" id="cancellation_date3" type="date" style='width:40%;' value="<?php echo $info['cancellation_date3']; ?>">
                    By
                    <input name="cancellation_by3" id="cancellation_by3" type="text" style='width:50%;' value="<?php echo $info['cancellation_by3']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref3" id="cancellation_ref3" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref3']; ?>">
                </td>
            </tr>
        </table>

        <table cellspacing="10px" width="100%" border="0" id="details4" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 4</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service4" id="service4" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service4'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service4'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service4'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address4" id="public_ip4" type="text" style='width:80%;' value="<?php echo $info['ip_address4']; ?>" onchange="interact(4, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider4" id="upstream_provider_other4" style='width:80%;' onchange="getUpstreamProvider(4,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo4 = db_fetch_array($res25)) {
                            echo '<option value="'.$uppinfo4['id'].'" '.($info['upstream_provider4'] == $uppinfo4['id'] ? "selected=\"selected\"":"").'>'.$uppinfo4['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password4" id="auth_password4" type="text" style='width:80%;' value="<?php echo $info['auth_password4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone4" id="provider_phone4" type="text" style='width:78%;' value="<?php echo $info['provider_phone4']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route4" id="primary_route4" type="text" style='width:80%;' value="<?php echo $info['primary_route4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip4" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status4" id="service_status4" type="text" style='width:67%;' value="<?php echo $info['service_status4']; ?>">
                </td>

                <td align='left' >
                    
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username4" id="auth_username4" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username4']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id4" id="service_id4" type="text" style='width:80%;' value="<?php echo $info['service_id4']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type4" id="device_type4" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id4" id="loc_id4" type="text" style='width:80%;' value="<?php echo $info['loc_id4']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand4" id="hardware_brand4" type="text" style='width:80%;' value="<?php echo $info['hardware_brand4']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type4" id="service2_type4" style='width:81%;' onchange="getServiceType(4,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type4'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type4'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type4'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type4'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type4'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type4'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type4'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type4'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type4'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type4'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type4'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type4'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type4'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type4'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type4'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type4'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type4'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type4'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type4'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model4" id="hardware_model4" type="text" style='width:80%;' value="<?php echo $info['hardware_model4']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier4" id="internet_underlining_carrier4" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier4'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier4'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier4'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier4'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier4'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip4" id="hardware_device_ip4" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service_use4" id="service_use4" type="text" style='width:80%;' value="--><?php //echo $info['service_use4']; ?><!--">-->
                    <select name="service_use4" id="service2_use4" style='width:81%;' onchange="getServiceUse(4,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use4'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use4'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use4'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use4'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use4'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use4'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use4'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username4" id="device_username4" type="text" style='width:80%;' value="<?php echo $info['device_username4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum4" id="service_telnum4" type="text" style='width:80%;' value="<?php echo $info['service_telnum4']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password4" id="device_password4" type="text" style='width:80%;' value="<?php echo $info['device_password4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed4" id="profile_or_speed4" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed4']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id4" id="mac_id4" type="text" style='width:80%;' value="<?php echo $info['mac_id4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type4" id="technology_type4" type="text" style='width:80%;' value="<?php echo $info['technology_type4']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id4" id="ull_id4" type="text" style='width:80%;' value="<?php echo $info['ull_id4']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed4" id="mdf_pair_detailed4" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed4']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="service_id4" id="service_id4" type="text" style='width:80%;' value="<?php echo $info['service_id4']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled4" id="wireless_enabled4" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract4" id="balance_contract4" type="text" style='width:80%;' value="<?php echo $info['balance_contract4']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd4" id="wireless_ssd4" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc4" id="mrc4" type="text" style='width:80%;' value="<?php echo $info['mrc4']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password4" id="wireless_password4" type="text" style='width:80%;' value="<?php echo $info['wireless_password4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf4" id="etf4" type="text" style='width:80%;' value="<?php echo $info['etf4']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="comments4" id="wireless_comments4" type="text" style='width:80%;' value="<?php echo $info['wireless_comments4']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date4" id="order_date4" type="date" style='width:40%;' value="<?php echo $info['order_date4']; ?>">
                    By
                    <input name="order_by4" id="order_by4" type="text" style='width:50%;' value="<?php echo $info['order_by4']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref4" id="order_ref4" type="text" style='width:80%;' value="<?php echo $info['order_ref4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date4" id="activation_date4" type="date" style='width:40%;' value="<?php echo $info['activation_date4']; ?>">
                    By
                    <input name="activation_by4" id="activation_by4" type="text" style='width:50%;' value="<?php echo $info['activation_by4']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref4" id="activation_ref4" type="text" style='width:80%;' value="<?php echo $info['activation_ref4']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date4" id="cancellation_date4" type="date" style='width:40%;' value="<?php echo $info['cancellation_date4']; ?>">
                    By
                    <input name="cancellation_by4" id="cancellation_by4" type="text" style='width:50%;' value="<?php echo $info['cancellation_by4']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref4" id="cancellation_ref4" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref4']; ?>">
                </td>
            </tr>


        </table>

        <table cellspacing="10px" width="100%" border="0" id="details5" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 5</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service5" id="service5" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service5'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service5'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service5'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address5" id="public_ip5" type="text" style='width:80%;' value="<?php echo $info['ip_address5']; ?>" onchange="interact(5, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider5" id="upstream_provider_other5" style='width:80%;' onchange="getUpstreamProvider(5,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo5 = db_fetch_array($res26)) {
                            echo '<option value="'.$uppinfo5['id'].'" '.($info['upstream_provider5'] == $uppinfo5['id'] ? "selected=\"selected\"":"").'>'.$uppinfo5['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password5" id="auth_password5" type="text" style='width:80%;' value="<?php echo $info['auth_password5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone5" id="provider_phone5" type="text" style='width:78%;' value="<?php echo $info['provider_phone5']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route5" id="primary_route5" type="text" style='width:80%;' value="<?php echo $info['primary_route5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip5" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status5" id="service_status5" type="text" style='width:67%;' value="<?php echo $info['service_status5']; ?>">
                </td>

                <td align='left'>
                    
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username5" id="auth_username5" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username5']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id5" id="service_id5" type="text" style='width:80%;' value="<?php echo $info['service_id5']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type5" id="device_type5" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id5" id="loc_id5" type="text" style='width:80%;' value="<?php echo $info['loc_id5']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand5" id="hardware_brand5" type="text" style='width:80%;' value="<?php echo $info['hardware_brand5']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type5" id="service2_type5" style='width:81%;' onchange="getServiceType(5,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type5'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type5'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type5'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type5'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type5'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type5'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type5'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type5'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type5'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type5'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type5'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type5'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type5'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type5'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type5'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type5'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type5'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type5'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type5'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model5" id="hardware_model5" type="text" style='width:80%;' value="<?php echo $info['hardware_model5']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier5" id="internet_underlining_carrier5" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier5'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier5'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier5'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier5'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier5'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip5" id="hardware_device_ip5" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service_use5" id="service_use5" type="text" style='width:80%;' value="--><?php //echo $info['service_use5']; ?><!--">-->
                    <select name="service_use5" id="service2_use5" style='width:81%;' onchange="getServiceUse(5,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use5'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use5'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use5'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use5'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use5'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use5'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use5'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username5" id="device_username5" type="text" style='width:80%;' value="<?php echo $info['device_username5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum5" id="service_telnum5" type="text" style='width:80%;' value="<?php echo $info['service_telnum5']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password5" id="device_password5" type="text" style='width:80%;' value="<?php echo $info['device_password5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed5" id="profile_or_speed5" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed5']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id5" id="mac_id5" type="text" style='width:80%;' value="<?php echo $info['mac_id5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type5" id="technology_type5" type="text" style='width:80%;' value="<?php echo $info['technology_type5']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id5" id="ull_id5" type="text" style='width:80%;' value="<?php echo $info['ull_id5']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed5" id="mdf_pair_detailed5" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed5']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="service_id5" id="service_id5" type="text" style='width:80%;' value="<?php echo $info['service_id5']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled5" id="wireless_enabled5" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract5" id="balance_contract5" type="text" style='width:80%;' value="<?php echo $info['balance_contract5']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd5" id="wireless_ssd5" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc5" id="mrc5" type="text" style='width:80%;' value="<?php echo $info['mrc5']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password5" id="wireless_password5" type="text" style='width:80%;' value="<?php echo $info['wireless_password5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf5" id="etf5" type="text" style='width:80%;' value="<?php echo $info['etf5']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments5" id="wireless_comments5" type="text" style='width:80%;' value="<?php echo $info['wireless_comments5']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date5" id="order_date5" type="date" style='width:40%;' value="<?php echo $info['order_date5']; ?>">
                    By
                    <input name="order_by5" id="order_by5" type="text" style='width:50%;' value="<?php echo $info['order_by5']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref5" id="order_ref5" type="text" style='width:80%;' value="<?php echo $info['order_ref5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date5" id="activation_date5" type="date" style='width:40%;' value="<?php echo $info['activation_date5']; ?>">
                    By
                    <input name="activation_by5" id="activation_by5" type="text" style='width:50%;' value="<?php echo $info['activation_by5']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref5" id="activation_ref5" type="text" style='width:80%;' value="<?php echo $info['activation_ref5']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date5" id="cancellation_date5" type="date" style='width:40%;' value="<?php echo $info['cancellation_date5']; ?>">
                    By
                    <input name="cancellation_by5" id="cancellation_by5" type="text" style='width:50%;' value="<?php echo $info['cancellation_by5']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref5" id="cancellation_ref5" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref5']; ?>">
                </td>
            </tr>


        </table>

        <table cellspacing="10px" width="100%" border="0" id="details6" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 6</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service6" id="service6" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service6'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service6'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service6'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address6" id="public_ip6" type="text" style='width:80%;' value="<?php echo $info['ip_address6']; ?>" onchange="interact(6, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider6" id="upstream_provider_other6" style='width:80%;' onchange="getUpstreamProvider(6,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo6 = db_fetch_array($res27)) {
                            echo '<option value="'.$uppinfo6['id'].'" '.($info['upstream_provider6'] == $uppinfo6['id'] ? "selected=\"selected\"":"").'>'.$uppinfo6['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password6" id="auth_password6" type="text" style='width:80%;' value="<?php echo $info['auth_password6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone6" id="provider_phone6" type="text" style='width:78%;' value="<?php echo $info['provider_phone6']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route6" id="primary_route6" type="text" style='width:80%;' value="<?php echo $info['primary_route6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip6" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status6" id="service_status6" type="text" style='width:67%;' value="<?php echo $info['service_status6']; ?>">
                </td>

                <td align='left'>
          
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username6" id="auth_username6" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username6']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id6" id="service_id6" type="text" style='width:80%;' value="<?php echo $info['service_id6']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type6" id="device_type6" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id6" id="loc_id6" type="text" style='width:80%;' value="<?php echo $info['loc_id6']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand6" id="hardware_brand6" type="text" style='width:80%;' value="<?php echo $info['hardware_brand6']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type6" id="service2_type6" style='width:81%;' onchange="getServiceType(6,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type6'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type6'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type6'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type6'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type6'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type6'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type6'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type6'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type6'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type6'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type6'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type6'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type6'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type6'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type6'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type6'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type6'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type6'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type6'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model6" id="hardware_model6" type="text" style='width:80%;' value="<?php echo $info['hardware_model6']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier6" id="internet_underlining_carrier6" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier6'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier6'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier6'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier6'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier6'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip6" id="hardware_device_ip6" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service_use6" id="service_use6" type="text" style='width:80%;' value="--><?php //echo $info['service_use6']; ?><!--">-->
                    <select name="service_use6" id="service2_use6" style='width:81%;' onchange="getServiceUse(6,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use6'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use6'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use6'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use6'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use6'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use6'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use6'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username6" id="device_username6" type="text" style='width:80%;' value="<?php echo $info['device_username6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum6" id="service_telnum6" type="text" style='width:80%;' value="<?php echo $info['service_telnum6']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password6" id="device_password6" type="text" style='width:80%;' value="<?php echo $info['device_password6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed6" id="profile_or_speed6" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed6']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id6" id="mac_id6" type="text" style='width:80%;' value="<?php echo $info['mac_id6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type6" id="technology_type6" type="text" style='width:80%;' value="<?php echo $info['technology_type6']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id6" id="ull_id6" type="text" style='width:80%;' value="<?php echo $info['ull_id6']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed6" id="mdf_pair_detailed6" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed6']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="service_id6" id="service_id6" type="text" style='width:80%;' value="<?php echo $info['service_id6']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled6" id="wireless_enabled6" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract6" id="balance_contract6" type="text" style='width:80%;' value="<?php echo $info['balance_contract6']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd6" id="wireless_ssd6" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc6" id="mrc6" type="text" style='width:80%;' value="<?php echo $info['mrc6']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password6" id="wireless_password6" type="text" style='width:80%;' value="<?php echo $info['wireless_password6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf6" id="etf6" type="text" style='width:80%;' value="<?php echo $info['etf6']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments6" id="wireless_comments6" type="text" style='width:80%;' value="<?php echo $info['wireless_comments6']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date6" id="order_date6" type="date" style='width:40%;' value="<?php echo $info['order_date6']; ?>">
                    By
                    <input name="order_by6" id="order_by6" type="text" style='width:50%;' value="<?php echo $info['order_by6']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref6" id="order_ref6" type="text" style='width:80%;' value="<?php echo $info['order_ref6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date6" id="activation_date6" type="date" style='width:40%;' value="<?php echo $info['activation_date6']; ?>">
                    By
                    <input name="activation_by6" id="activation_by6" type="text" style='width:50%;' value="<?php echo $info['activation_by6']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref6" id="activation_ref6" type="text" style='width:80%;' value="<?php echo $info['activation_ref6']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date6" id="cancellation_date6" type="date" style='width:40%;' value="<?php echo $info['cancellation_date6']; ?>">
                    By
                    <input name="cancellation_by6" id="cancellation_by6" type="text" style='width:50%;' value="<?php echo $info['cancellation_by6']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref6" id="cancellation_ref6" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref6']; ?>">
                </td>
            </tr>


        </table>

        <table cellspacing="10px" width="100%" border="0" id="details7" style="display:none;" class="service_details custtable">
            <tr>
                <td style="font-size:16px; color:red"><b>Service 7</b></td>
                <td align="left">
                    <b>Upstream Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Authentication Details</b>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Service Status</b></td>
                <td align='left'>
                    <select name="service7" id="service7" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" <?php echo $info['service7'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
                        <option class="greenText" value="active" <?php echo $info['service7'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
                        <option class="redText" value="cancelled" <?php echo $info['service7'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
                    </select>
                </td>
                <td align='right'>
                    Public IP Address
                </td>

                <td align='left'>
                    <input name="ip_address7" id="public_ip7" type="text" style='width:80%;' value="<?php echo $info['ip_address7']; ?>"  onchange="interact(7, 0)">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Upstream Provider</b></td>
                <td align='left'>
                    <select name="upstream_provider7" id="upstream_provider_other7" style='width:80%;' onchange="getUpstreamProvider(7,0);">
                        <option value="">&lt;Select&gt;</option>
                        <?php while($uppinfo7 = db_fetch_array($res28)) {
                            echo '<option value="'.$uppinfo7['id'].'" '.($info['upstream_provider7'] == $uppinfo7['id'] ? "selected=\"selected\"":"").'>'.$uppinfo7['upstream_provname'].'</option>';
                        }
                        ?>
                        <option value="other" <?php echo $info['upstream_provider7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Password
                </td>
                <td align='left'>
                    <input name="auth_password7" id="auth_password7" type="text" style='width:80%;' value="<?php echo $info['auth_password7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Provider Telephone
                </td>
                <td align='left'>
                    <input name="provider_phone7" id="provider_phone7" type="text" style='width:78%;' value="<?php echo $info['provider_phone7']; ?>">
                </td>
                <td align='right'>
                    Primary Route
                </td>
                <td align='left'>
                    <input name="primary_route7" id="primary_route7" type="text" style='width:80%;' value="<?php echo $info['primary_route7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Ping
                </td>

                <td align='left' style="display:flex;">
                    <div id="image_status_ip7" style="margin-left:10px; margin-right:10px;" class="redball"></div>
                    <input name="service_status7" id="service_status7" type="text" style='width:67%;' value="<?php echo $info['service_status7']; ?>">
                </td>

                <td align='left'>
                 
                </td>
                <td align='left'>
                    <input placeholder="User Name" name="auth_username7" id="auth_username7" type="text" style='width:128%; margin-left:-48%;' value="<?php echo $info['auth_username7']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Service Hardware</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Service ID</b></td>
                <td align='left'>
                    <input name="service_id7" id="service_id7" type="text" style='width:80%;' value="<?php echo $info['service_id7']; ?>">
                </td>
                <td align='right'>
                    Device Type
                </td>
                <td align='left'>
                    <select name="device_type7" id="device_type7" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">&lt;Select&gt;</option>
                        <option class="orangeText" value="pending" >Router</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    LOC ID
                </td>
                <td align='left'>
                    <input name="loc_id7" id="loc_id7" type="text" style='width:80%;' value="<?php echo $info['loc_id7']; ?>">
                </td>
                <td align='right'>
                    Brand
                </td>
                <td align='left'>
                    <input name="hardware_brand7" id="hardware_brand7" type="text" style='width:80%;' value="<?php echo $info['hardware_brand7']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right">Service Type</td>
                <td>
                    <select name="service_type7" id="service2_type7" style='width:81%;' onchange="getServiceType(7,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="adsl1" <?php echo $info['service_type7'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
                        <option value="adsl2_plus" <?php echo $info['service_type7'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
                        <option value="adsl_exstream" <?php echo $info['service_type7'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
                        <option value="wireless_bmb" <?php echo $info['service_type7'] == 'wireless_bmb' ? "selected=\"selected\"":""; ?>>Wireless / BMB</option>
                        <option value="wireless_gateway" <?php echo $info['service_type7'] == 'wireless_gateway' ? "selected=\"selected\"":""; ?>>Wireless / Gateway</option>
                        <option value="efm_4_wire" <?php echo $info['service_type7'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM / 4 Wire</option>
                        <option value="efm_6_wire" <?php echo $info['service_type7'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM / 6 Wire</option>
                        <option value="efm_8_wire" <?php echo $info['service_type7'] == 'efm_8_wire' ? "selected=\"selected\"":""; ?>>EFM / 8 Wire</option>
                        <option value="eofw" <?php echo $info['service_type7'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
                        <option value="fibre" <?php echo $info['service_type7'] == 'fibre' ? "selected=\"selected\"":""; ?>>Fibre</option>
                        <option value="mbe" <?php echo $info['service_type7'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
                        <option value="naked_adsl" <?php echo $info['service_type7'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
                        <option value="nbn" <?php echo $info['service_type7'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
                        <option value="shdsl" <?php echo $info['service_type7'] == 'shdsl' ? "selected=\"selected\"":""; ?>>SHDSL</option>
                        <option value="satellite" <?php echo $info['service_type7'] == 'satellite' ? "selected=\"selected\"":""; ?>>Satellite</option>
                        <option value="fofw" <?php echo $info['service_type7'] == 'fofw' ? "selected=\"selected\"":""; ?>>FoFW</option>
                        <option value="wireless_3g" <?php echo $info['service_type7'] == 'wireless_3g' ? "selected=\"selected\"":""; ?>>Wireless / 3G</option>
                        <option value="wireless_4g" <?php echo $info['service_type7'] == 'wireless_4g' ? "selected=\"selected\"":""; ?>>Wireless / 4G</option>
                        <option value="wireless_5g" <?php echo $info['service_type7'] == 'wireless_5g' ? "selected=\"selected\"":""; ?>>Wireless / 5G</option>
                        <option value="other" <?php echo $info['service_type7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Model
                </td>
                <td align='left'>
                    <input name="hardware_model7" id="hardware_model7" type="text" style='width:80%;' value="<?php echo $info['hardware_model7']; ?>">
                </td>
            </tr>

            <tr>
                <td align="right"><b>Underlining Carrier</b></td>
                <td>
                    <select name="internet_underlining_carrier7" id="internet_underlining_carrier7" style='width:81%;'>
                        <option value="">&lt;Select&gt;</option>
                        <option value="optus" <?php echo $info['internet_underlining_carrier7'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
                        <option value="telstra" <?php echo $info['internet_underlining_carrier7'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
                        <option value="bigair" <?php echo $info['internet_underlining_carrier7'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
                        <option value="polyphone" <?php echo $info['internet_underlining_carrier7'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyfone</option>
                        <option value="tpg" <?php echo $info['internet_underlining_carrier7'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
                        <option value="other" <?php echo $info['internet_underlining_carrier7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device IP
                </td>
                <td align='left'>
                    <input name="hardware_device_ip7" id="hardware_device_ip7" type="text" style='width:80%;' value="<?php echo $info['hardware_device_ip7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Use
                </td>
                <td align='left'>
<!--                    <input name="service_use7" id="service_use7" type="text" style='width:80%;' value="--><?php //echo $info['service_use7']; ?><!--">-->
                    <select name="service_use7" id="service2_use7" style='width:81%;' onchange="getServiceUse(7,0)">
                        <option value="">&lt;Select&gt;</option>
                        <option value="voice_phones" <?php echo $info['service_use7'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice</option>
                        <option value="data_office" <?php echo $info['service_use7'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data</option>
                        <option value="shared" <?php echo $info['service_use7'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared</option>
                        <option value="data_vpn" <?php echo $info['service_use7'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>VPN</option>
                        <option value="backup" <?php echo $info['service_use7'] == 'backup' ? "selected=\"selected\"":""; ?>>Backup</option>
                        <option value="failover" <?php echo $info['service_use7'] == 'failover' ? "selected=\"selected\"":""; ?>>Failover</option>
                        <option value="other" <?php echo $info['service_use7'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
                    </select>
                </td>
                <td align='right'>
                    Device User Name
                </td>
                <td align='left'>
                    <input name="device_username7" id="device_username7" type="text" style='width:80%;' value="<?php echo $info['device_username7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Service Tel Number
                </td>
                <td align='left'>
                    <input name="service_telnum7" id="service_telnum7" type="text" style='width:80%;' value="<?php echo $info['service_telnum7']; ?>">
                </td>
                <td align='right'>
                    Device Password
                </td>
                <td align='left'>
                    <input name="device_password7" id="device_password7" type="text" style='width:80%;' value="<?php echo $info['device_password7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Profile Speed
                </td>
                <td align='left'>
                    <input name="profile_or_speed7" id="profile_or_speed7" type="text" style='width:80%;' value="<?php echo $info['profile_or_speed7']; ?>">
                </td>
                <td align='right'>
                    Mac ID
                </td>
                <td align='left'>
                    <input name="mac_id7" id="mac_id7" type="text" style='width:80%;' value="<?php echo $info['mac_id7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Technology Type
                </td>
                <td align='left'>
                    <input name="technology_type7" id="technology_type7" type="text" style='width:80%;' value="<?php echo $info['technology_type7']; ?>">
                </td>
                <td align='right'>
                    ULL ID
                </td>
                <td align='left'>
                    <input name="ull_id7" id="ull_id7" type="text" style='width:80%;' value="<?php echo $info['ull_id7']; ?>">
                </td>
            </tr>
            
            <tr>
                <td align='right'>
                    MDF Pair Detailed
                </td>
                <td align='left'>
                    <input name="mdf_pair_detailed7" id="mdf_pair_detailed7" type="text" style='width:80%;' value="<?php echo $info['mdf_pair_detailed7']; ?>">
                </td>
                <td align='right'>

                </td>
                <td align='left'>

                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Plan Details</b>
                </td>
                <td> </td>
                <td align="left">
                    <b>Wireless</b>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Contact Term</b></td>
                <td align='left'>
                    <input name="service_id7" id="service_id7" type="text" style='width:80%;' value="<?php echo $info['service_id7']; ?>">
                    Months
                </td>
                <td align='right'>
                    Enabled | Wireless
                </td>
                <td align='left'>
                    <select name="wireless_enabled7" id="wireless_enabled7" width='80%' style='width:80%;'
                            onchange="this.className=this.options[this.selectedIndex].className">
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Balance of contract
                </td>
                <td align='left'>
                    <input name="balance_contract7" id="balance_contract7" type="text" style='width:80%;' value="<?php echo $info['balance_contract7']; ?>">
                    Months
                </td>
                <td align='right'>
                    SSD | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_ssd7" id="wireless_ssd7" type="text" style='width:80%;' value="<?php echo $info['wireless_ssd7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    MRC
                </td>
                <td align='left'>
                    <input name="mrc7" id="mrc7" type="text" style='width:80%;' value="<?php echo $info['mrc7']; ?>">
                    Months
                </td>
                <td align='right'>
                    Password | Wireless
                </td>
                <td align='left'>
                    <input name="wireless_password7" id="wireless_password7" type="text" style='width:80%;' value="<?php echo $info['wireless_password7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    ETF
                </td>
                <td align='left'>
                    <input name="etf7" id="etf7" type="text" style='width:80%;' value="<?php echo $info['etf7']; ?>">
                    Fee
                </td>
                <td align='right'>
                    Comments
                </td>
                <td align='left'>
                    <input name="wireless_comments7" id="wireless_comments7" type="text" style='width:80%;' value="<?php echo $info['wireless_comments7']; ?>">
                </td>
            </tr>

            <tr><td colspan="4"><hr/></td></tr>

            <tr>
                <td> </td>
                <td align="left">
                    <b>Service Provisioning Details</b>
                </td>
                <td> </td>
                <td align="left"> </td>
            </tr>

            <tr>
                <td align='right'>
                    Order Date
                </td>
                <td align='left'>
                    <input name="order_date7" id="order_date7" type="date" style='width:40%;' value="<?php echo $info['order_date7']; ?>">
                    By
                    <input name="order_by7" id="order_by7" type="text" style='width:50%;' value="<?php echo $info['order_by7']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="order_ref7" id="order_ref7" type="text" style='width:80%;' value="<?php echo $info['order_ref7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Activation Date
                </td>
                <td align='left'>
                    <input name="activation_date7" id="activation_date7" type="date" style='width:40%;' value="<?php echo $info['activation_date7']; ?>">
                    By
                    <input name="activation_by7" id="activation_by7" type="text" style='width:50%;' value="<?php echo $info['activation_by7']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="activation_ref7" id="activation_ref7" type="text" style='width:80%;' value="<?php echo $info['activation_ref7']; ?>">
                </td>
            </tr>

            <tr>
                <td align='right'>
                    Cancellation Date
                </td>
                <td align='left'>
                    <input name="cancellation_date7" id="cancellation_date7" type="date" style='width:40%;' value="<?php echo $info['cancellation_date7']; ?>">
                    By
                    <input name="cancellation_by7" id="cancellation_by7" type="text" style='width:50%;' value="<?php echo $info['cancellation_by7']; ?>">
                </td>
                <td align='right'>
                    Ref
                </td>
                <td align='left'>
                    <input name="cancellation_ref7" id="cancellation_ref7" type="text" style='width:80%;' value="<?php echo $info['cancellation_ref7']; ?>">
                </td>
            </tr>


        </table>

        <!-- Hong Coding End-->

        <table cellspacing="10px" width="100%" border="0" id="tb_sip" style="display:none;"  class="custtable">
            <tr>
            <th scope="col" width="25%">SIP Account Detail</th>
            <th scope="col" width="25%">Service 1</th>
            <th scope="col" width="25%">Service 2</th>
            <th scope="col" width="25%">Service 3</th>
          </tr>
          <tr>
            <td><b>SIP Number</b></td>
            <td><input name="sip_number1" id="sip_number1" type="text" style='width:90%;' value="<?php echo $info['sip_number1']; ?>"></td>
            <td><input name="sip_number2" id="sip_number2" type="text" style='width:90%;' value="<?php echo $info['sip_number2']; ?>"></td>
            <td><input name="sip_number3" id="sip_number3" type="text" style='width:90%;' value="<?php echo $info['sip_number3']; ?>"></td>
          </tr>
          <tr>
            <td><b>SIP Use</b></td>
            <td><select name="sip_use1" id="sip_use1" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="primary" <?php echo $info['sip_use1'] == 'primary' ? "selected=\"selected\"":""; ?>>Primary Number</option>
              <option value="fax" <?php echo $info['sip_use1'] == 'fax' ? "selected=\"selected\"":""; ?>>Fax Number</option>
              <option value="dial" <?php echo $info['sip_use1'] == 'dial' ? "selected=\"selected\"":""; ?>>In Dial Number</option>
              <option value="other" <?php echo $info['sip_use1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_use2" id="sip_use2" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="primary" <?php echo $info['sip_use2'] == 'primary' ? "selected=\"selected\"":""; ?>>Primary Number</option>
              <option value="fax" <?php echo $info['sip_use2'] == 'fax' ? "selected=\"selected\"":""; ?>>Fax Number</option>
              <option value="dial" <?php echo $info['sip_use2'] == 'dial' ? "selected=\"selected\"":""; ?>>In Dial Number</option>
              <option value="other" <?php echo $info['sip_use2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_use3" id="sip_use3" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="primary" <?php echo $info['sip_use3'] == 'primary' ? "selected=\"selected\"":""; ?>>Primary Number</option>
              <option value="fax" <?php echo $info['sip_use3'] == 'fax' ? "selected=\"selected\"":""; ?>>Fax Number</option>
              <option value="dial" <?php echo $info['sip_use3'] == 'dial' ? "selected=\"selected\"":""; ?>>In Dial Number</option>
              <option value="other" <?php echo $info['sip_use3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Other</b></td>
            <td><input name="sip_use_other1" id="sip_use_other1" type="text" style='width:90%;' value="<?php echo $info['sip_use_other1']; ?>"></td>
            <td><input name="sip_use_other2" id="sip_use_other2" type="text" style='width:90%;' value="<?php echo $info['sip_use_other2']; ?>"></td>
            <td><input name="sip_use_other3" id="sip_use_other3" type="text" style='width:90%;' value="<?php echo $info['sip_use_other3']; ?>"></td>
          </tr>
          <tr>
            <td><b>SIP Upstream Provider</b></td>
            <td><select name="sip_upstream1" id="sip_upstream1" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="viaip" <?php echo $info['sip_upstream1'] == 'viaip' ? "selected=\"selected\"":""; ?>>ViaIP</option>
              <option value="symbio" <?php echo $info['sip_upstream1'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="other" <?php echo $info['sip_upstream1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_upstream2" id="sip_upstream2" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="viaip" <?php echo $info['sip_upstream2'] == 'viaip' ? "selected=\"selected\"":""; ?>>ViaIP</option>
              <option value="symbio" <?php echo $info['sip_upstream2'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="other" <?php echo $info['sip_upstream2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_upstream3" id="sip_upstream3" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="viaip" <?php echo $info['sip_upstream3'] == 'viaip' ? "selected=\"selected\"":""; ?>>ViaIP</option>
              <option value="symbio" <?php echo $info['sip_upstream3'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="other" <?php echo $info['sip_upstream3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
          </tr>
          <tr><td colspan="4"><hr/></td></tr>
          <tr>
            <th scope="col" width="25%">SIP Interface Detail</th>
            <th scope="col" width="25%"></th>
            <th scope="col" width="25%"></th>
            <th scope="col" width="25%"></th>
          </tr>
          <tr>
            <td><b>SIP Connection</b></td>
            <td><select name="sip_connect1" id="sip_connect1" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="ip_pb_onpremise" <?php echo $info['sip_connect1'] == 'ip_pb_onpremise' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - On Premise</option>
              <option value="ip_pb_host" <?php echo $info['sip_connect1'] == 'ip_pb_host' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - Hosted</option>
              <option value="sip_handset" <?php echo $info['sip_connect1'] == 'sip_handset' ? "selected=\"selected\"":""; ?>>Hardware - SIP Handset</option>
              <option value="conf_handset" <?php echo $info['sip_connect1'] == 'conf_handset' ? "selected=\"selected\"":""; ?>>Hardware - Conference Handset</option>
              <option value="ata" <?php echo $info['sip_connect1'] == 'ata' ? "selected=\"selected\"":""; ?>>Hardware - ATA</option>
              <option value="cli_mobile" <?php echo $info['sip_connect1'] == 'cli_mobile' ? "selected=\"selected\"":""; ?>>Soft Client - Mobile</option>
              <option value="cli_tablet" <?php echo $info['sip_connect1'] == 'cli_tablet' ? "selected=\"selected\"":""; ?>>Soft Client - Tablet</option>
              <option value="cli_pc" <?php echo $info['sip_connect1'] == 'cli_pc' ? "selected=\"selected\"":""; ?>>Soft Client - PC</option>
              <option value="cli_note" <?php echo $info['sip_connect1'] == 'cli_note' ? "selected=\"selected\"":""; ?>>Soft Client - Notebook</option>
              <option value="other" <?php echo $info['sip_connect1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_connect2" id="sip_connect2" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="ip_pb_onpremise" <?php echo $info['sip_connect2'] == 'ip_pb_onpremise' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - On Premise</option>
              <option value="ip_pb_host" <?php echo $info['sip_connect2'] == 'ip_pb_host' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - Hosted</option>
              <option value="sip_handset" <?php echo $info['sip_connect2'] == 'sip_handset' ? "selected=\"selected\"":""; ?>>Hardware - SIP Handset</option>
              <option value="conf_handset" <?php echo $info['sip_connect2'] == 'conf_handset' ? "selected=\"selected\"":""; ?>>Hardware - Conference Handset</option>
              <option value="ata" <?php echo $info['sip_connect2'] == 'ata' ? "selected=\"selected\"":""; ?>>Hardware - ATA</option>
              <option value="cli_mobile" <?php echo $info['sip_connect2'] == 'cli_mobile' ? "selected=\"selected\"":""; ?>>Soft Client - Mobile</option>
              <option value="cli_tablet" <?php echo $info['sip_connect2'] == 'cli_tablet' ? "selected=\"selected\"":""; ?>>Soft Client - Tablet</option>
              <option value="cli_pc" <?php echo $info['sip_connect2'] == 'cli_pc' ? "selected=\"selected\"":""; ?>>Soft Client - PC</option>
              <option value="cli_note" <?php echo $info['sip_connect2'] == 'cli_note' ? "selected=\"selected\"":""; ?>>Soft Client - Notebook</option>
              <option value="other" <?php echo $info['sip_connect2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="sip_connect3" id="sip_connect3" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="ip_pb_onpremise" <?php echo $info['sip_connect3'] == 'ip_pb_onpremise' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - On Premise</option>
              <option value="ip_pb_host" <?php echo $info['sip_connect3'] == 'ip_pb_host' ? "selected=\"selected\"":""; ?>>Hardware - IP/PBX - Hosted</option>
              <option value="sip_handset" <?php echo $info['sip_connect3'] == 'sip_handset' ? "selected=\"selected\"":""; ?>>Hardware - SIP Handset</option>
              <option value="conf_handset" <?php echo $info['sip_connect3'] == 'conf_handset' ? "selected=\"selected\"":""; ?>>Hardware - Conference Handset</option>
              <option value="ata" <?php echo $info['sip_connect3'] == 'ata' ? "selected=\"selected\"":""; ?>>Hardware - ATA</option>
              <option value="cli_mobile" <?php echo $info['sip_connect3'] == 'cli_mobile' ? "selected=\"selected\"":""; ?>>Soft Client - Mobile</option>
              <option value="cli_tablet" <?php echo $info['sip_connect3'] == 'cli_tablet' ? "selected=\"selected\"":""; ?>>Soft Client - Tablet</option>
              <option value="cli_pc" <?php echo $info['sip_connect3'] == 'cli_pc' ? "selected=\"selected\"":""; ?>>Soft Client - PC</option>
              <option value="cli_note" <?php echo $info['sip_connect3'] == 'cli_note' ? "selected=\"selected\"":""; ?>>Soft Client - Notebook</option>
              <option value="other" <?php echo $info['sip_connect3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Other</b></td>
            <td><input name="sip_conn_other1" id="sip_conn_other1" type="text" style='width:90%;' value="<?php echo $info['sip_conn_other1']; ?>"></td>
            <td><input name="sip_conn_other2" id="sip_conn_other2" type="text" style='width:90%;' value="<?php echo $info['sip_conn_other2']; ?>"></td>
            <td><input name="sip_conn_other3" id="sip_conn_other3" type="text" style='width:90%;' value="<?php echo $info['sip_conn_other3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Brand</b></td>
            <td><input name="ip_pbx_brand1" id="ip_pbx_brand1" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_brand1']; ?>"></td>
            <td><input name="ip_pbx_brand2" id="ip_pbx_brand2" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_brand2']; ?>"></td>
            <td><input name="ip_pbx_brand3" id="ip_pbx_brand3" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_brand3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Model</b></td>
            <td><input name="ip_pbx_model1" id="ip_pbx_model1" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_model1']; ?>"></td>
            <td><input name="ip_pbx_model2" id="ip_pbx_model2" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_model2']; ?>"></td>
            <td><input name="ip_pbx_model3" id="ip_pbx_model3" type="text" style='width:90%;' value="<?php echo $info['ip_pbx_model3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Serial Number</b></td>
            <td><input name="serial_number1" id="serial_number1" type="text" style='width:90%;' value="<?php echo $info['serial_number1']; ?>"></td>
            <td><input name="serial_number2" id="serial_number2" type="text" style='width:90%;' value="<?php echo $info['serial_number2']; ?>"></td>
            <td><input name="serial_number3" id="serial_number3" type="text" style='width:90%;' value="<?php echo $info['serial_number3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Unique ID</b></td>
            <td><input name="unique_id1" id="unique_id1" type="text" style='width:90%;' value="<?php echo $info['unique_id1']; ?>"></td>
            <td><input name="unique_id2" id="unique_id2" type="text" style='width:90%;' value="<?php echo $info['unique_id2']; ?>"></td>
            <td><input name="unique_id3" id="unique_id3" type="text" style='width:90%;' value="<?php echo $info['unique_id3']; ?>"></td>
          </tr>
          <tr><td colspan="4"><hr/></td></tr>
          <tr>
            <td id="exp_licenses" colspan="4">
                <table cellspacing="10px" width="100%" border="0" id="myTable">
                    <tr>
                       <th scope="col" width="25%">Expansion License</th>
                       <th scope="col" width="25%"></th>
                       <th scope="col" width="25%"></th>
                       <th scope="col" width="25%"></th>
                    </tr>
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="4">
                <button type="button" onclick="addLicense()">Add License</button>
            </td>
          </tr>
          <tr><td colspan="4"><hr/></td></tr>
          <tr>
            <td id="attch_hwd" colspan="4">
                <table cellspacing="10px" width="100%" border="0" id="myTable2">
                    <tr>
                       <th scope="col" width="25%">Attached Hardware</th>
                       <th scope="col" width="25%"></th>
                       <th scope="col" width="25%"></th>
                       <th scope="col" width="25%"></th>
                    </tr>
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="4">
                <button type="button" onclick="addHardware()">Add Hardware</button>
            </td>
          </tr>
        </table>

        <table cellspacing="10px" width="100%" border="0" id="tb_fax" style="display:none;" class="custtable">
          <tr>
            <th scope="col" width="20%" align="left" ><span style="color:black;">Fax In</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Number</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Status</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Type</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Provider</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service ID</span></th>
          </tr>
          <tr>
            <td><b>Fax Inbound:</b></td>
            <td><input name="fax_in_svc_no" id="fax_in_svc_no" type="text" style='width:90%;' value="<?php echo $info['fax_in_svc_no']; ?>"></td>
            <td align='left'><select name="fax_in_svc_status" id="fax_in_svc_status" width='100%' style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_in_svc_status'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option class="orangeText" value="pending" <?php echo $info['fax_in_svc_status'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['fax_in_svc_status'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['fax_in_svc_status'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td align='left'><select name="fax_in_svc_type" id="fax_in_svc_type" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_in_svc_type'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option value="thrteen_hund_eight" <?php echo $info['fax_in_svc_type'] == 'thrteen_hund_eight' ? "selected=\"selected\"":""; ?>>13/1300/1800</option>
            </select></td>
            <td align='left'><select name="fax_in_svc_provider" id="fax_in_svc_provider" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="aapt" <?php echo $info['fax_in_svc_provider'] == 'aapt' ? "selected=\"selected\"":""; ?>>AAPT</option>
              <option value="integra" <?php echo $info['fax_in_svc_provider'] == 'integra' ? "selected=\"selected\"":""; ?>>Integra</option>
              <option value="isph" <?php echo $info['fax_in_svc_provider'] == 'isph' ? "selected=\"selected\"":""; ?>>Isphone</option>
              <option value="mnf" <?php echo $info['fax_in_svc_provider'] == 'mnf' ? "selected=\"selected\"":""; ?>>MNF</option>
              <option value="optus" <?php echo $info['fax_in_svc_provider'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
              <option value="symbio" <?php echo $info['fax_in_svc_provider'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="telstra" <?php echo $info['fax_in_svc_provider'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
              <option value="viaip" <?php echo $info['fax_in_svc_provider'] == 'viaip' ? "selected=\"selected\"":""; ?>>Viaip</option>
              <option value="westnet" <?php echo $info['fax_in_svc_provider'] == 'westnet' ? "selected=\"selected\"":""; ?>>Westnet</option>
              <option value="other" <?php echo $info['fax_in_svc_provider'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><input name="fax_in_svc_id" id="fax_in_svc_id" type="text" style='width:90%;' value="<?php echo $info['fax_in_svc_id']; ?>"></td>
          </tr>
          <tr>
            <td><b>End Point Number1:</b></td>
            <td><input name="fax_in_epn1_svc_no" id="fax_in_epn1_svc_no" type="text" style='width:90%;' value="<?php echo $info['fax_in_epn1_svc_no']; ?>"></td>
            <td align='left'><select name="fax_in_epn1_svc_status" id="fax_in_epn1_svc_status" width='100%' style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_in_epn1_svc_status'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option class="orangeText" value="pending" <?php echo $info['fax_in_epn1_svc_status'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['fax_in_epn1_svc_status'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['fax_in_epn1_svc_status'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td align='left'><select name="fax_in_epn1_svc_type" id="fax_in_epn1_svc_type" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thrteen_hund_eight" <?php echo $info['fax_in_epn1_svc_type'] == 'thrteen_hund_eight' ? "selected=\"selected\"":""; ?>>13/1300/1800</option>
              <option value="pstn" <?php echo $info['fax_in_epn1_svc_type'] == 'pstn' ? "selected=\"selected\"":""; ?>>PSTN</option>
              <option value="fax_two_email" <?php echo $info['fax_in_epn1_svc_type'] == 'fax_two_email' ? "selected=\"selected\"":""; ?>>Fax 2 Email</option>
              <option value="sip" <?php echo $info['fax_in_epn1_svc_type'] == 'sip' ? "selected=\"selected\"":""; ?>>SIP</option>
            </select></td>
            <td align='left'><select name="fax_in_epn1_svc_provider" id="fax_in_epn1_svc_provider" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="aapt" <?php echo $info['fax_in_epn1_svc_provider'] == 'aapt' ? "selected=\"selected\"":""; ?>>Aapt</option>
              <option value="integra" <?php echo $info['fax_in_epn1_svc_provider'] == 'integra' ? "selected=\"selected\"":""; ?>>Integra</option>
              <option value="isph" <?php echo $info['fax_in_epn1_svc_provider'] == 'isph' ? "selected=\"selected\"":""; ?>>Isphone</option>
              <option value="mnf" <?php echo $info['fax_in_epn1_svc_provider'] == 'mnf' ? "selected=\"selected\"":""; ?>>MNF</option>
              <option value="optus" <?php echo $info['fax_in_epn1_svc_provider'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
              <option value="symbio" <?php echo $info['fax_in_epn1_svc_provider'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="telstra" <?php echo $info['fax_in_epn1_svc_provider'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
              <option value="viaip" <?php echo $info['fax_in_epn1_svc_provider'] == 'viaip' ? "selected=\"selected\"":""; ?>>Viaip</option>
              <option value="westnet" <?php echo $info['fax_in_epn1_svc_provider'] == 'westnet' ? "selected=\"selected\"":""; ?>>Westnet</option>
              <option value="other" <?php echo $info['fax_in_epn1_svc_provider'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><input name="fax_in_epn1_svc_id" id="fax_in_epn1_svc_id" type="text" style='width:90%;' value="<?php echo $info['fax_in_epn1_svc_id']; ?>"></td>
          </tr>
          <tr>
            <td><b>End Point Number2:</b></td>
            <td><input name="fax_in_epn2_svc_no" id="fax_in_epn2_svc_no" type="text" style='width:90%;' value="<?php echo $info['fax_in_epn2_svc_no']; ?>"></td>
            <td align='left'><select name="fax_in_epn2_svc_status" id="fax_in_epn2_svc_status" width='100%' style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_in_epn2_svc_status'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option class="orangeText" value="pending" <?php echo $info['fax_in_epn2_svc_status'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['fax_in_epn2_svc_status'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['fax_in_epn2_svc_status'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td align='left'><select name="fax_in_epn2_svc_type" id="fax_in_epn2_svc_type" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thrteen_hund_eight" <?php echo $info['fax_in_epn2_svc_type'] == 'thrteen_hund_eight' ? "selected=\"selected\"":""; ?>>13/1300/1800</option>
              <option value="pstn" <?php echo $info['fax_in_epn2_svc_type'] == 'pstn' ? "selected=\"selected\"":""; ?>>PSTN</option>
              <option value="fax_two_email" <?php echo $info['fax_in_epn2_svc_type'] == 'fax_two_email' ? "selected=\"selected\"":""; ?>>Fax 2 Email</option>
              <option value="sip" <?php echo $info['fax_in_epn2_svc_type'] == 'sip' ? "selected=\"selected\"":""; ?>>SIP</option>
            </select></td>
            <td align='left'><select name="fax_in_epn2_svc_provider" id="fax_in_epn2_svc_provider" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="aapt" <?php echo $info['fax_in_epn2_svc_provider'] == 'aapt' ? "selected=\"selected\"":""; ?>>Aapt</option>
              <option value="integra" <?php echo $info['fax_in_epn2_svc_provider'] == 'integra' ? "selected=\"selected\"":""; ?>>Integra</option>
              <option value="isph" <?php echo $info['fax_in_epn2_svc_provider'] == 'isph' ? "selected=\"selected\"":""; ?>>Isphone</option>
              <option value="mnf" <?php echo $info['fax_in_epn2_svc_provider'] == 'mnf' ? "selected=\"selected\"":""; ?>>MNF</option>
              <option value="optus" <?php echo $info['fax_in_epn2_svc_provider'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
              <option value="symbio" <?php echo $info['fax_in_epn2_svc_provider'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="telstra" <?php echo $info['fax_in_epn2_svc_provider'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
              <option value="viaip" <?php echo $info['fax_in_epn2_svc_provider'] == 'viaip' ? "selected=\"selected\"":""; ?>>Viaip</option>
              <option value="westnet" <?php echo $info['fax_in_epn2_svc_provider'] == 'westnet' ? "selected=\"selected\"":""; ?>>Westnet</option>
              <option value="other" <?php echo $info['fax_in_epn2_svc_provider'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><input name="fax_in_epn2_svc_id" id="fax_in_epn2_svc_id" type="text" style='width:90%;' value="<?php echo $info['fax_in_epn2_svc_id']; ?>"></td>
          </tr>
          <tr>
            <td><b>Email Address1:</b></td>
            <td colspan="2"><input name="fax_in_email1" id="fax_in_email1" type="text" style='width:100%;' value="<?php echo $info['fax_in_email1']; ?>"></td>
          </tr>
          <tr>
            <td><b>Email Address2:</b></td>
            <td colspan="2"><input name="fax_in_email2" id="fax_in_email2" type="text" style='width:100%;' value="<?php echo $info['fax_in_email2']; ?>"></td>
          </tr>
          <tr>
            <td><b>Email Address3:</b></td>
            <td colspan="2"><input name="fax_in_email3" id="fax_in_email3" type="text" style='width:100%;' value="<?php echo $info['fax_in_email3']; ?>"></td>
          </tr>

          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <th scope="col" width="20%" align="left" ><span style="color:black;">Fax Out</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Number</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Status</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Type</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service Provider</span></th>
            <th scope="col" width="16%"><span style="color:black;">Service ID</span></th>
          </tr>
          <tr>
            <td><b>Fax Number:</b></td>
            <td><input name="fax_out_svc_no" id="fax_out_svc_no" type="text" style='width:90%;' value="<?php echo $info['fax_out_svc_no']; ?>"></td>
            <td align='left'><select name="fax_out_svc_status" id="fax_out_svc_status" width='100%' style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_out_svc_status'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option class="orangeText" value="pending" <?php echo $info['fax_out_svc_status'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['fax_out_svc_status'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['fax_out_svc_status'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td align='left'><select name="fax_out_svc_type" id="fax_out_svc_type" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thrteen_hund_eight" <?php echo $info['fax_out_svc_type'] == 'thrteen_hund_eight' ? "selected=\"selected\"":""; ?>>13/1300/1800</option>
              <option value="pstn" <?php echo $info['fax_out_svc_type'] == 'pstn' ? "selected=\"selected\"":""; ?>>PSTN</option>
              <option value="fax_two_email" <?php echo $info['fax_out_svc_type'] == 'fax_two_email' ? "selected=\"selected\"":""; ?>>Fax 2 Email</option>
              <option value="sip" <?php echo $info['fax_out_svc_type'] == 'sip' ? "selected=\"selected\"":""; ?>>SIP</option>
            </select></td>
            <td align='left'><select name="fax_out_svc_provider" id="fax_out_svc_provider" width='100%' style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="aapt" <?php echo $info['fax_out_svc_provider'] == 'aapt' ? "selected=\"selected\"":""; ?>>AAPT</option>
              <option value="integra" <?php echo $info['fax_out_svc_provider'] == 'integra' ? "selected=\"selected\"":""; ?>>Integra</option>
              <option value="isph" <?php echo $info['fax_out_svc_provider'] == 'isph' ? "selected=\"selected\"":""; ?>>Isphone</option>
              <option value="mnf" <?php echo $info['fax_out_svc_provider'] == 'mnf' ? "selected=\"selected\"":""; ?>>MNF</option>
              <option value="optus" <?php echo $info['fax_out_svc_provider'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
              <option value="symbio" <?php echo $info['fax_out_svc_provider'] == 'symbio' ? "selected=\"selected\"":""; ?>>Symbio</option>
              <option value="telstra" <?php echo $info['fax_out_svc_provider'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
              <option value="viaip" <?php echo $info['fax_out_svc_provider'] == 'viaip' ? "selected=\"selected\"":""; ?>>Viaip</option>
              <option value="westnet" <?php echo $info['fax_out_svc_provider'] == 'westnet' ? "selected=\"selected\"":""; ?>>Westnet</option>
              <option value="other" <?php echo $info['fax_out_svc_provider'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><input name="fax_out_svc_id" id="fax_out_svc_id" type="text" style='width:90%;' value="<?php echo $info['fax_out_svc_id']; ?>"></td>
          </tr>
          <tr>
            <td><b>Connected to Hardware:</b></td>
            <td align='left' colspan="3"><select name="fax_out_con_hd" id="fax_out_con_hd" style='width:20%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="na" <?php echo $info['fax_out_con_hd'] == 'na' ? "selected=\"selected\"":""; ?>>N/A</option>
              <option value="yes" <?php echo $info['fax_out_con_hd'] == 'yes' ? "selected=\"selected\"":""; ?>>Yes</option>
              <option value="no" <?php echo $info['fax_out_con_hd'] == 'no' ? "selected=\"selected\"":""; ?>>No</option>
            </select></td>
            <td colspan="2"><input name="fax_out_svc_prd_other" id="fax_out_svc_prd_other" type="text" style='width:48%;' value="<?php echo $info['fax_out_svc_prd_other']; ?>"></td>
          </tr>
          <tr>
            <td><b>Brand:</b></td>
            <td colspan="2"><input name="fax_out_brand" id="fax_out_brand" type="text" style='width:100%;' value="<?php echo $info['fax_out_brand']; ?>"></td>
          </tr>
          <tr>
            <td><b>Model:</b></td>
            <td colspan="2"><input name="fax_out_model" id="fax_out_model" type="text" style='width:100%;' value="<?php echo $info['fax_out_model']; ?>"></td>
          </tr>
          <tr>
            <td><b>Device:</b></td>
            <td align='left' colspan="2"><select name="fax_out_device" id="fax_out_device" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="fax_machine" <?php echo $info['fax_out_device'] == 'fax_machine' ? "selected=\"selected\"":""; ?>>Fax Machine</option>
              <option value="small_mfc" <?php echo $info['fax_out_device'] == 'small_mfc' ? "selected=\"selected\"":""; ?>>Small MFC</option>
              <option value="photo_copy_mfd" <?php echo $info['fax_out_device'] == 'photo_copy_mfd' ? "selected=\"selected\"":""; ?>>Photo Copier MFD</option>
              <option value="other" <?php echo $info['fax_out_device'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td colspan="2"><input name="fax_out_device_other" id="fax_out_device_other" type="text" style='width:100%;' value="<?php echo $info['fax_out_device_other']; ?>"></td>
          </tr>
          <tr>
            <td><b>Interface:</b></td>
            <td align='left' colspan="2"><select name="fax_out_if" id="fax_out_if" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="parallel" <?php echo $info['fax_out_if'] == 'parallel' ? "selected=\"selected\"":""; ?>>Parallel</option>
              <option value="serial" <?php echo $info['fax_out_if'] == 'serial' ? "selected=\"selected\"":""; ?>>Serial</option>
              <option value="usb" <?php echo $info['fax_out_if'] == 'usb' ? "selected=\"selected\"":""; ?>>USB</option>
              <option value="ethernet" <?php echo $info['fax_out_if'] == 'ethernet' ? "selected=\"selected\"":""; ?>>Ethernet</option>
              <option value="other" <?php echo $info['fax_out_if'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td colspan="2"><input name="fax_out_if_other" id="fax_out_if_other" type="text" style='width:100%;' value="<?php echo $info['fax_out_if_other']; ?>"></td>
          </tr>
          <tr>
            <td><b>Static IP Address:</b></td>
            <td colspan="2"><input name="fax_out_static_ip" id="fax_out_static_ip" type="text" style='width:100%;' value="<?php echo $info['fax_out_static_ip']; ?>"></td>
          </tr>
        </table>

        <!-- table inbound start -->
        <table cellspacing="10px" width="100%" border="0" id="tb_inbound" style="display:none;" class="custtable">
          <tr>
            <th scope="col" width="25%">&nbsp;</th>
            <th scope="col" width="25%">Service 1</th>
            <th scope="col" width="25%">Service 2</th>
            <th scope="col" width="25%">Service 3</th>
          </tr>
          <tr>
            <td><b>Service Status : </b></td>
            <td><select name="inb_svc_stat1" id="inb_svc_stat1" style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option class="orangeText" value="pending" <?php echo $info['inb_svc_stat1'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['inb_svc_stat1'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['inb_svc_stat1'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td><select name="inb_svc_stat2" id="inb_svc_stat2" style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option class="orangeText" value="pending" <?php echo $info['inb_svc_stat2'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['inb_svc_stat2'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['inb_svc_stat2'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
            <td><select name="inb_svc_stat3" id="inb_svc_stat3" style='width:100%;'
            onchange="this.className=this.options[this.selectedIndex].className">
              <option value="">&lt;Select&gt;</option>
              <option class="orangeText" value="pending" <?php echo $info['inb_svc_stat3'] == 'pending' ? "selected=\"selected\"":""; ?>>Pending</option>
              <option class="greenText" value="active" <?php echo $info['inb_svc_stat3'] == 'active' ? "selected=\"selected\"":""; ?>>Active</option>
              <option class="redText" value="cancelled" <?php echo $info['inb_svc_stat3'] == 'cancelled' ? "selected=\"selected\"":""; ?>>Cancelled</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Inbound Number : </b></td>
            <td><input name="inb_number1" id="inb_number1" type="text" style='width:90%;' value="<?php echo $info['inb_number1']; ?>"></td>
            <td><input name="inb_number2" id="inb_number2" type="text" style='width:90%;' value="<?php echo $info['inb_number2']; ?>"></td>
            <td><input name="inb_number3" id="inb_number3" type="text" style='width:90%;' value="<?php echo $info['inb_number3']; ?>"></td>
          </tr>
          <tr>
            <td><b>End Point Number(EP) : </b></td>
            <td><input name="inb_epn1" id="inb_epn1" type="text" style='width:90%;' value="<?php echo $info['inb_epn1']; ?>"></td>
            <td><input name="inb_epn2" id="inb_epn2" type="text" style='width:90%;' value="<?php echo $info['inb_epn2']; ?>"></td>
            <td><input name="inb_epn3" id="inb_epn3" type="text" style='width:90%;' value="<?php echo $info['inb_epn3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Follow Me Number : </b></td>
            <td><input name="inb_fmn1" id="inb_fmn1" type="text" style='width:90%;' value="<?php echo $info['inb_fmn1']; ?>"></td>
            <td><input name="inb_fmn2" id="inb_fmn2" type="text" style='width:90%;' value="<?php echo $info['inb_fmn2']; ?>"></td>
            <td><input name="inb_fmn3" id="inb_fmn3" type="text" style='width:90%;' value="<?php echo $info['inb_fmn3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Service Type : </b></td>
            <td><select name="inb_svc_type1" id="inb_svc_type1" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thir_tel" <?php echo $info['inb_svc_type1'] == 'thir_tel' ? "selected=\"selected\"":""; ?>>13-Inbound-Tel</option>
              <option value="thir_fax" <?php echo $info['inb_svc_type1'] == 'thir_fax' ? "selected=\"selected\"":""; ?>>13-Inbound-Fax</option>
              <option value="thir_hu_tel" <?php echo $info['inb_svc_type1'] == 'thir_hu_tel' ? "selected=\"selected\"":""; ?>>1300-Inbound-Tel</option>
              <option value="thir_hu_fax" <?php echo $info['inb_svc_type1'] == 'thir_hu_fax' ? "selected=\"selected\"":""; ?>>1300-Inbound-Fax</option>
              <option value="eight_hu_tel" <?php echo $info['inb_svc_type1'] == 'eight_hu_tel' ? "selected=\"selected\"":""; ?>>1800-Inbound-Tel</option>
              <option value="eight_hu_fax" <?php echo $info['inb_svc_type1'] == 'eight_hu_fax' ? "selected=\"selected\"":""; ?>>1800-Inbound-Fax</option>
            </select></td>
            <td><select name="inb_svc_type2" id="inb_svc_type2" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thir_tel" <?php echo $info['inb_svc_type2'] == 'thir_tel' ? "selected=\"selected\"":""; ?>>13-Inbound-Tel</option>
              <option value="thir_fax" <?php echo $info['inb_svc_type2'] == 'thir_fax' ? "selected=\"selected\"":""; ?>>13-Inbound-Fax</option>
              <option value="thir_hu_tel" <?php echo $info['inb_svc_type2'] == 'thir_hu_tel' ? "selected=\"selected\"":""; ?>>1300-Inbound-Tel</option>
              <option value="thir_hu_fax" <?php echo $info['inb_svc_type2'] == 'thir_hu_fax' ? "selected=\"selected\"":""; ?>>1300-Inbound-Fax</option>
              <option value="eight_hu_tel" <?php echo $info['inb_svc_type2'] == 'eight_hu_tel' ? "selected=\"selected\"":""; ?>>1800-Inbound-Tel</option>
              <option value="eight_hu_fax" <?php echo $info['inb_svc_type2'] == 'eight_hu_fax' ? "selected=\"selected\"":""; ?>>1800-Inbound-Fax</option>
            </select></td>
            <td><select name="inb_svc_type3" id="inb_svc_type3" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="thir_tel" <?php echo $info['inb_svc_type3'] == 'thir_tel' ? "selected=\"selected\"":""; ?>>13-Inbound-Tel</option>
              <option value="thir_fax" <?php echo $info['inb_svc_type3'] == 'thir_fax' ? "selected=\"selected\"":""; ?>>13-Inbound-Fax</option>
              <option value="thir_hu_tel" <?php echo $info['inb_svc_type3'] == 'thir_hu_tel' ? "selected=\"selected\"":""; ?>>1300-Inbound-Tel</option>
              <option value="thir_hu_fax" <?php echo $info['inb_svc_type3'] == 'thir_hu_fax' ? "selected=\"selected\"":""; ?>>1300-Inbound-Fax</option>
              <option value="eight_hu_tel" <?php echo $info['inb_svc_type3'] == 'eight_hu_tel' ? "selected=\"selected\"":""; ?>>1800-Inbound-Tel</option>
              <option value="eight_hu_fax" <?php echo $info['inb_svc_type3'] == 'eight_hu_fax' ? "selected=\"selected\"":""; ?>>1800-Inbound-Fax</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Upstream Provider : </b></td>
            <td><input name="inb_up_provider1" id="inb_up_provider1" type="text" style='width:90%;' value="<?php echo $info['inb_up_provider1']; ?>"></td>
            <td><input name="inb_up_provider2" id="inb_up_provider2" type="text" style='width:90%;' value="<?php echo $info['inb_up_provider2']; ?>"></td>
            <td><input name="inb_up_provider3" id="inb_up_provider3" type="text" style='width:90%;' value="<?php echo $info['inb_up_provider3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Upstream Reference ID : </b></td>
            <td><input name="inb_up_refid1" id="inb_up_refid1" type="text" style='width:90%;' value="<?php echo $info['inb_up_refid1']; ?>"></td>
            <td><input name="inb_up_refid2" id="inb_up_refid2" type="text" style='width:90%;' value="<?php echo $info['inb_up_refid2']; ?>"></td>
            <td><input name="inb_up_refid3" id="inb_up_refid3" type="text" style='width:90%;' value="<?php echo $info['inb_up_refid3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Complex Routing : </b></td>
            <td><select name="inb_com_routing1" id="inb_com_routing1" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="no" <?php echo $info['inb_com_routing1'] == 'no' ? "selected=\"selected\"":""; ?>>No</option>
              <option value="yes" <?php echo $info['inb_com_routing1'] == 'yes' ? "selected=\"selected\"":""; ?>>Yes</option>
            </select></td>
            <td><select name="inb_com_routing2" id="inb_com_routing2" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="no" <?php echo $info['inb_com_routing2'] == 'no' ? "selected=\"selected\"":""; ?>>No</option>
              <option value="yes" <?php echo $info['inb_com_routing2'] == 'yes' ? "selected=\"selected\"":""; ?>>Yes</option>
            </select></td>
            <td><select name="inb_com_routing3" id="inb_com_routing3" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="no" <?php echo $info['inb_com_routing3'] == 'no' ? "selected=\"selected\"":""; ?>>No</option>
              <option value="yes" <?php echo $info['inb_com_routing3'] == 'yes' ? "selected=\"selected\"":""; ?>>Yes</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Complex Routing : </b></td>
            <td><select name="inb_com_r_other1" id="inb_com_r_other1" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="postcode" <?php echo $info['inb_com_r_other1'] == 'postcode' ? "selected=\"selected\"":""; ?>>By Postcode</option>
              <option value="state" <?php echo $info['inb_com_r_other1'] == 'state' ? "selected=\"selected\"":""; ?>>By State</option>
              <option value="spec_area" <?php echo $info['inb_com_r_other1'] == 'spec_area' ? "selected=\"selected\"":""; ?>>By Specified Area</option>
              <option value="spec_number" <?php echo $info['inb_com_r_other1'] == 'spec_number' ? "selected=\"selected\"":""; ?>>By Specific Numbers</option>
              <option value="other" <?php echo $info['inb_com_r_other1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="inb_com_r_other2" id="inb_com_r_other2" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="postcode" <?php echo $info['inb_com_r_other2'] == 'postcode' ? "selected=\"selected\"":""; ?>>By Postcode</option>
              <option value="state" <?php echo $info['inb_com_r_other2'] == 'state' ? "selected=\"selected\"":""; ?>>By State</option>
              <option value="spec_area" <?php echo $info['inb_com_r_other2'] == 'spec_area' ? "selected=\"selected\"":""; ?>>By Specified Area</option>
              <option value="spec_number" <?php echo $info['inb_com_r_other2'] == 'spec_number' ? "selected=\"selected\"":""; ?>>By Specific Numbers</option>
              <option value="other" <?php echo $info['inb_com_r_other2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
            <td><select name="inb_com_r_other3" id="inb_com_r_other3" style='width:100%;'>
              <option value="">&lt;Select&gt;</option>
              <option value="postcode" <?php echo $info['inb_com_r_other3'] == 'postcode' ? "selected=\"selected\"":""; ?>>By Postcode</option>
              <option value="state" <?php echo $info['inb_com_r_other3'] == 'state' ? "selected=\"selected\"":""; ?>>By State</option>
              <option value="spec_area" <?php echo $info['inb_com_r_other3'] == 'spec_area' ? "selected=\"selected\"":""; ?>>By Specified Area</option>
              <option value="spec_number" <?php echo $info['inb_com_r_other3'] == 'spec_number' ? "selected=\"selected\"":""; ?>>By Specific Numbers</option>
              <option value="other" <?php echo $info['inb_com_r_other3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
            </select></td>
          </tr>
          <tr>
            <td><b>Routing Other : </b></td>
            <td><input name="inb_routing_other1" id="inb_routing_other1" type="text" style='width:90%;' value="<?php echo $info['inb_routing_other1']; ?>"></td>
            <td><input name="inb_routing_other2" id="inb_routing_other2" type="text" style='width:90%;' value="<?php echo $info['inb_routing_other2']; ?>"></td>
            <td><input name="inb_routing_other3" id="inb_routing_other3" type="text" style='width:90%;' value="<?php echo $info['inb_routing_other3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Date Service Activated : </b></td>
            <td><input name="inb_d_svc_act1" id="inb_d_svc_act1" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_act1']; ?>"></td>
            <td><input name="inb_d_svc_act2" id="inb_d_svc_act2" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_act2']; ?>"></td>
            <td><input name="inb_d_svc_act3" id="inb_d_svc_act3" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_act3']; ?>"></td>
          </tr>
          <tr>
            <td><b>Date Service Cancelled : </b></td>
            <td><input name="inb_d_svc_cancel1" id="inb_d_svc_cancel1" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_cancel1']; ?>"></td>
            <td><input name="inb_d_svc_cancel2" id="inb_d_svc_cancel2" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_cancel2']; ?>"></td>
            <td><input name="inb_d_svc_cancel3" id="inb_d_svc_cancel3" type="text" style='width:90%;' value="<?php echo $info['inb_d_svc_cancel3']; ?>"></td>
          </tr>
        </table>
        <!-- table inbound end -->
        <!-- table wifi PC -->
        <table cellspacing="10px" width="100%" border="0" id="tb_pc" style="display:none;" class="custtable">
          <tr>
            <td colspan="4">
                <table cellspacing="10px" width="100%" border="0" id="myTable5">
                    <colgroup>
                    <col width="16%">
                    <col width="84%">
                    </colgroup>
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="2">
                <button type="button" onclick="addHardwarePC()">Add Hardware</button>
            </td>
          </tr>
        </table>
        <!-- table wifi end -->
        <!-- table wifi start -->
        <table cellspacing="10px" width="100%" border="0" id="tb_wifi" style="display:none;" class="custtable">
          <tr>
            <td colspan="4">
                <table cellspacing="10px" width="100%" border="0" id="myTable3">
                    <colgroup>
                    <col width="16%">
                    <col width="34%">
                    <col width="16%">
                    <col width="34%">
                    </colgroup>
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="4">
                <button type="button" onclick="addHardwareWifi()">Add Hardware</button>
            </td>
          </tr>
        </table>
        <!-- table wifi end -->

        <!-- table notes start -->
        <table cellspacing="10px" width="100%" border="0" id="tb_notes" style="display:none;" class="custtable">
          <tr>
            <td colspan="4">
                <table cellspacing="10px" width="100%" border="0" id="myTable6">
                    <colgroup>
                    <col width="16%">
                    <col width="84%">
                    </colgroup>
                </table>
            </td>
          </tr>
          <tr>
            <td colspan="2">
                <button type="button" onclick="addNotes()">Add Notes</button>
            </td>
          </tr>
        </table>
        <!-- table notes end -->
    </div>
    </td>
    </tr>
    <!-- wipage code -->
    <tr >
        <td colspan=2 align='center'>
            <p style="padding-left:250px;">
                <input type="submit" name="do" value="<?php echo ($info['id']) ? "Update":"Add"; ?>" />
                <input type="reset"  name="reset"  value="Reset" />
                <input type="button" name="cancel" value="Cancel" onclick='window.location.href="customers.php"'>
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
            </p>
        </td>
    </tr>
    </table>
</form>
<table>
<tr>

</tr>
</table>

<input type="hidden" id="customers_internet_status" value="customers_internet_status"/>
<script type="text/javascript">
    function interact(index, isup) {
        var value=0;
        if (isup == 1) {
            value = $('#ip_address'+index).val();
            $('#public_ip'+index).val(value);
        } else if(isup==0) {
            value = $('#public_ip'+index).val();
            $('#ip_address'+index).val(value);
        }
    }
function checkLive1(host) {
	$.ajax({
	    url: "async-ping.php",
	    dataType : "json",
	    type : "GET",
	    data : { host: host},
	    success : function(data){
	        if(data.result == "live"){
	        	$('#img_status_ip1').addClass('greenball');
	        	$('#image_status_ip1').addClass('greenball');
	        	$('#txt_status_ip1').text('Online');
	        	$('#service_status1').val('Online');
	        }else{
	        	$('#img_status_ip1').addClass('redball');
	        	$('#image_status_ip1').addClass('redball');
                $('#txt_status_ip1').text('Offline');
                $('#service_status1').val('Offline');
	        }
	        window.cust_internet_status1 = setTimeout('myTimer1()', 1000);
	    }
	});
}

function myTimer1() {

	// if service 1 is cancelled, the light be grayed.
    if( $('#service1').val() == "" ) {
    	$('#img_status_ip1').addClass('grayball');
    	$('#txt_status_ip1').text('< Select >');
        $('#image_status_ip1').addClass('grayball');
    	$('#service_status1').val('< Select >');
    	clearTimeout(window.cust_internet_status1);
    	return;
     } else if ($('#service1').val() == "cancelled") {
            $('#img_status_ip1').addClass('grayball');
            $('#txt_status_ip1').text('Cancelled');
            $('#image_status_ip1').addClass('grayball');
            $('#service_status1').val('Cancelled');
            clearTimeout(window.cust_internet_status1);
            return;
     } else if ($('#service1').val() == "pending") {
        $('#img_status_ip1').addClass('grayball');
        $('#txt_status_ip1').text('Pending');
        $('#image_status_ip1').addClass('grayball');
        $('#service_status1').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }
    
	if( $('#customers_internet_status').val() !== "customers_internet_status") {
    	clearTimeout(window.cust_internet_status1);
    	return;
    }
     checkLive1($("#ip_address1").val());
}

function checkLive2(host) {
	$.ajax({
	    url: "async-ping.php",
	    dataType : "json",
	    type : "GET",
	    data : { host: host},
	    success : function(data){
	        if(data.result == "live"){
	        	$('#img_status_ip2').addClass('greenball');
                $('#txt_status_ip2').text('Online');
                $('#image_status_ip2').addClass('greenball');
                $('#service_status2').val('Online');
	        }else{
	        	$('#img_status_ip2').addClass('redball');
                $('#txt_status_ip2').text('Offline');
                $('#image_status_ip2').addClass('redball');
                $('#service_status2').val('Offline');
	        }
	        window.cust_internet_status2 = setTimeout('myTimer2()', 1000);
	    }
	});
}

function myTimer2() {

	// if service 2 is cancelled, the light be grayed.
    if( $('#service2').val() == "") {
    	$('#img_status_ip2').addClass('grayball');
        $('#txt_status_ip2').text('< Select >');
        $('#image_status_ip2').addClass('grayball');
        $('#service_status2').val('< Select >');
    	clearTimeout(window.cust_internet_status1);
    	return;
     }else if ($('#service2').val() == "cancelled") {
        $('#img_status_ip2').addClass('grayball');
        $('#txt_status_ip2').text('Cancelled');
        $('#image_status_ip2').addClass('grayball');
        $('#service_status2').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service2').val() == "pending") {
        $('#img_status_ip2').addClass('grayball');
        $('#txt_status_ip2').text('Pending');
        $('#image_status_ip2').addClass('grayball');
        $('#service_status2').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }
    
	if( $('#customers_internet_status').val() !== "customers_internet_status") {
    	clearTimeout(window.cust_internet_status2);
    	return;
    }
      checkLive2($("#ip_address2").val());
}

function checkLive3(host) {
	$.ajax({
	    url: "async-ping.php",
	    dataType : "json",
	    type : "GET",
	    data : { host: host},
	    success : function(data){
	        if(data.result == "live"){
	        	$('#img_status_ip3').addClass('greenball');
                $('#txt_status_ip3').text('Online');
                $('#image_status_ip3').addClass('greenball');
                $('#service_status3').val('Online');
	        }else{
	        	$('#img_status_ip3').addClass('redball');
                $('#txt_status_ip3').text('Offline');
                $('#image_status_ip3').addClass('redball');
                $('#service_status3').val('Offline');
	        }
	        window.cust_internet_status3 = setTimeout('myTimer3()', 1000);
	    }
	});
}

function myTimer3() {

	// if service 3 is cancelled, the light be grayed.
    if( $('#service3').val() == "" ) {
    	$('#img_status_ip3').addClass('grayball');
        $('#txt_status_ip3').text('< Select >');
        $('#image_status_ip3').addClass('grayball');
        $('#service_status3').val('< Select >');
    	clearTimeout(window.cust_internet_status1);
    	return;
     }else if ($('#service3').val() == "cancelled") {
        $('#img_status_ip3').addClass('grayball');
        $('#txt_status_ip3').text('Cancelled');
        $('#image_status_ip3').addClass('grayball');
        $('#service_status3').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service3').val() == "pending") {
        $('#img_status_ip3').addClass('grayball');
        $('#txt_status_ip3').text('Pending');
        $('#image_status_ip3').addClass('grayball');
        $('#service_status3').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }
    
	if( $('#customers_internet_status').val() !== "customers_internet_status") {
    	clearTimeout(window.cust_internet_status3);
    	return;
    }
      checkLive3($("#ip_address3").val());
}

//Hong Coding Start
function checkLive4(host) {
    $.ajax({
        url: "async-ping.php",
        dataType : "json",
        type : "GET",
        data : { host: host},
        success : function(data){
            if(data.result == "live"){
                $('#img_status_ip4').addClass('greenball');
                $('#txt_status_ip4').text('Online');
                $('#image_status_ip4').addClass('greenball');
                $('#service_status4').val('Online');
            }else{
                $('#img_status_ip4').addClass('redball');
                $('#txt_status_ip4').text('Offline');
                $('#image_status_ip4').addClass('redball');
                $('#service_status4').val('Offline');
            }
            window.cust_internet_status4 = setTimeout('myTimer4()', 1000);
        }
    });
}

function myTimer4() {

    // if service 4 is cancelled, the light be grayed.
    if( $('#service4').val() == "" ) {
        $('#img_status_ip4').addClass('grayball');
        $('#txt_status_ip4').text('< Select >');
        $('#image_status_ip4').addClass('grayball');
        $('#service_status4').val('< Select >');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service4').val() == "cancelled") {
        $('#img_status_ip4').addClass('grayball');
        $('#txt_status_ip4').text('Cancelled');
        $('#image_status_ip4').addClass('grayball');
        $('#service_status4').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service4').val() == "pending") {
        $('#img_status_ip4').addClass('grayball');
        $('#txt_status_ip4').text('Pending');
        $('#image_status_ip4').addClass('grayball');
        $('#service_status4').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }

    if( $('#customers_internet_status').val() !== "customers_internet_status") {
        clearTimeout(window.cust_internet_status4);
        return;
    }
    checkLive4($("#ip_address4").val());
}

function checkLive5(host) {
    $.ajax({
        url: "async-ping.php",
        dataType : "json",
        type : "GET",
        data : { host: host},
        success : function(data){
            if(data.result == "live"){
                $('#img_status_ip5').addClass('greenball');
                $('#txt_status_ip5').text('Online');
                $('#image_status_ip5').addClass('greenball');
                $('#service_status5').val('Online');
            }else{
                $('#img_status_ip5').addClass('redball');
                $('#txt_status_ip5').text('Offline');
                $('#image_status_ip5').addClass('redball');
                $('#service_status5').val('Offline');
            }
            window.cust_internet_status5 = setTimeout('myTimer5()', 1000);
        }
    });
}

function myTimer5() {

    // if service 5 is cancelled, the light be grayed.
    if( $('#service5').val() == "") {
        $('#img_status_ip5').addClass('grayball');
        $('#txt_status_ip5').text('< Select >');
        $('#image_status_ip5').addClass('grayball');
        $('#service_status5').val('< Select >');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service5').val() == "cancelled") {
        $('#img_status_ip5').addClass('grayball');
        $('#txt_status_ip5').text('Cancelled');
        $('#image_status_ip5').addClass('grayball');
        $('#service_status5').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service5').val() == "pending") {
        $('#img_status_ip5').addClass('grayball');
        $('#txt_status_ip5').text('Pending');
        $('#image_status_ip5').addClass('grayball');
        $('#service_status5').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }

    if( $('#customers_internet_status').val() !== "customers_internet_status") {
        clearTimeout(window.cust_internet_status5);
        return;
    }
    checkLive5($("#ip_address5").val());
}

function checkLive6(host) {
    $.ajax({
        url: "async-ping.php",
        dataType : "json",
        type : "GET",
        data : { host: host},
        success : function(data){
            if(data.result == "live"){
                $('#img_status_ip6').addClass('greenball');
                $('#txt_status_ip6').text('Online');
                $('#image_status_ip6').addClass('greenball');
                $('#service_status6').val('Online');
            }else{
                $('#img_status_ip6').addClass('redball');
                $('#txt_status_ip6').text('Offline');
                $('#image_status_ip6').addClass('redball');
                $('#service_status6').val('Offline');
            }
            window.cust_internet_status6 = setTimeout('myTimer6()', 1000);
        }
    });
}

function myTimer6() {

    // if service 6 is cancelled, the light be grayed.
    if( $('#service6').val() == "" ) {
        $('#img_status_ip6').addClass('grayball');
        $('#txt_status_ip6').text('< Select >');
        $('#image_status_ip6').addClass('grayball');
        $('#service_status6').val('< Select >');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service6').val() == "cancelled") {
        $('#img_status_ip6').addClass('grayball');
        $('#txt_status_ip6').text('Cancelled');
        $('#image_status_ip6').addClass('grayball');
        $('#service_status6').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service6').val() == "pending") {
        $('#img_status_ip6').addClass('grayball');
        $('#txt_status_ip6').text('Pending');
        $('#image_status_ip6').addClass('grayball');
        $('#service_status6').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }

    if( $('#customers_internet_status').val() !== "customers_internet_status") {
        clearTimeout(window.cust_internet_status6);
        return;
    }
    checkLive6($("#ip_address6").val());
}

function checkLive7(host) {
    $.ajax({
        url: "async-ping.php",
        dataType : "json",
        type : "GET",
        data : { host: host},
        success : function(data){
            if(data.result == "live"){
                $('#img_status_ip7').addClass('greenball');
                $('#txt_status_ip7').text('Online');
                $('#image_status_ip7').addClass('greenball');
                $('#service_status7').val('Online');
            } else {
                $('#img_status_ip7').addClass('redball');
                $('#txt_status_ip7').text('Offline');
                $('#image_status_ip7').addClass('redball');
                $('#service_status7').val('Offline');
            }
            window.cust_internet_status7 = setTimeout('myTimer7()', 1000);
        }
    });

    $('#txt_status_ip7').text('Online');
}

function myTimer7() {

    // if service 7 is cancelled, the light be grayed.
    if( $('#service7').val() == "") {
        $('#img_status_ip7').addClass('grayball');
        $('#txt_status_ip7').text('< Select >');
        $('#image_status_ip7').addClass('grayball');
        $('#service_status7').val('< Select >');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service7').val() == "cancelled") {
        $('#img_status_ip7').addClass('grayball');
        $('#txt_status_ip7').text('Cancelled');
        $('#image_status_ip7').addClass('grayball');
        $('#service_status7').val('Cancelled');
        clearTimeout(window.cust_internet_status1);
        return;
    }else if ($('#service7').val() == "pending") {
        $('#img_status_ip7').addClass('grayball');
        $('#txt_status_ip7').text('Pending');
        $('#image_status_ip7').addClass('grayball');
        $('#service_status7').val('Pending');
        clearTimeout(window.cust_internet_status1);
        return;
    }

    if( $('#customers_internet_status').val() !== "customers_internet_status") {
        clearTimeout(window.cust_internet_status7);
        return;
    }
    checkLive7($("#ip_address7").val());
}

//Hong Coding End

myTimer1();
myTimer2();
myTimer3();

//Hong Coding Start
myTimer4();
myTimer5();
myTimer6();
myTimer7();
//End

function gotoCustomerUrl() {
	var url = document.getElementById("website").value.trim();
	if (url =="") return;

	if(url.indexOf('https://') !=-1 || url.indexOf('http://') !=-1) window.location.assign(url);
	else window.location.assign('http://'+ url);
}

function gotoUpstreamProviderpage(idx) {
	
	var id = document.getElementById("upstream_provider"+idx).value;
	if (id =="" || id =="other") return;
	
	window.location.href="/ticket/scp/suppliers.php?id=" + id;
}

//Hong Coding Start

function showDetails(idx) {

    $('#cust_auth_table').find('.service_details').css('display','none');
    $('#cust_auth_table').find('#details' + idx).css('display','table');

    // $('#custom_nav').find('li').removeClass('active').addClass('inactive');
    // $('#' + 'toggle_' + tabName).removeClass('inactive').addClass('active');
}

//Hong Coding End

function getUpstreamProvider(id, idx) {

    // if (id =="" || id =="other") return;
    //
    // $.ajax({
    //     url: "async-getUpstreamUrl.php",
    //     dataType : "json",
    //     type : "GET",
    //     data : { id: id},
    //     success : function(data){
    //         $('#upstream_prov_contnum' + idx).val(data.phone);
    //         $('#upstream_provname' + idx).val(data.upstream_provname);
    //         $('#upstream_provurl' + idx).val(data.upstream_provurl);
    //         $('#upstream_username' + idx).val(data.upstream_username);
    //         $('#upstream_pwd' + idx).val(data.upstream_pwd);
    //     }
    // });

    var value=0;
    if (idx == 1) {
        value = $('#upstream_provider'+id).val();
        $('#upstream_provider_other'+id).val(value);
    } else if(idx==0) {
        value = $('#upstream_provider_other'+id).val();
        $('#upstream_provider'+id).val(value);
    }
}
    function getServiceType(id, idx) {
        var value=0;
        if (idx == 1) {
            value = $('#service_type'+id).val();
            $('#service2_type'+id).val(value);
        } else if(idx==0) {
            value = $('#service2_type'+id).val();
            $('#service_type'+id).val(value);
        }
    }

    function getServiceUse(id, idx) {
        var value=0;
        if (idx == 1) {
            value = $('#service_use'+id).val();
            $('#service2_use'+id).val(value);
        } else if(idx==0) {
            value = $('#service2_use'+id).val();
            $('#service_use'+id).val(value);
        }
    }

function gotoCustomerWesite(idx) {
	var url = document.getElementById("upstream_provurl"+idx).value.trim();
	if (url=="") return;

	if(url.indexOf('https://') !=-1 || url.indexOf('http://') !=-1) window.location.assign(url);
	else window.location.assign('http://'+ url);
}

<?php while($siplicense_info = db_fetch_array($res2)) {?>
		displayLicense('<?php echo $siplicense_info['type1'];?>', '<?php echo $siplicense_info['type2'];?>', '<?php echo $siplicense_info['type3'];?>',
	'<?php echo $siplicense_info['number1'];?>','<?php echo $siplicense_info['number2'];?>','<?php echo $siplicense_info['number3'];?>');
<?php }?>

<?php while($siphwd_info = db_fetch_array($res3)) {?>
		displayHardware('<?php echo $siphwd_info['type1'];?>', '<?php echo $siphwd_info['type2'];?>', '<?php echo $siphwd_info['type3'];?>',
		'<?php echo $siphwd_info['model1'];?>','<?php echo $siphwd_info['model2'];?>','<?php echo $siphwd_info['model3'];?>',
		'<?php echo $siphwd_info['qty1'];?>','<?php echo $siphwd_info['qty2'];?>','<?php echo $siphwd_info['qty3'];?>');
<?php }?>

<?php while($wifihwd_info = db_fetch_array($res10)) {?>
	displayHardwareWifi('<?php echo $wifihwd_info['ssidname'];?>','<?php echo $wifihwd_info['ssidpwd'];?>','<?php echo $wifihwd_info['svcname'];?>',
		'<?php echo $wifihwd_info['peip'];?>','<?php echo $wifihwd_info['svcother'];?>','<?php echo $wifihwd_info['peipuser'];?>',
		'<?php echo $wifihwd_info['devtype'];?>','<?php echo $wifihwd_info['peippwd'];?>','<?php echo $wifihwd_info['devtypeother'];?>',
		'<?php echo $wifihwd_info['devbrand'];?>','<?php echo $wifihwd_info['authip'];?>','<?php echo $wifihwd_info['devmodel'];?>',
		'<?php echo $wifihwd_info['authuser'];?>','<?php echo $wifihwd_info['devserial'];?>','<?php echo $wifihwd_info['authpwd'];?>');
<?php }?>

<?php while($contacts_info = db_fetch_array($res11)) {?>
	displayContacts('<?php echo $contacts_info['person'];?>','<?php echo $contacts_info['position'];?>','<?php echo $contacts_info['department'];?>',
	'<?php echo $contacts_info['phone'];?>','<?php echo $contacts_info['mobile'];?>','<?php echo $contacts_info['email'];?>');
<?php }?>

<?php while($pchwd_info = db_fetch_array($res12)) {?>
	displayHardwarePC('<?php echo $pchwd_info['devtype'];?>','<?php echo $pchwd_info['other'];?>','<?php echo $pchwd_info['owner'];?>',
		'<?php echo $pchwd_info['location'];?>','<?php echo $pchwd_info['user'];?>','<?php echo $pchwd_info['pwd'];?>',
		'<?php echo $pchwd_info['ipaddr'];?>','<?php echo $pchwd_info['hosting'];?>','<?php echo $pchwd_info['port'];?>');
<?php }?>

<?php while($notes_info = db_fetch_array($res13)) {

	$newstring = preg_replace("/[\n\r]/","\\n",$notes_info['contents']); 
	?>
	displayNotes('<?php echo $newstring ?>');
<?php }?>

</script>
