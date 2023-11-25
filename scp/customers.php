<?php
/*************************************************************************
 * tickets.php
 *
 * Handles all tickets related actions.
 *
 * Peter Rotich <peter@osticket.com>
 * Copyright (c)  2006-2012 osTicket
 * http://www.osticket.com
 *
 * Released under the GNU General Public License WITHOUT ANY WARRANTY.
 * See LICENSE.TXT for details.
 *
 * vim: expandtab sw=4 ts=4 sts=4:
 **********************************************************************/
if (!isset($_REQUEST["a"])){
    $_REQUEST["custom_status"] = "active";
    $_REQUEST["a"] = "search";
    $_REQUEST["query"] = "";
    $_REQUEST["custom_type"] = "";
}
require('staff.inc.php');
require_once(INCLUDE_DIR . 'class.ticket.php');
require_once(INCLUDE_DIR . 'class.dept.php');
require_once(INCLUDE_DIR . 'class.filter.php');
require_once(INCLUDE_DIR . 'class.canned.php');


//Navigation
$nav->setTabActive('customers');

$inc = 'customers.inc.php';

if ($thisstaff->hasPerm(Ticket::PERM_CREATE, false))  {
    $nav->addSubMenu(array('desc' => 'New Customer',
        'href' => 'customers.php?a=new',
        'iconclass' => 'newuser'),
        ($_REQUEST['a'] == 'new'));

}

if ($_REQUEST['id'] && $_REQUEST['a'] == 'label') {

    $res = db_query('select * from ' . TABLE_PREFIX . 'customer1 where id =  ' . intval($_REQUEST['id']));
    if (db_num_rows($res)) {
        $customers_info = db_fetch_array($res);
        $inc = 'customers-label.inc.php';
        require_once(STAFFINC_DIR . $inc);
        exit;
    } else {
        $error = "Customer not found";
    }
}

