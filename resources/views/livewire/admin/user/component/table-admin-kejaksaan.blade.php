{{-- admin kejaksaan --}}
<table class="table border-top table-bordered mb-0">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Akses</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $i=>$user)
        <tr>
            <td class="text-center align-middle">{{ ($users->currentpage()-1) * $users->perpage() + $i + 1 }}</td>
            <td class="text-nowrap align-middle">{{ $user->name }}</td>
            <td class="text-nowrap align-middle">{{ $user->email }}</td>
            <td class="text-center align-middle">
              @if(!$user->roles->isEmpty())
                <span class="badge bg-success text-white">{{ transRoleOperator()[$user->roles->pluck('name')[0]] }}</span>
              @else
                <span class="badge bg-warning text-white">Belum terdaftar</span>
              @endif
            </td>

            <td class="align-middle">
              @foreach ($user->akses as $item)
                {{ $item->satker ? $item->satker->name : '-' }}
              @endforeach
            </td>

            <td class="text-center align-middle">
              <div class="dropup btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fe fe-list"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="users/{{ helperEncrypt($user->id) }}/edit" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                    <a class="dropdown-item" wire:click="$emit('deleteModalUser', {{ $user->id }})"><i class="fe fe-trash"></i> Hapus</a>
                </div>
              </div>
            </td>
        </tr>
        @empty
            <td colspan="7">
            Data Kosong
            </td>
        @endforelse
    </tbody>
</table>