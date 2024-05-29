likeButtons = document.querySelectorAll('.like-btn')

likeButtons.forEach(button => {
    let icon = button.querySelector('i');

    button.addEventListener('mouseover', function () {
        if (this.dataset.isfavorite == 1) {
            undoFavoriteIcon(icon);
        } else {
            makeFavorite(icon);
        }
    });

    button.addEventListener('mouseout', function () {
        if (this.dataset.isfavorite == 1) {
            makeFavorite(icon);
        } else {
            undoFavoriteIcon(icon);
        }
    });

    button.addEventListener('click', async function (e) {
        e.stopPropagation();
        e.preventDefault();

        this.setAttribute('aria-busy', 'true');
        const response = await fetch('/like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include',
            body: JSON.stringify({
                "menu_id": this.id
            })
        })
        let content = await response.json()

        // Update the button state
        this.setAttribute('aria-pressed', content.liked);

        // Remove the busy state
        this.removeAttribute('aria-busy');

        if (content.liked) {
            this.dataset.isfavorite = 1;
            makeFavorite(icon);
        } else {
            this.dataset.isfavorite = 0;
            undoFavoriteIcon(icon);
        }
    });
});

function makeFavorite(elem) {
    elem.setAttribute('aria-label', 'This item is marked as favorite');
    elem.classList.remove('fa-regular')
    elem.classList.add('fa-solid')
}

function undoFavoriteIcon(elem) {
    elem.setAttribute('aria-label', 'This item is not marked as favorite');
    elem.classList.add('fa-regular')
    elem.classList.remove('fa-solid')
}
