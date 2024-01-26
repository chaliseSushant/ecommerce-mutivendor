<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/')."/category/".$category->id }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <name>{{$category->name}}</name>
            <description>{{$category->description}}</description>
            <commission>{{$category->commission}}</commission>
        </url>
    @endforeach
</urlset>
