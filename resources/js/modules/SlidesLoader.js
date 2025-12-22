export default {
    init() {
        if (window.location.pathname === '/result') {
            this.loadSlides();
        }
    },
    async loadSlides() {
        await axios.get('/sanctum/csrf-cookie');

        const maxAttempts = 30;
        const interval = 2000;
        let attempts = 0;

        const pollSlides = async () => {
            attempts++;

            if (attempts > maxAttempts) {
                this.showErrorMessage('Document processing timeout. Please try again.');

                return;
            }

            const response = await axios.get('/api/slides');

            if (response.status === 200) {
                const data = response.data;

                if (data.status === 'success' && data.success === true) {
                    Slider.slides = data.slides;
                    Slider.init();
                    Slider.show();

                    this.removeProcessingMessage();

                    if (data.success_message) {
                        this.showSuccessMessage(data.success_message);
                    }

                    if (data.document) {
                        this.showDownloadButton(data.document);
                    }

                    return;
                }

                if (data.status === 'error') {
                    this.removeProcessingMessage();
                    this.showErrorMessage(data.message || 'Document conversion failed.');

                    return;
                }

                if (data.status === 'expired' || data.status === 'not_found') {
                    this.removeProcessingMessage();
                    this.showErrorMessage(data.message || 'Document not found or expired.');

                    return;
                }

                if (data.status === 'processing' || data.status === 'queued') {
                    this.showProcessingMessage(data.message || 'Document is being processed');
                    setTimeout(pollSlides, interval);

                    return;
                }

                this.removeProcessingMessage();
                this.showErrorMessage('Unexpected response from server.');

                return;
            }

            setTimeout(pollSlides, interval);
        };

        pollSlides();
    },
    showProcessingMessage(message) {
        let processingContainer = document.getElementById('processing-message');

        if (!processingContainer) {
            processingContainer = document.createElement('div');
            processingContainer.id = 'processing-message';
            processingContainer.className =
                'conversion-message max-w-3xl mx-auto my-2 p-2 bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 overflow-hidden sm:rounded-lg shadow-sm';
            processingContainer.textContent = message;

            const slider = document.getElementById('slider');
            const container = document.querySelector('main .pb-8');

            if (slider && container) {
                container.insertBefore(processingContainer, slider);
            }
        }
    },
    removeProcessingMessage() {
        const processingContainer = document.getElementById('processing-message');

        if (processingContainer) {
            processingContainer.remove();
        }
    },
    showErrorMessage(message) {
        this.removeExistingMessages();

        const errorContainer = document.createElement('div');
        errorContainer.className =
            'conversion-message max-w-3xl mx-auto my-2 p-2 bg-white dark:bg-gray-800 text-red-600 dark:text-red-300 overflow-hidden sm:rounded-lg shadow-sm';
        errorContainer.textContent = message;

        const slider = document.getElementById('slider');
        const container = document.querySelector('main .pb-8');

        if (slider && container) {
            container.insertBefore(errorContainer, slider);
        }
    },
    showSuccessMessage(message) {
        this.removeExistingMessages();

        const successContainer = document.createElement('div');
        successContainer.className =
            'conversion-message max-w-3xl mx-auto my-2 p-2 bg-white dark:bg-gray-800 text-green-600 dark:text-green-300 overflow-hidden sm:rounded-lg shadow-sm';
        successContainer.textContent = message;

        const slider = document.getElementById('slider');
        const container = document.querySelector('main .pb-8');

        if (slider && container) {
            container.insertBefore(successContainer, slider);
        }
    },
    removeExistingMessages() {
        const container = document.querySelector('main .pb-8');

        if (!container) {
            return;
        }

        const existingMessages = container.querySelectorAll('.conversion-message');
        existingMessages.forEach(msg => msg.remove());
    },
    showDownloadButton(docData) {
        const downloadContainer = document.getElementById('download-container');
        const downloadButton = document.getElementById('download-button');

        if (downloadContainer && downloadButton) {
            downloadContainer.classList.remove('hidden');

            downloadButton.onclick = () => {
                window.location.href = `/document/${docData.id}/download-slider`;
            };
        }
    },
};
