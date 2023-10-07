document.addEventListener('alpine:init', () => {
   let self
   Alpine.data('menuHeader', () => ({
      showMenuMobile: false,

      init() {
         self = this
         self.windowVerify()
         window.addEventListener('resize', self.windowVerify)
      },

      windowVerify() {
         if (window.innerWidth > 1024) {
            self.showMenuMobile = true
         } else {
            self.showMenuMobile = false
         }
      },
   }))
})
