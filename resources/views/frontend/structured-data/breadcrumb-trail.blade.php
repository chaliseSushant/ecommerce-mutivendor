@if(isset($type))
        @if($type == 'home')
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{config('app.name')}}",
            "item": "{{config('app.url')}}"
            }]
            }
        @elseif($type == 'product')
            [
            @foreach($product->categories as $category)
                {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "{{config('app.name')}}",
                "item": "{{config('app.url')}}"
                },{
                "@type": "ListItem",
                "position": 2,
                "name": "{{$category->name}}",
                "item": "{{url('/category/'.$category->id)}}"
                },{
                "@type": "ListItem",
                "position": 3,
                "name": "{{$product->name}}"
                }]
                },
            @endforeach
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{config('app.name')}}",
            "item": "{{config('app.url')}}"
            },{
            "@type": "ListItem",
            "position": 2,
            "name": "{{$product->brand->name}}",
            "item": "{{url('/brand/'.$product->brand->id)}}"
            },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{$product->name}}"
            }]
            }]
        @elseif($type == 'brand')
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{config('app.name')}}",
            "item": "{{config('app.url')}}"
            },{
            "@type": "ListItem",
            "position": 2,
            "name": "brand"
            },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{$brand->name}}"
            }]
            }
        @elseif($type == 'category')
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{config('app.name')}}",
            "item": "{{config('app.url')}}"
            },{
            "@type": "ListItem",
            "position": 2,
            "name": "category"
            },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{$category->name}}"
            }]
            }
        @elseif($type == 'vendor')
            {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{config('app.name')}}",
            "item": "{{config('app.url')}}"
            },{
            "@type": "ListItem",
            "position": 2,
            "name": "vendor"
            },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{$vendor->name}}"
            }]
            }
        @endif

    @else

@endif
