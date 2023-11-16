@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Owner | Arisanku')
@section('content')

<!-- Striped Rows -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Owner</h4>

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
                            value="{{ request('search') }}" placeholder="Cari member..."> --}}
                        {{-- <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="ti ti-search"></i>
                            </button>
                        </div> --}}
                    {{-- </div>
                </form>
            </div>
        </div> --}}
        {{-- <div class="ms-3 end-0 top-0 mt-3 ml-4">
            <button type="button" class="btn btn-sm btn-primary">
                <span class="ti-xs ti ti-plus me-1"></span>Tambah
            </button>
        </div> --}}

      <table class="table table-striped">
        <div class="row p-3">
            <div class="col-sm">
                <button type="button" class="btn btn-sm btn-primary">
                    <span class="ti-xs ti ti-user-plus me-1"></span>Tambah
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
            <th scope="col" style="text-align: center; vertical-align: middle;">Foto Profil</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">No HP</th>
            <th scope="col" >Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($owners as $owner)
                <tr class="align-middle">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td style="display: flex; justify-content: center;">
                        <div class="ti ti-lg text-danger me-3">
                        @if ($owner->foto_profil)
                            <img src="{{ Storage::url($owner->foto_profil) }}" alt="Profile" class="rounded-circle" width="35"/>
                            {{-- <img src="{{ Storage::url($owner->foto_profil) }}" alt="Profile"
                            class="rounded-circle" width="100"> --}}
                        @else

                            <i class="ti ti-user-circle ti-lg text-info"></i>
                            {{-- <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                class="rounded-circle" width="100"> --}}
                        @endif
                        </div>
                    </td>
                    <td>{{ $owner->username }}</td>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->email }}</td>
                    <td>{{ $owner->nohp }}</td>
                    <td style="align-items: center; justify-content: center;">
                        @if ($owner->active == 0)
                            {{-- <button class="btn btn-sm btn-success">
                                <i class="bi bi-check"></i>
                            </button> --}}
                            <form
                                action="{{ route('activate-account-owner', ['id' => $owner->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-label-danger btn-sm">Mati</button>
                                {{-- <button type="submit"
                                    class="btn btn-sm btn-success col-6 mb-1">
                                    <i class="bi bi-check"></i>
                                </button> --}}
                            </form>
                        @elseif ($owner->active == 1)
                        <span class="badge bg-label-success me-1">Aktif</span>
                            {{-- <button class="btn btn-sm btn-secondary" disabled>
                                <i class="bi bi-check"></i>
                            </button> --}}
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('edit-owner', ['id' => $owner->id]) }}"
                                ><i class="ti ti-pencil me-1"></i> Ubah</a>

                              {{-- <form action="{{ route('delete-owner', ['id' => $owner->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button dropdown-item" href=""
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal-{{ $owner->id }}">
                                    <i class="ti ti-trash me-1"></i> Hapus
                                </button>
                              </form> --}}

                                <button class="button dropdown-item" href=""
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal-{{ $owner->id }}">
                                    <i class="ti ti-trash me-1"></i> Hapus
                                </button>


                              {{-- <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="ti ti-trash me-1"></i> Hapus</a
                              > --}}
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="ti ti-info-square me-1"></i> Info</a>
                            </div>
                          </div>
                    </td>
                </tr>
            @endforeach
            @foreach ($owners as $owner)
                                    <!-- Modal Konfirmasi Delete -->
                                 {{-- <div class="modal fade" id="confirmDeleteModal-{{ $owner->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $owner->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteModalLabel-{{ $owner->id }}">Konfirmasi
                                                        Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus owner ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('delete-owner', ['id' => $owner->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

            <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="confirmDeleteModal-{{ $owner->id }}"
                aria-labelledby="confirmDeleteModalLabel-{{ $owner->id }}"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h1 class="mb-2">🤔</h1>
                        <h3 class="mb-2">Apakah anda ingin menghapus</h3>
                        <h2 class="mb-2">
                            {{ $owner->username }}
                        </h2>
                        <p class="text-danger">*Data yang sudah dihapus tidak dapat dikembalikan</p>
                      </div>
                      <form id="addNewCCForm" class="row g-3" action="{{ route('delete-owner', ['id' => $owner->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        {{-- <div class="col-12">
                          <label class="form-label w-100" for="modalAddCard">Card Number</label>
                          <div class="input-group input-group-merge">
                            <input
                              id="modalAddCard"
                              name="modalAddCard"
                              class="form-control credit-card-mask"
                              type="text"
                              placeholder="1356 3215 6548 7898"
                              aria-describedby="modalAddCard2" />
                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"
                              ><span class="card-type"></span
                            ></span>
                          </div>
                        </div> --}}
                        {{-- <div class="col-12 col-md-6">
                          <label class="form-label" for="modalAddCardName">Name</label>
                          <input type="text" id="modalAddCardName" class="form-control" placeholder="John Doe" />
                        </div>
                        <div class="col-6 col-md-3">
                          <label class="form-label" for="modalAddCardExpiryDate">Exp. Date</label>
                          <input
                            type="text"
                            id="modalAddCardExpiryDate"
                            class="form-control expiry-date-mask"
                            placeholder="MM/YY" />
                        </div>
                        <div class="col-6 col-md-3">
                          <label class="form-label" for="modalAddCardCvv">CVV Code</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              id="modalAddCardCvv"
                              class="form-control cvv-code-mask"
                              maxlength="3"
                              placeholder="654" />
                            <span class="input-group-text cursor-pointer" id="modalAddCardCvv2"
                              ><i
                                class="text-muted ti ti-help"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Card Verification Value"></i
                            ></span>
                          </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-12">
                          <label class="switch">
                            <input type="checkbox" class="switch-input" />
                            <span class="switch-toggle-slider">
                              <span class="switch-on"></span>
                              <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Save card for future billing?</span>
                          </label>
                        </div> --}}
                        <div class="col-12 text-center">
                        {{-- <form action="{{ route('delete-owner', ['id' => $owner->id]) }}"
                            method="POST"> --}}
                          <button type="submit" class="btn btn-danger me-sm-3 me-1">Hapus</button>
                          <button
                            type="reset"
                            class="btn btn-label-secondary btn-reset"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Batal
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->
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
