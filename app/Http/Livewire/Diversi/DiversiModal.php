<?php

namespace App\Http\Livewire\Diversi;

use App\Http\Repositories\DiversiRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class DiversiModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteDiversi',
    ];

    public function deleteDiversi($params)
    {
        try {
            $id = helperDecrypt($params);
            $data = (new DiversiRepository)->getDiversiById($id);
            $data_file = (new DiversiRepository)->getFileDiversiById($id);
            foreach ($data_file as $data) {
                $data->delete();
            }
            $data->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listDiversi = (new DiversiRepository)->listDiversi($this->query)->paginate($this->perPage);
        $this->page > $listDiversi->lastPage() ? $this->page = $listDiversi->lastPage() : true;
        $paginate_content = (new DiversiRepository)->paginateContent($listDiversi);

        return view('livewire.diversi.diversi-modal', compact('paginate_content', 'listDiversi'));
    }
}
