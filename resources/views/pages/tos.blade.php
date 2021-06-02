@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')

<section class="sign-in-container">
    <div class="container bg-light p-4 tos-whole">
        <div class="display-2 ">Terms of Service</div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 ps-1 pt-1 pb-5">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms of Service</li>
        </ol>
        </nav>

        <main class="accordion-container border border-1 border-secondary rounded-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size: calc(1.425rem + 1.5vw) !important;">
                        User Interaction
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-light fs-3">Upon registry as a user of our website, you pledge to keep every auction a safe place, <b>free of harsh language and offensive comments</b>. Users who do not respect this rule <b>will be banned</b>.</div>
                    </div>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="font-size: calc(1.425rem + 1.5vw) !important;">
                        Buying
                    </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-light fs-3">As a buyer, you must obey your capitalist God's commands and buy everyday.</div>
                    </div>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="font-size: calc(1.425rem + 1.5vw) !important;">
                        Selling
                    </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-light fs-3">As a seller, you can manage the interaction that users partake in your auction pages. By default, you'll be assigned <b>moderator privileges</b> to these pages, with the ability to opt out.
                    <br>
                    You are not allowed to bid on your own auctions, and any discovered attempts of <b>inflating auction prices</b> will be met with a <b>ban</b>.</div>
                    </div>
                </div>
                <div class="accordion-item mt-2">
                    <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour" style="font-size: calc(1.425rem + 1.5vw) !important;">
                        Auctions
                    </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-light fs-3">An auction's date must always be set in the future. Auctions cannot be set to start at a past date. Auction duration is also fixed to a minimum of <b>1 hour</b>.</div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive" style="font-size: calc(1.425rem + 1.5vw) !important;">
                        Moderation
                    </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-light fs-3"><b>Moderators</b> have the duty to uphold the peace in their assigned auctions. They have the ability to ban users from comment sections and remove select comments.
                    <br>
                    Besides these responsibilities, <b>Admins</b> must also keep the website safe of troll auctions, removing them when need be, and problematic users, having the ability to <b>perma ban</b>.</div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</section>

@endsection
