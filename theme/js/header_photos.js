'use strict';

(function () {
  var photosContainer = document.querySelector('.site-header-home__photos');

  if (!photosContainer) return;

  var photos = photosContainer.querySelectorAll('.site-header-home__photos__photo');

  var photosSelector = document.querySelector('.site-header-home__photos-selector');
  var photosButtons = photosSelector.querySelectorAll('.site-header-home__photos-selector__button');

  // Reference to current timer.
  var timer;

  Array.from(photosButtons).forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault();
      selectPhoto(parseInt(button.getAttribute('data-photo-index')));
    });
  });

  // Select the first photo.
  selectPhoto(0);

  function selectPhoto(index) {
    Array.from(photosButtons).forEach(deselectLink);
    selectLink(photosButtons[index]);

    Array.from(photos).forEach(hidePhoto);
    showPhoto(photos[index]);

    if (timer) {
      clearTimeout(timer);
    }

    timer = setTimeout(selectNextPhoto, 5000);
  }

  function findSelectedPhoto() {
    var i = 0;
    while (i < photos.length && photos[i].getAttribute('data-photo-selected') === null) {
      i++;
    }
    return i;
  }

  function selectNextPhoto() {
    var index = findSelectedPhoto();
    selectPhoto((index + 1) % photos.length);
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
