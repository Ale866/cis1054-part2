const like_btn = document.querySelectorAll('.like-btn')

like_btn.forEach(button => {
    button.addEventListener('click', async function (e) {
        e.stopPropagation();
        e.preventDefault();

        this.closest('article').remove();
    });
})