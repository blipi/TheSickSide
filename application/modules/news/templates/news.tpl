{foreach from=$news item=news_item}
	<section>
		<h2>{$news_item->title}</h2>
		<article>
			{$news_item->text}
		</article>
	</section>
{/foreach}