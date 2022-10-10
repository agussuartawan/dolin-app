<?php

namespace App\Http\Livewire\Cure;

use App\Models\Cure;
use App\Models\Rack;
use Livewire\Component;
use App\Models\CureType;
use App\Models\CureUnit;

class ShowCureForm extends Component
{
    public $cure_type_id,
        $cure_unit_id,
        $rack_id,
        $code,
        $name,
        $minimum_stock,
        $purchase_price,
        $selling_price,
        $cure_types,
        $cure_units,
        $racks,
        $title;

    protected $rules = [
        'cure_type_id' => ['required'],
        'cure_unit_id' => ['required'],
        'rack_id' => ['required'],
        'code' => ['unique:cures,code'],
        'name' => ['required', 'max:255'],
        'minimum_stock' => ['required'],
        'purchase_price' => ['required'],
        'selling_price' => ['required']
    ];

    protected $messages = [
        'cure_type_id.required' => 'Jenis tidak boleh kosong',
        'cure_unit_id' => 'Unit tidak boleh kosong',
        'rack_id.required' => 'Rak tidak boleh kosong',
        'code.unique' => 'Kode telah digunakan',
        'name.required' => 'Nama tidak boleh kosong',
        'name.max' => 'Nama tidak boleh melebihi 255 karakter',
        'minimum_stock' => 'Stok minimum tidak boleh kosong',
        'purchase_price' => 'Harga beli tidak boleh kosong',
        'selling_price' => 'Harga jual tidak boleh kosong'
    ];

    protected $listeners = ['store:cure' => 'storeCure'];

    public function mount()
    {
        $this->title = 'Tambah Obat';
        $this->code = Cure::getNextCode();
        $this->cure_types = CureType::select('name', 'id')->get();
        $this->cure_units = CureUnit::select('name', 'id')->get();
        $this->racks = Rack::select('name', 'id')->get();
    }

    public function storeCure()
    {
        $this->validate();

        Cure::create([
            'name' => $this->name,
            'minimum_stock' => $this->minimum_stock,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'cure_type_id' => $this->cure_type_id,
            'cure_unit_id' => $this->cure_unit_id,
            'rack_id' => $this->rack_id,
        ]);
        $this->emit('refresh:table');
        $this->dispatchBrowserEvent('modal-hide');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->code = Cure::getNextCode();
        $this->name = '';
        $this->cure_type_id = '';
        $this->cure_unit_id = '';
        $this->rack_id = '';
        $this->minimum_stock = '';
        $this->purchase_price = '';
        $this->selling_price = '';
    }

    public function render()
    {
        return view('livewire.cure.show-cure-form');
    }
}