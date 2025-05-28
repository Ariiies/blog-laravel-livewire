            <div 
                    class="loading-modal fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-75 min-h-screen"
                    style="backdrop-filter: blur(5px); isolation: isolate;"
                    wire:loading.class="visible opacity-100"
                    wire:loading.class.remove="invisible opacity-0"
                >
                    <div class="flex flex-col items-center space-y-3 bg-white rounded-lg shadow-lg p-5 w-72 max-w-[85%] transform transition-all duration-300">
                        <!-- Spinner compacto -->
                        <svg class="w-10 h-10 text-blue-600 animate-spin-smooth" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-85" fill="currentColor" d="M12 2a10 10 0 0110 10h-2a8 8 0 00-8-8V2z"></path>
                        </svg>
                        <!-- Texto principal -->
                        <span class="font-semibold text-lg text-blue-800 tracking-tight">Processing...</span>
                        <!-- Texto secundario -->
                        <span class="text-gray-600 text-xs font-medium text-center">Processing, wait a moment.</span>
                    </div>
                </div>

                <style>
                    /* Animación suave para el spinner */
                    @keyframes spin-smooth {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .animate-spin-smooth {
                        animation: spin-smooth 1s cubic-bezier(0.4, 0, 0.6, 1) infinite;
                    }
                    /* Estilos base para el modal */
                    .loading-modal {
                        display: flex !important;
                        visibility: hidden;
                        opacity: 0;
                        transition: visibility 0s linear 0.3s, opacity 0.3s ease-in-out;
                    }
                    .loading-modal.visible {
                        visibility: visible;
                        opacity: 1;
                        transition: visibility 0s linear, opacity 0.3s ease-in-out;
                    }
                </style>