<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
	
    @foreach ($categories as $category)
        <url>
            <loc>{{ route('category', $category->cat_slug_en) }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
       	@if($category->subcategory)
        @foreach ($category->subcategory as $subcategory)
        <url>
            <loc>{{ route('category', [$category->cat_slug_en, $subcategory->subcat_slug_en]) }}</loc>
            <lastmod>{{ $subcategory->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
		@endforeach
       	@endif
    @endforeach
</urlset>