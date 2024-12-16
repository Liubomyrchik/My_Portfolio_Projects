"use strict"

/* Burger Menu */
const burger = document.querySelector(`.header__burger`)
const menu = document.querySelector(`.header__menu`)
const menuLinks = document.querySelectorAll(`.menu__link`)

document.querySelector('.header__burger').addEventListener('click', function () {
    this.classList.toggle('active');
    document.querySelector('.header__menu').classList.toggle('open');
})

menuLinks.forEach(link => {
    link.addEventListener(`click`, () => {
        if (menu.classList.contains(`open`)) {
            burger.classList.remove(`active`)
            menu.classList.remove(`open`)
        }
    })
})

/* Input Cleaning */

document.getElementById(`cleanInput`)
    .addEventListener(`keydown`, function (event) {
        if (event.key === `Enter`) {
            this.value = ``
            event.preventDefault()
        }
    })

/* Number Counter */

let members = 2245341
setInterval(() => {
    members++
    document.getElementById(`members`).textContent = members.toLocaleString(`en-US`)
}, 2000)

let clubs = 46328
setInterval(() => {
    clubs++
    document.getElementById(`clubs`).textContent = clubs.toLocaleString(`en-US`)
}, 5000)

let eventBookings = 828867
setInterval(() => {
    eventBookings++
    document.getElementById(`eventBookings`).textContent = eventBookings.toLocaleString(`en-US`)
}, 4000)

let payments = 828867
setInterval(() => {
    payments++
    document.getElementById(`payments`).textContent = payments.toLocaleString(`en-US`)
}, 3000)

/* Readmore button */

document.querySelectorAll('.card__link').forEach(link => {
    link.addEventListener('click', function (event) {
        event.preventDefault()
        const moreText = this.previousElementSibling.querySelector('.card__textmore');
        if (moreText.style.display === 'none' || !moreText.style.display) {
            moreText.style.display = 'block'
            this.textContent = 'Read Less'
        } else {
            moreText.style.display = 'none'
            this.textContent = 'Read More'
            this.blur()
        }
    })
})

// document.querySelector(`.card__link`).addEventListener(`click`, function() {
//     document.querySelector(`.card__textmore`).classList.toggle(`open`)
// })

/* Login Windows */

const loginButton = document.querySelector('.login-link');
const signUpButton = document.querySelector('.sign-up');
const loginModal = document.getElementById('login-modal');
const signUpModal = document.getElementById('signup-modal');
const closeButtons = document.querySelectorAll('.login__close');

// Open modals
loginButton.addEventListener('click', (e) => {
    e.preventDefault();
    loginModal.classList.remove('hidden');
});

signUpButton.addEventListener('click', (e) => {
    e.preventDefault();
    signUpModal.classList.remove('hidden');
});

// Close modals
closeButtons.forEach((button) => {
    button.addEventListener('click', () => {
        button.closest('.login').classList.add('hidden');
    });
});

// Close modal by clicking outside the content
[loginModal, signUpModal].forEach((modal) => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
