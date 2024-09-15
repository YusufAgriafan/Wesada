<x-auth.header></x-auth.header>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('/auth/images/img-01.png ') }}" alt="IMG">
				</div>

				<form class="login100-form validate-form"method="POST" action="{{ route('verification.send') }}">
					@csrf
					<!-- Session Status -->
					<x-auth-session-status class="mb-4" :status="session('status')" />

					{{-- <span class="login100-form-title">
						Konfirmasi Password
					</span> --}}

                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" style="text-align: center;">
                        {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah kamu memverifikasi alamat emailmu dengan mengklik tautan yang baru saja kami kirimi email kepada kamu? Jika kamu tidak menerima email, kami dengan senang hati akan mengirimi kamu yang lain.') }}
                    </div>
                
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400" style="text-align: center;">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang kamu berikan selama pendaftaran.') }}
                        </div>
                    @endif

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Kirim Ulang
						</button>
					</div>

                    <div class="text-center p-t-12">
						<form method="POST" action="{{ route('logout') }}">
                            @csrf
                
                            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Log Out') }}
                            </button>
                        </form>
					</div>

				</form>
			</div>
		</div>
	</div>
	
<x-auth.footer></x-auth.footer>