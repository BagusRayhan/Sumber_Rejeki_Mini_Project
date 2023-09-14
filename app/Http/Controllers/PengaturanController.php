<?php

namespace App\Http\Controllers;

use App\Models\Aboutproreq;
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
        $data = Sosmed::all()->first();
        $data1 = Kebijakan::all()->first();
        $about = Aboutproreq::all()->first();
        $faqs = FAQ::all();

        return view('Admin.pengaturan', compact('data', 'data1','admin','notification','about','faqs'));
    }

    public function updatekebijakan(Request $request) {
        $this->validate($request,[
            'content' => 'required'
        ],[
            'content.required' => 'Isi kebijakan privasi terlebih dahulu'
        ]);

        $data1 = Kebijakan::first(); 
        if ($data1) {
            $data1->kebijakan = $request->input('content');
            $data1->save();
        } else {
            
        }

        return back()->with('success','Data berhasil diperbarui!');
    }

    public function updatesosmed(Request $request){
        $this->validate($request,[
            'ig' => 'required|regex:/^[a-zA-Z0-9_.]+$/',
            'email' => 'required|email',
            'wa' => 'required|min:11|max:16|gt:0'
        ],[
            'ig.required' => 'Isi akun Instagram terlebih dahulu',
            'ig.regex' => 'Isi akun Instagram dengan benar',
            'email.required' => 'Isi alamat email terlebih dahulu',
            'email.email' => 'Isi alamat email dengan benar',
            'wa.required' => 'Isi nomor whatsapp terlebih dahulu',
            'wa.gt' => 'Isi nomor whatsapp dengan benar',
            'wa.min' => 'Minimal nomor 11 angka',
            'wa.max' => 'Maksimal Harga 16 angka'
        ]);

        $data = Sosmed::find(1);
        $data->wa = $request->input('wa');
        $data->ig = $request->input('ig');
        $data->email = $request->input('email');
        $data->save();

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    public function updateAboutUs(Request $request) {
        $this->validate($request,[
            'about' => 'required|min:10'
        ],[
            'about.required' => 'Isi about us terlebih dahulu',
            'about.min' => 'Isi about us minimal 10 karakter'
        ]);

        $about = Aboutproreq::find(1);
        $about->update([
            'about' => $request->about
        ]);
        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function addFAQ(Request $request) {
        $this->validate($request,[
            'question' => 'required|min:10',
            'answer' => 'required|min:10'
        ],[
            'question.required' => 'Isi pertanyaan terlebih dahulu',
            'answer.required' => 'Isi jawaban terlebih dahulu',
            'question.min' => 'Isi pertanyaan minimal 10 karakter',
            'answer.min' => 'Isi jawaban minimal 10 karakter'
        ]);
        
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
        $this->validate($request,[
            'question' => 'required|min:10',
            'answer' => 'required|min:10'
        ],[
            'question.required' => 'Isi pertanyaan terlebih dahulu',
            'answer.required' => 'Isi jawaban terlebih dahulu',
            'question.min' => 'Isi pertanyaan minimal 10 karakter',
            'answer.min' => 'Isi jawaban minimal 10 karakter'
        ]);

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

    public function deleteFAQ(Request $request, $faq_id) {
        $faq = FAQ::find($faq_id);
        if (!$faq) {
            // Penanganan jika FAQ tidak ditemukan
            return redirect()->back()->with('error', 'FAQ tidak ditemukan');
        }
    
        $faq->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus FAQ');
    }    

    public function kebijakan() {
        $admin = User::where('role', 'admin')->first();
        $privacypolicy = Kebijakan::all()->first();
        $sosmed = Sosmed::all();

        return view('kebijakanprivasi', compact('privacypolicy','admin','sosmed'));
    }
}