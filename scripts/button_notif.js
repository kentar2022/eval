var button = document.querySelector('.textarea_btn');


button.addEventListener('click', function() {
  var notification = document.createElement('div');
  notification.className = 'notification';
  notification.textContent = 'Votre message a été envoyé!';

  notification.style.position = 'fixed';
  notification.style.top = '50%';
  notification.style.left = '50%';
  notification.style.transform = 'translate(-50%, -50%)';
  notification.style.padding = '20px';
  notification.style.backgroundColor = '#fff';
  notification.style.color = '#C5001A';
  notification.style.border = '1px solid #ccc';
  notification.style.borderRadius = '5px';
  notification.style.zIndex = '9999';

  document.body.appendChild(notification);

  setTimeout(function() {
    document.body.removeChild(notification);
  }, 2000);
});