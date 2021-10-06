<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup</title>
</head>

<body>
    <?php
    include_once("./mysqldump/src/Ifsnop/Mysqldump/Mysqldump.php");

    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=debtorbook', 'root', '');
    $f = date("d-m-Y");
    $dump->start("sql_dump/$f.sql");

    ?>
    <script>
        let name = "<?php echo date("d-m-Y"); ?>.sql";
        let link = document.createElement("a");
        link.setAttribute('download', name);
        link.href = "http://localhost/debtorbook/api/backup/sql_dump/<?php echo date("d-m-Y"); ?>.sql";
        document.body.appendChild(link);
        link.click();
        link.remove();
        window.close();
    </script>
</body>

</html>