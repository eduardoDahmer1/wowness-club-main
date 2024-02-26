    //Add plugins to filepond plugin
    FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');
    const dataImage = inputElement.getAttribute('data-value-image');
    let labelIdle = `
    <svg width="20" height="20" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.9165 17.3334C11.9165 17.6403 12.0205 17.8974 12.2285 18.1047C12.4358 18.3127 12.6929 18.4167 12.9998 18.4167C13.3068 18.4167 13.5643 18.3174 13.7723 18.1188C13.9795 17.9202 14.0832 17.6674 14.0832 17.3605V14.0834H16.0332C16.2859 14.0834 16.4528 13.9707 16.5337 13.7454C16.6153 13.5193 16.5748 13.325 16.4123 13.1625L13.379 10.1292C13.2707 10.0209 13.1443 9.96671 12.9998 9.96671C12.8554 9.96671 12.729 10.0209 12.6207 10.1292L9.58734 13.1625C9.42484 13.325 9.38439 13.5193 9.466 13.7454C9.54689 13.9707 9.71373 14.0834 9.9665 14.0834H11.9165V17.3334ZM4.33317 21.6667C3.73734 21.6667 3.22745 21.4547 2.8035 21.0308C2.37884 20.6061 2.1665 20.0959 2.1665 19.5V6.50004C2.1665 5.90421 2.37884 5.39432 2.8035 4.97037C3.22745 4.54571 3.73734 4.33337 4.33317 4.33337H9.93942C10.2283 4.33337 10.5038 4.38754 10.766 4.49587C11.0274 4.60421 11.2575 4.75768 11.4561 4.95629L12.9998 6.50004H21.6665C22.2623 6.50004 22.7726 6.71237 23.1973 7.13704C23.6212 7.56099 23.8332 8.07087 23.8332 8.66671V19.5C23.8332 20.0959 23.6212 20.6061 23.1973 21.0308C22.7726 21.4547 22.2623 21.6667 21.6665 21.6667H4.33317Z" />
    </svg>
    Click or Drag
    `

    FilePond.create(inputElement, {
      labelIdle,
      credits: {
          label: '',
          url: ''
      },
      storeAsFile: true,
      maxFiles: 15,
      itemInsertLocation: 'after',
      files: dataImage ? [{source: dataImage }] : '',
      allowImagePreview: true,
      allowFileSizeValidation: true,
      imagePreviewHeight: 450,
      maxFileSize: "3MB",
      fileValidateTypeDetectType: (source, type) =>
          new Promise((resolve, reject) => {
              resolve(type);
          }),
      imagePreviewTransparencyIndicator: "grid",
  });

const fileInputElements = document.querySelectorAll('.photo-modal');

// Iterate over each file input element
fileInputElements.forEach((inputFile, index) => {
    const dataImage = inputFile.getAttribute('data-value-image');
    let labelIdle = `
        <i class="bi bi-plus-square"></i>
    `;

    // Create FilePond instance for each input File
    FilePond.create(inputFile, {
        labelIdle,
        credits: {
            label: '',
            url: ''
        },
        storeAsFile: true,
        maxFiles: 15,
        itemInsertLocation: 'after',
        files: dataImage ? [{ source: dataImage }] : '',
        allowImagePreview: true,
        allowFileSizeValidation: true,
        imagePreviewHeight: 250,
        maxFileSize: "3MB",
        fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                resolve(type);
            }),
        imagePreviewTransparencyIndicator: "grid",
        name: 'photo',
    });
});