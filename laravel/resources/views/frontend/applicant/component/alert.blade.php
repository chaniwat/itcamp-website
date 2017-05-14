<div class="col-12 alert-row">
    <div class="alert {{ $alert['class'] }} alert-dismissible" role="alert" style="padding: 0.75rem 0.85rem;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="force-fredoka"><i class="icon fa {{ $alert['icon'] }}"></i> {{ $alert['title'] }}!</h4>
        {{ $alert['message'] }}
    </div>
</div>