document.addEventListener('DOMContentLoaded', function() {
    // Handling Form Submission
    const contactForm = document.getElementById('form-kontak');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Pesan Anda berhasil terkirim. Terima kasih!');
            contactForm.reset();
        });
    }

    // Dynamic Search Filter untuk Tabel Admin
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});