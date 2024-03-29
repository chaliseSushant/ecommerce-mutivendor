<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/')."/products/".$product->id }}</loc>
            <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <sku>{{$product->sku}}</sku>
            <name>{{$product->name}}</name>
            <description>{{$product->description}}</description>
            <price>{{$product->price}}</price>
            <brand>{{$product->brand->name}}</brand>
        </url>
    @endforeach
</urlset>
