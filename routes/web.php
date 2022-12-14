<?php

use App\Http\Livewire\Cure\ShowCures;
use App\Http\Livewire\Rack\ShowRacks;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Livewire\CureType\ShowCureTypes;
use App\Http\Livewire\Customer\ShowCustomer;
use App\Http\Livewire\Purchase\ShowDetail;
use App\Http\Livewire\Purchase\ShowPurchaseForm;
use App\Http\Livewire\Purchase\ShowPurchases;
use App\Http\Livewire\Report\ShowPurchase;
use App\Http\Livewire\Report\ShowSale;
use App\Http\Livewire\Report\ShowStocks;
use App\Http\Livewire\Sale\ShowDetail as SaleShowDetail;
use App\Http\Livewire\Sale\ShowSaleForm;
use App\Http\Livewire\Sale\ShowSales;
use App\Http\Livewire\Supplier\ShowSupplier;
use App\Http\Livewire\Unit\ShowUnits;
use App\Models\Cure;
use Illuminate\Http\Request;
use Spatie\Permission\Commands\Show;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('home');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:akses obat'], function () {
        Route::get('/cures', ShowCures::class)
            ->name('cures.index');
    });

    Route::group(['middleware' => 'can:akses rak obat'], function () {
        Route::get('/racks', ShowRacks::class)
            ->name('racks.index');
    });

    Route::group(['middleware' => 'can:akses jenis obat'], function () {
        Route::get('/cure-types', ShowCureTypes::class)
            ->name('cure-types.index');
    });

    Route::group(['middleware' => 'can:akses unit obat'], function () {
        Route::get('/units', ShowUnits::class)
            ->name('units.index');
    });

    Route::group(['middleware' => 'can:akses rak obat'], function () {
        Route::get('/racks', ShowRacks::class)
            ->name('racks.index');
    });

    Route::group(['middleware' => 'can:akses obat masuk'], function () {
        Route::get('/purchases', ShowPurchases::class)
            ->name('purchases.index');

        Route::get('/purchases/form/{id}', ShowPurchaseForm::class)
            ->name('purchases.edit');

        Route::get('/purchases/form/0', ShowPurchaseForm::class)
            ->name('purchases.create');

        Route::get('/purchases/show/{purchase}', ShowDetail::class)
            ->name('purchases.show');

        Route::get('/report/purchases/invoice/{purchase}', [ReportController::class, 'purchaseInvoice'])
            ->name('report.purchase.invoice');
    });

    Route::group(['middleware' => 'can:akses obat keluar'], function () {
        Route::get('/sales', ShowSales::class)
            ->name('sales.index');

        Route::get('/sales/form/{id}', ShowSaleForm::class)
            ->name('sales.edit');

        Route::get('/sales/form/0', ShowSaleForm::class)
            ->name('sales.create');

        Route::get('/sales/show/{sale}', SaleShowDetail::class)
            ->name('sales.show');

        Route::get('/report/sales/invoice/{sale}', [ReportController::class, 'saleInvoice'])
            ->name('report.sale.invoice');
    });

    Route::group(['middleware' => 'can:akses laporan'], function () {
        Route::get('/report/stocks', ShowStocks::class)
            ->name('report.stocks');

        Route::get('/report/stocks/print', [ReportController::class, 'printStock'])
            ->name('report.stocks.print');

        Route::get('/report/purchases', ShowPurchase::class)
            ->name('report.purchases');

        Route::get('/report/purchases/print', [ReportController::class, 'printPurchase'])
            ->name('report.purchase.print');

        Route::get('/report/sales', ShowSale::class)
            ->name('report.sales');

        Route::get('/report/sales/print', [ReportController::class, 'printSale'])
            ->name('report.sale.print');
    });

    Route::group(['middleware' => 'can:akses supplier'], function () {
        Route::get('/suppliers', ShowSupplier::class)
            ->name('suppliers.index');
    });

    Route::group(['middleware' => 'can:akses customer'], function () {
        Route::get('/customers', ShowCustomer::class)
            ->name('customers.index');
    });

    Route::group(['middleware' => 'can:akses pelanggan'], function () {
        Route::get('/customers', ShowCustomer::class)
            ->name('customers.index');
    });
});
