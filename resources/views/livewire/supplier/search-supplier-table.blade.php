<tbody>
    @foreach ($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>
                <a href="#" wire:click.prevent="$emit('choose:supplier', {{ $supplier->id }})"><span
                        class="badge rounded-pill bg-primary">pilih</span></a>
            </td>
        </tr>
    @endforeach
</tbody>
