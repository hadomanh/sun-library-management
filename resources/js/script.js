window.addEventListener('load', () => {
    handleDelete()
})

function handleDelete() {
    const elements = document.querySelectorAll('.deleteItemBtn')

    elements.forEach(element => {
        element.addEventListener('click', () => {
            const url = element.dataset.url
            const method = 'DELETE'

            document.getElementById('deleteConfirm').addEventListener('click', ()=> {
                fetch(url, { method })
                .then(() => {
                    location.reload()
                })
            })
        })
    });
}
