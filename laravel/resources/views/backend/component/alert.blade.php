<div class="alert {{ $alert['class'] }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4><i class="icon fa {{ $alert['icon'] }}"></i> {{ $alert['title'] }}!</h4>
    {{ $alert['message'] }}
</div>