<div class="row">
    <!-- looping -->
    @foreach ($datas as $data)
    @php
    $class_card_read = $data->is_read == 1 ? 'card-read' : 'card-no__read';
    $text_read = $data->is_read == 1 ? 'Read' : 'Unread';
    @endphp
    <div class="col-lg-3" wire:ignore>
        <div class="card card-margin {{ $class_card_read }}" wire:click="$emit('detailModal', {{ $data->data_id }}, {{ $data->notif_type }})">
            <div class="card-header no-border">
                @if ($data->notif_type == \App\Constant::NOTIF_PRANUT)
                    <h5 class="card-title mt-4">{{$data->perkara ? $data->perkara->no_lp :'' }}</h5>
                @else
                    <h5 class="card-title mt-4"> {{$data->notif_fitur}}</h5>
                @endif
            </div>
            <div class="card-body pt-0">
                <div class="widget-49">
                    <div class="widget-49-title-wrapper">
                        <div class="widget-49-meeting-info">
                            <span class="widget-49-pro-title">{{ $text_read }}</span>
                            <span class="widget-49-meeting-time mt-1">{{ $data->age_of_data }}</span>
                        </div>
                    </div>
                    <div class="widget-49-meeting-action">
                        <a class="btn btn-sm btn-flash-border-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('detailModal', (id, notif_type) => {
            setTimeout(function () {
                Swal.fire({
                    title: 'Masukan PIN!',
                    text: "Masukan PIN Anda untuk bisa melihat detail data prapenuntutan!",
                    icon: 'warning',
                    input: 'password',
                    inputAttributes: {
                        required: true,
                        placeholder: 'Masukan PIN Anda',
                        autocapitalize: 'off',
                        maxlength: 6,
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Submit',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                }).then(function (result) {
                    let pinUser = result.value;
                    if (pinUser) {
                        window.livewire.emit('authPinNotification', id, pinUser, notif_type);
                    }
                });

            }, 1000);

            window.livewire.on('sweetAlertWithRedirect', (param) => {
                setTimeout(function () {
                    Swal.fire({
                        icon: param.icon,
                        title: param.title,
                        text: param.text,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    }).then(function () {
                        if (param.url_redirect != null) {
                            window.location = param.url_redirect;
                        }
                    });
                }, 1000);
            });

            window.livewire.on('sweetAlert', (param) => {
                setTimeout(function () {
                    Swal.fire({
                        icon: param.icon,
                        title: param.title,
                        text: param.text,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }, 1000);
            });
        });
    });

</script>
@endsection
