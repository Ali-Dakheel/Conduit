document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('tagsButton');
    const dropdown = document.getElementById('tagsDropdown');
    const arrow = document.getElementById('tagsArrow');
    let isOpen = false;

    button.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        isOpen = !isOpen;

        if (isOpen) {
            dropdown.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
        } else {
            dropdown.classList.add('hidden');
            arrow.style.transform = 'rotate(0deg)';
        }
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
            arrow.style.transform = 'rotate(0deg)';
            isOpen = false;
        }
    });
});
