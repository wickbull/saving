(function (window, $, undefined) {

	var Tags = function (element) {

		var self = this;
		this.$target = $(element);
		this.url = this.$target.data('url');

		this.tags = new Bloodhound({
			name: 'tag',
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('tags'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			limit: 10,
			remote: {
				url: this.url+'?name=%QUERY',
				wildcard: '%QUERY'
			}
		});

		this.$target.tagsinput({
			typeaheadjs: {
				name: 'tags',
				displayKey: 'name',
				valueKey: 'name',
				source: this.tags.ttAdapter()
			},
			freeInput: false
		});
		var elem = this.$target.tagsinput('input');
		elem.keypress(function(e) {
			if(e.which == 13) {
				return false;
			}
		});
	}

	$('.js-tags-group').each(function () {

		this.tags = new Tags(this);

	});

})(window, jQuery);
