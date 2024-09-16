<section class="d-flex justify-content-center">
    <div class="col-lg-8 wow fadeInUp">
        <header class="text-center">
            <h2 class="display-5 mb-2">
                {{ __('Informasi Profil') }}
            </h2>
            <p class="mb-4">
                {{ __("Perbarui informasi profil dan alamat email akunmu.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div class="row mb-4">
                <div class="col-lg-12">
                    <x-input-label for="name" :value="__('Name')" />
                    <div class="">
                        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-12">
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="">
                        <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2">
                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                    {{ __('Alamat email kamu tidak diverifikasi.') }}

                                    <button form="send-verification" class="btn btn-primary w-100 py-3">
                                        {{ __('Klik di sini untuk mengubah kembali email verifikasi.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('Tautan verifikasi baru telah dikirim ke alamat emailmu.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <x-primary-button class="w-100">{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400 text-center"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>
