const cards = document.querySelectorAll('.card');

cards.forEach((card, index) => {
    card.addEventListener('click', () => {
        window.location.href = 'http://localhost/inmobiliaria/inmobiliaria/view-property.php';
      });
})