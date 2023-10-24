<div class="col-12">
        <table class="table table-bordered table-striped">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Nota</th>
            </tr>
            @php $no = 1 @endphp
                @foreach ($cetaklaporan as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->barangmasuk->kode_nota }}</td>
                </tr>

                @endforeach

        </table>
    </div>