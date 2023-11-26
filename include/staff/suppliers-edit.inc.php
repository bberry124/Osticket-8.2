<?php
	if (!defined('OSTSCPINC') || !$thisstaff
    || !$thisstaff->hasPerm(Ticket::PERM_CREATE, false))
    die('Access Denied');
    $info=array();
	$info=Format::htmlchars(($errors && $_POST)?$_POST:$info);
?>

<form action="suppliers.php" method="post" id="save"  enctype="multipart/form-data">
 <?php csrf_token(); ?>
 <h2>Suppliers</h2>
<table cellpadding="0" width="940" cellspacing="2" border="0">
<tr>
 <td width="65%">
 <table class="form_table" border="0" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th colspan="3">
                <em><strong><?php if(!$_REQUEST['id']) echo 'New '; ?> Supplier Information</strong></em>
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
            <td width="160" class="required">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trading name:
            </td>
            <td>
                <input type="text" size="50" name="trading" id="trading" class="typeahead" value="<?php echo $info['trading']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
                &nbsp;<span class="error">*&nbsp;<?php echo $errors['trading']; ?></span>
            </td>
        </tr>			
        <tr>
            <td width="160" class="required">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company:
            </td>
            <td>

                <input type="text" size="50" name="company" id="company" class="typeahead" value="<?php echo $info['company']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
                &nbsp;<span class="error">*&nbsp;<?php echo $errors['company']; ?></span>
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
            <td width="160" class="required">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:
            </td>
            <td>
                <input type="text" size="50" name="name" id="name" value="<?php echo $info['name']; ?>">
                &nbsp;<span class="error">*&nbsp;<?php echo $errors['name']; ?></span>
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
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
            </td>
            <td>
                <input type="text" size="20" name="phone" id="phone" value="<?php echo $info['phone']; ?>">
                &nbsp;<span class="error">&nbsp;<?php echo $errors['phone']; ?></span>
			</td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direct Number:
            </td>
            <td>
                <input type="text" size="20" name="direct" id="direct" value="<?php echo $info['direct']; ?>">
                Inbound Phone: <input type="text" size="6" name="direct_inbound" id="direct_inbound" value="<?php echo $info['direct_inbound']; ?>">
			</td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax Number:
            </td>
            <td>
                <input type="text" size="18" name="fax" id="fax" class="typeahead" value="<?php echo $info['fax']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
                    Inbound Fax:
                <input type="text" size="18" name="fax_ext" id="fax_ext" class="typeahead" value="<?php echo $info['fax_ext']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 
            </td>
            <td>
                <input type="text" size="50" name="mobile" id="mobile" value="<?php echo $info['mobile']; ?>">
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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Website: 
            </td>
            <td>
                <input type="text" size="50" name="website" id="website" value="<?php echo $info['website']; ?>">
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
	<!-- wipage	
	   <tr>
            <td width="160">
                Email BCC:
            </td>
            <td>

                <input type="text" size="50" name="email2" id="email2" class="typeahead" value="<?php echo $info['email2']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
                &nbsp;<span class="error">&nbsp;</span>
            </td>
        </tr>
		
		wipage -->
        				
        <tr>
            <td width="160" valign="top">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Site Address:
            </td>
            <td>

                <input type="text" size="50" name="address" id="address" value="<?php echo $info['address']; ?>" >
                &nbsp;
				<br/>
			    <input type="text" size="50" name="address2" id="address2" value="<?php echo $info['address2']; ?>" >
                &nbsp;
            </td>
        </tr>
					
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Suburb:
            </td>
            <td>
                <input type="text" size="20" name="suburb" id="suburb" value="<?php echo $info['suburb']; ?>" >
                &nbsp;
				&nbsp;
				&nbsp;
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
				&nbsp;
				&nbsp;
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
		
        <!--
        <tr>
            <td width="160">Contract Number:</td>
            <td>
			  <input type="text" size="20" name="contract" id="contract" value="<?php echo $info['contract']; ?>" >
				&nbsp;&nbsp;&nbsp;								
            </td>
        </tr>
    	-->
    </tbody>
    <thead>
        <tr>
            <th colspan="3">
                <em><strong>Upstream Provider</strong></em>
            </th>
        </tr>
    </thead>
    <tbody>
    	<tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upstream Provider: 
            </td>
            <td>
                <input type="text" size="30" name="upstream_provname" id="upstream_provname" value="<?php echo $info['upstream_provname']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;URL: 
            </td>
            <td>
                <input type="text" size="50" name="upstream_provurl" id="upstream_provurl" value="<?php echo $info['upstream_provurl']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name: 
            </td>
            <td>
                <input type="text" size="50" name="upstream_username" id="upstream_username" value="<?php echo $info['upstream_username']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: 
            </td>
            <td>
                <input type="text" size="50" name="upstream_pwd" id="upstream_pwd" value="<?php echo $info['upstream_pwd']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Go to page: 
            </td>
            <td>
                <button type="button" onclick="gotoUpstreamProviderpage();">Click Here</button>
            </td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan="3">
                <em><strong>Banking Details</strong></em>
            </th>
        </tr>
    </thead>
    <tbody>
    	<tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank: 
            </td>
            <td>
                <input type="text" size="50" name="bank" id="bank" value="<?php echo $info['bank']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Name: 
            </td>
            <td>
                <input type="text" size="50" name="bank_account_name" id="bank_account_name" value="<?php echo $info['bank_account_name']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BSB Number: 
            </td>
            <td>
                <input type="text" size="20" name="bank_bsb" id="bank_bsb" value="<?php echo $info['bank_bsb']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Number: 
            </td>
            <td>
                <input type="text" size="20" name="bank_account_no" id="bank_account_no" value="<?php echo $info['bank_account_no']; ?>">
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
            <td width="160" class="required">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department: 
            </td>
            <td>
                <input type="text" size="40" name="other_dept1" id="other_dept1" value="<?php echo $info['other_dept1']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Person: 
            </td>
            <td>
                <input type="text" size="50" name="other_contact1" id="other_contact1" value="<?php echo $info['other_contact1']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
            </td>
            <td>
                <input type="text" size="18" name="other_phone1" id="other_phone1" class="typeahead" value="<?php echo $info['other_phone1']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off"> &nbsp;
                    Mobile:
                <input type="text" size="18" name="other_mobile1" id="other_mobile1" class="typeahead" value="<?php echo $info['other_mobile1']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: 
            </td>
            <td>
                <input type="text" size="50" name="other_email1" id="other_email1" value="<?php echo $info['other_email1']; ?>">
            </td>
        </tr>
        
        <tr>
            <td width="160" class="required">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department: 
            </td>
            <td>
                <input type="text" size="40" name="other_dept2" id="other_dept2" value="<?php echo $info['other_dept2']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Person: 
            </td>
            <td>
                <input type="text" size="50" name="other_contact2" id="other_contact2" value="<?php echo $info['other_contact2']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
            </td>
            <td>
                <input type="text" size="18" name="other_phone2" id="other_phone2" class="typeahead" value="<?php echo $info['other_phone2']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off"> &nbsp;
                    Mobile:
                <input type="text" size="18" name="other_mobile2" id="other_mobile2" class="typeahead" value="<?php echo $info['other_mobile2']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: 
            </td>
            <td>
                <input type="text" size="50" name="other_email2" id="other_email2" value="<?php echo $info['other_email2']; ?>">
            </td>
        </tr>
        
        <tr>
            <td width="160" class="required">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department: 
            </td>
            <td>
                <input type="text" size="40" name="other_dept3" id="other_dept3" value="<?php echo $info['other_dept3']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Person: 
            </td>
            <td>
                <input type="text" size="50" name="other_contact3" id="other_contact3" value="<?php echo $info['other_contact3']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
            </td>
            <td>
                <input type="text" size="18" name="other_phone3" id="other_phone3" class="typeahead" value="<?php echo $info['other_phone3']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off"> &nbsp;
                    Mobile:
                <input type="text" size="18" name="other_mobile3" id="other_mobile3" class="typeahead" value="<?php echo $info['other_mobile3']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: 
            </td>
            <td>
                <input type="text" size="50" name="other_email3" id="other_email3" value="<?php echo $info['other_email3']; ?>">
            </td>
        </tr>
        
        <tr>
            <td width="160" class="required">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department: 
            </td>
            <td>
                <input type="text" size="40" name="other_dept4" id="other_dept4" value="<?php echo $info['other_dept4']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Person: 
            </td>
            <td>
                <input type="text" size="50" name="other_contact4" id="other_contact4" value="<?php echo $info['other_contact4']; ?>">
            </td>
        </tr>
        <tr>
            <td width="160">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone Number:
            </td>
            <td>
                <input type="text" size="18" name="other_phone4" id="other_phone4" class="typeahead" value="<?php echo $info['other_phone4']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off"> &nbsp;
                    Mobile:
                <input type="text" size="18" name="other_mobile4" id="other_mobile4" class="typeahead" value="<?php echo $info['other_mobile4']; ?>"
                    autocomplete="off" autocorrect="off" autocapitalize="off">
            </td>
        </tr>
        <tr>
            <td width="160">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: 
            </td>
            <td>
                <input type="text" size="50" name="other_email4" id="other_email4" value="<?php echo $info['other_email4']; ?>">
            </td>
        </tr>
    </tbody>
