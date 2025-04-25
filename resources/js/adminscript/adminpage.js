document.addEventListener('DOMContentLoaded', function () {
    // Toggle sidebar
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');

    toggleSidebar.addEventListener('click', function () {
        sidebar.classList.toggle('sidebar-collapsed');
    });

    // Toggle dropdown menu
    const menuItems = document.querySelectorAll('.menu-item > a');

    menuItems.forEach(item => {
        if (item.nextElementSibling && item.nextElementSibling.classList.contains('submenu')) {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');

                // Close other open dropdowns
                document.querySelectorAll('.menu-item').forEach(otherItem => {
                    if (otherItem !== parent && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        }
    });

    // Responsive sidebar
    function handleResponsive() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('sidebar-collapsed');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
        }
    }

    window.addEventListener('resize', handleResponsive);
    handleResponsive();
});