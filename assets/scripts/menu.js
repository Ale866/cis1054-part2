const categorySelect = document.getElementById('category-select')
categorySelect.addEventListener('change', function () {
    if (this.value == 'All') {
        window.location.href = window.location.pathname
    } else {
        window.location.href = window.location.pathname + `?category=${this.value}`
    }
});

const deleteButtons = document.querySelectorAll('.delete-btn')

deleteButtons.forEach(button => {
    button.addEventListener('click', async function (e) {
        e.stopPropagation();
        e.preventDefault();
        const id = this.getAttribute('data-id')
        result = await fetch(`dish.php?dish_id=${id}`, {
            method: 'DELETE'
        })
        if (result.ok) {
            window.location.reload()
        }
    })
})