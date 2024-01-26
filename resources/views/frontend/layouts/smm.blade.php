<link rel="canonical" href="{{url(rawurldecode($_SERVER['REQUEST_URI']))}}" />
<meta property="fb:app_id" content="{{env('FACEBOOK_APP_ID')}}" />

{{--Comment Codes--}}{{--
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ne_NP/sdk.js#xfbml=1&version=v6.0&appId=2705472969529806&autoLogAppEvents=1"></script>
--}}{{--Comment Codes--}}
@if(isset($type))
    @if($type == 'home')
        <title>{{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{config('app.name')}}" />
        <meta property="og:description" content="{{config('app.meta_description')}}" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:site_name" content="{{config('app.name')}}" />

        <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="{{config('app.meta_description')}}" />
        <meta name="twitter:title" content="{{config('app.name')}}" />
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @elseif($type == 'product')
        <title>{{$product->name}} - {{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{$product->title}} - {{config('app.name')}}" />
        @if(isset($product->description))
            <meta property="og:description" content="{{$product->description}}" />
        @endif
        <meta property="og:url" content="{{url('/product/'.$product->id)}}" />
        <meta property="og:site_name" content="{{$product->title }} - {{config('app.name')}}" />
        @if(isset($product->thumbnail))
            <meta property="og:image" content="{{url($product->thumbnail)}}" />
            <meta property="og:image:secure_url" content="{{url($product->thumbnail)}}" />
        @else
            <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
            <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        @endif
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />

        <meta name="twitter:card" content="summary_large_image" />
        @if(isset($product->description))
            <meta name="twitter:description" content="{{$product->description}}" />
        @endif
        <meta name="twitter:title" content="{{$product->title }} - {{config('app.name')}}" />
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        @if(isset($product->thumbnail))
            <meta name="twitter:image" content="{{url($product->thumbnail)}}" />
        @else
            <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        @endif

        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @elseif($type == 'brand')
        <title>{{$brand->name}} - {{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{$brand->name}} - {{config('app.name')}}" />
        @if(isset($brand->description))
            <meta property="og:description" content="{{$brand->description}}" />
        @endif
        <meta property="og:url" content="{{url('/brand/'.$brand->id)}}" />
        <meta property="og:site_name" content="{{$brand->name }} - {{config('app.name')}}" />
        @if(isset($brand->icon))
            <meta property="og:image" content="{{url($brand->icon)}}" />
            <meta property="og:image:secure_url" content="{{url($brand->icon)}}" />
        @else
            <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
            <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        @endif
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />

        <meta name="twitter:card" content="summary_large_image" />
        @if(isset($brand->description))
            <meta name="twitter:description" content="{{$brand->description}}" />
        @endif
        <meta name="twitter:title" content="{{$brand->name }} - {{config('app.name')}}" />
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        @if(isset($brand->icon))
            <meta name="twitter:image" content="{{url($brand->icon)}}" />
        @else
            <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        @endif
        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @elseif($type == 'category')
        <title>{{$category->name}} - {{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{$category->title}} - {{config('app.name')}}" />
        @if(isset($category->description))
            <meta property="og:description" content="{{$category->description}}" />
        @endif
        <meta property="og:url" content="{{url('/category/'.$category->id)}}" />
        <meta property="og:site_name" content="{{$category->title }} - {{config('app.name')}}" />
        <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />
        <meta name="twitter:card" content="summary_large_image" />
        @if(isset($category->description))
            <meta name="twitter:description" content="{{$category->description}}" />
        @endif
        <meta name="twitter:title" content="{{$category->title }} - {{config('app.name')}}" />
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @elseif($type == 'vendor')
        <title>{{$vendor->name}} - {{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{$vendor->name}} - {{config('app.name')}}" />
        <meta property="og:description" content="{{config('app.meta_description')}}" />
        <meta property="og:url" content="{{url('/vendor/'.$vendor->id)}}" />
        <meta property="og:site_name" content="{{$vendor->name }} - {{config('app.name')}}" />
        <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="{{config('app.meta_description')}}" />
        <meta name="twitter:title" content="{{$vendor->name }} - {{config('app.name')}}" />
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @elseif($type == 'search')
        <title>Search Result for "{{$term}}" - {{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
        <meta property="fb:pages" content="{{env('FACEBOOK_PAGE_ID')}}" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content='Search Result for "{{$term}}" - {{config('app.name')}}' />
        <meta property="og:description" content="{{config('app.meta_description')}}" />
        <meta property="og:url" content="{{url(rawurldecode($_SERVER['REQUEST_URI']))}}" />
        <meta property="og:site_name" content='Search Result for "{{$term}}" - {{config('app.name')}}' />
        <meta property="og:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:secure_url" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="859" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="{{config('app.meta_description')}}" />
        <meta name="twitter:title" content='Search Result for "{{$term}}" - {{config('app.name')}}'/>
        <meta name="twitter:site" content="{{'@'.config('app.twitter_handle')}}" />
        <meta name="twitter:image" content="{{url('/frontend/images/brand_thumbnail.jpg')}}" />
        <meta name="twitter:creator" content="{{'@'.config('app.twitter_handle')}}" />
    @else
        <title>{{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
    @endif

    @else
    <title>{{config('app.name')}} - Online Marketplace - {{config('app.meta_description')}}</title>
@endif
