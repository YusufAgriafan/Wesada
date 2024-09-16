<section class="space-y-6 d-flex justify-content-center">
    <div class="col-lg-8 wow fadeInUp">
        <header class="text-center">
            <h2 class="display-5 mb-2">
                {{ __('Hapus Akun') }}
            </h2>

            <p class="mb-4">
                {{ __('Setelah akunmu dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akunmu, silakan unduh data atau informasi apa pun yang ingin kamu simpan.') }}
            </p>
        </header>

        <div class="text-center">
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >{{ __('Hapus Akun') }}</x-danger-button>
        </div>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                    {{ __('Apakah kamu yakin ingin menghapus akunmu?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
                    {{ __('Setelah akunmu dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap masukkan kata sandimu untuk mengonfirmasi bahwa kamu ingin menghapus akunmu secara permanen.') }}
                </p>

                <div class="mt-6 d-flex justify-content-center">
                    <div class="col-lg-8">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-100"
                            placeholder="{{ __('Password') }}"
                        />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 d-flex justify-content-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</section>
