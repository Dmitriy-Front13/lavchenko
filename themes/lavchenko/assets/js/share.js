document.addEventListener('DOMContentLoaded', function() {
    const element = document.querySelector('.gameclose__inner');
    const downloadButton = document.querySelector('#download-btn');

    domtoimage.toPng(element)
        .then(function(dataUrl) {
            // Устанавливаем URL изображения в атрибут `href` кнопки для скачивания
            downloadButton.setAttribute('href', dataUrl);
            downloadButton.setAttribute('download', 'screenshot.png'); // Указываем имя файла для скачивания
        })
        .catch(function(error) {
            console.error('Ошибка захвата изображения:', error);
        });
});