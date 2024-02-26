export default async function createFileAvatar(){
    const avatar = window.location.origin + '/storage/' + contentData.thumbnail
    const nameImage = `avatarFile${userWowness.id}`

    let response = await fetch(avatar);
    let data = await response.blob();
    let metadata = {
      type: 'image/jpeg'
    };
    let file = new File([data],`${nameImage}.jpg`, metadata)

    const liveObject = FileRepository.createFile({
        file,
        onProgress: ({ currentFile, currentPercent }) => {
        },
    });

    await liveObject.on('loadingStatusChanged', ({ newValue }) => {
        if (newValue === LoadingStatus.Loaded) {
            console.log('The file is uploaded', liveObject.model);
            return liveObject.model.fileId
        }
    });

    await liveObject.on('dataError', (error) => {
        console.error('can not upload the file', error);
    });

}
