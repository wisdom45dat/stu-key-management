<section class="space-y-6">
    <!-- Header Section -->
    <div class="glass-card rounded-2xl shadow-lg border border-green-200 dark:border-green-800/50 p-8">
        <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Update Password') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 max-w-2xl">
                        {{ __('Ensure your account is using a long, random password to stay secure. We recommend using a combination of letters, numbers, and special characters.') }}
                    </p>
                    
                    <!-- Security Tips -->
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            At least 8 characters
                        </div>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Mix of characters
                        </div>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Avoid common words
                        </div>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Unique to this account
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Update Form -->
        <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6" id="password-update-form">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400" onclick="togglePassword('update_password_current_password', this)">
                        Show Password
                    </button>
                </div>
                <div class="relative">
                    <x-text-input 
                        id="update_password_current_password" 
                        name="current_password" 
                        type="password" 
                        class="password-input pr-10"
                        autocomplete="current-password"
                        required
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <x-input-label for="update_password_password" :value="__('New Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400" onclick="togglePassword('update_password_password', this)">
                        Show Password
                    </button>
                </div>
                <div class="relative">
                    <x-text-input 
                        id="update_password_password" 
                        name="password" 
                        type="password" 
                        class="password-input pr-10"
                        autocomplete="new-password"
                        required
                        oninput="checkPasswordStrength(this.value)"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Password Strength Meter -->
                <div id="password-strength" class="hidden">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div id="password-strength-bar" class="h-2 rounded-full transition-all duration-300"></div>
                        </div>
                        <span id="password-strength-text" class="text-xs font-medium w-16"></span>
                    </div>
                    <div id="password-requirements" class="grid grid-cols-1 md:grid-cols-2 gap-1 text-xs">
                        <div class="requirement" data-requirement="length">✓ At least 8 characters</div>
                        <div class="requirement" data-requirement="lowercase">✓ Lowercase letter</div>
                        <div class="requirement" data-requirement="uppercase">✓ Uppercase letter</div>
                        <div class="requirement" data-requirement="number">✓ Number</div>
                        <div class="requirement" data-requirement="special">✓ Special character</div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <button type="button" class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400" onclick="togglePassword('update_password_password_confirmation', this)">
                        Show Password
                    </button>
                </div>
                <div class="relative">
                    <x-text-input 
                        id="update_password_password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        class="password-input pr-10"
                        autocomplete="new-password"
                        required
                        oninput="checkPasswordMatch()"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                <div id="password-match" class="hidden text-xs mt-1">
                    <span class="text-green-600 dark:text-green-400">✓ Passwords match</span>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <button type="submit" class="update-password-btn group">
                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Update Password') }}
                    </button>

                    <!-- Success Message -->
                    @if (session('status') === 'password-updated')
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="success-message"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Password updated successfully!') }}
                        </div>
                    @endif
                </div>
                
                <button type="button" onclick="resetForm()" class="mt-3 sm:mt-0 text-sm text-gray-600 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors duration-200">
                    Reset Form
                </button>
            </div>
        </form>
    </div>
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
    
    .password-input {
        @apply w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/50 dark:bg-gray-700/50 backdrop-blur-sm;
    }
    
    .update-password-btn {
        @apply inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2;
    }
    
    .success-message {
        @apply inline-flex items-center px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-medium rounded-lg transition-all duration-200;
    }
    
    .requirement {
        @apply flex items-center text-xs text-gray-500 dark:text-gray-400 transition-colors duration-200;
    }
    
    .requirement.met {
        @apply text-green-600 dark:text-green-400;
    }
    
    .requirement:not(.met) {
        @apply text-gray-400 dark:text-gray-500;
    }
</style>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        button.textContent = type === 'password' ? 'Show Password' : 'Hide Password';
    }
    
    function checkPasswordStrength(password) {
        const strengthMeter = document.getElementById('password-strength');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        const requirements = document.querySelectorAll('.requirement');
        
        if (password.length === 0) {
            strengthMeter.classList.add('hidden');
            requirements.forEach(req => req.classList.remove('met'));
            return;
        }
        
        strengthMeter.classList.remove('hidden');
        
        // Check requirements
        const hasLength = password.length >= 8;
        const hasLower = /[a-z]/.test(password);
        const hasUpper = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        // Update requirement indicators
        document.querySelector('[data-requirement="length"]').classList.toggle('met', hasLength);
        document.querySelector('[data-requirement="lowercase"]').classList.toggle('met', hasLower);
        document.querySelector('[data-requirement="uppercase"]').classList.toggle('met', hasUpper);
        document.querySelector('[data-requirement="number"]').classList.toggle('met', hasNumber);
        document.querySelector('[data-requirement="special"]').classList.toggle('met', hasSpecial);
        
        // Calculate strength score
        let strength = 0;
        if (hasLength) strength += 20;
        if (hasLower) strength += 20;
        if (hasUpper) strength += 20;
        if (hasNumber) strength += 20;
        if (hasSpecial) strength += 20;
        
        // Update strength meter
        strengthBar.style.width = strength + '%';
        
        // Update strength text and color
        if (strength <= 40) {
            strengthBar.className = 'h-2 rounded-full bg-red-500';
            strengthText.textContent = 'Weak';
            strengthText.className = 'text-xs font-medium w-16 text-red-600 dark:text-red-400';
        } else if (strength <= 80) {
            strengthBar.className = 'h-2 rounded-full bg-yellow-500';
            strengthText.textContent = 'Good';
            strengthText.className = 'text-xs font-medium w-16 text-yellow-600 dark:text-yellow-400';
        } else {
            strengthBar.className = 'h-2 rounded-full bg-green-500';
            strengthText.textContent = 'Strong';
            strengthText.className = 'text-xs font-medium w-16 text-green-600 dark:text-green-400';
        }
    }
    
    function checkPasswordMatch() {
        const password = document.getElementById('update_password_password').value;
        const confirmPassword = document.getElementById('update_password_password_confirmation').value;
        const matchIndicator = document.getElementById('password-match');
        
        if (confirmPassword.length === 0) {
            matchIndicator.classList.add('hidden');
            return;
        }
        
        if (password === confirmPassword && password.length > 0) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.innerHTML = '<span class="text-green-600 dark:text-green-400">✓ Passwords match</span>';
        } else {
            matchIndicator.classList.remove('hidden');
            matchIndicator.innerHTML = '<span class="text-red-600 dark:text-red-400">✗ Passwords do not match</span>';
        }
    }
    
    function resetForm() {
        document.getElementById('password-update-form').reset();
        document.getElementById('password-strength').classList.add('hidden');
        document.getElementById('password-match').classList.add('hidden');
        document.querySelectorAll('.requirement').forEach(req => req.classList.remove('met'));
    }
    
    // Add form submission enhancement
    document.getElementById('password-update-form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <div class="spinner border-2 border-white border-t-transparent rounded-full w-4 h-4 animate-spin mr-2"></div>
            Updating...
        `;
    });
</script>