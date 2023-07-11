<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sosmed;
use App\Models\Kebijakan;
use App\Models\Notification;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //   $data = Sosmed::FirstOrFail();
    //   $data1 = Kebijakan::FirstOrFail();
    //     return view('Admin.pengaturan', compact('data','data1'));
    // }

    public function pengaturan() {
        $admin = User::where('role', 'admin')->first();
        $notification = Notification::where('role', 'admin')->latest()->get();
        $data = sosmed::all()->first();
        $data1 = Kebijakan::all()->first();

        return view('Admin.pengaturan', compact('data', 'data1','admin','notification'));
    }

    public function updatekebijakan(Request $request) {
        $data1 = Kebijakan::first(); // Mengambil objek pertama dari tabel Kebijakan
        if ($data1) {
            $data1->kebijakan = $request->input('content');
            $data1->save();
        } else {
            // Tangani ketika tidak ada record Kebijakan
            // Misalnya, bisa menambahkan record baru dengan nilai 'kebijakan'
        }

        return redirect()->back()->with('sukses','Data berhasil diperbarui!');
    }

    public function updatesosmed(Request $request){
        $data = Sosmed::find(1);
        $data->wa = $request->input('wa');
        $data->ig = $request->input('ig');
        $data->email = $request->input('email');
        $data->save();

        return redirect()->back()->with('sukses', 'Data berhasil diperbarui.');
    }

    public function kebijakan() {
        $admin = User::where('role', 'admin')->first();
        $dataa = Kebijakan::all()->first();

        return view('kebijakanprivasi', compact('dataa','admin'));
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
        //
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
}
