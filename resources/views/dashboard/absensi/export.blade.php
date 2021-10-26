<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Date Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach($absensi as $a) { ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $a->nik }}</td>
                <td>{{ $a->pegawai->full_name }}</td>
                <td>{{ date('d-M-Y H:i:s', strtotime($a->date_time)) }}</td>
                <td>{{ $a->in_out == 1 ? '<div class="label bg-green">In</div>' : '<div class="label bg-red">Out</div>' }}</td>
            </tr>
        <?php } ?>
    </tbody>
</table>