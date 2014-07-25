<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Перевод средств — Finance App</title>
    <link rel='stylesheet' type='text/css' media='all' href='/assets/css/style.css' />
</head>
<body>

<div id='container'>
    <h1>Перевести средства</h1>

    <div id='body'>
        <div class='error'>
            <?php echo validation_errors(); ?>
            <?php echo $errors; ?>
        </div>
        <?php echo form_open_multipart(''); ?>
        <?php
            $options = array();

            foreach($accounts as $account)
            {
                $options[$account->serial] = $account->client . ' (' . $account->balance . ' ед.)';
            }
        ?>
        <p>
            <?php echo form_label('От кого:', 'from'); ?>
            <br>
            <?php echo form_dropdown('from', $options); ?>
        </p>

        <p>
            <?php echo form_label('Кому:', 'to'); ?>
            <br>
            <?php echo form_dropdown('to', $options); ?>
        </p>

        <p><?php echo form_submit('submit', 'Перевести средства'); ?> &nbsp;&nbsp; <a href='/' class='cancel'>отмена</a></p>
        <?php echo form_close(); ?>
    </div>

    <p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>