<div class="dropdown" style="text-align: center;">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
        <span><i class="fa fa-cog fa-fw"></i></span>&nbsp;<span class="caret"></span>
    </button>
    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
        <li>{update}</li>
        <?php if ($id !== 1) :?>
            <li class="divider"></li>
            <li>{delete}</li>
        <?php endif;?>
    </ul>
</div>
