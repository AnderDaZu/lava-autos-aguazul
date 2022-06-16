<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Amount;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AmountController extends Controller
{

    public function index()
    {
        $amount = Amount::where('active', true)->first();
        // return $amount;
        return view('admin.amounts.index', compact('amount'));
    }

    public function edit(Amount $amount)
    {
        $amounts = Amount::pluck('num', 'id');
        return view('admin.amounts.edit', compact('amount', 'amounts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amounts' => 'exists:amounts,id'
        ]);

        $amount_old = Amount::find($id);
        $amount_new = Amount::find($request->amounts);

        if ( $amount_old->id != $amount_new->id ) {
            
            $amount_old->update(['active' => false]);
            $amount_new->update(['active' => true]);

            toast("La cantidad citas simultaneas se actualizó con exito!",'success');

            return redirect()->route('admin.amounts.index');

        }else {

            toast("La cantidad de citas simultaneas no se actualizó",'info');

            return redirect()->route('admin.amounts.index');

        }

    }
}
