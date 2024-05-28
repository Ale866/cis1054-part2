const categorySelect = document.getElementById('category-select')
categorySelect.addEventListener('change', function () {
    if (this.value == 'All') {
        window.location.href = window.location.pathname
    } else {
        window.location.href = window.location.pathname + `?category=${this.value}`
    }
});
