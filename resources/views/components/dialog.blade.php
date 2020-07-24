<div id="{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">{{ $title ?? '' }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      {{ $body }}
    </div>
  </div>
</div>
