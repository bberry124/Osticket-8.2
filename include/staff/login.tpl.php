<?php
include_once(INCLUDE_DIR.'staff/login.header.php');
$info = ($_POST && $errors)?Format::htmlchars($_POST):array();


if ($thisstaff && $thisstaff->is2FAPending())
    $msg = "2FA Pending";

?>
<div id="loginBox">
    <h1 id="logo"><a href="index.php">
        <span class="valign-helper"></span>
        <img src="logo.php?login" alt="osTicket :: <?php echo __('Staff Control Panel');?>" />
    </a></h1>
    <h3 id="login-message"><?php echo Format::htmlchars($msg); ?></h3>
    <div class="banner"><small><?php echo ($content) ? Format::display($content->getLocalBody()) : ''; ?></small></div>
    <div id="loading" style="display:none;" class="dialog">
        <h1><i class="icon-spinner icon-spin icon-large"></i>
        <?php echo __('Verifying');?></h1>
    </div>
    <form action="login.php" method="post" id="login" onsubmit="attemptLoginAjax(event)">
        <?php csrf_token();
        if ($thisstaff
                &&  $thisstaff->is2FAPending()
                && ($bk=$thisstaff->get2FABackend())
                && ($form=$bk->getInputForm($_POST))) {
            // Render 2FA input form
            include STAFFINC_DIR . 'templates/dynamic-form-simple.tmpl.php';
            ?>
            <fieldset style="padding-top:10px;">
            <input type="hidden" name="do" value="2fa">
            <button class="submit button pull-center" type="submit"
                name="submit"><i class="icon-signin"></i>
                <?php echo __('Verify'); ?>
            </button>
             </fieldset>
        <?php
        } else { ?>
            <input type="hidden" name="do" value="scplogin">
            <fieldset>
            <input type="text" name="userid" id="name" value="<?php
                echo $info['userid'] ?? null; ?>" placeholder="<?php echo __('Email or Username'); ?>"
                autofocus autocorrect="off" autocapitalize="off" >
            <input type="password" name="passwd" id="pass" maxlength="128" placeholder="<?php echo __('Password'); ?>" autocorrect="off" autocapitalize="off">
                <h3 style="display:inline"><a id="reset-link" class="<?php
                    if (!$show_reset || !$cfg->allowPasswordReset()) echo 'hidden';
                    ?>" href="pwreset.php"><?php echo __('Forgot My Password'); ?></a></h3>
                <input class="submit" type="submit" name="submit" value="<?php echo __('Log In'); ?>">
            </fieldset>
        <?php
        } ?>
    </form>
    <?php
$ext_bks = array();
foreach (StaffAuthenticationBackend::allRegistered() as $bk)
    if ($bk instanceof ExternalAuthentication)
        $ext_bks[] = $bk;

if (count($ext_bks)) { ?>
<div class="or">
    <hr/>
</div><?php
    foreach ($ext_bks as $bk) { ?>
<div class="external-auth"><?php $bk->renderExternalLink(); ?></div><?php
    }
} ?>
</div>
<div id="copyRights"><?php echo __('Integra Corporation Pty Ltd © | 1994 - 2024 | Version 7.1'); ?> </div>
</body>
</html>
