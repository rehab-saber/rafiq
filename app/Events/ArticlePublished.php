<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\Parents;
use App\Services\FcmService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNewArticleNotifications implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $articleId
    ) {
    }

    public function handle(FcmService $fcm): void
    {
        $article = Article::find($this->articleId);

        if (!$article) {
            return;
        }

        // ما نبعتش Notification لو المقال مش منشور
        if (!$article->is_published) {
            return;
        }

        Parents::whereNotNull('fcm_token')
            ->chunkById(100, function ($parents) use ($article, $fcm) {

                foreach ($parents as $parent) {

                    $settings = $parent->notificationSettings;

                    if (!$settings) {
                        continue;
                    }

                    // Main Notifications OFF
                    if (!$settings->main_notifications) {
                        continue;
                    }

                    // New Article Reminder OFF
                    if (!$settings->new_article_reminder) {
                        continue;
                    }

                    $fcm->send(
                        $parent->fcm_token,
                        'New Article Available',
                        "A new article has been added: {$article->title}",
                        [
                            'type' => 'new_article',
                            'article_id' => $article->id,
                        ]
                    );
                }
            });
    }
}