class header {
  burger() {
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', () => {
      const menu = document.querySelector('.navbar__menu');
      menu.classList.toggle('navbar__toggleBtn');
    });
  }
}

export { header };
