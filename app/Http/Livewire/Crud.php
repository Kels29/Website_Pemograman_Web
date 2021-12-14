<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JadwalKuliah;

class Crud extends Component
{
    public $jadwal_kuliahs, $nama_pelajaran, $jadwal_pelajaran, $kode_pelajaran, $nama_dosen, $jadwal_kuliah_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->jadwal_kuliahs= JadwalKuliah::all();
        return view('livewire.crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->nama_pelajaran = '';
        $this->jadwal_pelajaran = '';
        $this->kode_pelajaran = '';
        $this->nama_dosen = '';
    }
    
    public function store()
    {
        $this->validate([
            'nama_pelajaran' => 'required',
            'jadwal_pelajaran' => 'required',
            'kode_pelajaran' => 'required',
            'nama_dosen' => 'required',
        ]);
    
        JadwalKuliah::updateOrCreate(['id' => $this->jadwal_kuliah_id], [
            'nama_pelajaran' => $this->nama_pelajaran,
            'jadwal_pelajaran' => $this->jadwal_pelajaran,
            'kode_pelajaran' => $this->kode_pelajaran,
            'nama_dosen' => $this->nama_dosen,
        ]);

        session()->flash('message', $this->jadwal_kuliah_id ? 'Jadwal Kuliah Diubah.' : 'Jadwal Kuliah Dibuat.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $jadwal_kuliah = JadwalKuliah::findOrFail($id);
        $this->jadwal_kuliah_id = $id;
        $this->nama_pelajaran = $jadwal_kuliah->nama_pelajaran;
        $this->jadwal_pelajaran = $jadwal_kuliah->jadwal_pelajaran;
        $this->kode_pelajaran = $jadwal_kuliah->kode_pelajaran;
        $this->nama_dosen = $jadwal_kuliah->nama_dosen;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        JadwalKuliah::find($id)->delete();
        session()->flash('message', 'Jadwal Kuliah Dihapus.');
    }
}
