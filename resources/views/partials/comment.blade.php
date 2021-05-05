<div class="comment p-2 clearfix rounded-3 border border-1 border-secondary">
    <!-- User and date -->
    
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('show_profile', ['id' => $user_id]) }}" class="profile_text">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ asset('assets/' . App\Models\User::findUserImage($user_id)->path) }}" class="rounded-circle profile_picture_comment m-3" alt="Hanna Green"> 
                    <div>
                        <h6 class="m-0"> {{$username}} </h6>

                        <p>
                            {{\Carbon\Carbon::parse($datetime)->timezone('Europe/London')->format('H:i:s')}}
                            {{\Carbon\Carbon::parse($datetime)->timezone('Europe/London')->format('Y-m-d')}}
                        </p>
                    </div>
                </div>
            </a>
            
            <div class="moderator area m-3 text-center">
                <button type="button" class="btn rounded-pill m-1 moderator_button_ban" id="moderator_button">BAN FROM AUCTION</button>
                
                <form style="display: inline-block;" method="post" action="{{'/auctions/' . $auction_id . '/comments/' . $comment_id}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    {{-- <input type="hidden" name="comment_id" value="{{$comment_id}}"> --}}
                    <button type="submit" class="btn rounded-pill m-1" id="moderator_button">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    <p class="m-3 mt-0 text-justify">
        {{$content}}
    </p>
</div>