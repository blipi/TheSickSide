{foreach from=$news item=news_item}
	<section>
		<div class="news_bullet"><img src="{$base_url}style/images/news_bullet.png" /></div>
		<h2 class="news_title">{$news_item->title}</h2>
		<hr />
		<article>
			{$news_item->text}
		</article>
	</section>
{/foreach}