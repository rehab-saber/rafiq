<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
use App\Jobs\SendNewArticleNotifications;

class SendArticleNotification
{
    public function handle(ArticlePublished $event): void
    {
        SendNewArticleNotifications::dispatch(
            $event->article->id
        );
    }
}