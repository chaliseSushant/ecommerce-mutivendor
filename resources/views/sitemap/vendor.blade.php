<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($vendors as $vendor)
        <url>
            <loc>{{ url('/')."/vendor/".$vendor->id }}</loc>
            <lastmod>{{ $vendor->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <name>{{$vendor->name}}</name>
            <phone>{{$vendor->phone}}</phone>
            <address>{{$vendor->address}}</address>
            <email>{{$vendor->email}}</email>
        </url>
    @endforeach
</urlset>
