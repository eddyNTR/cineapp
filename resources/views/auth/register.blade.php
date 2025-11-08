<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-white/90">Nombres</label>
                <x-text-input id="name" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-white/90">E-mail</label>
                <x-text-input id="email" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-white/90">Password</label>
                <x-text-input id="password" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white/90">Confirm Password</label>
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-full bg-white/20 text-white placeholder-white/70 px-4 py-2 border-0 focus:ring-2 focus:ring-custom-purple"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-yellow-300" />
            </div>

            <div class="flex items-center justify-between">
                <a class="text-sm text-white/80 hover:text-white underline" href="{{ route('login') }}">
                    ¿Ya estás registrado?
                </a>

                <x-primary-button class="bg-custom-purple hover:bg-[#3b075a] rounded-full px-6 py-2">
                    Registro
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
