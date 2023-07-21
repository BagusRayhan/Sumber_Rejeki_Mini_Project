<?php

namespace App\Http\Controllers;

use App\Models\aboutproreq;
use App\Models\FAQ;
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
        $notification = Notification::where('role', 'admin')->limit(4)->latest()->get();
        $data = sosmed::all()->first();
        $data1 = Kebijakan::all()->first();
        $about = aboutproreq::all()->first();
        $faqs = FAQ::all();

        return view('Admin.pengaturan', compact('data', 'data1','admin','notification','about','faqs'));
    }

    public function updatekebijakan(Request $request) {
        $data1 = Kebijakan::first(); 
        if ($data1) {
            $data1->kebijakan = $request->input('content');
            $data1->save();
        } else {
            
        }

        return back()->with('success','Data berhasil diperbarui!');
    }

    public function updatesosmed(Request $request){
        $data = Sosmed::find(1);
        $data->wa = $request->input('wa');
        $data->ig = $request->input('ig');
        $data->email = $request->input('email');
        $data->save();

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function updateAboutUs(Request $request) {
        $about = aboutproreq::find(1);
        $about->update([
            'about' => $request->about
        ]);
        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function addFAQ(Request $request) {
        $qmark = substr($request->question, -1);
        if ($qmark !== '?') {
            FAQ::create([
                'question' => $request->question.'?',
                'answer' => $request->answer
            ]);
        } else {
            FAQ::create([
                'question' => $request->question,
                'answer' => $request->answer
            ]);
        }
        return back()->with('success', 'Berhasil menambahkan FAQ');
    }

    public function editFAQ(Request $request) {
        $faq = FAQ::find($request->faq_id);
        $qmark = substr($request->question, -1);
        if ($qmark !== '?') {
            $faq->update([
                'question' => $request->question.'?',
                'answer' => $request->answer
            ]);
        } else {
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer
            ]);
        }
        return back()->with('success', 'Berhasil mengubah FAQ');
    }

    public function deleteFAQ(Request $request) {
        $faq = FAQ::find($request->faq_id);
        $faq->delete();
        return back()->with('success', 'Berhasil menghapus FAQ');
    }

    public function kebijakan() {
        $admin = User::where('role', 'admin')->first();
        $privacypolicy = Kebijakan::all()->first();
        $sosmed = Sosmed::all();

        return view('kebijakanprivasi', compact('privacypolicy','admin','sosmed'));
    }
}