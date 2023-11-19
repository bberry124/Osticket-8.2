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




//Navigation
$nav->setTabActive('suppliers');


if ($thisstaff->hasPerm(Ticket::PERM_CREATE, false)) {
    $nav->addSubMenu(array('desc'=>'New Supplier',
                           'href'=>'suppliers.php?a=new',
                           'iconclass'=>'newTicket'),
                        ($_REQUEST['a']=='new'));    

}

$inc = 'suppliers.inc.php';

if($_REQUEST['id'] && $_REQUEST['a'] == 'label' )
{

  $res = db_query('select * from '.TABLE_PREFIX.'supplier where id =  '.intval($_REQUEST['id']));
  if( db_num_rows($res))
	{
	  $sup_info = db_fetch_array($res);
		$inc	= 'suppliers-label.inc.php';
		require_once(STAFFINC_DIR.$inc);
		exit;
	}
	else {
	   $error = "Supplier not found";
	}
}

if($_REQUEST['id'] && $_SERVER['REQUEST_METHOD'] == 'GET' )
{

  $res = db_query('select * from '.TABLE_PREFIX.'supplier where id =  '.intval($_REQUEST['id']));
  if( db_num_rows($res))
	{
	  $sup_info = db_fetch_array($res);
		$inc	= 'suppliers-edit.inc.php';
	}
	else {
	   $error = "Supplier not found";
	}
}
else if( $_REQUEST['do'] && $_SERVER['REQUEST_METHOD'] == 'POST'   )
{
    
		    $vars = $_POST;
				
        $fields=array();
        $fields['name']     = array('type'=>'string',   'required'=>1, 'error'=>'Name required');
        $fields['email']    = array('type'=>'email',    'required'=>1, 'error'=>'Valid email required');
        $fields['phone']    = array('type'=>'phone',    'required'=>0, 'error'=>'Valid phone # required');
	 		 	$fields['suburb']    	 		 = array('type'=>'string',   'required'=>0, 'error'=>'');	 			
				$fields['address']  	     = array('type'=>'string',   'required'=>0, 'error'=>'');
				$fields['address2']  	     = array('type'=>'string',   'required'=>0, 'error'=>'');				
				$fields['state']     			 = array('type'=>'string',   'required'=>0, 'error'=>'');
				$fields['postcode']     	 = array('type'=>'string',   'required'=>0, 'error'=>'');
				$fields['company']     	   = array('type'=>'string',   'required'=>1, 'error'=>'Company required');
				//$fields['vip']     		     = array('type'=>'string',   'required'=>0, 'error'=>'');
				$fields['contract']     	 = array('type'=>'string',   'required'=>0, 'error'=>'');
				$fields['mobile']     		 = array('type'=>'string',   'required'=>0, 'error'=>'Valid phone # required');
				//$fields['email2']     		 = array('type'=>'email',    'required'=>0, 'error'=>'Valid email required');
				
				$fields['trading']     = array('type'=>'string',   'required'=>1, 'error'=>'Trading Name required');
	
        if(!Validator::process($fields, $vars, $errors) && !$errors['err'])
            $errors['err'] = 'Missing or invalid data - check the errors and try again';
						
        //Make sure phone extension is valid
        if($vars['phone_ext'] ) {
            if(!is_numeric($vars['phone_ext']) && !$errors['phone'])
                $errors['phone']='Invalid phone ext.';
            elseif(!$vars['phone']) //make sure they just didn't enter ext without phone #
                $errors['phone']='Phone number required';
        }

        if(!$errors)
				{
				  
					$where = "";
				  if($_REQUEST['do'] == 'Add')
					{
					  $_sql = "insert into ";
					}
					else {
					  
					  $_sql  =  "update ";
						$where  = " where id = ".intval($_REQUEST['id']);
					}

					$sql = "$_sql ".TABLE_PREFIX."supplier SET last_update = NOW() , ".
							 	 "  email      = '".db_input($vars['email'],false)."'  , ".
								 "  name       = '".db_input(Format::striptags($vars['name']),false)."' , ".
								 "  phone	 	   = '".db_input($vars['phone'],false)."' , ".
								 "  phone_ext	 = '".db_input($vars['phone_ext'],false)."',  ".
								 "  suburb		 = '".db_input($vars['suburb'],false)."', ".
								 "  company		 = '".db_input($vars['company'],false)."', ".
								 "  address		 = '".db_input($vars['address'],false)."', ".
								 "  address2	 = '".db_input($vars['address2'],false)."', ".								 
								 "  state			 = '".db_input($vars['state'],false)."', ".
								 "	mobile		 = '".db_input($vars['mobile'],false)."', ".
								 "  postcode     = '".db_input($vars['postcode'],false)."' , ".	

								 "  trading           = '".db_input(Format::striptags($vars['trading']),false)."' , ".
								 "  abn		          = '".db_input($vars['abn'],false)."', ".
								 "  acn		          = '".db_input($vars['acn'],false)."', ".
								 "  position		  = '".db_input($vars['position'],false)."', ".
								 "  direct		      = '".db_input($vars['direct'],false)."', ".
								 "  direct_inbound    = '".db_input($vars['direct_inbound'],false)."', ".
								 "  fax		          = '".db_input($vars['fax'],false)."', ".
								 "  fax_ext		      = '".db_input($vars['fax_ext'],false)."', ".
								 "  website		      = '".db_input($vars['website'],false)."', ".
								 "  city		      = '".db_input($vars['city'],false)."', ".
								 "  country		      = '".db_input($vars['country'],false)."', ".
								 "  bank		      = '".db_input($vars['bank'],false)."', ".
								 "  bank_account_name = '".db_input($vars['bank_account_name'],false)."', ".
								 "  bank_bsb		  = '".db_input($vars['bank_bsb'],false)."', ".
								 "  bank_account_no	  = '".db_input($vars['bank_account_no'],false)."', ".
								 "  other_dept1		  = '".db_input($vars['other_dept1'],false)."', ".
								 "  other_contact1	  = '".db_input($vars['other_contact1'],false)."', ".
								 "  other_phone1	  = '".db_input($vars['other_phone1'],false)."', ".
								 "  other_mobile1	  = '".db_input($vars['other_mobile1'],false)."', ".
								 "  other_email1	  = '".db_input($vars['other_email1'],false)."', ".
								 "  other_dept2		  = '".db_input($vars['other_dept2'],false)."', ".
								 "  other_contact2	  = '".db_input($vars['other_contact2'],false)."', ".
								 "  other_phone2	  = '".db_input($vars['other_phone2'],false)."', ".
								 "  other_mobile2	  = '".db_input($vars['other_mobile2'],false)."', ".
								 "  other_email2	  = '".db_input($vars['other_email2'],false)."', ".
								 "  other_dept3		  = '".db_input($vars['other_dept3'],false)."', ".
								 "  other_contact3	  = '".db_input($vars['other_contact3'],false)."', ".
								 "  other_phone3	  = '".db_input($vars['other_phone3'],false)."', ".
								 "  other_mobile3	  = '".db_input($vars['other_mobile3'],false)."', ".
								 "  other_email3	  = '".db_input($vars['other_email3'],false)."', ".
								 "  other_dept4		  = '".db_input($vars['other_dept4'],false)."', ".
								 "  other_contact4	  = '".db_input($vars['other_contact4'],false)."', ".
								 "  other_phone4	  = '".db_input($vars['other_phone4'],false)."', ".
								 "  other_mobile4	  = '".db_input($vars['other_mobile4'],false)."', ".
								 "  other_email4	  = '".db_input($vars['other_email4'],false)."', ".
					
								"  upstream_provname  = '".db_input($vars['upstream_provname'],false)."', ".
								"  upstream_provurl	  = '".db_input($vars['upstream_provurl'],false)."', ".
								"  upstream_username  = '".db_input($vars['upstream_username'],false)."', ".
								"  upstream_pwd	      = '".db_input($vars['upstream_pwd'],false)."', ".
					
								 "  contract	      = '".db_input($vars['contract'],false)." '$where "; 
								 //" 	vip				 = '".db_input($vars['vip'],false)." '
								 //"	email2		 = '".db_input($vars['email2'],false)."' 
								 
		            
								db_query($sql);	
								$success = "Record successfully updated";
								if( !$_REQUEST['id'])
								{
								   $success = "Record successfully added";
  								 $_REQUEST['id'] = mysql_insert_id();
								}
								
								$res = db_query('select * from '.TABLE_PREFIX.'supplier where id =  '.intval($_REQUEST['id']));
  							$sup_info = db_fetch_array($res);								

		     }
				 
				 $inc = 'suppliers-edit.inc.php';
}

if($_REQUEST['a'] == 'export') {
        require_once(INCLUDE_DIR.'class.export.php');
				require_once(INCLUDE_DIR.'class.suppliers.export.php');
        $ts = strftime('%Y%m%d');
        if (!($token=$_REQUEST['h']))
            $errors['err'] = 'Query token required';
        elseif (!($query=$_SESSION['search_'.$token]))
            $errors['err'] = 'Query token not found';
        elseif ( !customerExport::saveCustomers($query, "suppliers-$ts.csv", 'csv'))
            $errors['err'] = 'Internal error: Unable to dump query results';
}

if( $_REQUEST['a'] == 'new' )
  $inc = 'suppliers-edit.inc.php'; 

require_once(STAFFINC_DIR.'header.inc.php');
require_once(STAFFINC_DIR.$inc);
require_once(STAFFINC_DIR.'footer.inc.php');
?>
