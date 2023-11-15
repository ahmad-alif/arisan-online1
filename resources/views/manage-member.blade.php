@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Owner')
@section('content')

<!-- Striped Rows -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Pengguna</h4>

<div class="card">
    <div class="table-responsive text-nowrap">
        {{-- <div class="d-flex justify-content-between align-items-center ms-3 ">
            <div class="col-1">
                <button type="button" class="btn btn-sm btn-primary">
                    <span class="ti-xs ti ti-plus me-1"></span>Tambah
                </button>
            </div>
            <div class="col-1">
                <!-- Area tengah kosong -->
            </div>
            <div class="">
                <form action="/manage-member" method="GET">
                    <div class="input-group input-group-merge card-body">
                        <input type="text" class="form-control" name="search"
                            value="{{ request('search') }}" placeholder="Cari member...">
                    </div>
                </form>
            </div>
        </div> --}}
        {{-- <div class="ms-3 end-0 top-0 mt-3 ml-4">
            <button type="button" class="btn btn-sm btn-primary">
                <span class="ti-xs ti ti-plus me-1"></span>Tambah
            </button>
            <div class="ml-auto">
                <span id="basic-addon-search31"><i class="ti ti-search"></i></span>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Search..."
                          aria-label="Search..."
                          aria-describedby="basic-addon-search31" />
            </div>
        </div> --}}

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

      <table class="table table-striped">
        <div class="row p-3">
            <div class="col-sm">
                <button type="button" class="btn btn-sm btn-primary">
                    <span class="ti-xs ti ti-plus me-1"></span>Tambah
                </button>
            </div>
            <div class="col-sm">

            </div>
            <div class="col-sm">
                <input type="text" class="form-control" name="search"
                value="{{ request('search') }}" placeholder="Cari member...">
            </div>
        </div>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Foto Profil</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">No HP</th>
            @if (Auth::user()->role == 2)
                <th scope="col">Status</th>
            @endif
                <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($members as $member)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    @if ($member->foto_profil)
                        <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile" class="rounded-circle" width="35" height="35">
                    @else
                        <i class="ti ti-user-circle ti-lg text-info"></i>
                    @endif
                </td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->nohp }}</td>
                @if (Auth::user()->role == 2)
                <td>
                    @if ($member->active == 0)

                        <form
                            action="{{ route('activate-account', ['id' => $member->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <span class="badge bg-label-success me-1">Aktif</span>
                        </form>
                            @elseif ($member->active == 1)
                            <button type="button" class="btn btn-label-danger btn-sm">Mati</button>
                            @endif
                </td>
                @endif
                <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"
                          ><i class="ti ti-pencil me-1"></i> Edit</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                          ><i class="ti ti-trash me-1"></i> Delete</a
                        >
                        <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="ti ti-info-square me-1"></i> Info</a>
                      </div>
                    </div>
                  </td>
            </tr>


            @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Striped Rows -->

  </div>
<!--/ Responsive Table -->
</div>
<!-- / Content -->

@endsection
