<div class="card">
  <div class="card-header card-header-icon" data-background-color="green">
    <i class="material-icons">{{ isset($icon) ? $icon : 'language' }}</i>
  </div>
  <div class="card-content">
    <h4 class="card-title">
      {{ isset($title) ?$title : '&nbsp;' }}
      @if (isset($tools))
      <span class="pull-right" style="margin: 0;padding: 0">
        {{ $tools }}
      </span>
      @endif
    </h4>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>