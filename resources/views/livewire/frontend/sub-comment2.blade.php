@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px; border-left:1px solid darkgreen" @endif>
          <div class="container mt-1">
            <div class="d-flex justify-content-center row g-0">
                <div class="col-md-12">
                    <div class="d-flex flex-column comment-section">
                        <div class="bg-white p-1">
                            <div class="d-flex flex-row user-info">
                                <img class="rounded-circle" src="{{ $comment->users->profile_photo_url }}" width="45">
                                <div class="d-flex flex-column justify-content-start ms-2"><span class="d-block font-weight-bold name">{{ $comment->users->name }}</span><span class="date text-black-50">{{ date('d-M-Y h:i a', strtotime($comment->created_at)); }}</span></div>
                            </div>
                            <div class="mt-2 ms-5">
                                <p class="comment-text ps-2">{!! $comment->comment_body !!}</p>
                            </div>
                        </div>
                        <div class="bg-white ms-5">
                            <div class="d-flex flex-row fs-12">
                                <div class="like p-2 cursor"><i class="fa-solid fa-thumbs-up"></i><span class="ms-1">Like</span></div>
                                <div class="like p-2 cursor"><a class="showreply" id="{{ $comment->id }}"><i class="fa-solid fa-reply"></i><span class="ms-1">Reply</span></a></div>
                                <div style="display: none" id="copyname{{ $comment->id }}">{{ '@' }}{{ $comment->users->name }}</div>
                            </div>
                        </div>
                        @auth
                        <div class="p-2 comment-reply-box{{ $comment->id }} commenter-avatar ms-5" style="display: none">
                            <form method="post" action="{{ route('comments.store')}}" style="width: 100%">
                                @csrf
                                <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}
                                " width="30" height="25">
                                <textarea class="form-control ms-1 shadow-none textarea" wire:model="reply_body" id="comment_body{{ $comment->id }}" name="comment_body" placeholder="Write Your Comment Here"></textarea>
                                <input type="hidden" name="post_id" wire:model="reply_pid" value="{{ $post_id }}" />
                                <input type="hidden" name="parent_id" wire:model="parent_id" value="{{ $comment->id }}" />

                                </div>
                                <div class="ps-5 mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none me-1"  wire:click.prevent='storeReply()'>Reply comment</button>
                                    <a class="btn btn-outline-primary btn-sm ml-1 shadow-none closereply" id="{{ $comment->id }}" type="button">Cancel</a>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="p-2 comment-reply-box{{ $comment->id }} commenter-avatar ms-5" style="display: none"><h6>Please <a href="{{ url('/login') }}">Login</a> First for Reply</h6><a class="btn btn-outline-primary btn-sm ml-1 shadow-none closereply" id="{{ $comment->id }}" type="button">Cancel</a></div>

                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.frontend.sub-comment', ['comments' => $comment->replies])
    </div>

@endforeach
