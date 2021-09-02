window.addEventListener('load', () => {

    //Initialize Select2 Elements
    $('.select2').select2()
})

window.addEventListener('load', () => {
    handleDelete()

    document.getElementById('logout')?.addEventListener('click', (event) => {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
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
