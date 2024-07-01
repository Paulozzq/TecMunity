<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Usuario;

class SearchUsuario extends Component
{
    public $search = '';
    
    public function render()
    {
        $result = [];

        if (strlen($this->search) >= 1) {
            $result = Usuario::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('apellido', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->search . '%')
                ->get();
        }

        return view('livewire.search-usuario', [
            'users' => $result,
        ]);
    }
}
