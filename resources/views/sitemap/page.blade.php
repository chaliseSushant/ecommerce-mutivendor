<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($pages as $page)
        <url>
            <loc>{{ url('/')."/page/".$page->id }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <title>{{$page->title}}</title>
            <description>{{$page->description}}</description>
            <meta_description>{{$page->meta_description}}</meta_description>
        </url>
    @endforeach
</urlset>
