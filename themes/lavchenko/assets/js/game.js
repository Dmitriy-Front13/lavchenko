$(document).ready(function () {
    $('#search-btn').on('click', function () {
        var number = $('#search-input').val();

        if (number === "") {
            alert("Please enter a number.");
            return;
        }

        number = parseInt(number, 10);

        var button = $('.game-cell[data-number="' + number + '"]');
        if (button.length) {
            if (button.hasClass('special-class-326')) {
                alert("This number has already been chosen. Please choose another.");
                return;
            }
            var slideIndex = button.attr('data-slide-index');
            if (swiper2.activeIndex !== parseInt(slideIndex)) {
                swiper2.slideTo(parseInt(slideIndex));
            }
            button.click();
        } else {
            alert("Invalid number. Please enter a valid number from the grid.");
        }
    });

    $('.game-cell').on('click', function () {
        var number = $(this).data('number');
        var gameId = $(this).data('game-id');
        var button = $(this);

        button.request('onCheckNumber', {
            data: { number: number, game_id: gameId },
            success: function (data) {
                handleResponse(button, data);
            }
        });
    });

    function handleResponse(button, data) {
        console.log('Request successful with result:', data.result);

        if (data.result === 'success') {
            updateButtonState(button, 'winner');
            disableAllButtons();
            openInfoModal();
            updateAttemptClass(data.attempts, 'success');
        } else if (data.result === 'failure') {
            updateButtonState(button, 'chosen');
            updateAttemptClass(data.attempts, 'failure');
            updateOpenedCellsCount(data.cellsCount);
        } else if (data.error) {
            alert(data.error);
        }
    }





    function updateAttemptClass(attempts, result) {
        var span = $('#attempt-' + attempts);
        console.log(span)
        if (span.length) {
            if (result === 'success') {
                span.removeClass('no').addClass('yes');
            } else if (result === 'failure') {
                span.addClass('no');
            }
        }
        console.log('Updated attempt class:', attempts, result);
    }

    function updateOpenedCellsCount(cellsCount) {
        var openedCellsInfoElement = $('.main-bottom__text');
        var spanElement = openedCellsInfoElement.find('span');
        spanElement.text(cellsCount);
        console.log('Updated opened cells count:', cellsCount);
    }

    function disableAllButtons() {
        $('.game-cell').prop('disabled', true);
    }
    function openInfoModal() {
        Fancybox.show([{
                src: "#modal-adv",
                type: "inline",
                closeButton: false,
                dragToClose: false,
                closeExisting: true
            }]);
    }
});