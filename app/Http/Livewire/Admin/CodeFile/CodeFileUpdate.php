<?php

namespace App\Http\Livewire\Admin\CodeFile;

use App\CodeFile;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class CodeFileUpdate extends Component
{
    public $uid = null,
    $code, $name;

    public function mount($selectedCodeFileId)
    {
        try {
            $this->breadcrumb = "Tambah Code File";
            $this->codeFile = null;
            if ($selectedCodeFileId) {
                $idCodeFile = Crypt::decrypt($selectedCodeFileId);
                $this->codeFile = CodeFile::find($idCodeFile);
                if ($this->codeFile) {
                    $this->breadcrumb = "Edit Code File";
                    $this->uid = $this->codeFile->id;
                    $this->name = $this->codeFile->name;
                    $this->code = $this->codeFile->code;
                }
            }
        } catch (DecryptException $e) {
            return $e;
        }
    }

    public function addCodeFile()
    {
        if (!$this->codeFile) {
            $this->validate([
                'name' => 'nullable',
                'code' => 'required|unique:code_files,code',
            ]);

            $codeFile = CodeFile::create([
                'code' => $this->code,
                'name' => $this->name,
            ]);

            $this->emit('codeFileUpdated', false);
        } else {

            if ($this->codeFile->code != $this->code) {
                $this->validate([
                    'code' => 'required|unique:code_files,code',
                ]);
            }

            $this->validate([
                'name' => 'nullable',
                'code' => 'required',
            ]);

            $this->codeFile->name = $this->name;
            $this->codeFile->code = $this->code;
            $this->codeFile->save();

            $this->emit('codeFileUpdated', true);
        }

        $this->name = '';
        $this->code = '';
    }

    public function indexCodeFile()
    {
        $this->emit('indexCodeFile', true);
    }

    public function render()
    {
        return view('livewire.admin.code-file.code-file-update');
    }
}
