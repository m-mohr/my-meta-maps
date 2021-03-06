<div class="modal fade" id="ModalAddComment" tabindex="-1" role="dialog" aria-labelledby="meinModalLabel" aria-hidden="true">
	<div class="modal-dialog">

		<form class="modal-content" id="form-comment-firstStep" onsubmit="return false">
				
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('client.close')</span></button>
				<h4 class="modal-title" id="meinModalLabel">@lang('misc.createComm')</h4>
			</div>
						
			<div class="modal-body">
											
								
					<div class="row form-group form-group-marginSides">
						<label for="url">@lang('misc.url')</label>
						<input class="form-control" name="url" id="inputURL" type="text">
						<div class="error-message"></div>
					</div>
								
					<div class="row form-group form-group-marginSides">
						<label for="datatype">@lang('misc.dataFormat')</label>
						<select class="form-control" name="datatype" id="inputDataType">
						<option value="">@lang('misc.chooseFormat')</option>
						@foreach (\GeoMetadata\GmRegistry::getServices() as $service)
							<option value="{{{ $service->getCode() }}}">{{{ $service->getName() }}}</option>
						@endforeach
						</select>
						<div class="error-message"></div>
					</div>
							
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="addCommentBtn">@lang('misc.create')</button>
				<div class="modal-progress"></div>
			</div>
				
		</form>
	</div>
</div>