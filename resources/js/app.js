import 'preline'

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
Alpine.plugin(persist)
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('livewire:navigated', () => {
    // Re-initialize all Preline UI components
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});