<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Dosen</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 20px 0;
                font-family: Arial, sans-serif;
            }
            th, td {
                border: 1px solid #333;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
    </head>
    <body>
        <?php
        $Dosen = [
            'Nama' => 'Elok Nur Hamdana',   
            'Domisili' => 'Malang',
            'Jenis Kelamin' => 'Perempuan'
        ];

        echo "<h2>Data Dosen</h2>";
        echo "<table>";
        echo "<tr><th>Keterangan</th><th>Isi</th></tr>";

        foreach ($Dosen as $key => $value) {
            echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
        }

        echo "</table>";
        ?>
    </body>
</html>
