<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Finance App</title>
    <link rel='stylesheet' type='text/css' media='all' href='/assets/css/style.css' />
</head>
<body>

<div id='container'>
    <h1>Создать счёт</h1>

    <div id='body'>
        <div class='error'><?php echo validation_errors(); ?></div>
        <?php echo form_open_multipart(''); ?>
            <p>
                <?php echo form_label('Имя клиента:', 'client'); ?>
                <br>
                <?php echo form_input('client', set_value('client')); ?>
            </p>

            <p>
                <?php echo form_label('Номер:', 'serial'); ?>
                <br>
                <?php echo form_input('serial', set_value('serial')); ?>
            </p>

            <p>
                <?php echo form_label('Баланс:', 'balance'); ?>
                <br>
                <?php echo form_input('balance', set_value('balance')); ?>
            </p>

            <p><?php echo form_submit('submit', 'Создать счёт'); ?> &nbsp;&nbsp; <a href='/' class='cancel'>отмена</a></p>
        <?php echo form_close(); ?>
    </div>

    <p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>