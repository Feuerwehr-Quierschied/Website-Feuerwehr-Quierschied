<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
        {{-- Hero --}}
        <div class="relative rounded-xl bg-gray-800 p-8 md:p-10 shadow-lg shadow-red-950/30 mb-12 text-center border-fire-red">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Kontakt</h1>
            <p class="text-def-text">
                Haben Sie Fragen oder Anliegen? Nutzen Sie unser Kontaktformular – wir melden uns in Kürze bei Ihnen.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-8 p-4 rounded-lg bg-green-900/50 border border-green-700 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Contact Form --}}
        <section class="relative rounded-xl bg-gray-800 p-6 md:p-8 shadow-lg shadow-red-950/30">
            <h2 class="text-2xl font-bold mb-6 text-white border-b-2 border-red-700 pb-2">
                Nachricht senden
            </h2>

            <form method="POST" action="{{ route('kontakt.store') }}" class="space-y-6">
                @csrf
                @honeypot

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name (optional) --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-def-text mb-2">Name (optional)</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 bg-background-dropdown border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red @error('name') border-red-500 @enderror"
                               placeholder="Ihr Name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Telefon (optional) --}}
                    <div>
                        <label for="telefon" class="block text-sm font-medium text-def-text mb-2">Telefonnummer (optional)</label>
                        <input type="tel"
                               name="telefon"
                               id="telefon"
                               value="{{ old('telefon') }}"
                               class="w-full px-4 py-2 bg-background-dropdown border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red @error('telefon') border-red-500 @enderror"
                               placeholder="z. B. 06897 12345">
                        @error('telefon')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- E-Mail (required) --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-def-text mb-2">
                        E-Mail <span class="text-fire-red">*</span>
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-4 py-2 bg-background-dropdown border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red @error('email') border-red-500 @enderror"
                           placeholder="ihre@email.de">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ansprechpartner (required) --}}
                <div>
                    <label for="empfaenger" class="block text-sm font-medium text-def-text mb-2">
                        Ansprechpartner <span class="text-fire-red">*</span>
                    </label>
                    <select name="empfaenger"
                            id="empfaenger"
                            required
                            class="w-full px-4 py-2 bg-background-dropdown border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red @error('empfaenger') border-red-500 @enderror">
                        <option value="">Bitte wählen Sie einen Ansprechpartner</option>
                        @foreach ($recipients as $key => $recipient)
                            <option value="{{ $key }}" {{ old('empfaenger') === $key ? 'selected' : '' }}>
                                {{ $recipient['label'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('empfaenger')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nachricht (required) --}}
                <div>
                    <label for="nachricht" class="block text-sm font-medium text-def-text mb-2">
                        Nachricht <span class="text-fire-red">*</span>
                    </label>
                    <textarea name="nachricht"
                              id="nachricht"
                              rows="6"
                              required
                              class="w-full px-4 py-2 bg-background-dropdown border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red @error('nachricht') border-red-500 @enderror"
                              placeholder="Ihre Nachricht...">{{ old('nachricht') }}</textarea>
                    @error('nachricht')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-8 py-3 bg-fire-red text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                        Nachricht senden
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-layout>
