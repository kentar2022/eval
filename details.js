const modalButton = document.querySelectorAll('.details-button');
const modal = document.getElementById('modal');

modalButton.forEach(modalButton => {
  modalButton.addEventListener('click', function() {
    console.log('Test');
    modal.classList.add('popup');
    modal.classList.remove('modal');
  });
});

const closeButton = modal.querySelector('.close-button');
closeButton.addEventListener('click', function() {
  modal.classList.remove('popup');
  modal.classList.add('modal');
});


