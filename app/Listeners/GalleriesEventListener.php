<?php

namespace App\Listeners;

//use App\Events\gallery.created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GalleriesEventListener
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
     * @param  gallery.created  $event
     * @return void
     */
    public function handle(\App\Events\GalleriesEvent $event)
    {
        if ($event->action === 'created') {
            \Log::info(sprintf(
                '새로운 작품이 등록되었습니다.: %s', $event->gallery->title
            ));
        }
    }
}