if ($_REQUEST['id'] && $_SERVER['REQUEST_METHOD'] == 'GET') {

    $res = db_query('select * from ' . TABLE_PREFIX . 'customer1 where id =  ' . intval($_REQUEST['id']));
    if (db_num_rows($res)) {
        $customers_info = db_fetch_array($res);
        $inc = 'customers-edit.inc.php';
    } else {
        $error = "Customer not found";
    }
} else if ($_REQUEST['do'] && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $vars = $_POST;

    $fields = array();
    $fields['name'] = array('type' => 'string', 'required' => 1, 'error' => 'Name required');
    $fields['email'] = array('type' => 'email', 'required' => 1, 'error' => 'Valid email required');
    $fields['phone'] = array('type' => 'phone', 'required' => 0, 'error' => 'Valid phone # required');
    $fields['suburb'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['address'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['address2'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['state'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['postcode'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['company'] = array('type' => 'string', 'required' => 1, 'error' => 'Company required');
    $fields['vip'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['contract'] = array('type' => 'string', 'required' => 0, 'error' => '');
    $fields['mobile'] = array('type' => 'string', 'required' => 0, 'error' => 'Valid phone # required');
    $fields['email2'] = array('type' => 'email', 'required' => 0, 'error' => 'Valid email required');

    $fields['trading'] = array('type' => 'string', 'required' => 1, 'error' => 'Trading required');
    $fields['acnt_rand_no'] = array('type' => 'string', 'required' => 1, 'error' => 'Account Number required.');
    $fields['acnt_rand_manager'] = array('type' => 'string', 'required' => 1, 'error' => 'Account Manager required.');

    if (!Validator::process($fields, $vars, $errors) && !$errors['err'])
        $errors['err'] = 'Missing or invalid data - check the errors and try again';

    //Make sure phone extension is valid
    if ($vars['phone_ext']) {
        if (!is_numeric($vars['phone_ext']) && !$errors['phone'])
            $errors['phone'] = 'Invalid phone ext.';
        elseif (!$vars['phone']) //make sure they just didn't enter ext without phone #
            $errors['phone'] = 'Phone number required';
    }

    if (!$errors) {

        $where = "";
        if ($_REQUEST['do'] == 'Add') {
            $_sql = "insert into ";
        } else {

            $_sql = "update ";
            $where = " where id = " . intval($_REQUEST['id']);
        }

        $sql = "$_sql " . TABLE_PREFIX . "customer1 SET last_update = NOW() , " .
            "  email      = '" . db_input($vars['email'], false) . "'  , " .
            "  name       = '" . db_input(Format::striptags($vars['name']), false) . "' , " .
            "  phone	 	   = '" . db_input($vars['phone'], false) . "' , " .
            "  phone_ext	 = '" . db_input($vars['phone_ext'], false) . "',  " .
            "  suburb		 = '" . db_input($vars['suburb'], false) . "', " .
            "  company		 = '" . db_input($vars['company'], false) . "', " .
            "  address		 = '" . db_input($vars['address'], false) . "', " .
            "  address2	 = '" . db_input($vars['address2'], false) . "', " .
            "  state			 = '" . db_input($vars['state'], false) . "', " .
            "	mobile		 = '" . db_input($vars['mobile'], false) . "', " .
            "  postcode   = '" . db_input($vars['postcode'], false) . "' , " .
            "  contract	 = '" . db_input($vars['contract'], false) . "', " .
            "  voice_contract	 = '" . db_input($vars['voice_contract'], false) . "', " .
            "  network_contract	 = '" . db_input($vars['network_contract'], false) . "', " .
            "  voice_seats	 = '" . db_input($vars['voice_seats'], false) . "', " .
            "  network_seats	 = '" . db_input($vars['network_seats'], false) . "', " .
            " 	vip				 = '" . db_input($vars['vip'], false) . "',  " .
            " 	vip_club		 = '" . db_input($vars['vip_club'], false) . "',  " .
            " 	voice_sla		 = '" . db_input($vars['voice_sla'], false) . "',  " .
            " 	network_sla		 = '" . db_input($vars['network_sla'], false) . "',  " .

            " 	upstream_provider1	 = '" . db_input($vars['upstream_provider1'], false) . "',  " .
            " 	upstream_provider2	 = '" . db_input($vars['upstream_provider2'], false) . "',  " .
            " 	upstream_provider3	 = '" . db_input($vars['upstream_provider3'], false) . "',  " .
            " 	upstream_provider4	 = '" . db_input($vars['upstream_provider4'], false) . "',  " .
            " 	upstream_provider5	 = '" . db_input($vars['upstream_provider5'], false) . "',  " .
            " 	upstream_provider6	 = '" . db_input($vars['upstream_provider6'], false) . "',  " .
            " 	upstream_provider7	 = '" . db_input($vars['upstream_provider7'], false) . "',  " .
//            " 	upstream_ref1	 = '" . db_input($vars['upstream_ref1'], false) . "',  " .
//            " 	upstream_ref2	 = '" . db_input($vars['upstream_ref2'], false) . "',  " .
//            " 	upstream_ref3	 = '" . db_input($vars['upstream_ref3'], false) . "',  " .
            " 	service_use1	 = '" . db_input($vars['service_use1'], false) . "',  " .
            " 	service_use2	 = '" . db_input($vars['service_use2'], false) . "',  " .
            " 	service_use3	 = '" . db_input($vars['service_use3'], false) . "',  " .
            " 	service_use4	 = '" . db_input($vars['service_use4'], false) . "',  " .
            " 	service_use5	 = '" . db_input($vars['service_use5'], false) . "',  " .
            " 	service_use6	 = '" . db_input($vars['service_use6'], false) . "',  " .
            " 	service_use7	 = '" . db_input($vars['service_use7'], false) . "',  " .
            " 	service_type1	 = '" . db_input($vars['service_type1'], false) . "',  " .
            " 	service_type2	 = '" . db_input($vars['service_type2'], false) . "',  " .
            " 	service_type3	 = '" . db_input($vars['service_type3'], false) . "',  " .
            " 	service_type4	 = '" . db_input($vars['service_type4'], false) . "',  " .
            " 	service_type5	 = '" . db_input($vars['service_type5'], false) . "',  " .
            " 	service_type6	 = '" . db_input($vars['service_type6'], false) . "',  " .
            " 	service_type7	 = '" . db_input($vars['service_type7'], false) . "',  " .
//            " 	service_telephone_number1	 = '" . db_input($vars['service_telephone_number1'], false) . "',  " .
//            " 	service_telephone_number2	 = '" . db_input($vars['service_telephone_number2'], false) . "',  " .
//            " 	service_telephone_number3	 = '" . db_input($vars['service_telephone_number3'], false) . "',  " .
            " 	internet_underlining_carrier1	 = '" . db_input($vars['internet_underlining_carrier1'], false) . "',  " .
            " 	internet_underlining_carrier2	 = '" . db_input($vars['internet_underlining_carrier2'], false) . "',  " .
            " 	internet_underlining_carrier3	 = '" . db_input($vars['internet_underlining_carrier3'], false) . "',  " .
            " 	internet_underlining_carrier4	 = '" . db_input($vars['internet_underlining_carrier4'], false) . "',  " .
            " 	internet_underlining_carrier5	 = '" . db_input($vars['internet_underlining_carrier5'], false) . "',  " .
            " 	internet_underlining_carrier6	 = '" . db_input($vars['internet_underlining_carrier6'], false) . "',  " .
            " 	internet_underlining_carrier7	 = '" . db_input($vars['internet_underlining_carrier7'], false) . "',  " .
            " 	profile_or_speed1	 = '" . db_input($vars['profile_or_speed1'], false) . "',  " .
            " 	profile_or_speed2	 = '" . db_input($vars['profile_or_speed2'], false) . "',  " .
            " 	profile_or_speed3	 = '" . db_input($vars['profile_or_speed3'], false) . "',  " .
            " 	profile_or_speed4	 = '" . db_input($vars['profile_or_speed4'], false) . "',  " .
            " 	profile_or_speed5	 = '" . db_input($vars['profile_or_speed5'], false) . "',  " .
            " 	profile_or_speed6	 = '" . db_input($vars['profile_or_speed6'], false) . "',  " .
            " 	profile_or_speed7	 = '" . db_input($vars['profile_or_speed7'], false) . "',  " .
            " 	actual_speed1	 = '" . db_input($vars['actual_speed1'], false) . "',  " .
            " 	actual_speed2	 = '" . db_input($vars['actual_speed2'], false) . "',  " .
            " 	actual_speed3	 = '" . db_input($vars['actual_speed3'], false) . "',  " .
            " 	actual_speed4	 = '" . db_input($vars['actual_speed4'], false) . "',  " .
            " 	actual_speed5	 = '" . db_input($vars['actual_speed5'], false) . "',  " .
            " 	actual_speed6	 = '" . db_input($vars['actual_speed6'], false) . "',  " .
            " 	actual_speed7	 = '" . db_input($vars['actual_speed7'], false) . "',  " .
            " 	ip_address1	 = '" . db_input($vars['ip_address1'], false) . "',  " .
            " 	ip_address2	 = '" . db_input($vars['ip_address2'], false) . "',  " .
            " 	ip_address3	 = '" . db_input($vars['ip_address3'], false) . "',  " .
            " 	ip_address4	 = '" . db_input($vars['ip_address4'], false) . "',  " .
            " 	ip_address5	 = '" . db_input($vars['ip_address5'], false) . "',  " .
            " 	ip_address6	 = '" . db_input($vars['ip_address6'], false) . "',  " .
            " 	ip_address7	 = '" . db_input($vars['ip_address7'], false) . "',  " .
            " 	auth_username1	 = '" . db_input($vars['auth_username1'], false) . "',  " .
            " 	auth_username2	 = '" . db_input($vars['auth_username2'], false) . "',  " .
            " 	auth_username3	 = '" . db_input($vars['auth_username3'], false) . "',  " .
            " 	auth_username4	 = '" . db_input($vars['auth_username4'], false) . "',  " .
            " 	auth_username5	 = '" . db_input($vars['auth_username5'], false) . "',  " .
            " 	auth_username6	 = '" . db_input($vars['auth_username6'], false) . "',  " .
            " 	auth_username7	 = '" . db_input($vars['auth_username7'], false) . "',  " .
            " 	auth_password1	 = '" . db_input($vars['auth_password1'], false) . "',  " .
            " 	auth_password2	 = '" . db_input($vars['auth_password2'], false) . "',  " .
            " 	auth_password3	 = '" . db_input($vars['auth_password3'], false) . "',  " .
            " 	auth_password4	 = '" . db_input($vars['auth_password4'], false) . "',  " .
            " 	auth_password5	 = '" . db_input($vars['auth_password5'], false) . "',  " .
            " 	auth_password6	 = '" . db_input($vars['auth_password6'], false) . "',  " .
            " 	auth_password7	 = '" . db_input($vars['auth_password7'], false) . "',  " .
            " 	bound_tel	 = '" . db_input($vars['bound_tel'], false) . "',  " .
            " 	bound_fax	 = '" . db_input($vars['bound_fax'], false) . "',  " .
            " 	check1	 = '" . db_input($vars['check1'], false) . "',  " .
            " 	check2	 = '" . db_input($vars['check2'], false) . "',  " .
//            " 	service2_type1	 = '" . db_input($vars['service2_type1'], false) . "',  " .
//            " 	service2_type2	 = '" . db_input($vars['service2_type2'], false) . "',  " .
//            " 	service2_type3	 = '" . db_input($vars['service2_type3'], false) . "',  " .
//            " 	service2_type4	 = '" . db_input($vars['service2_type4'], false) . "',  " .
//            " 	service2_type5	 = '" . db_input($vars['service2_type5'], false) . "',  " .
//            " 	service2_type6	 = '" . db_input($vars['service2_type6'], false) . "',  " .
//            " 	service2_type7	 = '" . db_input($vars['service2_type7'], false) . "',  " .
            " 	service1	 = '" . db_input($vars['service1'], false) . "',  " .
            " 	service2	 = '" . db_input($vars['service2'], false) . "',  " .
            " 	service3	 = '" . db_input($vars['service3'], false) . "',  " .
            " 	service4	 = '" . db_input($vars['service4'], false) . "',  " .
            " 	service5	 = '" . db_input($vars['service5'], false) . "',  " .
            " 	service6	 = '" . db_input($vars['service6'], false) . "',  " .
            " 	service7	 = '" . db_input($vars['service7'], false) . "',  " .
            " 	provider_phone1	     = '" . db_input($vars['provider_phone1'], false) . "',  " .
            " 	provider_phone2	     = '" . db_input($vars['provider_phone2'], false) . "',  " .
            " 	provider_phone3	     = '" . db_input($vars['provider_phone3'], false) . "',  " .
            " 	provider_phone4	     = '" . db_input($vars['provider_phone4'], false) . "',  " .
            " 	provider_phone5	     = '" . db_input($vars['provider_phone5'], false) . "',  " .
            " 	provider_phone6	     = '" . db_input($vars['provider_phone6'], false) . "',  " .
            " 	provider_phone7	     = '" . db_input($vars['provider_phone7'], false) . "',  " .
            " 	primary_route1	     = '" . db_input($vars['primary_route1'], false) . "',  " .
            " 	primary_route2	     = '" . db_input($vars['primary_route2'], false) . "',  " .
            " 	primary_route3	     = '" . db_input($vars['primary_route3'], false) . "',  " .
            " 	primary_route4	     = '" . db_input($vars['primary_route4'], false) . "',  " .
            " 	primary_route5	     = '" . db_input($vars['primary_route5'], false) . "',  " .
            " 	primary_route6	     = '" . db_input($vars['primary_route6'], false) . "',  " .
            " 	primary_route7	     = '" . db_input($vars['primary_route7'], false) . "',  " .
            " 	service_status1	     = '" . db_input($vars['service_status1'], false) . "',  " .
            " 	service_status2	     = '" . db_input($vars['service_status2'], false) . "',  " .
            " 	service_status3	     = '" . db_input($vars['service_status3'], false) . "',  " .
            " 	service_status4	     = '" . db_input($vars['service_status4'], false) . "',  " .
            " 	service_status5	     = '" . db_input($vars['service_status5'], false) . "',  " .
            " 	service_status6	     = '" . db_input($vars['service_status6'], false) . "',  " .
            " 	service_status7	     = '" . db_input($vars['service_status7'], false) . "',  " .
            " 	contact_term1	     = '" . db_input($vars['contact_term1'], false) . "',  " .
            " 	contact_term2	     = '" . db_input($vars['contact_term2'], false) . "',  " .
            " 	contact_term3	     = '" . db_input($vars['contact_term3'], false) . "',  " .
            " 	contact_term4	     = '" . db_input($vars['contact_term4'], false) . "',  " .
            " 	contact_term5	     = '" . db_input($vars['contact_term5'], false) . "',  " .
            " 	contact_term6	     = '" . db_input($vars['contact_term6'], false) . "',  " .
            " 	contact_term7	     = '" . db_input($vars['contact_term7'], false) . "',  " .
            " 	wireless_enabled1	     = '" . db_input($vars['wireless_enabled1'], false) . "',  " .
            " 	wireless_enabled2	     = '" . db_input($vars['wireless_enabled2'], false) . "',  " .
            " 	wireless_enabled3	     = '" . db_input($vars['wireless_enabled3'], false) . "',  " .
            " 	wireless_enabled4	     = '" . db_input($vars['wireless_enabled4'], false) . "',  " .
            " 	wireless_enabled5	     = '" . db_input($vars['wireless_enabled5'], false) . "',  " .
            " 	wireless_enabled6	     = '" . db_input($vars['wireless_enabled6'], false) . "',  " .
            " 	wireless_enabled7	     = '" . db_input($vars['wireless_enabled7'], false) . "',  " .
            " 	service_id1	     = '" . db_input($vars['service_id1'], false) . "',  " .
            " 	service_id2	     = '" . db_input($vars['service_id2'], false) . "',  " .
            " 	service_id3	     = '" . db_input($vars['service_id3'], false) . "',  " .
            " 	service_id4	     = '" . db_input($vars['service_id4'], false) . "',  " .
            " 	service_id5	     = '" . db_input($vars['service_id5'], false) . "',  " .
            " 	service_id6	     = '" . db_input($vars['service_id6'], false) . "',  " .
            " 	service_id7	     = '" . db_input($vars['service_id7'], false) . "',  " .
            " 	device_type1	     = '" . db_input($vars['device_type1'], false) . "',  " .
            " 	device_type2	     = '" . db_input($vars['device_type2'], false) . "',  " .
            " 	device_type3	     = '" . db_input($vars['device_type3'], false) . "',  " .
            " 	device_type4	     = '" . db_input($vars['device_type4'], false) . "',  " .
            " 	device_type5	     = '" . db_input($vars['device_type5'], false) . "',  " .
            " 	device_type6	     = '" . db_input($vars['device_type6'], false) . "',  " .
            " 	device_type7	     = '" . db_input($vars['device_type7'], false) . "',  " .
            " 	loc_id1	     = '" . db_input($vars['loc_id1'], false) . "',  " .
            " 	loc_id2	     = '" . db_input($vars['loc_id2'], false) . "',  " .
            " 	loc_id3	     = '" . db_input($vars['loc_id3'], false) . "',  " .
            " 	loc_id4	     = '" . db_input($vars['loc_id4'], false) . "',  " .
            " 	loc_id5	     = '" . db_input($vars['loc_id5'], false) . "',  " .
            " 	loc_id6	     = '" . db_input($vars['loc_id6'], false) . "',  " .
            " 	loc_id7	     = '" . db_input($vars['loc_id7'], false) . "',  " .
            " 	hardware_brand1	     = '" . db_input($vars['hardware_brand1'], false) . "',  " .
            " 	hardware_brand2	     = '" . db_input($vars['hardware_brand2'], false) . "',  " .
            " 	hardware_brand3	     = '" . db_input($vars['hardware_brand3'], false) . "',  " .
            " 	hardware_brand4	     = '" . db_input($vars['hardware_brand4'], false) . "',  " .
            " 	hardware_brand5	     = '" . db_input($vars['hardware_brand5'], false) . "',  " .
            " 	hardware_brand6	     = '" . db_input($vars['hardware_brand6'], false) . "',  " .
            " 	hardware_brand7	     = '" . db_input($vars['hardware_brand7'], false) . "',  " .
            " 	hardware_model1	     = '" . db_input($vars['hardware_model1'], false) . "',  " .
            " 	hardware_model2	     = '" . db_input($vars['hardware_model2'], false) . "',  " .
            " 	hardware_model3	     = '" . db_input($vars['hardware_model3'], false) . "',  " .
            " 	hardware_model4	     = '" . db_input($vars['hardware_model4'], false) . "',  " .
            " 	hardware_model5	     = '" . db_input($vars['hardware_model5'], false) . "',  " .
            " 	hardware_model6	     = '" . db_input($vars['hardware_model6'], false) . "',  " .
            " 	hardware_model7	     = '" . db_input($vars['hardware_model7'], false) . "',  " .
            " 	hardware_device_ip1	     = '" . db_input($vars['hardware_device_ip1'], false) . "',  " .
            " 	hardware_device_ip2	     = '" . db_input($vars['hardware_device_ip2'], false) . "',  " .
            " 	hardware_device_ip3	     = '" . db_input($vars['hardware_device_ip3'], false) . "',  " .
            " 	hardware_device_ip4	     = '" . db_input($vars['hardware_device_ip4'], false) . "',  " .
            " 	hardware_device_ip5	     = '" . db_input($vars['hardware_device_ip5'], false) . "',  " .
            " 	hardware_device_ip6	     = '" . db_input($vars['hardware_device_ip6'], false) . "',  " .
            " 	hardware_device_ip7	     = '" . db_input($vars['hardware_device_ip7'], false) . "',  " .
            " 	device_username1	     = '" . db_input($vars['device_username1'], false) . "',  " .
            " 	device_username2	     = '" . db_input($vars['device_username2'], false) . "',  " .
            " 	device_username3	     = '" . db_input($vars['device_username3'], false) . "',  " .
            " 	device_username4	     = '" . db_input($vars['device_username4'], false) . "',  " .
            " 	device_username5	     = '" . db_input($vars['device_username5'], false) . "',  " .
            " 	device_username6	     = '" . db_input($vars['device_username6'], false) . "',  " .
            " 	device_username7	     = '" . db_input($vars['device_username7'], false) . "',  " .
            " 	service_telnum1	     = '" . db_input($vars['service_telnum1'], false) . "',  " .
            " 	service_telnum2	     = '" . db_input($vars['service_telnum2'], false) . "',  " .
            " 	service_telnum3	     = '" . db_input($vars['service_telnum3'], false) . "',  " .
            " 	service_telnum4	     = '" . db_input($vars['service_telnum4'], false) . "',  " .
            " 	service_telnum5	     = '" . db_input($vars['service_telnum5'], false) . "',  " .
            " 	service_telnum6	     = '" . db_input($vars['service_telnum6'], false) . "',  " .
            " 	service_telnum7	     = '" . db_input($vars['service_telnum7'], false) . "',  " .
            " 	device_password1	     = '" . db_input($vars['device_password1'], false) . "',  " .
            " 	device_password2	     = '" . db_input($vars['device_password2'], false) . "',  " .
            " 	device_password3	     = '" . db_input($vars['device_password3'], false) . "',  " .
            " 	device_password4	     = '" . db_input($vars['device_password4'], false) . "',  " .
            " 	device_password5	     = '" . db_input($vars['device_password5'], false) . "',  " .
            " 	device_password6	     = '" . db_input($vars['device_password6'], false) . "',  " .
            " 	device_password7	     = '" . db_input($vars['device_password7'], false) . "',  " .
            " 	mac_id1	     = '" . db_input($vars['mac_id1'], false) . "',  " .
            " 	mac_id2	     = '" . db_input($vars['mac_id2'], false) . "',  " .
            " 	mac_id3	     = '" . db_input($vars['mac_id3'], false) . "',  " .
            " 	mac_id4	     = '" . db_input($vars['mac_id4'], false) . "',  " .
            " 	mac_id5	     = '" . db_input($vars['mac_id5'], false) . "',  " .
            " 	mac_id6	     = '" . db_input($vars['mac_id6'], false) . "',  " .
            " 	mac_id7	     = '" . db_input($vars['mac_id7'], false) . "',  " .
            " 	balance_contract1	     = '" . db_input($vars['balance_contract1'], false) . "',  " .
            " 	balance_contract2	     = '" . db_input($vars['balance_contract2'], false) . "',  " .
            " 	balance_contract3	     = '" . db_input($vars['balance_contract3'], false) . "',  " .
            " 	balance_contract4	     = '" . db_input($vars['balance_contract4'], false) . "',  " .
            " 	balance_contract5	     = '" . db_input($vars['balance_contract5'], false) . "',  " .
            " 	balance_contract6	     = '" . db_input($vars['balance_contract6'], false) . "',  " .
            " 	balance_contract7	     = '" . db_input($vars['balance_contract7'], false) . "',  " .
            " 	wireless_ssd1	     = '" . db_input($vars['wireless_ssd1'], false) . "',  " .
            " 	wireless_ssd2	     = '" . db_input($vars['wireless_ssd2'], false) . "',  " .
            " 	wireless_ssd3	     = '" . db_input($vars['wireless_ssd3'], false) . "',  " .
            " 	wireless_ssd4	     = '" . db_input($vars['wireless_ssd4'], false) . "',  " .
            " 	wireless_ssd5	     = '" . db_input($vars['wireless_ssd5'], false) . "',  " .
            " 	wireless_ssd6	     = '" . db_input($vars['wireless_ssd6'], false) . "',  " .
            " 	wireless_ssd7	     = '" . db_input($vars['wireless_ssd7'], false) . "',  " .
            " 	mrc1	     = '" . db_input($vars['mrc1'], false) . "',  " .
            " 	mrc2	     = '" . db_input($vars['mrc2'], false) . "',  " .
            " 	mrc3	     = '" . db_input($vars['mrc3'], false) . "',  " .
            " 	mrc4	     = '" . db_input($vars['mrc4'], false) . "',  " .
            " 	mrc5	     = '" . db_input($vars['mrc5'], false) . "',  " .
            " 	mrc6	     = '" . db_input($vars['mrc6'], false) . "',  " .
            " 	mrc7	     = '" . db_input($vars['mrc7'], false) . "',  " .
            " 	wireless_password1	     = '" . db_input($vars['wireless_password1'], false) . "',  " .
            " 	wireless_password2	     = '" . db_input($vars['wireless_password2'], false) . "',  " .
            " 	wireless_password3	     = '" . db_input($vars['wireless_password3'], false) . "',  " .
            " 	wireless_password4	     = '" . db_input($vars['wireless_password4'], false) . "',  " .
            " 	wireless_password5	     = '" . db_input($vars['wireless_password5'], false) . "',  " .
            " 	wireless_password6	     = '" . db_input($vars['wireless_password6'], false) . "',  " .
            " 	wireless_password7	     = '" . db_input($vars['wireless_password7'], false) . "',  " .
            " 	etf1	     = '" . db_input($vars['etf1'], false) . "',  " .
            " 	etf2	     = '" . db_input($vars['etf2'], false) . "',  " .
            " 	etf3	     = '" . db_input($vars['etf3'], false) . "',  " .
            " 	etf4	     = '" . db_input($vars['etf4'], false) . "',  " .
            " 	etf5	     = '" . db_input($vars['etf5'], false) . "',  " .
            " 	etf6	     = '" . db_input($vars['etf6'], false) . "',  " .
            " 	etf7	     = '" . db_input($vars['etf7'], false) . "',  " .
            " 	wireless_comments1	     = '" . db_input($vars['wireless_comments1'], false) . "',  " .
            " 	wireless_comments2	     = '" . db_input($vars['wireless_comments2'], false) . "',  " .
            " 	wireless_comments3	     = '" . db_input($vars['wireless_comments3'], false) . "',  " .
            " 	wireless_comments4	     = '" . db_input($vars['wireless_comments4'], false) . "',  " .
            " 	wireless_comments5	     = '" . db_input($vars['wireless_comments5'], false) . "',  " .
            " 	wireless_comments6	     = '" . db_input($vars['wireless_comments6'], false) . "',  " .
            " 	wireless_comments7	     = '" . db_input($vars['wireless_comments7'], false) . "',  " .
            " 	order_date1	     = '" . db_input($vars['order_date1'], false) . "',  " .
            " 	order_date2	     = '" . db_input($vars['order_date2'], false) . "',  " .
            " 	order_date3	     = '" . db_input($vars['order_date3'], false) . "',  " .
            " 	order_date4	     = '" . db_input($vars['order_date4'], false) . "',  " .
            " 	order_date5	     = '" . db_input($vars['order_date5'], false) . "',  " .
            " 	order_date6	     = '" . db_input($vars['order_date6'], false) . "',  " .
            " 	order_date7	     = '" . db_input($vars['order_date7'], false) . "',  " .
            " 	order_by1	     = '" . db_input($vars['order_by1'], false) . "',  " .
            " 	order_by2	     = '" . db_input($vars['order_by2'], false) . "',  " .
            " 	order_by3	     = '" . db_input($vars['order_by3'], false) . "',  " .
            " 	order_by4	     = '" . db_input($vars['order_by4'], false) . "',  " .
            " 	order_by5	     = '" . db_input($vars['order_by5'], false) . "',  " .
            " 	order_by6	     = '" . db_input($vars['order_by6'], false) . "',  " .
            " 	order_by7	     = '" . db_input($vars['order_by7'], false) . "',  " .
            " 	order_ref1	     = '" . db_input($vars['order_ref1'], false) . "',  " .
            " 	order_ref2	     = '" . db_input($vars['order_ref2'], false) . "',  " .
            " 	order_ref3	     = '" . db_input($vars['order_ref3'], false) . "',  " .
            " 	order_ref4	     = '" . db_input($vars['order_ref4'], false) . "',  " .
            " 	order_ref5	     = '" . db_input($vars['order_ref5'], false) . "',  " .
            " 	order_ref6	     = '" . db_input($vars['order_ref6'], false) . "',  " .
            " 	order_ref7	     = '" . db_input($vars['order_ref7'], false) . "',  " .
            " 	activation_date1	     = '" . db_input($vars['activation_date1'], false) . "',  " .
            " 	activation_date2	     = '" . db_input($vars['activation_date2'], false) . "',  " .
            " 	activation_date3	     = '" . db_input($vars['activation_date3'], false) . "',  " .
            " 	activation_date4	     = '" . db_input($vars['activation_date4'], false) . "',  " .
            " 	activation_date5	     = '" . db_input($vars['activation_date5'], false) . "',  " .
            " 	activation_date6	     = '" . db_input($vars['activation_date6'], false) . "',  " .
            " 	activation_date7	     = '" . db_input($vars['activation_date7'], false) . "',  " .
            " 	activation_by1	     = '" . db_input($vars['activation_by1'], false) . "',  " .
            " 	activation_by2	     = '" . db_input($vars['activation_by2'], false) . "',  " .
            " 	activation_by3	     = '" . db_input($vars['activation_by3'], false) . "',  " .
            " 	activation_by4	     = '" . db_input($vars['activation_by4'], false) . "',  " .
            " 	activation_by5	     = '" . db_input($vars['activation_by5'], false) . "',  " .
            " 	activation_by6	     = '" . db_input($vars['activation_by6'], false) . "',  " .
            " 	activation_by7	     = '" . db_input($vars['activation_by7'], false) . "',  " .
            " 	activation_ref1	     = '" . db_input($vars['activation_ref1'], false) . "',  " .
            " 	activation_ref2	     = '" . db_input($vars['activation_ref2'], false) . "',  " .
            " 	activation_ref3	     = '" . db_input($vars['activation_ref3'], false) . "',  " .
            " 	activation_ref4	     = '" . db_input($vars['activation_ref4'], false) . "',  " .
            " 	activation_ref5	     = '" . db_input($vars['activation_ref5'], false) . "',  " .
            " 	activation_ref6	     = '" . db_input($vars['activation_ref6'], false) . "',  " .
            " 	activation_ref7	     = '" . db_input($vars['activation_ref7'], false) . "',  " .
            " 	cancellation_date1	     = '" . db_input($vars['cancellation_date1'], false) . "',  " .
            " 	cancellation_date2	     = '" . db_input($vars['cancellation_date2'], false) . "',  " .
            " 	cancellation_date3	     = '" . db_input($vars['cancellation_date3'], false) . "',  " .
            " 	cancellation_date4	     = '" . db_input($vars['cancellation_date4'], false) . "',  " .
            " 	cancellation_date5	     = '" . db_input($vars['cancellation_date5'], false) . "',  " .
            " 	cancellation_date6	     = '" . db_input($vars['cancellation_date6'], false) . "',  " .
            " 	cancellation_date7	     = '" . db_input($vars['cancellation_date7'], false) . "',  " .
            " 	cancellation_by1	     = '" . db_input($vars['cancellation_by1'], false) . "',  " .
            " 	cancellation_by2	     = '" . db_input($vars['cancellation_by2'], false) . "',  " .
            " 	cancellation_by3	     = '" . db_input($vars['cancellation_by3'], false) . "',  " .
            " 	cancellation_by4	     = '" . db_input($vars['cancellation_by4'], false) . "',  " .
            " 	cancellation_by5	     = '" . db_input($vars['cancellation_by5'], false) . "',  " .
            " 	cancellation_by6	     = '" . db_input($vars['cancellation_by6'], false) . "',  " .
            " 	cancellation_by7	     = '" . db_input($vars['cancellation_by7'], false) . "',  " .
            " 	cancellation_ref1	     = '" . db_input($vars['cancellation_ref1'], false) . "',  " .
            " 	cancellation_ref2	     = '" . db_input($vars['cancellation_ref2'], false) . "',  " .
            " 	cancellation_ref3	     = '" . db_input($vars['cancellation_ref3'], false) . "',  " .
            " 	cancellation_ref4	     = '" . db_input($vars['cancellation_ref4'], false) . "',  " .
            " 	cancellation_ref5	     = '" . db_input($vars['cancellation_ref5'], false) . "',  " .
            " 	cancellation_ref6	     = '" . db_input($vars['cancellation_ref6'], false) . "',  " .
            " 	cancellation_ref7	     = '" . db_input($vars['cancellation_ref7'], false) . "',  " .

//            " 	subnet_mask1	 = '" . db_input($vars['subnet_mask1'], false) . "',  " .
//            " 	subnet_mask2	 = '" . db_input($vars['subnet_mask2'], false) . "',  " .
//            " 	subnet_mask3	 = '" . db_input($vars['subnet_mask3'], false) . "',  " .
//            " 	primary_dns1	 = '" . db_input($vars['primary_dns1'], false) . "',  " .
//            " 	primary_dns2	 = '" . db_input($vars['primary_dns2'], false) . "',  " .
//            " 	primary_dns3	 = '" . db_input($vars['primary_dns3'], false) . "',  " .
//            " 	secondary_dns1	 = '" . db_input($vars['secondary_dns1'], false) . "',  " .
//            " 	secondary_dns2	 = '" . db_input($vars['secondary_dns2'], false) . "',  " .
//            " 	secondary_dns3	 = '" . db_input($vars['secondary_dns3'], false) . "',  " .
//            " 	ip_pbx_brand1	 = '" . db_input($vars['ip_pbx_brand1'], false) . "',  " .
//            " 	ip_pbx_brand2	 = '" . db_input($vars['ip_pbx_brand2'], false) . "',  " .
//            " 	ip_pbx_brand3	 = '" . db_input($vars['ip_pbx_brand3'], false) . "',  " .
//            " 	ip_pbx_model1	 = '" . db_input($vars['ip_pbx_model1'], false) . "',  " .
//            " 	ip_pbx_model2	 = '" . db_input($vars['ip_pbx_model2'], false) . "',  " .
//            " 	ip_pbx_model3	 = '" . db_input($vars['ip_pbx_model3'], false) . "',  " .
//            " 	serial_number1	 = '" . db_input($vars['serial_number1'], false) . "',  " .
//            " 	serial_number2	 = '" . db_input($vars['serial_number2'], false) . "',  " .
//            " 	serial_number3	 = '" . db_input($vars['serial_number3'], false) . "',  " .
//            " 	unique_id1	 = '" . db_input($vars['unique_id1'], false) . "',  " .
//            " 	unique_id2	 = '" . db_input($vars['unique_id2'], false) . "',  " .
//            " 	unique_id3	 = '" . db_input($vars['unique_id3'], false) . "',  " .

            "   trading		     = '" . db_input($vars['trading'], false) . "', " .
            " 	abn	             = '" . db_input($vars['abn'], false) . "',  " .
            " 	acn	             = '" . db_input($vars['acn'], false) . "',  " .
            " 	position	     = '" . db_input($vars['position'], false) . "',  " .
            " 	license_id	     = '" . db_input($vars['license_id'], false) . "',  " .
             " 	passport_id	     = '" . db_input($vars['passport_id'], false) . "',  " .
            " 	fax	             = '" . db_input($vars['fax'], false) . "',  " .
            " 	fax_ext	         = '" . db_input($vars['fax_ext'], false) . "',  " .
            " 	city	         = '" . db_input($vars['city'], false) . "',  " .
            " 	country	         = '" . db_input($vars['country'], false) . "',  " .
            "   other_contact    = '" . db_input(Format::striptags($vars['other_contact']), false) . "' , " .
            " 	other_phone	     = '" . db_input($vars['other_phone'], false) . "',  " .
            " 	other_mobile	 = '" . db_input($vars['other_mobile'], false) . "',  " .
            " 	other_email	     = '" . db_input($vars['other_email'], false) . "',  " .
            " 	other_contact1	 = '" . db_input($vars['other_contact1'], false) . "',  " .
            " 	other_position1	 = '" . db_input($vars['other_position1'], false) . "',  " .
            " 	other_phone1	 = '" . db_input($vars['other_phone1'], false) . "',  " .
            " 	other_mobile1	 = '" . db_input($vars['other_mobile1'], false) . "',  " .
            " 	other_email1	 = '" . db_input($vars['other_email1'], false) . "',  " .
            " 	other_contact2	 = '" . db_input(Format::striptags($vars['other_contact2']), false) . "' , " .
            " 	other_position2	 = '" . db_input($vars['other_position2'], false) . "',  " .
            " 	other_phone2	 = '" . db_input($vars['other_phone2'], false) . "',  " .
            " 	other_mobile2	 = '" . db_input($vars['other_mobile2'], false) . "',  " .
            " 	other_email2	 = '" . db_input($vars['other_email2'], false) . "',  " .

            " 	surname	         = '" . db_input(Format::striptags($vars['surname']), false) . "' , " .
            " 	pri_birth	     = '" . db_input($vars['pri_birth'], false) . "',  " .
            " 	gender	         = '" . db_input($vars['gender'], false) . "',  " .

            " 	fax_in_svc_no	         = '" . db_input($vars['fax_in_svc_no'], false) . "',  " .
            " 	fax_in_svc_status	     = '" . db_input($vars['fax_in_svc_status'], false) . "',  " .
            " 	fax_in_svc_type	         = '" . db_input($vars['fax_in_svc_type'], false) . "',  " .
            " 	fax_in_svc_provider	     = '" . db_input($vars['fax_in_svc_provider'], false) . "',  " .
            " 	fax_in_svc_id	         = '" . db_input($vars['fax_in_svc_id'], false) . "',  " .
            " 	fax_in_epn1_svc_no	     = '" . db_input($vars['fax_in_epn1_svc_no'], false) . "',  " .
            " 	fax_in_epn1_svc_status	 = '" . db_input($vars['fax_in_epn1_svc_status'], false) . "',  " .
            " 	fax_in_epn1_svc_type	 = '" . db_input($vars['fax_in_epn1_svc_type'], false) . "',  " .
            " 	fax_in_epn1_svc_provider = '" . db_input($vars['fax_in_epn1_svc_provider'], false) . "',  " .
            " 	fax_in_epn1_svc_id	     = '" . db_input($vars['fax_in_epn1_svc_id'], false) . "',  " .
            " 	fax_in_epn2_svc_no	     = '" . db_input($vars['fax_in_epn2_svc_no'], false) . "',  " .
            " 	fax_in_epn2_svc_status	 = '" . db_input($vars['fax_in_epn2_svc_status'], false) . "',  " .
            " 	fax_in_epn2_svc_type	 = '" . db_input($vars['fax_in_epn2_svc_type'], false) . "',  " .
            " 	fax_in_epn2_svc_provider = '" . db_input($vars['fax_in_epn2_svc_provider'], false) . "',  " .
            " 	fax_in_epn2_svc_id	     = '" . db_input($vars['fax_in_epn2_svc_id'], false) . "',  " .
            " 	fax_in_email1	         = '" . db_input($vars['fax_in_email1'], false) . "',  " .
            " 	fax_in_email2	         = '" . db_input($vars['fax_in_email2'], false) . "',  " .
            " 	fax_in_email3	         = '" . db_input($vars['fax_in_email3'], false) . "',  " .
            " 	fax_out_svc_no	         = '" . db_input($vars['fax_out_svc_no'], false) . "',  " .
            " 	fax_out_svc_status	     = '" . db_input($vars['fax_out_svc_status'], false) . "',  " .
            " 	fax_out_svc_type	     = '" . db_input($vars['fax_out_svc_type'], false) . "',  " .
            " 	fax_out_svc_provider	 = '" . db_input($vars['fax_out_svc_provider'], false) . "',  " .
            " 	fax_out_svc_id	         = '" . db_input($vars['fax_out_svc_id'], false) . "',  " .
            " 	fax_out_con_hd	         = '" . db_input($vars['fax_out_con_hd'], false) . "',  " .
            " 	fax_out_svc_prd_other	 = '" . db_input($vars['fax_out_svc_prd_other'], false) . "',  " .
            " 	fax_out_brand	         = '" . db_input($vars['fax_out_brand'], false) . "',  " .
            " 	fax_out_model	         = '" . db_input($vars['fax_out_model'], false) . "',  " .
            " 	fax_out_device	         = '" . db_input($vars['fax_out_device'], false) . "',  " .
            " 	fax_out_device_other	 = '" . db_input($vars['fax_out_device_other'], false) . "',  " .
            " 	fax_out_if	             = '" . db_input($vars['fax_out_if'], false) . "',  " .
            " 	fax_out_if_other	     = '" . db_input($vars['fax_out_if_other'], false) . "',  " .
            " 	fax_out_static_ip	     = '" . db_input($vars['fax_out_static_ip'], false) . "',  " .

            " 	inb_svc_stat1	     = '" . db_input($vars['inb_svc_stat1'], false) . "',  " .
            " 	inb_svc_stat2	     = '" . db_input($vars['inb_svc_stat2'], false) . "',  " .
            " 	inb_svc_stat3	     = '" . db_input($vars['inb_svc_stat3'], false) . "',  " .
            " 	inb_number1	         = '" . db_input($vars['inb_number1'], false) . "',  " .
            " 	inb_number2	         = '" . db_input($vars['inb_number2'], false) . "',  " .
            " 	inb_number3	         = '" . db_input($vars['inb_number3'], false) . "',  " .
            " 	inb_epn1	         = '" . db_input($vars['inb_epn1'], false) . "',  " .
            " 	inb_epn2	         = '" . db_input($vars['inb_epn2'], false) . "',  " .
            " 	inb_epn3	         = '" . db_input($vars['inb_epn3'], false) . "',  " .
            " 	inb_fmn1	         = '" . db_input($vars['inb_fmn1'], false) . "',  " .
            " 	inb_fmn2	         = '" . db_input($vars['inb_fmn2'], false) . "',  " .
            " 	inb_fmn3	         = '" . db_input($vars['inb_fmn3'], false) . "',  " .
            " 	inb_svc_type1	     = '" . db_input($vars['inb_svc_type1'], false) . "',  " .
            " 	inb_svc_type2	     = '" . db_input($vars['inb_svc_type2'], false) . "',  " .
            " 	inb_svc_type3	     = '" . db_input($vars['inb_svc_type3'], false) . "',  " .
            " 	inb_up_provider1	 = '" . db_input($vars['inb_up_provider1'], false) . "',  " .
            " 	inb_up_provider2	 = '" . db_input($vars['inb_up_provider2'], false) . "',  " .
            " 	inb_up_provider3	 = '" . db_input($vars['inb_up_provider3'], false) . "',  " .
            " 	inb_up_refid1	     = '" . db_input($vars['inb_up_refid1'], false) . "',  " .
            " 	inb_up_refid2	     = '" . db_input($vars['inb_up_refid2'], false) . "',  " .
            " 	inb_up_refid3	     = '" . db_input($vars['inb_up_refid3'], false) . "',  " .
            " 	inb_com_routing1	 = '" . db_input($vars['inb_com_routing1'], false) . "',  " .
            " 	inb_com_routing2	 = '" . db_input($vars['inb_com_routing2'], false) . "',  " .
            " 	inb_com_routing3	 = '" . db_input($vars['inb_com_routing3'], false) . "',  " .
            " 	inb_com_r_other1	 = '" . db_input($vars['inb_com_r_other1'], false) . "',  " .
            " 	inb_com_r_other2	 = '" . db_input($vars['inb_com_r_other2'], false) . "',  " .
            " 	inb_com_r_other3	 = '" . db_input($vars['inb_com_r_other3'], false) . "',  " .
            " 	inb_routing_other1	 = '" . db_input($vars['inb_routing_other1'], false) . "',  " .
            " 	inb_routing_other2	 = '" . db_input($vars['inb_routing_other2'], false) . "',  " .
            " 	inb_routing_other3	 = '" . db_input($vars['inb_routing_other3'], false) . "',  " .
            " 	inb_d_svc_act1	     = '" . db_input($vars['inb_d_svc_act1'], false) . "',  " .
            " 	inb_d_svc_act2	     = '" . db_input($vars['inb_d_svc_act2'], false) . "',  " .
            " 	inb_d_svc_act3	     = '" . db_input($vars['inb_d_svc_act3'], false) . "',  " .
            " 	inb_d_svc_cancel1	 = '" . db_input($vars['inb_d_svc_cancel1'], false) . "',  " .
            " 	inb_d_svc_cancel2	 = '" . db_input($vars['inb_d_svc_cancel2'], false) . "',  " .
            " 	inb_d_svc_cancel3	 = '" . db_input($vars['inb_d_svc_cancel3'], false) . "',  " .

            " 	custom_type	         = '" . db_input($vars['custom_type'], false) . "',  " .
            " 	website	             = '" . db_input($vars['website'], false) . "',  " .
            " 	title	             = '" . db_input($vars['title'], false) . "',  " .
            " 	middlename	         = '" . db_input($vars['middlename'], false) . "',  " .
            " 	plan_code	         = '" . db_input($vars['plan_code'], false) . "',  " .

            " 	inbound_phone	         = '" . db_input($vars['inbound_phone'], false) . "',  " .
            " 	inbound_phone_ext	         = '" . db_input($vars['inbound_phone_ext'], false) . "',  " .
            " 	inbound_fax	         = '" . db_input($vars['inbound_fax'], false) . "',  " .
            " 	inbound_fax_ext	         = '" . db_input($vars['inbound_fax_ext'], false) . "',  " .

            " 	trust	             = '" . db_input($vars['trust'], false) . "',  " .
            " 	busicat	             = '" . db_input($vars['busicat'], false) . "',  " .

            " 	sip_number1	             = '" . db_input($vars['sip_number1'], false) . "',  " .
            " 	sip_number2	             = '" . db_input($vars['sip_number2'], false) . "',  " .
            " 	sip_number3	             = '" . db_input($vars['sip_number3'], false) . "',  " .
            " 	sip_use1	             = '" . db_input($vars['sip_use1'], false) . "',  " .
            " 	sip_use2	             = '" . db_input($vars['sip_use2'], false) . "',  " .
            " 	sip_use3	             = '" . db_input($vars['sip_use3'], false) . "',  " .
            " 	sip_use_other1	             = '" . db_input($vars['sip_use_other1'], false) . "',  " .
            " 	sip_use_other2	             = '" . db_input($vars['sip_use_other2'], false) . "',  " .
            " 	sip_use_other3	             = '" . db_input($vars['sip_use_other3'], false) . "',  " .
            " 	sip_upstream1	             = '" . db_input($vars['sip_upstream1'], false) . "',  " .
            " 	sip_upstream2	             = '" . db_input($vars['sip_upstream2'], false) . "',  " .
            " 	sip_upstream3	             = '" . db_input($vars['sip_upstream3'], false) . "',  " .
            " 	sip_connect1	             = '" . db_input($vars['sip_connect1'], false) . "',  " .
            " 	sip_connect2	             = '" . db_input($vars['sip_connect2'], false) . "',  " .
            " 	sip_connect3	             = '" . db_input($vars['sip_connect3'], false) . "',  " .
            " 	sip_conn_other1	             = '" . db_input($vars['sip_conn_other1'], false) . "',  " .
            " 	sip_conn_other2	             = '" . db_input($vars['sip_conn_other2'], false) . "',  " .
            " 	sip_conn_other3	             = '" . db_input($vars['sip_conn_other3'], false) . "',  " .

            " 	custom_status	             = '" . db_input($vars['custom_status'], false) . "',  " .
            " 	preferredname	             = '" . db_input($vars['preferredname'], false) . "',  " .

            " 	direct_phone	             = '" . db_input($vars['direct_phone'], false) . "',  " .
            " 	acnt_rand_no	             = '" . db_input($vars['acnt_rand_no'], false) . "',  " .
            " 	acnt_rand_manager            = '" . db_input($vars['acnt_rand_manager'], false) . "',  " .

            "	email2		 = '" . db_input($vars['email2'], false) . "' $where ";

        db_query($sql);


        /* added by hong*/
        // first delete all SIP license
        $license_del_sql = "delete from " . TABLE_PREFIX . "customer_siplicense where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($license_del_sql);
        if($vars['slicense'])
            // insert license
            for ($i = 0; $i < count($vars['slicense']['type1']); $i++) {
                $license_open_sql = "INSERT into " . TABLE_PREFIX . "customer_siplicense " .
                    " (type1,type2,type3,number1,number2,number3,customer_id,last_update) " .
                    " VALUES " .
                    " ('" . $vars['slicense']['type1'][$i] . "','" . $vars['slicense']['type2'][$i] . "','" . $vars['slicense']['type3'][$i] . "',
                                                '" . $vars['slicense']['num1'][$i] . "','" . $vars['slicense']['num2'][$i] . "','" . $vars['slicense']['num3'][$i] . "','" . $_REQUEST['id'] . "', now())";
                $ret = db_query($license_open_sql);
            }

        // first delete all SIP hardware
        $hwd_del_sql = "delete from " . TABLE_PREFIX . "customer_siphwd where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($hwd_del_sql);

        if($vars['hwd'])
        // insert hardware
        for ($i = 0; $i < count($vars['hwd']['type1']); $i++) {
            $hwd_open_sql = "INSERT into " . TABLE_PREFIX . "customer_siphwd " .
                " (type1,type2,type3,model1,model2,model3,qty1,qty2,qty3,customer_id,last_update) " .
                " VALUES " .
                " ('" . $vars['hwd']['type1'][$i] . "','" . $vars['hwd']['type2'][$i] . "','" . $vars['hwd']['type3'][$i] . "',
											'" . $vars['hwd']['model1'][$i] . "','" . $vars['hwd']['model2'][$i] . "','" . $vars['hwd']['model3'][$i] . "',
											'" . $vars['hwd']['qty1'][$i] . "','" . $vars['hwd']['qty2'][$i] . "','" . $vars['hwd']['qty3'][$i] . "','" . $_REQUEST['id'] . "', now())";
            $ret = db_query($hwd_open_sql);
        }

        // first delete all Wifi hardware
        $wifihwd_del_sql = "delete from " . TABLE_PREFIX . "customer_wifihwd where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($wifihwd_del_sql);

        if($vars['hwdwifi'])
        // insert wifi hardware
        for ($i = 0; $i < count($vars['hwdwifi']['ssidname']); $i++) {
            $wifihwd_open_sql = "INSERT into " . TABLE_PREFIX . "customer_wifihwd " .
                " (ssidname, ssidpwd, svcname, peip, svcother, peipuser, devtype, peippwd, devtypeother, devbrand," .
                "  authip, devmodel, authuser, devserial, authpwd, customer_id,last_update) " .
                " VALUES " .
                " ('" . $vars['hwdwifi']['ssidname'][$i] . "','" . $vars['hwdwifi']['ssidpwd'][$i] . "','" . $vars['hwdwifi']['svcname'][$i] . "',
											'" . $vars['hwdwifi']['peip'][$i] . "','" . $vars['hwdwifi']['svcother'][$i] . "','" . $vars['hwdwifi']['peipuser'][$i] . "',
											'" . $vars['hwdwifi']['devtype'][$i] . "','" . $vars['hwdwifi']['peippwd'][$i] . "','" . $vars['hwdwifi']['devtypeother'][$i] . "',
											'" . $vars['hwdwifi']['devbrand'][$i] . "','" . $vars['hwdwifi']['authip'][$i] . "','" . $vars['hwdwifi']['devmodel'][$i] . "',
											'" . $vars['hwdwifi']['authuser'][$i] . "','" . $vars['hwdwifi']['devserial'][$i] . "','" . $vars['hwdwifi']['authpwd'][$i] . "',
											'" . $_REQUEST['id'] . "', now())";
            $ret = db_query($wifihwd_open_sql);
        }

        // first delete all PC hardware
        $pchwd_del_sql = "delete from " . TABLE_PREFIX . "customer_pchwd where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($pchwd_del_sql);
        
        if($vars['hwdpc'])
        // insert PC hardware
        for ($i = 0; $i < count($vars['hwdpc']['devtype']); $i++) {
            $pchwd_open_sql = "INSERT into " . TABLE_PREFIX . "customer_pchwd " .
                " (devtype, other, owner, location, user, pwd, ipaddr, hosting, port, customer_id, last_update) " .
                " VALUES " .
                " ('" . $vars['hwdpc']['devtype'][$i] . "','" . $vars['hwdpc']['other'][$i] . "','" . $vars['hwdpc']['owner'][$i] . "',
											'" . $vars['hwdpc']['location'][$i] . "','" . $vars['hwdpc']['user'][$i] . "','" . $vars['hwdpc']['pwd'][$i] . "',
											'" . $vars['hwdpc']['ipaddr'][$i] . "','" . $vars['hwdpc']['hosting'][$i] . "','" . $vars['hwdpc']['port'][$i] . "',
											'" . $_REQUEST['id'] . "', now())";

            $ret = db_query($pchwd_open_sql);
        }

        // first delete all contacts information
        $cont_del_sql = "delete from " . TABLE_PREFIX . "customer_contacts where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($cont_del_sql);

        if($vars['cont'])
        // insert contacts
        for ($i = 0; $i < count($vars['cont']['person']); $i++) {
            $cont_open_sql = "INSERT into " . TABLE_PREFIX . "customer_contacts " .
                " (person,position,department,phone,mobile,email,customer_id,last_update) " .
                " VALUES " .
                " ('" . $vars['cont']['person'][$i] . "','" . $vars['cont']['position'][$i] . "','" . $vars['cont']['dept'][$i] . "','" .
                $vars['cont']['phone'][$i] . "','" . $vars['cont']['mobile'][$i] . "','" . $vars['cont']['email'][$i] . "','" . $_REQUEST['id'] . "', now())";
            $ret = db_query($cont_open_sql);
        }

        // first delete all notes information
        $notes_del_sql = "delete from " . TABLE_PREFIX . "customer_notes where customer_id= '" . $_REQUEST['id'] . "' ";
        db_query($notes_del_sql);

        if ($vars['notes'])
            // insert notes
            for ($i = 0; $i < count($vars['notes']['contents']); $i++) {
                $notes_open_sql = "INSERT into " . TABLE_PREFIX . "customer_notes " .
                    " (contents, customer_id, last_update) " .
                    " VALUES " .
                    " ('" . $vars['notes']['contents'][$i] . "','" . $_REQUEST['id'] . "', now())";
                $ret = db_query($notes_open_sql);
            }
        /* added by hong end */


        $success = "Record successfully updated";
        if (!$_REQUEST['id']) {
            $success = "Record successfully added";
            $_REQUEST['id'] = $mysqli->insert_id;
        }

        $res = db_query('select * from ' . TABLE_PREFIX . 'customer1 where id =  ' . intval($_REQUEST['id']));
        $customers_info = db_fetch_array($res);

    }

    // for edit customer
    $inc = 'customers-edit.inc.php';
}

if ($_REQUEST['a'] == 'export') {
    require_once(INCLUDE_DIR . 'class.export.php');
    require_once(INCLUDE_DIR . 'class.customers.export.php');
    $ts = strftime('%Y%m%d');
    if (!($token = $_REQUEST['h']))
        $errors['err'] = 'Query token required';
    elseif (!($query = $_SESSION['search_' . $token]))
        $errors['err'] = 'Query token not found';
    elseif (!customerExport::saveCustomers($query, "customers-$ts.csv", 'csv'))
        $errors['err'] = 'Internal error: Unable to dump query results';
}

//for new customer
if ($_REQUEST['a'] == 'new') {
    $inc = 'customers-edit.inc.php';
}
require_once(STAFFINC_DIR . 'header.inc.php');
require_once(STAFFINC_DIR . $inc);
require_once(STAFFINC_DIR . 'footer.inc.php');
?>
