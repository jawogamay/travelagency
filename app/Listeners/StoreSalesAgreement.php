<?php

namespace App\Listeners;

use App\Events\BookletCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SalesAgreement;
use Illuminate\Support\Facades\DB;
class StoreSalesAgreement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookletCreated  $event
     * @return void
     */
    public function handle(BookletCreated $event)
    {
        DB::table('salesagreements')->insert([
            'saNumber' => 5
        ]);
    }
}
