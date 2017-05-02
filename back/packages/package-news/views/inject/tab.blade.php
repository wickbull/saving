<li role="presentation" class="js-container-loader" data-container=".js-news-materials-container" data-url="{{ action('\Packages\PackageNewsController@getNewsByUser', $user) }}">
	<a href="#news" aria-controls="news" role="tab" data-toggle="tab">{{ _('News') }}</a>
</li>
