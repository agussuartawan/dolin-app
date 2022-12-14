<tbody>
    @foreach ($cures as $cure)
        <tr>
            <td>{{ $cure->code }}</td>
            <td>{{ $cure->name }}</td>
            <td>{{ $cure->purchase_price }}</td>
            <td>{{ $cure->selling_price }}</td>
            <td>{{ idr($cure->stock->amount) }}</td>
            <td>
                <a href="#" wire:click.prevent="$emit('choose:cure', {{ $cure->id }})"><span
                        class="badge rounded-pill bg-primary">pilih</span></a>
            </td>
        </tr>
    @endforeach
</tbody>
