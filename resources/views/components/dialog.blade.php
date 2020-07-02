<div id="{{$id}}" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      {{ $slot }}
    </div>
  </div>
</div>
