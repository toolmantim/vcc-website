'use strict';

(function () {
  var photosContainer = document.querySelector('.site-header__photos');
  var photos = photosContainer.querySelectorAll('.site-header__photos__photo');

  var photosSelector = document.querySelector('.site-header__photos-selector');
  var photosButtons = photosSelector.querySelectorAll('.site-header__photos-selector__button');

  Array.from(photosButtons).forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      selectPhoto(parseInt(button.getAttribute('data-photo-index')));
    });
  });

  function selectPhoto(index) {
    Array.from(photosButtons).forEach(deselectLink);
    selectLink(photosButtons[index]);

    Array.from(photos).forEach(hidePhoto);
    showPhoto(photos[index]);
  }

  function hidePhoto(photo) {
    photo.removeAttribute('data-photo-selected');
    photo.setAttribute('data-photo-hidden', true);
  }

  function showPhoto(photo) {
    photo.removeAttribute('data-photo-hidden');
    photo.setAttribute('data-photo-selected', true);
  }

  function deselectLink(button) {
    button.removeAttribute('data-photo-selected');
  }

  function selectLink(button) {
    button.setAttribute('data-photo-selected', true);
  }
})();