</table>
</td>

<td align="center" style="background-color:#e4ebf1; border-radius:6px;" width="30%">
 <form action="suppliers.php" method="get"> 
						   <br/> 
							 Supplier Search<br/><br/>

							 <input type="text"  name="query" size=30 autocomplete="off" autocorrect="off" autocapitalize="off">
               <br/><input type="submit" value="Search" style="margin-top:20px">			 
							 
							 <br/><br/><br/>
							 <hr size="1" width="76%" />
							 <br/><br/>
						   <input type="button" onclick="document.location='tickets.php?a=open&cid=<?php echo $_REQUEST['id']; ?>';" value="Create Ticket" /><br/><br/>
						   <input type="button" onclick="window.open('suppliers.php?a=label&id=<?php echo $_REQUEST['id']; ?>','_blank','width=280,height=200,scrollbars=0,resizable=0');" value="Print Label" /><br/><br/>							 

						</form>
						   </td>
<tr>
<!-- wipage code -->

<!-- not needed for suppliers

<tr>
<td colspan=2 >
<br>

<div id="cust_auth_table" style='background-color: #CCCCCC;'>
    	<h2>Internet | Authentication Details</h2>
      <table cellspacing="10px" width="100%" border="0">
  <tr>
    <th scope="col" width='25%'>&nbsp;</th>
    <th scope="col" width='25%'>Service 1</th>
    <th scope="col" width='25%'>Service 2</th>
    <th scope="col" width='25%'>Service 3</th>
  </tr>
  <tr>
    <td><b>Upstream Provider</b></td>
    <td align='left'><select name="upstream_provider1" id="upstream_provider1" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="isph" <?php echo $info['upstream_provider1'] == 'isph' ? "selected=\"selected\"":""; ?>>ISPH</option>
      <option value="mnr" <?php echo $info['upstream_provider1'] == 'mnr' ? "selected=\"selected\"":""; ?>>MNR</option>
      <option value="optus" <?php echo $info['upstream_provider1'] == 'optus' ? "selected=\"selected\"":""; ?>>OPTUS</option>
      <option value="telstra" <?php echo $info['upstream_provider1'] == 'telstra' ? "selected=\"selected\"":""; ?>>TELSTRA</option>
      <option value="bigair" <?php echo $info['upstream_provider1'] == 'bigair' ? "selected=\"selected\"":""; ?>>BIGAIR</option>
      <option value="westnet" <?php echo $info['upstream_provider1'] == 'westnet' ? "selected=\"selected\"":""; ?>>WESTNET</option>
      <option value="tpg" <?php echo $info['upstream_provider1'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="polyphone" <?php echo $info['upstream_provider1'] == 'polyphone' ? "selected=\"selected\"":""; ?>>POLYPHONE</option>
      <option value="other" <?php echo $info['upstream_provider1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td align='left'><select name="upstream_provider2" id="upstream_provider2" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="isph" <?php echo $info['upstream_provider2'] == 'isph' ? "selected=\"selected\"":""; ?>>ISPH</option>
      <option value="mnr" <?php echo $info['upstream_provider2'] == 'mnr' ? "selected=\"selected\"":""; ?>>MNR</option>
      <option value="optus" <?php echo $info['upstream_provider2'] == 'optus' ? "selected=\"selected\"":""; ?>>OPTUS</option>
      <option value="telstra" <?php echo $info['upstream_provider2'] == 'telstra' ? "selected=\"selected\"":""; ?>>TELSTRA</option>
      <option value="bigair" <?php echo $info['upstream_provider2'] == 'bigair' ? "selected=\"selected\"":""; ?>>BIGAIR</option>
      <option value="westnet" <?php echo $info['upstream_provider2'] == 'westnet' ? "selected=\"selected\"":""; ?>>WESTNET</option>
      <option value="tpg" <?php echo $info['upstream_provider2'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="polyphone" <?php echo $info['upstream_provider2'] == 'polyphone' ? "selected=\"selected\"":""; ?>>POLYPHONE</option>
      <option value="other" <?php echo $info['upstream_provider2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td align='left'><select name="upstream_provider3" id="upstream_provider3" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="isph" <?php echo $info['upstream_provider3'] == 'isph' ? "selected=\"selected\"":""; ?>>ISPH</option>
      <option value="mnr" <?php echo $info['upstream_provider3'] == 'mnr' ? "selected=\"selected\"":""; ?>>MNR</option>
      <option value="optus" <?php echo $info['upstream_provider3'] == 'optus' ? "selected=\"selected\"":""; ?>>OPTUS</option>
      <option value="telstra" <?php echo $info['upstream_provider3'] == 'telstra' ? "selected=\"selected\"":""; ?>>TELSTRA</option>
      <option value="bigair" <?php echo $info['upstream_provider3'] == 'bigair' ? "selected=\"selected\"":""; ?>>BIGAIR</option>
      <option value="westnet" <?php echo $info['upstream_provider3'] == 'westnet' ? "selected=\"selected\"":""; ?>>WESTNET</option>
      <option value="tpg" <?php echo $info['upstream_provider3'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="polyphone" <?php echo $info['upstream_provider3'] == 'polyphone' ? "selected=\"selected\"":""; ?>>POLYPHONE</option>
      <option value="other" <?php echo $info['upstream_provider3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
  </tr>
  <tr>
    <td><b>Upstream Ref</b></td>
    <td align='left'><input name="upstream_ref1" id="upstream_ref1" type="text" style='width:90%;' value="<?php echo $info['upstream_ref1']; ?>">&nbsp;</td>
    <td align='left'><input name="upstream_ref2" id="upstream_ref2" type="text" style='width:90%;' value="<?php echo $info['upstream_ref2']; ?>">&nbsp;</td>
    <td align='left'><input name="upstream_ref3" id="upstream_ref3" type="text" style='width:90%;' value="<?php echo $info['upstream_ref3']; ?>">&nbsp;</td>
  </tr>
  <tr>
    <td><b>Service Use</b></td>
    <td><select name="service_use1" id="service_use1" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="voice_phones" <?php echo $info['service_use1'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice (Phones)</option>
      <option value="data_office" <?php echo $info['service_use1'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data (Office)</option>
      <option value="data_vpn" <?php echo $info['service_use1'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>Data (VPN)</option>
      <option value="shared" <?php echo $info['service_use1'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared (Voice+Data)</option>
      <option value="other" <?php echo $info['service_use1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="service_use2" id="service_use2" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="voice_phones" <?php echo $info['service_use2'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice (Phones)</option>
      <option value="data_office" <?php echo $info['service_use2'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data (Office)</option>
      <option value="data_vpn" <?php echo $info['service_use2'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>Data (VPN)</option>
      <option value="shared" <?php echo $info['service_use2'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared (Voice+Data)</option>
      <option value="other" <?php echo $info['service_use2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="service_use3" id="service_use3" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="voice_phones" <?php echo $info['service_use3'] == 'voice_phones' ? "selected=\"selected\"":""; ?>>Voice (Phones)</option>
      <option value="data_office" <?php echo $info['service_use3'] == 'data_office' ? "selected=\"selected\"":""; ?>>Data (Office)</option>
      <option value="data_vpn" <?php echo $info['service_use3'] == 'data_vpn' ? "selected=\"selected\"":""; ?>>Data (VPN)</option>
      <option value="shared" <?php echo $info['service_use3'] == 'shared' ? "selected=\"selected\"":""; ?>>Shared (Voice+Data)</option>
      <option value="other" <?php echo $info['service_use3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
  </tr>
  <tr>
    <td><b>Service Type</b></td>
    <td><select name="service_type1" id="service_type1" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="naked_adsl" <?php echo $info['service_type1'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
      <option value="adsl1" <?php echo $info['service_type1'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
      <option value="adsl_exstream" <?php echo $info['service_type1'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
      <option value="adsl2_plus" <?php echo $info['service_type1'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
      <option value="eofw" <?php echo $info['service_type1'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
      <option value="efm_4_wire" <?php echo $info['service_type1'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM (4 Wire)</option>
      <option value="efm_6_wire" <?php echo $info['service_type1'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM (6 Wire)</option>
      <option value="nbn" <?php echo $info['service_type1'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
      <option value="mbe" <?php echo $info['service_type1'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
      <option value="other" <?php echo $info['service_type1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="service_type2" id="service_type2" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="naked_adsl" <?php echo $info['service_type2'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
      <option value="adsl1" <?php echo $info['service_type2'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
      <option value="adsl_exstream" <?php echo $info['service_type2'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
      <option value="adsl2_plus" <?php echo $info['service_type2'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
      <option value="eofw" <?php echo $info['service_type2'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
      <option value="efm_4_wire" <?php echo $info['service_type2'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM (4 Wire)</option>
      <option value="efm_6_wire" <?php echo $info['service_type2'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM (6 Wire)</option>
      <option value="nbn" <?php echo $info['service_type2'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
      <option value="mbe" <?php echo $info['service_type2'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
      <option value="other" <?php echo $info['service_type2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="service_type3" id="service_type3" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="naked_adsl" <?php echo $info['service_type3'] == 'naked_adsl' ? "selected=\"selected\"":""; ?>>Naked ADSL</option>
      <option value="adsl1" <?php echo $info['service_type3'] == 'adsl1' ? "selected=\"selected\"":""; ?>>ADSL 1</option>
      <option value="adsl_exstream" <?php echo $info['service_type3'] == 'adsl_exstream' ? "selected=\"selected\"":""; ?>>ADSL Exstream</option>
      <option value="adsl2_plus" <?php echo $info['service_type3'] == 'adsl2_plus' ? "selected=\"selected\"":""; ?>>ADSL 2+</option>
      <option value="eofw" <?php echo $info['service_type3'] == 'eofw' ? "selected=\"selected\"":""; ?>>EoFW</option>
      <option value="efm_4_wire" <?php echo $info['service_type3'] == 'efm_4_wire' ? "selected=\"selected\"":""; ?>>EFM (4 Wire)</option>
      <option value="efm_6_wire" <?php echo $info['service_type3'] == 'efm_6_wire' ? "selected=\"selected\"":""; ?>>EFM (6 Wire)</option>
      <option value="nbn" <?php echo $info['service_type3'] == 'nbn' ? "selected=\"selected\"":""; ?>>NBN</option>
      <option value="mbe" <?php echo $info['service_type3'] == 'mbe' ? "selected=\"selected\"":""; ?>>MBE</option>
      <option value="other" <?php echo $info['service_type3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
  </tr>
  <tr>
    <td><b>Service Telephone Number</b></td>
    <td align='left'><input name="service_telephone_number1" id="service_telephone_number1" type="text" style='width:90%;' value="<?php echo $info['service_telephone_number1']; ?>">&nbsp;</td>
    <td align='left'><input name="service_telephone_number2" id="service_telephone_number2" type="text" style='width:90%;' value="<?php echo $info['service_telephone_number2']; ?>">&nbsp;</td>
    <td align='left'><input name="service_telephone_number3" id="service_telephone_number3" type="text" style='width:90%;' value="<?php echo $info['service_telephone_number3']; ?>">&nbsp;</td>
  </tr>
  <tr>
    <td><b>Internet Underlining Carrier</b></td>
    <td><select name="internet_underlining_carrier1" id="internet_underlining_carrier1" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="optus" <?php echo $info['internet_underlining_carrier1'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
      <option value="telstra" <?php echo $info['internet_underlining_carrier1'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
      <option value="bigair" <?php echo $info['internet_underlining_carrier1'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
      <option value="polyphone" <?php echo $info['internet_underlining_carrier1'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyphone</option>
      <option value="tpg" <?php echo $info['internet_underlining_carrier1'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="other" <?php echo $info['internet_underlining_carrier1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="internet_underlining_carrier2" id="internet_underlining_carrier2" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="optus" <?php echo $info['internet_underlining_carrier2'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
      <option value="telstra" <?php echo $info['internet_underlining_carrier2'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
      <option value="bigair" <?php echo $info['internet_underlining_carrier2'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
      <option value="polyphone" <?php echo $info['internet_underlining_carrier2'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyphone</option>
      <option value="tpg" <?php echo $info['internet_underlining_carrier2'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="other" <?php echo $info['internet_underlining_carrier2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="internet_underlining_carrier3" id="internet_underlining_carrier3" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="optus" <?php echo $info['internet_underlining_carrier3'] == 'optus' ? "selected=\"selected\"":""; ?>>Optus</option>
      <option value="telstra" <?php echo $info['internet_underlining_carrier3'] == 'telstra' ? "selected=\"selected\"":""; ?>>Telstra</option>
      <option value="bigair" <?php echo $info['internet_underlining_carrier3'] == 'bigair' ? "selected=\"selected\"":""; ?>>Bigair</option>
      <option value="polyphone" <?php echo $info['internet_underlining_carrier3'] == 'polyphone' ? "selected=\"selected\"":""; ?>>Polyphone</option>
      <option value="tpg" <?php echo $info['internet_underlining_carrier3'] == 'tpg' ? "selected=\"selected\"":""; ?>>TPG</option>
      <option value="other" <?php echo $info['internet_underlining_carrier3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
  </tr>
  <tr>
    <td><b>Profile/Speed</b></td>
    <td><select name="profile_or_speed1" id="profile_or_speed1" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="five_tweleve" <?php echo $info['profile_or_speed1'] == 'five_twelve' ? "selected=\"selected\"":""; ?>>512/512</option>
      <option value="fifteen_hund" <?php echo $info['profile_or_speed1'] == 'fifteen_hund' ? "selected=\"selected\"":""; ?>>1,500/256</option>
      <option value="eight_thou1" <?php echo $info['profile_or_speed1'] == 'eight_thou1' ? "selected=\"selected\"":""; ?>>8,000/1,000</option>
      <option value="twentyfour_thou" <?php echo $info['profile_or_speed1'] == 'twentyfour_thou' ? "selected=\"selected\"":""; ?>>24,000/1,500</option>
      <option value="two_thou" <?php echo $info['profile_or_speed1'] == 'two_thou' ? "selected=\"selected\"":""; ?> >2,000/2.000</option>
      <option value="four_thou" <?php echo $info['profile_or_speed1'] == 'four_thou' ? "selected=\"selected\"":""; ?>>4,000/4,000</option>
      <option value="five_thou" <?php echo $info['profile_or_speed1'] == 'five_thou' ? "selected=\"selected\"":""; ?>>5,000/5,000</option>
      <option value="six_thou" <?php echo $info['profile_or_speed1'] == 'six_thou' ? "selected=\"selected\"":""; ?>>6,000/6,000</option>
      <option value="eight_thou2" <?php echo $info['profile_or_speed1'] == 'eight_thou2' ? "selected=\"selected\"":""; ?>>8,000/8,000</option>
      <option value="ten_thou" <?php echo $info['profile_or_speed1'] == 'ten_thou' ? "selected=\"selected\"":""; ?>>10,000/10,000</option>
      <option value="twenty_thou" <?php echo $info['profile_or_speed1'] == 'twenty_thou' ? "selected=\"selected\"":""; ?>>20,000/20,000</option>
      <option value="fifty_thou" <?php echo $info['profile_or_speed1'] == 'fifty_thou' ? "selected=\"selected\"":""; ?>>50,000/50,000</option>
      <option value="hund_thou" <?php echo $info['profile_or_speed1'] == 'hund_thou' ? "selected=\"selected\"":""; ?>>100,000/100,000</option>
      <option value="other" <?php echo $info['profile_or_speed1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="profile_or_speed2" id="profile_or_speed2" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="five_tweleve" <?php echo $info['profile_or_speed2'] == 'five_twelve' ? "selected=\"selected\"":""; ?>>512/512</option>
      <option value="fifteen_hund" <?php echo $info['profile_or_speed2'] == 'fifteen_hund' ? "selected=\"selected\"":""; ?>>1,500/256</option>
      <option value="eight_thou1" <?php echo $info['profile_or_speed2'] == 'eight_thou1' ? "selected=\"selected\"":""; ?>>8,000/1,000</option>
      <option value="twentyfour_thou" <?php echo $info['profile_or_speed2'] == 'twentyfour_thou' ? "selected=\"selected\"":""; ?>>24,000/1,500</option>
      <option value="two_thou" <?php echo $info['profile_or_speed2'] == 'two_thou' ? "selected=\"selected\"":""; ?> >2,000/2.000</option>
      <option value="four_thou" <?php echo $info['profile_or_speed2'] == 'four_thou' ? "selected=\"selected\"":""; ?>>4,000/4,000</option>
      <option value="five_thou" <?php echo $info['profile_or_speed2'] == 'five_thou' ? "selected=\"selected\"":""; ?>>5,000/5,000</option>
      <option value="six_thou" <?php echo $info['profile_or_speed2'] == 'six_thou' ? "selected=\"selected\"":""; ?>>6,000/6,000</option>
      <option value="eight_thou2" <?php echo $info['profile_or_speed2'] == 'eight_thou2' ? "selected=\"selected\"":""; ?>>8,000/8,000</option>
      <option value="ten_thou" <?php echo $info['profile_or_speed2'] == 'ten_thou' ? "selected=\"selected\"":""; ?>>10,000/10,000</option>
      <option value="twenty_thou" <?php echo $info['profile_or_speed2'] == 'twenty_thou' ? "selected=\"selected\"":""; ?>>20,000/20,000</option>
      <option value="fifty_thou" <?php echo $info['profile_or_speed2'] == 'fifty_thou' ? "selected=\"selected\"":""; ?>>50,000/50,000</option>
      <option value="hund_thou" <?php echo $info['profile_or_speed2'] == 'hund_thou' ? "selected=\"selected\"":""; ?>>100,000/100,000</option>
      <option value="other" <?php echo $info['profile_or_speed2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
    <td><select name="profile_or_speed3" id="profile_or_speed3" width='100%' style='width:100%;'>
      <option value="">&lt;Select&gt;</option>
      <option value="five_tweleve" <?php echo $info['profile_or_speed3'] == 'five_twelve' ? "selected=\"selected\"":""; ?>>512/512</option>
      <option value="fifteen_hund" <?php echo $info['profile_or_speed3'] == 'fifteen_hund' ? "selected=\"selected\"":""; ?>>1,500/256</option>
      <option value="eight_thou1" <?php echo $info['profile_or_speed3'] == 'eight_thou1' ? "selected=\"selected\"":""; ?>>8,000/1,000</option>
      <option value="twentyfour_thou" <?php echo $info['profile_or_speed3'] == 'twentyfour_thou' ? "selected=\"selected\"":""; ?>>24,000/1,500</option>
      <option value="two_thou" <?php echo $info['profile_or_speed3'] == 'two_thou' ? "selected=\"selected\"":""; ?> >2,000/2.000</option>
      <option value="four_thou" <?php echo $info['profile_or_speed3'] == 'four_thou' ? "selected=\"selected\"":""; ?>>4,000/4,000</option>
      <option value="five_thou" <?php echo $info['profile_or_speed3'] == 'five_thou' ? "selected=\"selected\"":""; ?>>5,000/5,000</option>
      <option value="six_thou" <?php echo $info['profile_or_speed3'] == 'six_thou' ? "selected=\"selected\"":""; ?>>6,000/6,000</option>
      <option value="eight_thou2" <?php echo $info['profile_or_speed3'] == 'eight_thou2' ? "selected=\"selected\"":""; ?>>8,000/8,000</option>
      <option value="ten_thou" <?php echo $info['profile_or_speed3'] == 'ten_thou' ? "selected=\"selected\"":""; ?>>10,000/10,000</option>
      <option value="twenty_thou" <?php echo $info['profile_or_speed3'] == 'twenty_thou' ? "selected=\"selected\"":""; ?>>20,000/20,000</option>
      <option value="fifty_thou" <?php echo $info['profile_or_speed3'] == 'fifty_thou' ? "selected=\"selected\"":""; ?>>50,000/50,000</option>
      <option value="hund_thou" <?php echo $info['profile_or_speed3'] == 'hund_thou' ? "selected=\"selected\"":""; ?>>100,000/100,000</option>
      <option value="other" <?php echo $info['profile_or_speed3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
    </select></td>
  </tr>
  <tr>
    <td><b>Actual Speed</b></td>
    <td><input name="actual_speed1" id="actual_speed1" type="text" style='width:90%;' value="<?php echo $info['actual_speed1']; ?>"></td>
    <td><input name="actual_speed2" id="actual_speed2" type="text" style='width:90%;' value="<?php echo $info['actual_speed2']; ?>"></td>
    <td><input name="actual_speed3" id="actual_speed3" type="text" style='width:90%;' value="<?php echo $info['actual_speed3']; ?>"></td>
  </tr>
  <tr>
    <td><b>IP Address</b></td>
    <td><input name="ip_address1" id="ip_address1" type="text" style='width:90%;' value="<?php echo $info['ip_address1']; ?>"></td>
    <td><input name="ip_address2" id="ip_address2" type="text" style='width:90%;' value="<?php echo $info['ip_address2']; ?>"></td>
    <td><input name="ip_address3" id="ip_address3" type="text" style='width:90%;' value="<?php echo $info['ip_address3']; ?>"></td>
  </tr>
  <tr>
    <td><b>User name</b></td>
    <td><input name="user_name1" id="user_name1" type="text" style='width:90%;' value="<?php echo $info['user_name1']; ?>"></td>
    <td><input name="user_name2" id="user_name2" type="text" style='width:90%;' value="<?php echo $info['user_name2']; ?>"></td>
    <td><input name="user_name3" id="user_name3" type="text" style='width:90%;' value="<?php echo $info['user_name3']; ?>"></td>
  </tr>
  <tr>
    <td><b>Password</b></td>
    <td><input name="password1" id="password1" type="text" style='width:90%;' value="<?php echo $info['password1']; ?>"></td>
    <td><input name="password2" id="password2" type="text" style='width:90%;' value="<?php echo $info['password2']; ?>"></td>
    <td><input name="password3" id="password3" type="text" style='width:90%;' value="<?php echo $info['password3']; ?>"></td>
  </tr>
  <tr>
    <td><b>Subnet Mask</b></td>
    <td><input name="subnet_mask1" id="subnet_mask1" type="text" style='width:90%;' value="<?php echo $info['subnet_mask1']; ?>"></td>
    <td><input name="subnet_mask2" id="subnet_mask2" type="text" style='width:90%;' value="<?php echo $info['subnet_mask2']; ?>"></td>
    <td><input name="subnet_mask3" id="subnet_mask3" type="text" style='width:90%;' value="<?php echo $info['subnet_mask3']; ?>"></td>
  </tr>
  <tr>
    <td><b>Primary DNS</b></td>
    <td><input name="primary_dns1" id="primary_dns1" type="text" style='width:90%;' value="<?php echo $info['primary_dns1']; ?>"></td>
    <td><input name="primary_dns2" id="primary_dns2" type="text" style='width:90%;' value="<?php echo $info['primary_dns2']; ?>"></td>
    <td><input name="primary_dns3" id="primary_dns3" type="text" style='width:90%;' value="<?php echo $info['primary_dns3']; ?>"></td>
  </tr>
  <tr>
    <td><b>Secondary DNS</b></td>
    <td><input name="secondary_dns1" id="secondary_dns1" type="text" style='width:90%;' value="<?php echo $info['secondary_dns1']; ?>"></td>
    <td><input name="secondary_dns2" id="secondary_dns2" type="text" style='width:90%;' value="<?php echo $info['secondary_dns2']; ?>"></td>
    <td><input name="secondary_dns3" id="secondary_dns3" type="text" style='width:90%;' value="<?php echo $info['secondary_dns3']; ?>"></td>
  </tr>
</table>

	<br/>

	<h2>IP PBX | Authentication Details</h2>
    
    
    
    <table cellspacing="10px" width="100%" border="0">
      <tr>
        <th scope="col" width="25%">&nbsp;</th>
        <th scope="col" width="25%">Service 1</th>
        <th scope="col" width="25%">Service 2</th>
        <th scope="col" width="25%">Service 3</th>
      </tr>
      <tr>
        <td><b>IP PBX Brand</b></td>
        <td><select name="ip_pbx_brand1" id="ip_pbx_brand1" width='100%' style='width:100%;'>
          <option value="">&lt;Select&gt;</option>
          <option value="epygi" <?php echo $info['ip_pbx_brand1'] == 'epygi' ? "selected=\"selected\"":""; ?>>EPYGI</option>
          <option value="cisco" <?php echo $info['ip_pbx_brand1'] == 'cisco' ? "selected=\"selected\"":""; ?>>CISCO</option>
          <option value="other" <?php echo $info['ip_pbx_brand1'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
        </select></td>
        <td><select name="ip_pbx_brand2" id="ip_pbx_brand2" width='100%' style='width:100%;'>
          <option value="">&lt;Select&gt;</option>
          <option value="epygi" <?php echo $info['ip_pbx_brand2'] == 'epygi' ? "selected=\"selected\"":""; ?>>EPYGI</option>
          <option value="cisco" <?php echo $info['ip_pbx_brand2'] == 'cisco' ? "selected=\"selected\"":""; ?>>CISCO</option>
          <option value="other" <?php echo $info['ip_pbx_brand2'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
        </select></td>
        <td><select name="ip_pbx_brand3" id="ip_pbx_brand3" width='100%' style='width:100%;'>
          <option value="">&lt;Select&gt;</option>
          <option value="epygi" <?php echo $info['ip_pbx_brand3'] == 'epygi' ? "selected=\"selected\"":""; ?>>EPYGI</option>
          <option value="cisco" <?php echo $info['ip_pbx_brand3'] == 'cisco' ? "selected=\"selected\"":""; ?>>CISCO</option>
          <option value="other" <?php echo $info['ip_pbx_brand3'] == 'other' ? "selected=\"selected\"":""; ?>>&lt;Other&gt;</option>
        </select></td>
      </tr>
      <tr>
        <td><b>IP PBX Model</b></td>
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
    </table>
</div>
</td>
</tr>

-->

<!-- wipage code -->
<tr >
<td colspan=2 align='center'>
<p style="padding-left:250px;">
    <input type="submit" name="do" value="<?php echo ($info['id']) ? "Update":"Add"; ?>" />
    <input type="reset"  name="reset"  value="Reset" />
    <input type="button" name="cancel" value="Cancel" onclick='window.location.href="suppliers.php"'>
		<input type="hidden" name="id" value="<?php echo $info['id']; ?>" />
</p>
</form>
</td>
</tr>
</table>

<table>
<tr>

</tr>
</table>
<script type="text/javascript">
function gotoUpstreamProviderpage() {
	var url = document.getElementById("upstream_provurl").value.trim();
	if (url=="") return;

	if(url.indexOf('https://') !=-1 || url.indexOf('http://') !=-1) window.location.assign(url);
	else window.location.assign('http://'+ url);
}
</script>