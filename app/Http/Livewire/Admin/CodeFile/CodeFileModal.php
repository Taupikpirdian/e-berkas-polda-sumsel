<?php

namespace App\Http\Livewire\Admin\CodeFile;

use App\CodeFile;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Livewire\WithPagination;

class CodeFileModal extends Component
{
    use WithPagination;
    public $query = '';
    public $perPage = 10;
    public $createdCodeFile = false;
    public $selectedCodeFileId = null;
    public $deleteModalCodeFile = false;

    protected $listeners = [
        'codeFileUpdated',
        'indexCodeFile',
        'deleteCodeFile',
    ];

    public function codeFileUpdated($status)
    {
        $this->createdCodeFile = false;
        if ($status) {
            $this->emit('updateSweetAlert', true);
        } else {
            $this->emit('createSweetAlert', true);
        }
    }

    public function showFormCreateCodeFile($id)
    {
        try {
            $idCodeFile = $id != null ? Crypt::encrypt($id) : $id;
            $this->createdCodeFile = true;
            $this->emit('showFormCreateCodeFile', true);
            $this->selectedCodeFileId = $id;
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function deleteCodeFile($params)
    {
        try {
            $idCodeFile = Crypt::decrypt($params);
            $codeFile = CodeFile::find($idCodeFile);
            $codeFile->delete();
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function indexCodeFile($params)
    {
        $this->createdCodeFile = false;
    }

    public function showDetail($id)
    {
        try {
            $idCodeFile = Crypt::decrypt($id);
            $this->createdCodeFile = true;
            $this->emit('showFormCreateCodeFile', true);
            $data = [
                'id' => $idCodeFile,
                'show' => true,
            ];

            $this->selectedCodeFileId = $data;
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function render()
    {
        $codeFile = CodeFile::orderBy('updated_at', 'desc')
            ->where('code', 'like', "%$this->query%")
            ->orWhere('name', 'like', "%$this->query%")
            ->paginate($this->perPage);

        $this->page > $codeFile->lastPage() ? $this->page = $codeFile->lastPage() : true;

        $count = $codeFile->count();

        $limit = $codeFile->perPage();
        $page = $codeFile->currentPage();
        $total = $codeFile->total();

        $upper = min($total, $page * $limit);
        if ($count == 0) {
            $lower = 0;
        } else {
            $lower = ($page - 1) * $limit + 1;
        }
        $paginate_content = "Showing $lower to $upper of $total";

        return view('livewire.admin.code-file.code-file-modal', compact('codeFile', 'paginate_content'));
    }
}
