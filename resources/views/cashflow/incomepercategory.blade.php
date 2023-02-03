@php
    $i = 0;
@endphp
@foreach ($incomepercategory as $ic)
    <tr>
        <td>{{ $incomepercategory[$i]->bulan }}</td>
        <td>Rp {{ number_format($incomepercategory[$i]->total, 2, ',', '.') }}</td>
    </tr>
    @php
        $i++;
    @endphp
@endforeach
