export default {
    init() {
        const documentUploadForm = document.getElementById('documentUploadForm');
        if (!documentUploadForm) { return; }

        const documentUploadButton = document.getElementById('documentUploadButton');

        documentUploadForm.addEventListener('submit', () => {
            const $text = documentUploadButton.querySelector('span.text');
            const $spinner = documentUploadButton.querySelector('span.spinner');

            documentUploadButton.disabled = true;
            $text.classList.add('invisible');
            $spinner.classList.remove('invisible');
        });
    },
}
