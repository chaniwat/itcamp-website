<div class="col-12 alert-row">
    <div class="alert {{ $alert['class'] }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="alert-heading force-fredoka"><i class="icon fa {{ $alert['icon'] }}"></i> {{ $alert['title'] }}!</h4>
        <p class="mb-0">{{ $alert['message'] }}</p>
    </div>
</div>