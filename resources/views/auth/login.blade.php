<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-white/90">Correo electrónico</label>
                <x-text-input id="email" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white/90">Contraseña</label>
                <x-text-input id="password" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <!-- Remember & Actions -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-white/90">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm">Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-white/80 hover:text-white underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div class="flex justify-center mt-2">
                <x-primary-button class="bg-custom-purple hover:bg-[#3b075a] rounded-full px-6 py-2">
                    Iniciar sesión
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
