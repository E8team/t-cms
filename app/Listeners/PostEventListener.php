<?php

namespace App\Listeners;

use App\Events\PostHasBeenRead;
use App\Events\VisitedPostList;
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
            app(Navigation::class)->setActiveNav($event->category);
            if(!$this->isAlreadyRead($event->post, $event->ip)){
                $this->setAlreadyRead($event->post, $event->ip);
                $event->post->addViewCount();
            }
        }elseif($event instanceof VisitedPostList) {
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
