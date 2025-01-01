import { FileRepository, SimpleUploadAdapter } from '../node_modules/@ckeditor/ckeditor5-upload';
const uploadAdapter = new SimpleUploadAdapter({
uploadUrl: '/upload', // Replace with the appropriate route
headers: {
    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for Laravel
},
});

ClassicEditor
    .create(document.querySelector('#content-editor'), {
        plugins: [FileRepository, SimpleUploadAdapter],
        fileUpload: {
            uploadAdapter: uploadAdapter,
        },
    })
    .catch(error => {
        console.error(error);
    });
