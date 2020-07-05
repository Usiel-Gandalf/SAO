
@if(Auth::id() == $admin->id)
{{'El perfil del administrador coincide'}}
@else
{{'el perfil no coincide'}}
@endif