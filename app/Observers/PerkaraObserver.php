<?php

namespace App\Observers;

use App\Perkara;
use Illuminate\Support\Facades\Auth;

class PerkaraObserver
{
    public function creating(Perkara $perkara)
    {
        $perkara->created_by = Auth::user()->id;
        $perkara->updated_by = Auth::user()->id;
    }

    public function updating(Perkara $perkara)
    {
        $perkara->updated_by = Auth::user()->id;
    }
}
