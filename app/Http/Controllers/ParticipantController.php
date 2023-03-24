<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Role;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $training = Training::where('slug', $slug)->first();
        $roles = Role::latest()->get();
        $participants = Participant::all()->count();
        $participants++;
        return view('auth.participant.create', compact('roles', 'training', 'participants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:participants',
                'name' => 'required',
                'role' => 'required',
            ],
            [
                'code.required' => 'Kode Peserta Wajib Di Isi.',
                'code.unique' => 'Kode Peserta Telah Di Gunakan.',
                'name.required' => 'Nama Peserta Wajib Di Isi.',
                'role.required' => 'Role Peserta Wajib Di Isi.',
            ],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            // Get Training
            $training = Training::where('slug', $slug)->first();
            // Store data
            Participant::create([
                'code' => $request->code,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-') . '-' . $request->code,
                'nip' => $request->nip,
                'birth' => $request->birth,
                'pangkat_golongan' => $request->pangkat_golongan,
                'jabatan' => $request->jabatan,
                'instansi' => $request->instansi,
                'role_id' => $request->role,
                'training_id' => $training->id,
            ]);
            return redirect()->route('dashboard.training.index')->with('success', 'Peserta ' . $request->name . ' berhasil di tambahkan pada pelatihan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dashboard.training.index')->with('fails', 'Peserta ' . $request->name . ' gagal di tambahkan pada pelatihan.');
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $training = Training::where('slug', $slug)->first();
        $participants = Participant::where('training_id', $training->id)->get();
        return view('auth.participant.show', compact('training', 'participants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $participant = Participant::where('code', $code)->first();
        $roles = Role::latest()->get();
        return view('auth.participant.edit', compact('participant', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        // Get participant
        $participant = Participant::where('code', $code)->first();

        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:participants,code,' . $participant->id,
                'name' => 'required',
                'role' => 'required',
            ],
            [
                'code.required' => 'Kode Peserta Wajib Di Isi.',
                'code.unique' => 'Kode Peserta Telah Di Gunakan.',
                'name.required' => 'Nama Peserta Wajib Di Isi.',
                'role.required' => 'Role Peserta Wajib Di Isi.',
            ],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            // Store data
            $participant->update([
                'code' => $request->code,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-') . '-' . $request->code,
                'nip' => $request->nip,
                'birth' => $request->birth,
                'pangkat_golongan' => $request->pangkat_golongan,
                'jabatan' => $request->jabatan,
                'instansi' => $request->instansi,
                'role_id' => $request->role,
                'training_id' => $participant->training_id,
            ]);
            return redirect()->route('dashboard.participant.show.peserta', $participant->training->slug)->with('success', 'Peserta ' . $request->name . ' berhasil di update.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('fails', 'Peserta ' . $request->name . ' gagal di update.');
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        DB::beginTransaction();
        try {
            $participant = Participant::where('code', $code)->first();

            $participant->delete($participant);
            return redirect()->route('dashboard.participant.show.peserta', $participant->training->slug)->with('success', 'Peserta ' . $participant->name . ' telah dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dashboard.participant.show.peserta', $participant->training->slug)->with('fails', 'Peserta ' . $participant->name . ' gagal dihapus.');
        } finally {
            DB::commit();
        }
    }
}
