let userBox = document.querySelector('.header .header-2 .user-box ');
document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
}
let navbar = document.querySelector('.header .header-2 .navbar ');
document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}
