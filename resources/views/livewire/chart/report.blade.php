<div class="chart" wire:poll.visible>
    <canvas id="myChart" width="100" height="35px"></canvas>
@php
    $label = [];
    $data = [];
@endphp
@foreach ($barang as $row)
    @php
        $label[] = date("l-F-Y", strtotime($row->barangmasuk->tanggal_pembelian));
        $data[] = $row->qty;
    @endphp
@endforeach
@php
    $label = array_merge([], $label);
    $data = array_merge([], $data);
@endphp
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

    const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @js($label),
                datasets: [{
                    label: 'Grafik Barang Masuk',
                    data: @js($data),
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 3
                },
                {
                    label: 'Grafik Barang Keluar',
                    data: [],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
</div>
