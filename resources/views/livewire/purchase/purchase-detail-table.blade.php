<tbody>
    @foreach ($purchaseDetails as $detail)
        <tr>
            @if ($detail->name)
                {{-- for cure_detail table --}}
                <td>{{ $detail->pivot->expired }}</td>
                <td>{{ $detail->name }}</td>
                <td>{{ $detail->pivot->qty }}</td>
                <td class="text-end">{{ idr($detail->pivot->price) }}</td>
                <td class="text-end">{{ idr($detail->pivot->subtotal) }}</td>
                <td>
                    <a href="#" wire:click.prevent="$emit('edit:detail', {{ $detail->pivot->id }})"
                        class="badge rounded-pill bg-primary">edit</a>
                    <a href="#" wire:click.prevent="$emit('delete:detail', {{ $detail->pivot->id }})"
                        class="badge rounded-pill bg-danger">hapus</a>
                </td>
            @else
                {{-- for temporary table --}}
                <td>{{ $detail->expired }}</td>
                <td>{{ $detail->cure->name }}</td>
                <td>{{ $detail->qty }}</td>
                <td class="text-end">{{ idr($detail->price) }}</td>
                <td class="text-end">{{ idr($detail->subtotal) }}</td>
                <td>
                    <a href="#" wire:click.prevent="$emit('edit:temporaryDetail', {{ $detail->id }})"
                        class="badge rounded-pill bg-primary">edit</a>
                    <a href="#" wire:click.prevent="$emit('delete:temporaryDetail', {{ $detail->id }})"
                        class="badge rounded-pill bg-danger">hapus</a>
                </td>
            @endif
        </tr>
    @endforeach
    <tr>
        <td colspan="3" class="text-end">
            <h5>Total</h5>
        </td>
        <td colspan="2">
            <h5 class="text-end">Rp. {{ $grandTotal }}</h5>
        </td>
    </tr>
</tbody>
