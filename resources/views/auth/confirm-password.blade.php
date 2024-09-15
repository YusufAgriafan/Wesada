<x-auth.header></x-auth.header>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('/auth/images/img-01.png ') }}" alt="IMG">
				</div>

				<form class="login100-form validate-form"method="POST" action="{{ route('password.confirm') }}">
					@csrf
					<!-- Session Status -->
					<x-auth-session-status class="mb-4" :status="session('status')" />

					<span class="login100-form-title">
						Konfirmasi Password
					</span>

                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" style="text-align: center;">
                        {{ __('Ini adalah area aplikasi yang aman. Harap konfirmasi kata sandimu sebelum melanjutkan.') }}
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <x-text-input placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password" />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<x-input-error :messages="$errors->get('password')" class="mt-2" />

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Konfirmasi
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
<x-auth.footer></x-auth.footer>