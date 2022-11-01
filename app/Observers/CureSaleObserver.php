<?php

namespace App\Observers;

use App\Models\CureSale;
use App\Models\Stock;

class CureSaleObserver
{
    /**
     * Handle the CureSale "created" event.
     *
     * @param  \App\Models\CureSale  $cureSale
     * @return void
     */
    public function created(CureSale $cureSale)
    {
        $cureSale->stock()->decrement('amount', $cureSale->qty);
    }

    public function creating(CureSale $cureSale)
    {
        return $cureSale->subtotal = (int)$cureSale->qty * (int)$cureSale->price;
    }

    /**
     * Handle the CureSale "updated" event.
     *
     * @param  \App\Models\CureSale  $cureSale
     * @return void
     */
    public function updated(CureSale $cureSale)
    {
        //
    }

    public function updating(CureSale $cureSale)
    {
        Stock::where('expired_date', $cureSale->expired)
            ->where('cure_id', $cureSale->cure_id)
            ->decrement('amount', $cureSale->qty);

        return $cureSale->subtotal = (int)$cureSale->qty * (int)$cureSale->price;
    }

    /**
     * Handle the CureSale "deleted" event.
     *
     * @param  \App\Models\CureSale  $cureSale
     * @return void
     */
    public function deleted(CureSale $cureSale)
    {
        //
    }

    /**
     * Handle the CureSale "restored" event.
     *
     * @param  \App\Models\CureSale  $cureSale
     * @return void
     */
    public function restored(CureSale $cureSale)
    {
        //
    }

    /**
     * Handle the CureSale "force deleted" event.
     *
     * @param  \App\Models\CureSale  $cureSale
     * @return void
     */
    public function forceDeleted(CureSale $cureSale)
    {
        //
    }
}