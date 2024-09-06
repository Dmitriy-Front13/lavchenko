document.addEventListener('DOMContentLoaded', function () {
    Fancybox.bind("[data-fancybox]", {
        closeButton: false,
        dragToClose: false,
        closeExisting: true,
    });
    Fancybox.bind("[data-fancybox='reg']", {
        on: {
            done: (fancybox) => {
                $('select').styler({
                    selectSearch: true,
                    selectSmartPositioning: -1,
                    selectVisibleOptions: 5,
                    selectPlaceholder: 'Country',
                    locale: 'en'
                });
            }
        },
        closeButton: false,
        dragToClose: false,
        closeExisting: true,
    });

});


