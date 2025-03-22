<!DOCTYPE html>
<html>.

<head>
    <title>Document</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Rekap Absensi</h1>
    <table id="customers">
        <tr>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Jurusan</th>
            <th>Kehadiran</th>
            <th>Jadwal</th>
        </tr>
        <?php
        $query = "SELECT * from absensi a
                    JOIN mahasiswa b
                    ON a.npm = b.npm";
        $absensi = $this->db->query($query)->result_array();
        foreach ($absensi as $absn) :
        ?>
            <tr>
                <td><?= $absn['npm']; ?></td>
                <td><?= $absn['nama_mhs']; ?></td>
                <td><?= $absn['jurusan']; ?></td>
                <td><?= $absn['keterangan']; ?></td>
                <td><?= $absn['jadwal']; ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</body>

</html>