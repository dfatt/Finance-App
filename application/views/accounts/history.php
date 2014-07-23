<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>История операций — Finance App</title>
    <link rel='stylesheet' type='text/css' media='all' href='/assets/css/style.css' />
</head>
<body>

<div id='container'>
    <h1>История операций</h1>

    <div id='body'>
        <?php if (null != $history) { ?>
        <table width="50%" border="1">
            <thead>
            <th>Дата</th>
            <th>Отправил</th>
            <th>Получил</th>
            <th>Приход</th>
            <th>Расход</th>
            </thead>
            <tbody>
            <?php
            foreach($history as $transfer)
            {
                ?>
                <tr>
                    <td><?php echo $transfer->date_create ?></td>
                    <td><?php echo $transfer->from ?> &rarr;</td>
                    <td><?php echo $transfer->to ?></td>
                    <td><?php echo $transfer->incoming ? $transfer->incoming . ' ед.' : '' ?></td>
                    <td><?php echo $transfer->outgoing ? $transfer->outgoing . ' ед.': '' ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="5" align="right">Баланс: <b><?php echo $account->balance ?> ед.</b></td>
            </tr>
            </tbody>
        </table>

        <?php } else { ?>
            Нет записей по данному счёту.
        <?php }?>
    </div>

    <p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>