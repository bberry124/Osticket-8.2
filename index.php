<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/
require('client.inc.php');

require_once INCLUDE_DIR . 'class.page.php';

$section = 'home';
// require(CLIENTINC_DIR.'header.inc.php');
?>
<link rel="stylesheet" id="bootstrap-css-css" href="https://integra.net.au/wp-content/themes/integraone-new/css/bootstrap.min.css?ver=1.0.0" type="text/css" media="all">

<style>
    .ticket-wrapper {
        display: flex;
        flex-direction: column;
        width: 60%;
        align-items: center;
        margin: 0 auto;
    }
    
    .ticket-wrapper h3 {
        font-weight: bold;
    }
    
    .ticket-wrapper span {
        margin: 30px 0;
        min-height: 70px;
    }
    
    .ticket-wrapper img {
        width: 60px;
    }
    
    .ticket-wrapper a {
        text-decoration: none;
        cursor: pointer;
        height: 40px;
        font-size: 14px;
        margin-top: 40px;
        font-weight: bold;
        line-height: 40px;
        padding: 0 10px;
        color: #ffffff;
        background: linear-gradient(90deg,rgba(37,183,245,1),rgba(43,99,251,1));;
    }
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="ticket-wrapper">
            <img src="images/open-ticket.png">
            <h3>Open a New Ticket</h3>
            <span>Please provide as much detail as possible so we can best assist you. To update a previously submitted ticket, please login.</span>
            <a href="open.php">Open a New Ticket</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ticket-wrapper">
            <img src="images/check-ticket.png">
            <h3>Check Ticket Status</h3>
            <span>We provide archives and history of all your current and past support requests complete with responses.</span>
            <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>">Check Ticket Status</a>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<!--<div id="landing_page">-->
    <?php
    // if($cfg && ($page = $cfg->getLandingPage()))
    //     echo $page->getBodyWithImages();
    // else
    //     echo  '<h1>'.__('Welcome to the Support Center').'</h1>';
    ?>
<!--    <div id="new_ticket" class="pull-left">-->
<!--        <h3><?php echo __('Open a New Ticket');?></h3>-->
<!--        <br>-->
<!--        <div><?php echo __('Please provide as much detail as possible so we can best assist you. To update a previously submitted ticket, please login.');?></div>-->
<!--    </div>-->

<!--    <div id="check_status" class="pull-right">-->
<!--        <h3><?php echo __('Check Ticket Status');?></h3>-->
<!--        <br>-->
<!--        <div><?php echo __('We provide archives and history of all your current and past support requests complete with responses.');?></div>-->
<!--    </div>-->

<!--    <div class="clear"></div>-->
<!--    <div class="front-page-button pull-left">-->
<!--        <p>-->
<!--            <a href="open.php" class="green button"><?php echo __('Open a New Ticket');?></a>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="front-page-button pull-right">-->
<!--        <p>-->
<!--            <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>" class="blue button"><?php echo __('Check Ticket Status');?></a>-->
<!--        </p>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="clear"></div>-->
<?php
if($cfg && $cfg->isKnowledgebaseEnabled()){
    //FIXME: provide ability to feature or select random FAQs ??
?>
<p><?php echo sprintf(
    __('Be sure to browse our %s before opening a ticket'),
    sprintf('<a href="kb/index.php">%s</a>',
        __('Frequently Asked Questions (FAQs)')
    )); ?></p>
</div>
<?php
} ?>

<?php //require(CLIENTINC_DIR.'footer.inc.php'); ?>
