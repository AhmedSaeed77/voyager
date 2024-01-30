<?php

namespace App\Observers;

use App\Models\Box;
use Illuminate\Support\Facades\Mail;

class BoxObserver
{
    /**
     * Handle the Box "created" event.
     */
    public function created(Box $box): void
    {
        Mail::to("ahmedsaeed1722@gmail.com")->send(new \App\Mail\ActiveUser(454));
    }

    /**
     * Handle the Box "updated" event.
     */
    public function updated(Box $box): void
    {
        //
    }

    /**
     * Handle the Box "deleted" event.
     */
    public function deleted(Box $box): void
    {
        //
    }

    /**
     * Handle the Box "restored" event.
     */
    public function restored(Box $box): void
    {
        //
    }

    /**
     * Handle the Box "force deleted" event.
     */
    public function forceDeleted(Box $box): void
    {
        //
    }
}
