<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Список счетов — Finance App</title>
    <link rel='stylesheet' type='text/css' media='all' href='/assets/css/style.css' />
</head>
<body>

<div id='container'>
    <h1>Создать счёт</h1>

    <div id='body'>
        <table width="50%" border="1">
            <thead>
                <th>Имя</th>
                <th>Счёт</th>
                <th>Баланс</th>
            </thead>
            <tbody>
            <?php
            foreach($accounts as $account)
            {
            ?>
                <tr>
                    <td><?php echo anchor('/account/' . $account->id, $account->client, 'target="_blank"') ?></td>
                    <td><?php echo $account->serial ?></td>
                    <td><?php echo $account->balance ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>