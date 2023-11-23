Controller
 public function UpdatePassword(Request $request){
        try {
            // Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);

            // Match Old Password
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with('alert', 'error')->with('message', 'Password Lama Salah.');
            }

            // Update New Password
            $updateResult = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            if ($updateResult) {
                return back()->with('alert', 'success')->with('message', 'Update Password Berhasil.');
            } else {
                throw new \Exception('Gagal mengupdate password.');
            }
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return a specific error message
            return back()->with('alert', 'error')->with('message', $e->getMessage());
        }
    }
blade :
   <form method="POST" action="{{ route('update.password') }}"  class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label">Password Lama</label>
                      <div class="input-group input-group-merge has-validation">
                        <input
                        class="form-control "
                        type="text"
                        name="old_password"
                        id="old_password"
                        placeholder="············"
                        >
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                      <div id="password-feedback"></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label">Password Baru</label>
                      <div class="input-group input-group-merge has-validation">
                        <input
                        class="form-control"
                        type="text"
                        id="new_password"
                        name="new_password"
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>

                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                      <label class="form-label">Konfirmasi Password Baru</label>
                      <div class="input-group input-group-merge has-validation">
                        <input class="form-control"
                        type="text"
                        name="new_password_confirmation"
                        id="new_password_confirmation"
                        placeholder="············"
                        autocomplete="off">
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                      <div id="password-error" class="text-danger"></div>
                    </div>
                    <div class="col-12 mb-4">
                      <h6>Password Requirements:</h6>
                      <ul class="ps-3 mb-0">
                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                      </ul>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Simpan</button>
                      <button type="reset" class="btn btn-label-secondary waves-effect">Reset</button>
                    </div>
                  </div>
              </form>
