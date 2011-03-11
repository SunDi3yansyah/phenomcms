<?php 
echo "<?php xml version=\"1.0\" encoding=\"utf-8\"?>";
?>

<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>
    
    <title>{feed_name}</title>
    <link>{feed_url}</link>
    <description>{page_description}</description>
    <dc:language>{page_language}</dc:language>
    <dc:creator>{creator_email}</dc:creator>

    <dc:rights>{rights}</dc:rights>
    <admin:generatorAgent rdf:resource="{feed_url}" />

	{RecentPosts}   
        <item>
          <title>{posting_title}</title>
          <link>{posting_url}</link>
          <guid>{posting_url}</guid>

          <description><![CDATA[{posting_content}]]></description>
      <pubDate>{posting_date}</pubDate>
        </item>
	{/RecentPosts}   
    
    </channel>
</rss> 
