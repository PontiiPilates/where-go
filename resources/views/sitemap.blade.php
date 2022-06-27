@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach ($data as $item)
   <url>
      <loc>{{ $item['link']}}</loc>
      <lastmod>{{ $item['updated_at'] }}</lastmod>
      <changefreq>{{ $item['freq'] }}</changefreq>
      <priority>{{ $item['priority'] }}</priority>
   </url>
@endforeach

</urlset> 