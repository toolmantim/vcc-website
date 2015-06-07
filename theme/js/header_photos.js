'use strict';

(function () {
  var photosContainer = document.querySelector('.site-header__photos');
  var photos = photosContainer.querySelectorAll('.site-header__photos__photo');

  var photosSelector = document.querySelector('.site-header__photos__selector');
  var photosLinks = photosSelector.querySelectorAll('.site-header__photos__selector__link');

  Array.from(photosLinks).forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault();
      selectPhoto(parseInt(link.getAttribute('data-photo-index')));
    });
  });

  function selectPhoto(index) {
    Array.from(photosLinks).forEach(deselectLink);
    selectLink(photosLinks[index]);

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

  function deselectLink(link) {
    link.removeAttribute('data-photo-selected');
  }

  function selectLink(link) {
    link.setAttribute('data-photo-selected', true);
  }
})();