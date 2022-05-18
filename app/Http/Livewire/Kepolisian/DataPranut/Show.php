<?php

namespace App\Http\Livewire\Kepolisian\DataPranut;

use App\Perkara;
use App\FilePerkara;
use App\AssignPerkara;
use Livewire\Component;
use App\TersangkaPerkara;
use Livewire\WithPagination;
use App\Http\Repositories\DataMasterRepository;

class Show extends Component
{
    use WithPagination;
    public $uid, $perkara;
    public $perPage = 10;

    public function mount($id = null)
    {
        $this->uid = $id;
        $this->perkara = Perkara::with([
            'listPenyidik.masterPenyidik.pangkat',
            'listPenyidik.masterPenyidik.user'
        ])->find($this->uid);
    }

    public function render()
    {
        // data berkas
        $filePerkara = FilePerkara::with([
            'masterFile',
            'uploadedBy',
            'tersangka',
        ])->where('perkara_id', $this->uid)->paginate($this->perPage, ['*'], 'fileperkara');
        $this->page > $filePerkara->lastPage() ? $this->page = $filePerkara->lastPage() : true;
        $paginate_content_fileperkara = (new DataMasterRepository)->contentPaginate($filePerkara);

        // data tersangka
        $listTersangka = TersangkaPerkara::where('perkara_id', $this->uid)->paginate($this->perPage, ['*'], 'tersangka');
        $this->page > $listTersangka->lastPage() ? $this->page = $listTersangka->lastPage() : true;
        $paginate_content_listtersangka = (new DataMasterRepository)->contentPaginate($listTersangka);

        // data jaksa
        $listJaksa = AssignPerkara::with([
            'masterJaksa.pangkat',
            'masterJaksa.user',
        ])->where('perkara_id', $this->uid)->paginate($this->perPage, ['*'], 'jaksa');
        $this->page > $listJaksa->lastPage() ? $this->page = $listJaksa->lastPage() : true;
        $paginate_content_listjaksa = (new DataMasterRepository)->contentPaginate($listJaksa);

        return view('livewire.kepolisian.data-pranut.show', compact(
            'filePerkara',
            'paginate_content_fileperkara',
            'listTersangka',
            'paginate_content_listtersangka',
            'listJaksa',
            'paginate_content_listjaksa'
        ));
    }
}
