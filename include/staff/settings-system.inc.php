<?php
if(!defined('OSTADMININC') || !$thisstaff || !$thisstaff->isAdmin() || !$config) die('Access Denied');

$gmtime = Misc::gmtime();
?>
<h2><?php echo __('System Settings and Preferences');?> <small>— <span class="ltr">osTicket (<?php echo $cfg->getVersion(); ?>)</span></small></h2>
<form action="settings.php?t=system" method="post" class="save">
<?php csrf_token(); ?>
<input type="hidden" name="t" value="system" >
<table class="form_table settings_table" width="940" border="0" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th colspan="2">
                <h4><?php echo __('System Settings and Preferences'); ?></h4>
                <em><b><?php echo __('General Settings'); ?></b></em>
            </th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td width="220" class="required"><?php echo __('Helpdesk Status');?>:</td>
            <td>
                <span>
                <label><input type="radio" name="isonline"  value="1"   <?php echo $config['isonline']?'checked="checked"':''; ?> />&nbsp;<b><?php echo __('Online'); ?></b>&nbsp;</label>
                <label><input type="radio" name="isonline"  value="0"   <?php echo !$config['isonline']?'checked="checked"':''; ?> />&nbsp;<b><?php echo __('Offline'); ?></b></label>
                &nbsp;<font class="error"><?php echo $config['isoffline']?'osTicket '.__('Offline'):''; ?></font>
                <i class="help-tip icon-question-sign" href="#helpdesk_status"></i>
                </span>
            </td>
        </tr>
        <tr>
            <td width="220" class="required"><?php echo __('Helpdesk URL');?>:</td>
            <td>
                <input type="text" size="40" name="helpdesk_url" value="<?php echo $config['helpdesk_url']; ?>">
                &nbsp;<font class="error">*&nbsp;<?php echo $errors['helpdesk_url']; ?></font>
                <i class="help-tip icon-question-sign" href="#helpdesk_url"></i>
        </td>
        </tr>
        <tr>
            <td width="220" class="required"><?php echo __('Helpdesk Name/Title');?>:</td>
            <td><input type="text" size="40" name="helpdesk_title" value="<?php echo $config['helpdesk_title']; ?>">
                &nbsp;<font class="error">*&nbsp;<?php echo $errors['helpdesk_title']; ?></font>
                <i class="help-tip icon-question-sign" href="#helpdesk_name_title"></i>
            </td>
        </tr>
        <tr>
            <td width="220" class="required"><?php echo __('Default Department');?>:</td>
            <td>
                <select name="default_dept_id" data-quick-add="department">
                    <option value="">&mdash; <?php echo __('Select Default Department');?> &mdash;</option>
                    <?php
                    if (($depts=Dept::getPublicDepartments())) {
                        foreach ($depts as $id => $name) {
                            $selected = ($config['default_dept_id']==$id)?'selected="selected"':''; ?>
                            <option value="<?php echo $id; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
                        <?php
                        }
                    } ?>
                    <option value="0" data-quick-add>&mdash; <?php echo __('Add New');?> &mdash;</option>
                </select>&nbsp;<font class="error">*&nbsp;<?php echo $errors['default_dept_id']; ?></font>
                <i class="help-tip icon-question-sign" href="#default_department"></i>
            </td>
        </tr>
        <tr><td><?php echo __('Default Page Size');?>:</td>
            <td>
                <select name="max_page_size">
                    <?php
                     $pagelimit=$config['max_page_size'];
                    for ($i = 5; $i <= 50; $i += 5) {
                        ?>
                        <option <?php echo $config['max_page_size']==$i?'selected="selected"':''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                    } ?>
                </select>
                <i class="help-tip icon-question-sign" href="#default_page_size"></i>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Default Log Level');?>:</td>
            <td>
                <select name="log_level">
                    <option value=0 <?php echo $config['log_level'] == 0 ? 'selected="selected"':''; ?>><?php echo __('None (Disable Logger)');?></option>
                    <option value=3 <?php echo $config['log_level'] == 3 ? 'selected="selected"':''; ?>> <?php echo __('DEBUG');?></option>
                    <option value=2 <?php echo $config['log_level'] == 2 ? 'selected="selected"':''; ?>> <?php echo __('WARN');?></option>
                    <option value=1 <?php echo $config['log_level'] == 1 ? 'selected="selected"':''; ?>> <?php echo __('ERROR');?></option>
                </select>
                <font class="error">&nbsp;<?php echo $errors['log_level']; ?></font>
                <i class="help-tip icon-question-sign" href="#default_log_level"></i>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Purge Logs');?>:</td>
            <td>
                <select name="log_graceperiod">
                    <option value=0 selected><?php echo __('Never Purge Logs');?></option>
                    <?php
                    for ($i = 1; $i <=12; $i++) {
                        ?>
                        <option <?php echo $config['log_graceperiod']==$i?'selected="selected"':''; ?> value="<?php echo $i; ?>">
                            <?php echo sprintf(_N('After %d month', 'After %d months', $i), $i);?>
                        </option>
                        <?php
                    } ?>
                </select>
                <i class="help-tip icon-question-sign" href="#purge_logs"></i>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <em><b><?php echo __('Date and Time Options'); ?></b>&nbsp;
                <i class="help-tip icon-question-sign" href="#date_time_options"></i>
                </em>
            </th>
        </tr>
