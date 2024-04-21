<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Firefly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make(__('filament-blog::post.widgets.published-post'), Post::published()->count()),
            BaseWidget\Stat::make(__('filament-blog::post.widgets.scheduled-post'), Post::scheduled()->count()),
            BaseWidget\Stat::make(__('filament-blog::post.widgets.pending-post'), Post::pending()->count()),
        ];
    }
}
