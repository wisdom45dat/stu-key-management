<section class="space-y-6">
    <!-- Header Section -->
    <div class="glass-card rounded-2xl shadow-lg border border-red-200 dark:border-red-800/50 p-8">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Delete Account') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 max-w-2xl">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                    
                    <!-- Warning Points -->
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center text-sm text-red-600 dark:text-red-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            All personal data will be permanently removed
                        </div>
                        <div class="flex items-center text-sm text-red-600 dark:text-red-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            This action cannot be reversed or recovered
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Requires password confirmation
            </div>
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="delete-account-btn group"
            >
                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                {{ __('Delete Account') }}
            </button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="modal-glass p-6">
            <!-- Modal Header -->
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Confirm Account Deletion') }}
                </h2>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <!-- Warning Message -->
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 dark:text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 dark:text-red-400">
                                This action is permanent and cannot be undone
                            </h4>
                            <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                                All your data, including profile information, activity history, and personal settings will be permanently deleted from our servers.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="space-y-3">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ __('Enter your password to confirm') }}
                    </label>
                    <div class="relative">
                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="w-full password-input"
                            placeholder="{{ __('Your current password') }}"
                            required
                            autocomplete="current-password"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <!-- Final Confirmation Checkbox -->
                <div class="flex items-start space-x-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <input 
                        id="final-confirmation" 
                        name="final_confirmation" 
                        type="checkbox" 
                        required
                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-0.5"
                    >
                    <label for="final-confirmation" class="text-sm text-gray-700 dark:text-gray-300">
                        I understand that this action cannot be undone and I have downloaded any data I wish to keep.
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row-reverse sm:justify-between sm:space-x-reverse sm:space-x-3 space-y-3 sm:space-y-0">
                    <button
                        type="submit"
                        id="delete-confirm-btn"
                        disabled
                        class="confirm-delete-btn disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        {{ __('Permanently Delete Account') }}
                    </button>
                    
                    <button 
                        type="button" 
                        x-on:click="$dispatch('close')"
                        class="cancel-btn"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .dark .glass-card {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .modal-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
    }
    
    .dark .modal-glass {
        background: rgba(30, 41, 59, 0.95);
    }
    
    .delete-account-btn {
        @apply inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2;
    }
    
    .confirm-delete-btn {
        @apply inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 w-full sm:w-auto;
    }
    
    .cancel-btn {
        @apply inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 w-full sm:w-auto;
    }
    
    .password-input {
        @apply w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-white/50 dark:bg-gray-700/50 backdrop-blur-sm pr-10;
    }
    
    /* Smooth modal animations */
    [x-cloak] {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmationCheckbox = document.getElementById('final-confirmation');
        const deleteButton = document.getElementById('delete-confirm-btn');
        
        function updateDeleteButton() {
            const passwordFilled = passwordInput.value.length > 0;
            const confirmed = confirmationCheckbox.checked;
            
            deleteButton.disabled = !(passwordFilled && confirmed);
        }
        
        passwordInput.addEventListener('input', updateDeleteButton);
        confirmationCheckbox.addEventListener('change', updateDeleteButton);
        
        // Add some security delay for the delete button
        deleteButton.addEventListener('mouseover', function() {
            if (!this.disabled) {
                this.classList.add('ring-2', 'ring-red-300', 'dark:ring-red-700');
            }
        });
        
        deleteButton.addEventListener('mouseout', function() {
            this.classList.remove('ring-2', 'ring-red-300', 'dark:ring-red-700');
        });
        
        // Initialize button state
        updateDeleteButton();
    });
</script>