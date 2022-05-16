 <!-- Блок прокрутки в разработке -->
 <!-- <div class="container-fluid fixed-bottom" id="to-top" style="display: none;">
     <div class="container-content">
         <div class="row" style="height: 0px;">
             <div class="col-lg-3 d-none d-lg-block"></div>
             <div class="col-lg-1 d-none d-lg-block"></div>
             <div class="col-lg-8 position-relative">
                 <div class="position-absolute start-50 translate-middle" id=""></div>
             </div>
         </div>
     </div>
 </div>

 <style>
     #to-top {
         width: 100px;
         height: 100px;
         background: pink;
         bottom: 100px;
     }
 </style>

 <script>
     // Контейнер для значения высоты
     var maxHeight = 0;
     var luftToTop = 600;
     var luftToBottom = 300;

     // Запуск события при скролле
     $(window).scroll(function() {

         // Текущая позиция
         var currentScroll = $(this).scrollTop();

         // Если текущая позиция больше значения в контейнере, то значение обновляется
         if (currentScroll > maxHeight) {
             maxHeight = currentScroll;
         }

         if (currentScroll < (maxHeight - luftToTop)) {
             console.log('show');
             $('#to-top').show();
         }

         if (currentScroll > (maxHeight - luftToBottom)) {
             console.log('show');
             $('#to-top').hide();
         }

         console.log(maxHeight - luftToTop);
     })
 </script> -->
 <!-- Блок прокрутки в разработке -->