<div>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Diskusi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Diskusi</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-left main-content-left-chat">

                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model='query' placeholder="Search ...">
                            </div>
                        </div>
                        <nav class="nav main-nav-line main-nav-line-chat card-body">
                            <a class="nav-link @if($is_chat == true) active @endif" data-bs-toggle="tab" href="#ChatList" wire:click="flagActive('ChatList')">Diskusi Terbaru</a>
                            {{-- <a class="nav-link @if($is_chat == false) active @endif" data-bs-toggle="tab" href="#ChatContacts" wire:click="flagActive('ChatContacts')">Contacts</a> --}}
                        </nav>
                        <div class="tab-content main-chat-list ps ps--active-y">
                            <div class="tab-pane @if($is_chat == true) active @endif" id="ChatList">
                                <div class="main-chat-list tab-pane">
                                    {{-- loop here --}}
                                    @foreach($recent_chats as $key=>$recent_chat)
                                    @php
                                        $countChat = count($recent_chat->conversationNotRead);
                                    @endphp
                                    <a class="media @if($countChat > 0) new @else selected @endif" wire:click="selectUser({{ $recent_chat->user_id }})">
                                        <div class="main-img-user online">
                                            <img alt="" src="../../assets/images/users/5.jpg"> @if($countChat > 0) <span>{{ $countChat }}</span> @endif
                                        </div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>{{ $recent_chat->name }}</span> <span>{{ $recent_chat->conversation ? $recent_chat->conversation->created_at : '' }}</span>
                                            </div>
                                            <p>{{ $recent_chat->conversation ? ($recent_chat->conversation->type_message == 'text' ? \Illuminate\Support\Str::limit($recent_chat->conversation->message, 50, $end='...') : 'upload file ...') : '' }}</p>
                                        </div>
                                    </a>
                                    @endforeach
                                </div><!-- main-chat-list -->
                            </div><!-- main-chat-list -->
                            <div class="tab-pane @if($is_chat == false) active @endif" id="ChatContacts">
                                @forelse ($contacts as $i=>$contact)
                                <a href="#" wire:click="selectUser({{ $contact->id }})" class="d-flex align-items-center media">
                                    <div class="mb-0 me-2">
                                        <div class="main-img-user online">
                                            <img alt="" src="../../assets/images/users/3.jpg"> <span>2</span>
                                        </div>
                                    </div>
                                    <div class="align-items-center justify-content-between">
                                        <div class="media-body ms-2">
                                            <div class="media-contact-name">
                                                    <span>{{ $contact->name }}</span>
                                                    <span></span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <p class="text-muted tx-13">{{ $contact->roles->pluck('name')[0] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="contact-status text-primary fe fe-message-square  me-2"></i>
                                    </div>
                                </a>
                                @empty
                                <a href="#" class="d-flex align-items-center media">
                                    <div class="align-items-center justify-content-between">
                                        <div class="media-body ms-2">
                                            <div class="media-contact-name">
                                                    <span>Data Kosong</span>
                                                    <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforelse
                            </div>
                        </div>
                        <!-- main-chat-list -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">
            @if($user_id)
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat">
                        <div class="main-chat-header pt-3">
                            <div class="main-img-user online"><img alt="avatar" src="../../assets/images/users/1.jpg"></div>
                            <div class="main-chat-msg-name mt-2">
                                <h6>{{ $user_name_selected }}</h6>
                                <span class="dot-label bg-success"></span><small class="me-3">online</small>
                            </div>
                            {{-- create berita acara --}}
                            <nav class="nav">
                                @if($conversations->count() > 0)
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Buat berita acara"></i> Buat Berita Acara</a>
                                @endif
                            </nav>
                        </div><!-- main-chat-header -->
                        <div class="main-chat-body ps ps--active-y" id="ChatBody">
                            <div class="content-inner">
                              @forelse ($conversations as $i=>$conversation)
                              <div class="@if(Auth::user()->id == $conversation->user_id) media flex-row-reverse chat-right @else media chat-left @endif">
                                  <div class="main-img-user online"><img alt="avatar" src="../../assets/images/users/2.jpg"></div>
                                  <div class="media-body">
                                      <div class="main-msg-wrapper">
                                          @if($conversation->type_message == 'text')
                                            {{ $conversation->message }}
                                          @else
                                            {{ $conversation->original_name }}
                                            <a href="/download-file-discussion/{{ helperEncrypt($conversation->id) }}" class="btn btn-info-light btn-square  br-50 m-1" data-bs-toggle="tooltip" title="" data-bs-original-title="download berkas">
                                                <i class="fe fe-download"></i>
                                            </a>
                                          @endif
                                      </div>
                                      <div>
                                          <span>{{ $conversation->created_at }}</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                                      </div>
                                  </div>
                              </div>
                              @empty
                              <label class="main-chat-time"><span>Tidak ada histori percakapan</span></label>
                              @endforelse
                            </div>
                        </div>
                        <form action="#" method="post" wire:submit.prevent="submitMessage">
                          @csrf
                          <div class="main-chat-footer">
                              <nav class="nav">
                                    <label class="input-group-text btn-file__message">
                                        <i class="fe fe-paperclip"></i><input type="file" wire:model='files' id="actual-btn" name="files" class="file-browserinput" hidden multiple>
                                    </label>
                                    <!-- <a class="nav-link" data-bs-toggle="tooltip" href="" title="Attach a File"><i class="fe fe-paperclip"></i></a> -->
                              </nav>
                              <input class="form-control" wire:model='text' placeholder="Type your message here..." type="text">
                              <button type="submit" class="btn btn-primary btn-sm main-msg-send"><i class="fa fa-paper-plane-o"></i></button>
                              <!-- <button class="main-msg-send" href=""><i class="fa fa-paper-plane-o"></i></button> -->
                          </div>
                        </form>
                    </div>                   
                </div>
                <div class="main-content-app pt-0">
                    <div class="main-content-body main-content-body-chat">
                        <div class="content-inner">
                            @if($files)
                                @foreach ($files as $file)
                                    <div class="row mt-3" style="width: 98%; margin: auto;">
                                        <div class="col-sm-12">
                                            <div class="card bg-primary img-card box-primary-shadow">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="text-white">
                                                            <h4 class="mb-0 number-font mt-2">{{ $file->getClientOriginalName() }}</h4>
                                                        </div>
                                                        <div class="ms-auto"> <i class="fa fa-file text-white fs-30 me-2 mt-2"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card custom-card">
                <div class="main-content-app pt-0">
                    {{-- ketika pertama kali dibuka --}}
                    <div class="main-content-body main-content-body-chat">
                        <div class="main-chat-body ps ps--active-y" id="ChatBody">
                            <div class="content-inner">
                                <label class="main-chat-time"><span>Selamat datang di fitur diskusi</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- End Row -->
</div>
