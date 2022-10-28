<?php

namespace App\Observers;

use App\Models\Adquisicion;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class AdquisicionObserver
{
    /**
     * Handle the Adquisicion "created" event.
     *
     * @param  \App\Models\Adquisicion  $adquisicion
     * @return void
     */
    public function created(Adquisicion $adquisicion)
    {
        $nregistro = new Registro;
        $nregistro->registro_idusuario = Auth::user()->id;
        $nregistro->registro_nusuario = Auth::user()->name;
        $nregistro->registro_accion = 'Se creo la adquisición con folio: '.$adquisicion->folio;
        $nregistro->folio = $adquisicion->folio;
        $nregistro->save();
    }

    /**
     * Handle the Adquisicion "updated" event.
     *
     * @param  \App\Models\Adquisicion  $adquisicion
     * @return void
     */
    public function updated(Adquisicion $adquisicion)
    {
        $nregistro = new Registro;
        $nregistro->registro_idusuario = Auth::user()->id;
        $nregistro->registro_nusuario = Auth::user()->name;
        $nregistro->registro_accion = 'Se actualizo la adquisición con folio: '.$adquisicion->folio;
        $nregistro->folio = $adquisicion->folio;
        $nregistro->save();
    }

    /**
     * Handle the Adquisicion "deleted" event.
     *
     * @param  \App\Models\Adquisicion  $adquisicion
     * @return void
     */
    // public function deleted(Adquisicion $adquisicion)
    // {
    //     //
    // }

    /**
     * Handle the Adquisicion "restored" event.
     *
     * @param  \App\Models\Adquisicion  $adquisicion
     * @return void
     */
    // public function restored(Adquisicion $adquisicion)
    // {
    //     //
    // }

    /**
     * Handle the Adquisicion "force deleted" event.
     *
     * @param  \App\Models\Adquisicion  $adquisicion
     * @return void
     */
    // public function forceDeleted(Adquisicion $adquisicion)
    // {
    //     //
    // }
}
