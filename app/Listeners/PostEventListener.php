<?php

namespace App\Listeners;

use App\Events\BaseEvent;
use App\Events\PostHasBeenRead;
use App\Events\VisitPostList;
use App\T\Navigation\Navigation;
use Cache;

class PostEventListener
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
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        if($event instanceof PostHasBeenRead){
            if(!$this->isAlreadyRead($event->post, $event->ip)){
                $this->setAlreadyRead($event->post, $event->ip);
                $event->post->addViewCount();
            }
        }elseif($event instanceof VisitPostList) {
            app(Navigation::class)->setActiveNav($event->category);
        }
    }

    private function  isAlreadyRead($post, $ip)
    {
        return Cache::has("post:{$post->id}:$ip");
    }

    private function setAlreadyRead($post, $ip)
    {
        Cache::put("post:{$post->id}:$ip", true, config('cache.ttl'));
    }
}
