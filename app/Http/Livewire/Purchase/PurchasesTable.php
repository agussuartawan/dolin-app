<?php

namespace App\Http\Livewire\Purchase;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\Purchase;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class PurchasesTable extends DataTableComponent
{
    protected $model = Purchase::class;

    protected $listeners = ['refresh:table' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setEmptyMessage('Tidak ada data')
            ->setDefaultSort('id', 'desc')
            ->setTableAttributes([
                'class' => 'bg-white rounded-3 table-hover',
            ])
            ->setSortingPillsDisabled()
            ->setConfigurableAreas([
                'toolbar-right-start' => [
                    'include.btn-add', [
                        'action' => route('purchases.create'),
                        'noEmit' => true,
                    ]
                ],
            ])            
            ->setThAttributes(function(Column $column) {
                if ($column->isField('Aksi')) {
                  return [
                    'width' => '10%',
                  ];
                }
            
                return [];
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Kode Obat Masuk", "code")
                ->sortable()
                ->searchable(),
            Column::make("Nama Supplier", "supplier.name")
                ->sortable()
                ->searchable(),
            Column::make("Tanggal", "date")
                ->sortable()
                ->searchable(),
            Column::make('Total', 'grand_total')
                ->sortable()
                ->format(function($value) {
                    return idr($value);
                }),
            ButtonGroupColumn::make('Aksi')
            ->attributes(function($row) {
                return [
                    'class' => 'py-2',
                ];
            })
            ->buttons([
                LinkColumn::make('Aksi')
                ->title(fn ($row) => 'edit')
                ->location(fn ($row) => route('purchases.edit', $row->id))
                ->attributes(fn ($row) => [
                    'class' => 'badge rounded-pill bg-primary',
                    'title' => 'Edit ' . $row->code,
                ]),
                LinkColumn::make('Aksi')
                ->title(fn ($row) => 'detail')
                ->location(fn ($row) => route('purchases.show', $row->id))
                ->attributes(fn ($row) => [
                    'class' => 'badge rounded-pill bg-info',
                    'title' => 'Detail ' . $row->code,
                ]),
            ]),
        ];
    }
}
