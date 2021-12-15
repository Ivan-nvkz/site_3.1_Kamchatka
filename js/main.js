'use strict';
document.addEventListener('DOMContentLoaded', () => {


   // Плавный скролл + кнопка вверх
   const anchors = document.querySelectorAll('.menu__link');

   if (window.location.hash != '') {
      scrollToId(window.location.hash);
   }

   for (let anchor of anchors) {
      anchor.addEventListener('click', function (e) {

         if (e.target.classList.contains('menu__link')) {
            e.preventDefault();

            let link = e.target;
            scrollToId(link.hash);

            let ancorActive = document.querySelector('.menu__link--active');
            ancorActive.classList.remove('menu__link--active');
            link.classList.add('menu__link--active');
         }
      });
   }

   function elemOffsetTop(node) {
      let coords = node.getBoundingClientRect();
      return coords.top + window.pageYOffset;

   }

   function scrollToId(id) {
      let target = document.querySelector(id);

      if (target !== null) {
         let position = elemOffsetTop(target) - 0;

         window.scrollTo({
            top: position,
            behavior: "smooth"
         });
      }
   }

   let btnUp = document.querySelector('.btn-up');
   btnUp.addEventListener('click', function (e) {
      window.scrollTo({
         top: 0,
         behavior: "smooth"
      });
   });

   let scrollWind = window;
   scrollWind.addEventListener('scroll', function () {
      let pos = window.pageYOffset;

      if (pos > window.innerHeight) {
         btnUp.classList.add('btn-up-open');
      } else {
         btnUp.classList.remove('btn-up-open');
      }
   });


   // Меню бургер 2
   const burgerBtn = document.querySelector('.burger__btn');
   const menuList = document.querySelector('.menu__list');


   burgerBtn.addEventListener('click', function (e) {
      e.preventDefault();
      this.classList.toggle('burger__btn-line--active');
      menuList.classList.toggle('menu__list--active');
   });




   // Календарь в форме ()
   new AirDatepicker('.date__tour', {
      buttons: ['today', 'clear'],
      //  timepicker: true,
      toggleSelected: true,
      multipleDates: 2,
      // range: true,
      multipleDatesSeparator: ' - ',
      position: 'top right',
      minDate: new Date(),
      onSelect({ date, formattedDate, datepicker, }) {
         // datepicker.hide();
      }
   });


   let formBtn = document.querySelector('.btn__application');
   let inputRadio = document.querySelectorAll('.input__base-box');


   inputRadio.forEach(radio => {
      radio.addEventListener('click', function () {

         if (radio.value === "Базовый (для камчадал)") {
            console.log(1);

         } else if (radio.value === "Базовый + проживание") {
            console.log(2);
         } else if (radio.value === "Базовый + проживание + долина гейзеров") {
            console.log(3);
         }
      });

   });



























});