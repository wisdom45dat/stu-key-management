<section class="space-y-6">
    <!-- Header Section -->
    <div class="glass-card rounded-2xl shadow-lg border border-blue-200 dark:border-blue-800/50 p-8">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Profile Information') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 max-w-2xl">
                        {{ __("Update your account's profile information and email address. Your email address will be used for important notifications and account recovery.") }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Profile Update Form -->
        <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6" id="profile-update-form">
            @csrf
            @method('patch')

            <!-- Name Field -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <x-input-label for="name" :value="__('Full Name')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Required') }}</div>
                </div>
                <div class="relative">
                    <x-text-input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="profile-input pr-10"
                        :value="old('name', $user->name)" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="{{ __('Enter your full name') }}"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email Field -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <x-input-label for="email" :value="__('Email Address')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Required') }}</div>
                </div>
                <div class="relative">
                    <x-text-input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="profile-input pr-10"
                        :value="old('email', $user->email)" 
                        required 
                        autocomplete="email"
                        placeholder="{{ __('Enter your email address') }}"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Additional Profile Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <!-- Phone Field -->
                <div class="space-y-3">
                    <x-input-label for="phone" :value="__('Phone Number (Optional)')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <div class="relative">
                        <x-text-input 
                            id="phone" 
                            name="phone" 
                            type="tel" 
                            class="profile-input pr-10"
                            :value="old('phone', $user->phone)" 
                            autocomplete="tel"
                            placeholder="{{ __('+1 (555) 000-0000') }}"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <!-- Department Field -->
                <div class="space-y-3">
                    <x-input-label for="department" :value="__('Department (Optional)')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <div class="relative">
                        <x-text-input 
                            id="department" 
                            name="department" 
                            type="text" 
                            class="profile-input pr-10"
                            :value="old('department', $user->department)" 
                            autocomplete="organization"
                            placeholder="{{ __('Your department') }}"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <button type="submit" class="save-profile-btn group">
                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Changes') }}
                    </button>

                    @if (session('status') === 'profile-updated')
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="success-message">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Profile updated successfully!') }}
                        </div>
                    @endif
                </div>

                <button type="button" onclick="resetForm()" class="mt-3 sm:mt-0 text-sm text-gray-600 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-200">
                    Discard Changes
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Keep your same <style> and <script> blocks here --}}
