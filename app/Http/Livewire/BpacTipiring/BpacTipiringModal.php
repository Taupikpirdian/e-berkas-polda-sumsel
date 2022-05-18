<?php

namespace App\Http\Livewire\BpacTipiring;

use App\Http\Repositories\BpacTipiringRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;
use App\TersangkaBpacTipiring;

class BpacTipiringModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;

    protected $listeners = [
        'deleteBpacTipiring',
    ];

    public function deleteBpacTipiring($params)
    {
        try {
            $id = helperDecrypt($params);
            $data = (new BpacTipiringRepository)->getBpacTipiringById($id);
            $deleted = $data->delete();

            if ($deleted) {
                TersangkaBpacTipiring::where('id_bpac_tipiring', $id)->delete();
            }

        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $listBpacTipiring = (new BpacTipiringRepository)->listBpacTipiring($this->query)->paginate($this->perPage);

        $this->page > $listBpacTipiring->lastPage() ? $this->page = $listBpacTipiring->lastPage() : true;
        $paginate_content = (new BpacTipiringRepository)->paginateContent($listBpacTipiring);

        return view('livewire.bpac-tipiring.bpac-tipiring-modal', compact('paginate_content', 'listBpacTipiring'));
    }
}
