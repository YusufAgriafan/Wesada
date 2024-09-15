<x-auth.header></x-auth.header>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('/auth/images/img-01.png ') }}" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('password.store') }}">
					@csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

					<!-- Session Status -->
					<x-auth-session-status class="mb-4" :status="session('status')" />

					<span class="login100-form-title">
						Reset Password
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required">
						<x-text-input placeholder="Email" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<x-input-error :messages="$errors->get('email')" class="mt-2" />

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <x-text-input placeholder="Password" id="password" type="password" name="password" required autocomplete="new-password"  />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<x-input-error :messages="$errors->get('password')" class="mt-2" />

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <x-text-input placeholder="Password confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset Password
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
<x-auth.footer></x-auth.footer>