@php
    $i = 0;
@endphp
@foreach ($expensepercategory as $ic)
    <tr>
        <td>{{ $expensepercategory[$i]->bulan }}</td>
        <td>Rp {{ number_format($expensepercategory[$i]->total, 2, ',', '.') }}</td>
    </tr>
    @php
        $i++;
    @endphp
@endforeach
