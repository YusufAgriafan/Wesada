<section>
    <div class="row g-5 align-items-center justify-content-center">
        <div class="col-lg-8 wow fadeInUp">
            <header class="text-center">
                <h2 class="display-5 mb-2">
                    {{ __('Perbarui Kata Sandi') }}
                </h2>
                <p class="mb-4">
                    {{ __('Pastikan akunmu menggunakan kata sandi panjang dan acak agar tetap aman.') }}
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div class="row mb-4">
                    <div class="col-lg-12">
                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                        <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-12">
                        <x-input-label for="update_password_password" :value="__('New Password')" />
                        <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-12">
                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6 ">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
