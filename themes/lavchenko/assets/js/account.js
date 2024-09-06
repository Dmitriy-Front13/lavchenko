document.addEventListener('click', (e) => {
    const userpic = document.querySelector('.profile__userpic-label'),
    inputUserpic = document.querySelector('.profile__userpic-input');
  if (e.target.closest('.profile-accordeon__item-text')) {
    const title = e.target.closest('.profile-accordeon__item-text');
    const content = title.nextElementSibling;
    const isOpened = title.classList.toggle('opened');

    if (content) {
      content.style.transition = 'height 0.3s ease-out';
      content.style.height = isOpened ? content.scrollHeight + 1 +'px' : '0';
    }
  } else if (e.target.closest('#btn-edit')) {
    const btnSave = document.querySelector('#btn-save');
    btnSave.style.display = 'block';
    userpic.classList.add('edit');
    inputUserpic.removeAttribute('disabled');
    e.target.style.display = 'none';
  } else if (e.target.closest('#btn-save')) {
    const btnEdit = document.querySelector('#btn-edit'),
    btnSaveUserpic = document.querySelector('#btn-save-userpic');
    btnSaveUserpic.click();
    userpic.classList.remove('edit');
    inputUserpic.setAttribute('disabled', 'disabled');
    btnEdit.style.display = 'block';
    e.target.style.display = 'none';
  }
});