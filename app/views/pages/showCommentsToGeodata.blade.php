<div class="modal fade bs-example-modal-lg" id="ModalShowCommentsToGeodata" tabindex="-1" role="dialog" aria-labelledby="meinModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('client.close')</span></button>
				<h4 class="modal-title" id="meinModalLabel"><%- data.metadata.title %></h4>
			</div>

			<div class="modal-body row"><!-- Model Body Start -->

				<div class="col-md-6"><!-- Left Column Start -->
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="commentHeader">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#showCommentsToGeodata" aria-expanded="true" aria-controls="showCommentsToGeodata">@lang('misc.comments')</a>
							</h4>
						</div>

						<div id="showCommentsToGeodata" class="panel-body collapse in" role="tabpanel" aria-labelledby="commentHeader">
							
							<div class="panel-group" id="commentAccordion" role="tablist" aria-multiselectable="true">
								
								<div class="panel panel-default" data-layer="">
									<div class="panel-heading" role="tab" id="LayerGeneralheader">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#LayerGeneralBody" data-parent="#commentAccordion" aria-expanded="true" aria-controls="LayerGeneralBody">
												@lang('client.generalComm')
											</a>
											<span class="pull-right">
												<a class="badge" href="javascript:createCommentDirectly('<%- data.url %>','<%- data.metadata.datatype %>')" role="button" title="@lang('misc.addComment')">+</a>&nbsp;
												<span class="badge"><%= data.comments.length %></span>
											</span>
										</h4>
									</div>
									<div class="panel-body list-group collapse<%= (data.comments.length > 0) ? ' in' : '' %>" id="LayerGeneralBody" role="tabpanel" aria-labelledby="LayerGeneralheader">
										<% _.each(data.comments, function(comment) { %>
										@include('pages.showCommentsToGeodataBit')
										<% }); if (_.isEmpty(data.comments)) { %>
										<span class="list-group-item">@lang('misc.noComm')</span>
										<% } %>
									</div>
							  	</div>
							  	
								<% _.each(data.layer, function(layer, key) { %>
								<div class="panel panel-default" data-layer="<%- layer.id %>">
									<div class="panel-heading" role="tab" id="Layer<%= key %>Header">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#Layer<%= key %>Body" data-parent="#commentAccordion" aria-expanded="false" aria-controls="Layer<%= key %>Body">
												@lang('misc.layer') <%- ViewUtils.join(' - ', [layer.title, layer.id]) %>
											</a>
											<span class="pull-right">
												<a class="badge" href="javascript:createCommentDirectly('<%- data.url %>', '<%- data.metadata.datatype %>', '<%- layer.id %>')" role="button" title="@lang('misc.addComment')">+</a>&nbsp;
												<span class="badge"><%= layer.comments.length %></span>
											</span>
										</h4>
									</div>
									<div class="panel-body list-group collapse<%= (data.comment > 0 && layer.comments.length > 0) ? ' in' : '' %>" id="Layer<%= key %>Body" role="tabpanel" aria-labelledby="Layer<%= key %>Header">
										<% _.each(layer.comments, function(comment) { %>
										@include('pages.showCommentsToGeodataBit')
										<% }); if (_.isEmpty(layer.comments)) { %>
										<span class="list-group-item">@lang('misc.noCommLayer')</span>
										<% } %>
									</div>
								</div>
								<% }); %>
							 	
							</div>

						</div>

					</div>
				</div> <!-- Left Column End -->

				<div class="col-md-6"><!-- Right Column Start -->
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="dataHeader">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#showDataToGeodata" aria-expanded="true" aria-controls="showDataToGeodata">@lang('misc.generalData')</a>
							</h4>
						</div>
						<dl class="panel-body dl-horizontal metadata-list collapse in" id="showDataToGeodata" role="tabpanel" aria-labelledby="dataHeader">
							<dt>@lang('misc.adress')</dt>
							<dd><a href="<%- data.url %>" id="commMetaAdress" target="_blank"><%- data.url %></a></dd>
							<dt>@lang('misc.dataFormatComm')</dt>
							<dd id="commMetaFormat"><%- config.datatypes[data.metadata.datatype] %></dd>
							<dt>Σ @lang('misc.comments')</dt>
							<dd><%- data.commentCount.filtered %> (<%- data.commentCount.all %> @lang('misc.total'))</dd>
							<dt>Ø @lang('misc.rating')</dt>
							<dd><%- data.ratingAvg.filtered %> (<%- data.ratingAvg.all %> @lang('misc.total'))</dd>
							<dt>@lang('misc.permlink')</dt>
							<dd><a href="<%- data.permalink %>" target="_blank"><%- data.permalink %></a></dd>
						</dl>
					</div>
					
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="mapHeader">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#showMapToGeodata" aria-expanded="true" aria-controls="showMapToGeodata">@lang('misc.map')</a>
							</h4>
						</div>
						<div class="panel-body collapse in" id="showMapToGeodata" role="tabpanel" aria-labelledby="mapHeader">
							<div id="commentviewmap"></div>
						</div>
					</div>
							
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="metadataHeader">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#showMetadataToGeodata" aria-expanded="true" aria-controls="showMetadataToGeodata">@lang('misc.metadata')</a>
							</h4>
						</div>
						<dl class="panel-body dl-horizontal metadata-list collapse in" id="showMetadataToGeodata" role="tabpanel" aria-labelledby="metadataHeader">
							<%  if (!_.isEmpty(data.metadata.abstract)) { %>
							<dt>@lang('misc.description')</dt>
							<dd><pre><%- data.metadata.abstract %></pre></dd>
							<% } if (!_.isEmpty(data.metadata.keywords)) { %>
							<dt>@lang('misc.tags')</dt>
							<dd>
								<% _.each(data.metadata.keywords, function(word) { %>
								<span class="label label-default"><%- word %></span>
								<% }); %>
							</dd>
							<% } if (!_.isEmpty(data.metadata.language)) { %>
							<dt>@lang('misc.lang')</dt>
							<dd><%- data.metadata.language %></dd>
							<% } if (!_.isEmpty(data.metadata.beginTime) || !_.isEmpty(data.metadata.endTime)) { %>
							<dt>@lang('misc.timerange')</dt>
							<dd>
								@lang('misc.startingDate'): <%- data.metadata.beginTime ? data.metadata.beginTime : '@lang('misc.unknown')' %><br />
								@lang('misc.endingDate'): <%- data.metadata.endTime ? data.metadata.endTime : '@lang('misc.unknown')' %>
							</dd>
							<% } if (!_.isEmpty(data.metadata.author)) { %>
							<dt>@lang('misc.author')</dt>
							<dd><pre><%- data.metadata.author %></pre></dd>
							<% } if (!_.isEmpty(data.metadata.copyright)) { %>
							<dt>@lang('misc.copyright')</dt>
							<dd><pre><%- data.metadata.copyright %></pre></dd>
							<% } if (!_.isEmpty(data.metadata.license)) { %>
							<dt>@lang('misc.license')</dt>
							<dd><pre><%- data.metadata.license %></pre></dd>
							<% } %>
						</dl>
					</div>
				</div><!-- Right Column End -->

			</div><!-- Model Body End -->
		</div>
	</div>
