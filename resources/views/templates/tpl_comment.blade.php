<template id="comment">
<div class="comment p-2 clearfix rounded-3 border border-1 border-secondary">
    <!-- User and date -->
    
        <div class="d-flex justify-content-between align-items-center">
            <a href="" class="profile_text">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="" class="rounded-circle profile_picture_comment m-3" alt="Hanna Green"> 
                    <div>
                        <h6 class="username m-0"></h6>

                        <p class="datetime">
                        </p>
                    </div>
                </div>
            </a>
            
            @if (!Auth::guest() && (App\Models\User::findOrFail(Auth::id())->moderator() || App\Models\User::findOrFail(Auth::id())->modAuction($auction->id)))
                <div class="moderator area m-3 text-center">
                        <form class="delete_form" style="display: inline-block;" onsubmit="Comment.delete(this, auctionId); Comment.updateSection(auctionId); return false;">
                            @csrf
                            <input type="hidden" name="id">
                            <button type="submit" class="btn rounded-pill m-1" id="moderator_button">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                </div>
            @endif

        </div>
    <p class="content m-3 mt-0 text-justify">
    </p>
</div>
</template>
