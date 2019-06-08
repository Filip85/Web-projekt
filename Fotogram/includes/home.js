const navSlide = () => {
    const mobile = document.querySelector('.mobile');
    const nav = document.querySelector('.nav-links');

    mobile.addEventListener('click', () => {
        nav.classList.toggle('nav-active');
    });

    mobile.addEventListener('scroll', () =>{
        nav.classList.toggle('nav-deactivate');
    });
}

navSlide();