<?php if (extension_loaded('intl')) { ?>
        <tr><td width="220" class="required"><?php echo __('Default Locale');?>:</td>
            <td>
                <select name="default_locale">
                    <option value=""><?php echo __('Use Language Preference'); ?></option>
                    <?php
                    foreach (Internationalization::allLocales() as $code=>$name) { ?>
                    <option value="<?php echo $code; ?>" <?php
                        if ($code == $config['default_locale'])
                            echo 'selected="selected"';
                    ?>><?php echo $name; ?></option>

                    <?php
                    } ?>
                </select>
            </td>
        </tr>
<?php } ?>

    </tbody>
    <tbody id="advanced-time" <?php if ($config['date_formats'] != 'custom')
        echo 'style="display:none;"'; ?>>
        <tr>
            <td width="220" class="indented required"><?php echo __('Time Format');?>:</td>
            <td>
                <input type="text" name="time_format" value="<?php echo $config['time_format']; ?>" class="date-format-preview">
                    &nbsp;<font class="error">*&nbsp;<?php echo $errors['time_format']; ?></font>
                    <em><?php echo Format::time(null, false); ?></em>
                <span class="faded date-format-preview" data-for="time_format">
                    <?php echo Format::time('now'); ?>
                </span>
            </td>
        </tr>
        <tr><td width="220" class="indented required"><?php echo __('Date Format');?>:</td>
            <td><input type="text" name="date_format" value="<?php echo $config['date_format']; ?>" class="date-format-preview">
                        &nbsp;<font class="error">*&nbsp;<?php echo $errors['date_format']; ?></font>
                        <em><?php echo Format::date(null, false); ?></em>
                <span class="faded date-format-preview" data-for="date_format">
                    <?php echo Format::date('now'); ?>
                </span>
            </td>
        </tr>
        <tr><td width="220" class="indented required"><?php echo __('Date and Time Format');?>:</td>
            <td><input type="text" name="datetime_format" value="<?php echo $config['datetime_format']; ?>" class="date-format-preview">
                        &nbsp;<font class="error">*&nbsp;<?php echo $errors['datetime_format']; ?></font>
                        <em><?php echo Format::datetime(null, false); ?></em>
                <span class="faded date-format-preview" data-for="datetime_format">
                    <?php echo Format::datetime('now'); ?>
                </span>
            </td>
        </tr>
        <tr><td width="220" class="indented required"><?php echo __('Day, Date and Time Format');?>:</td>
            <td><input type="text" name="daydatetime_format" value="<?php echo $config['daydatetime_format']; ?>" class="date-format-preview">
                        &nbsp;<font class="error">*&nbsp;<?php echo $errors['daydatetime_format']; ?></font>
                        <em><?php echo Format::daydatetime(null, false); ?></em>
                <span class="faded date-format-preview" data-for="daydatetime_format">
                    <?php echo Format::daydatetime('now'); ?>
                </span>
            </td>
        </tr>
        <tr><td width="220" class="required"><?php echo __('Default Time Zone');?>:</td>
            <td>
                <?php
                $TZ_TIMEZONE = $config['default_timezone'];
                $TZ_NAME = 'default_timezone';
                $TZ_ALLOW_DEFAULT = false;
                include STAFFINC_DIR.'templates/timezone.tmpl.php'; ?>
                <div class="error"><?php echo $errors['default_timezone']; ?></div>
            </td>
        </tr>
        <tr>
            <td width="220"><?php echo __('Daylight Saving');?>:</td>
            <td>
                <input type="checkbox" name="enable_daylight_saving" <?php echo $config['enable_daylight_saving'] ? 'checked="checked"': ''; ?>><?php echo __('Observe daylight savings');?>
            </td>
        </tr>
        
    </tbody>
</table>
<p style="text-align:center;">
    <input class="button" type="submit" name="submit" value="<?php echo __('Save Changes');?>">
    <input class="button" type="reset" name="reset" value="<?php echo __('Reset Changes');?>">
</p>
</form>
<script type="text/javascript">
$(function() {
    $('#secondary_langs').sortable({
        cursor: 'move'
    });
    var prev = [];
    $('input.date-format-preview').keyup(function() {
        var name = $(this).attr('name'),
            div = $('span.date-format-preview[data-for='+name+']'),
            current = $(this).val();
        if (prev[name] && prev[name] == current)
            return;
        prev[name] = current;
        div.text('...');
        $.get('ajax.php/config/date-format', {format:$(this).val()})
            .done(function(html) { div.html(html); });
    });
});
</script>
