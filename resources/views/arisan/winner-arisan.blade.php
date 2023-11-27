<!-- resources/views/dashboard/draw-winner.blade.php -->

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Undian Arisan')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <h2 class="fw-light m-0 p-0">
                {{-- Logika tampilan peran pengguna Anda --}}
                {{ $arisan->nama_arisan }}
            </h2>
            <small class="text-muted m-0">*klik Putar dan tunggu untuk mulai mengundi</small>
        </div>

        <div class="card-body">
            <button id="spin" >Putar</button>
            {{-- <span class="arrow"></span> --}}
            <div class="container">
                <div class="one">🤣</div>
                <div class="two">😡</div>
                <div class="three">😚</div>
                <div class="four">🥴</div>
                <div class="five">🫣</div>
                <div class="six">😇</div>
                <div class="seven">😭</div>
                <div class="eight">🥶</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade animate__animated animate__tada" id="myModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <form method="POST" action="{{ route('draw-winner', ['uuid' => $arisan->uuid]) }}">
                @csrf
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h1 class="mb-2">🎉Selamat🎉</h1>
                <div class="m-1">
                    @if ($selectedWinner->foto_profil)
                    <img
                      src="{{ Storage::url($selectedWinner->foto_profil) }}"
                      alt="Profile"
                      width="200"
                      class="img-fluid"
                      />
                    @else
                      <i class="ti ti-user-circle ti-lg text-info"></i>
                    @endif
                  </div>
                <div class="row">
                    <div class="col">
                        <h3 class="mb-2">
                            {{ $selectedWinner->name }}
                        </h3>
                        <input type="hidden" class="form-control" id="winner" name="winner"
                            value="{{ $selectedWinner->name }}" readonly >
                        <input type="hidden" name="winner_id" value="{{ $selectedWinner->id }}" >
                        <input type="hidden" name="remaining_users" value="{{ $remainingUsers }}" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
                <div class="col-12 text-center">
                    <button type="submit"
                        class="btn btn-success me-sm-2">Undi Sekarang!</button>
                    <button type="reset" class="btn btn-label-danger btn-reset"
                        data-bs-dismiss="modal" aria-label="Close">
                        Batal
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Sertakan gaya CSS Anda di sini */
    *{
	box-sizing:border-box;
}

/* body{
	margin:0;
	padding:0;
	background-color: #1e1212;
	display:flex;
	align-items:center;
	justify-content: center;
	height:100vh;
	overflow:hidden;
} */

.container{
    top: 10px;
	width:500px;
	height:500px;
	background-color: #cfd3ec;
	border-radius:50%;
	border:15px solid #cfd3ec;
	position: relative;
	overflow: hidden;
	transition: 5s;
}

.container div{
	height:50%;
	width:200px;
	position: absolute;
	clip-path: polygon(100% 0 , 50% 100% , 0 0 );
	transform:translateX(-50%);
	transform-origin:bottom;
	text-align:center;
	display:flex;
	align-items: center;
	justify-content: center;
	font-size:20px;
	font-weight:bold;
	font-family:sans-serif;
	color:#000000;
	left:135px;
}

.container .one{
	background-color: #3f51b5;
	left:50%;
}
.container .two{
	background-color: #ff9800;
	transform: rotate(45deg);
}
.container .three{
	background-color: #e91e63;
	transform:rotate(90deg);
}
.container .four{
	background-color: #4caf50;
	transform: rotate(135deg);
}
.container .five{
	background-color: #009688;
	transform: rotate(180deg);
}
.container .six{
	background-color: #795548;
	transform: rotate(225deg);
}
.container .seven{
	background-color: #9c27b0;
	transform: rotate(270deg);
}
.container .eight{
	background-color: #f44336;
	transform: rotate(315deg);
}

.arrow{
	position: absolute;
	top:130px;
	left:70%;
	transform: translateX(-50%);
	color:#fff;
}

.arrow::before{
	content:"\1F817";
	font-size:50px;
}

#spin{
	position: absolute;
	top:80%;
	left:47%;
	transform:translate(-40%,-50%);
	z-index:10;
	background-color: #7464f4;
	text-transform: uppercase;
	border:8px solid #cfd3ec;
	font-weight:bold;
	font-size:16px;
	color:#ffffff;
	width: 100px;
	height:100px;
	font-family: sans-serif;
	border-radius:50%;
	cursor: pointer;
	outline:none;
	letter-spacing: 1px;
}

    /* ... Gaya lainnya ... */

</style>
<script>
    let container = document.querySelector(".container");
    let btn = document.getElementById("spin");
    let number = Math.ceil(Math.random() * 48000);

    btn.onclick = function () {
        container.style.transform = "rotate(" + number + "deg)";
        number += Math.ceil(Math.random() * 48000);

        // Set a timeout to show the modal after 5 seconds
        setTimeout(function () {
            showModal();
        }, 5000);
    }

    function showModal() {
        // Get the modal element
        var modal = new bootstrap.Modal(document.getElementById("myModal"));

        // Show the modal
        modal.show();

        // Bootstrap's Modal events
        modal.addEventListener('hide.bs.modal', function () {
            // Do something when the modal is hiding
        });

        modal.addEventListener('hidden.bs.modal', function () {
            // Do something when the modal is hidden
        });
    }
</script>
@endsection
