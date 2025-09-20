document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('[data-tab]');
    const contents = document.querySelectorAll('[data-content]');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active classes from all tabs
            tabs.forEach(t => {
                t.classList.remove('border-primary', 'text-primary');
                t.classList.add('border-transparent', 'text-gray-500');
            });

            // Add active classes to clicked tab
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-primary', 'text-primary');

            // Show/hide content
            const targetTab = this.getAttribute('data-tab');
            contents.forEach(content => {
                if (content.getAttribute('data-content') === targetTab) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });

    // Tags dropdown functionality
    const tagsButton = document.getElementById('tagsButton');
    const tagsDropdown = document.getElementById('tagsDropdown');
    const tagsArrow = document.getElementById('tagsArrow');

    if (tagsButton) {
        tagsButton.addEventListener('click', function(e) {
            e.preventDefault();
            tagsDropdown.classList.toggle('hidden');
            tagsArrow.classList.toggle('rotate-180');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!tagsButton.contains(e.target) && !tagsDropdown.contains(e.target)) {
                tagsDropdown.classList.add('hidden');
                tagsArrow.classList.remove('rotate-180');
            }
        });
    }
});
