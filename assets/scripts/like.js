likeButtons = document.querySelectorAll('.fa-heart')

likeButtons.forEach(button => {

    button.addEventListener('mouseover', function () {
        if (this.dataset.isfavorite == 1) {
            undoFavoriteIcon(this);
        } else {
            makeFavorite(this);
        }
    });

    button.addEventListener('mouseout', function () {
        if (this.dataset.isfavorite == 1) {
            makeFavorite(this);
        } else {
            undoFavoriteIcon(this);
        }
    });

    button.addEventListener('click', async function (e) {
        e.stopPropagation();
        e.preventDefault();
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
        if (content.liked) {
            this.dataset.isfavorite = 1;
            makeFavorite(this);
        } else {
            this.dataset.isfavorite = 0;
            undoFavoriteIcon(this);
        }
    });
});

function makeFavorite(elem) {
    elem.classList.remove('fa-regular')
    elem.classList.add('fa-solid')
}

function undoFavoriteIcon(elem) {
    elem.classList.add('fa-regular')
    elem.classList.remove('fa-solid')
}
