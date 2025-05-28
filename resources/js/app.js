import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const categoryTabs = document.querySelectorAll('.category-tab');
    const categorySections = document.querySelectorAll('.category-section');
    
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetCategory = this.dataset.category;
            
            // Update active tab
            categoryTabs.forEach(t => {
                t.classList.remove('active', 'text-red-600', 'border-red-600');
                t.classList.add('text-gray-500', 'border-transparent');
            });
            
            this.classList.add('active', 'text-red-600', 'border-red-600');
            this.classList.remove('text-gray-500', 'border-transparent');
            
            // Show/hide category sections
            categorySections.forEach(section => {
                if (section.dataset.category === targetCategory) {
                    section.classList.remove('hidden');
                    section.classList.add('active');
                } else {
                    section.classList.add('hidden');
                    section.classList.remove('active');
                }
            });
        });
    });
});