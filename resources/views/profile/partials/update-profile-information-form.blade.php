<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-8">
        @csrf
        @method('patch')

            <!-- Profile Photo -->
            <div x-data="{ 
                preview: '{{ $user->profile_image ? Storage::url($user->profile_image) : '' }}',
                selectImage() {
                    window.openMediaPicker((item) => {
                        this.preview = item.url;
                        $refs.imageInput.value = item.url;
                    });
                }
            }" class="flex flex-col gap-4">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Profile Photo') }}</label>
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        <template x-if="preview">
                            <img :src="preview" class="w-24 h-24 rounded-[32px] object-cover border-2 border-emerald-500/20 ring-4 ring-emerald-500/5 group-hover:scale-105 transition-transform">
                        </template>
                        <template x-if="!preview">
                            <div class="w-24 h-24 rounded-[32px] bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-3xl font-bold shadow-xl">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="selectImage()" class="px-5 py-2.5 bg-gray-50 dark:bg-gray-900 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all border border-transparent hover:border-emerald-100 dark:hover:border-emerald-500/20">
                        {{ __('Change Photo') }}
                    </button>
                    <input type="hidden" name="profile_image" x-ref="imageInput" value="{{ $user->profile_image }}">
                </div>
            </div>

            <!-- Business Card -->
            <div x-data="{ 
                preview: '{{ $user->business_card ? Storage::url($user->business_card) : '' }}',
                selectCard() {
                    window.openMediaPicker((item) => {
                        this.preview = item.url;
                        $refs.cardInput.value = item.url;
                    });
                }
            }" class="flex flex-col gap-4 mt-8">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Business Card') }}</label>
                <div class="flex items-center gap-6">
                    <div class="relative group w-40 aspect-[1.75/1] bg-gray-50 dark:bg-gray-900 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden">
                        <template x-if="preview">
                            <img :src="preview" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        </template>
                        <template x-if="!preview">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </template>
                    </div>
                    <button type="button" @click="selectCard()" class="px-5 py-2.5 bg-gray-50 dark:bg-gray-900 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all border border-transparent hover:border-emerald-100 dark:hover:border-emerald-500/20">
                        {{ __('Upload Card') }}
                    </button>
                    <input type="hidden" name="business_card" x-ref="cardInput" value="{{ $user->business_card }}">
                </div>
                <p class="text-[10px] text-gray-400 font-medium italic">This card will be available for download on your contact links.</p>
            </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-gray-50 dark:border-gray-700">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Name</label>
                <input id="name" name="name" type="text" 
                       class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Email Address</label>
                <input id="email" name="email" type="email" 
                       class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-semibold focus:ring-2 focus:ring-emerald-500/20 dark:text-gray-300" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Jurisdiction / Country</label>
                <div class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700 rounded-xl text-sm font-semibold text-gray-600 dark:text-gray-400">
                    {{ $user->country ?? 'Global / Administrator' }}
                </div>
                <p class="mt-1 text-[10px] text-gray-400 italic">This is assigned by the system administrator.</p>
            </div>
        </div>

        <div class="flex items-center gap-6 pt-6">
            <button type="submit" class="px-8 py-3 bg-acef-dark dark:bg-emerald-600 text-white rounded-xl font-black uppercase text-[10px] tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-emerald-500/20">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-2 text-emerald-600 font-bold text-xs"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    {{ __('Saved successfully.') }}
                </div>
            @endif
        </div>
    </form>
</section>
