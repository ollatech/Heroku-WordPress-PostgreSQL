<div class="ux-collection">
	{{#posts}}
		<div class="{{_row}}">
			{{#posts_loop}}
				<div class="{{_column}}">
					{{#posts_item}}
					{{/posts_item}}
				</div>
			{{/posts_loop}}
		</div>
		{{#posts_pagination}}{{/posts_pagination}}
	{{/posts}}
</div>