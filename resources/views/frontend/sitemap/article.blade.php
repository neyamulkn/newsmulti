<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    @foreach ($articles as $article)
        <url>
            <loc>{{ route('news_details', $article->news_slug) }}</loc>
            <image:image>
			<image:loc>{{asset('upload/images/'.$article->source_path) }}</image:loc>
			</image:image>
            <lastmod>{{ $article->publish_date->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>