<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\stok_barang;
use Illuminate\Support\Facades\DB;

class order_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang=stok_barang::paginate(10);
        $data = order::leftJoin('stok_barang', 'orders.kode', '=', 'stok_barang.kode')
                ->select('orders.*', 'stok_barang.*')->orderBy('orders.id_order', 'desc')->paginate(25);
        return view('order',compact('data','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = order::create([
            'kode' => $request->kode,
            'jumlah' => $request->jumlah
        ]);
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function order()
    {
        $order = order::where('status_mutasi', 'Pending')->update([
            'status_order' => 'Diajukan',
            'status_mutasi' => 'Proses',
            'tgl_order' => now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('order.index')->with('success','Berhasil Melakukan Order');
    }
}