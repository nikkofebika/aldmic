<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Handphone</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach($pegawai as $p) { ?>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ strval($p->nik) }}</td>
                <td>{{ $p->full_name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ strval($p->mobile_number) }}</td>
                <td>{{ $p->address }}</td>
            </tr>
        <?php } ?>
    </tbody>
</table>