<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL ?>
<rss version="2.0"
  xmlns:atom="http://www.w3.org/2005/Atom"
 >
<channel>
  <title>বিডি টাইপ</title>
  <link>{{ url('/') }}</link>
  <atom:link href="{{route('feed')}}" type="application/rss+xml" rel="self"/>
  <description>Online Latest Bangla News/Article - Sports, Crime, Entertainment, Business, Politics, Education, Opinion, Lifestyle, Photo, Video, Travel, National, World</description>
  <image>
    <url>{{ asset('frontend')}}/images/logo-black.png</url>
    <title>বিডি টাইপ</title>
    <link>{{ url('/') }}</link>
  </image>
  
      <copyright>Copyright 2020 Bdtype.com</copyright>
    <language>bn</language>

@foreach($get_feeds as $feed_news)


  <item>
    <title><![CDATA[{{$feed_news->news_title}}]]></title>
    <link>{{ route('news_details', $feed_news->news_slug)}}</link>
    <pubDate>{{ date("r", strtotime(Carbon\Carbon::parse($feed_news->created_at)->format('d M Y H:i:s'))) }}</pubDate>
    <category>@if($feed_news->categoryList) {{ $feed_news->categoryList->category_bd }} @else category @endif</category>
    <guid isPermaLink="false">{{ route('news_details', $feed_news->news_slug)}}</guid>
    
    <description><![CDATA[
     <img style="float:left; margin:0 10px 10px 0;" width="150" src="{{ asset('upload/images/news/'. $feed_news->image->source_path)}}" />
    {!! Str::limit($feed_news->news_dsc, 500 ) !!}]]></description>
     
    <author><![CDATA[ @if($feed_news->reporter) {{ $feed_news->reporter->name }} @else বিডি টাইপ @endif  ]]></author>
    
    <image>
      <url>{{ asset('upload/images/news/'. $feed_news->image->source_path)}}</url>
    </image>
  </item>
@endforeach

</channel>
</rss>