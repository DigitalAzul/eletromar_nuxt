<template>
  <div
    class="zbox-border flex h-[100vh] flex-col zitems-center zjustify-center overflow-clip"
  >
    <div class="wrapper">
      <div id="slider">

        

        <div class="slide flex flex-col items-center justify-center">
          <div class="slide-wrapper">
            <div class="img-wrapper">
              <img src="/img/bg_banner_1.jpg" alt="" />
            </div>

            <div
              class="envelopeAnima absolute 
              top-[3%] mx-auto  flex w-screen h-[calc(100vh-30px)] flex-row items-center justify-center"
            >
            <explosao-primeiro :titulo_esquerdo='titulo_esquerdo1' :titulo_direito='titulo_direito1'/>
            
            </div>
            <div
              @click="solucaoDetalhe(1)"
              class="seta right-[15%] ztop-[70%] lg:right-[25%] lg:bottom-[15%]"
            >
              <div></div>
              <div></div>
              <div>{{ $t("confira") }}</div>
            </div>
          </div>
        </div>



        <div class="slide flex flex-col items-center justify-center">
          <div class="slide-wrapper">
            <div class="img-wrapper">
              <img src="/img/bg_banner_2.jpg" alt="" />
            </div>

            <div
              class="envelopeAnima absolute 
              top-[3%] mx-auto  flex w-screen h-[calc(100vh-30px)] flex-row items-center justify-center"
            >
            <explosao-segundo :titulo_esquerdo='titulo_esquerdo2' :titulo_direito='titulo_direito2'/>
              <!-- <partes-millenium /> -->
            </div>
            <div
              @click="solucaoDetalhe(1)"
              class="seta right-[15%] ztop-[70%] lg:right-[25%] lg:bottom-[15%]"
            >
              <div></div>
              <div></div>
              <div>{{ $t("confira") }}</div>
            </div>
          </div>
        </div>


        <div class="slide flex flex-col items-center justify-center">
          <div class="slide-wrapper">
            <div class="img-wrapper">
              <img src="/img/bg_banner_3.jpg" alt="" />
            </div>

            <div
              class="envelopeAnima absolute 
              top-[3%] mx-auto  flex w-screen h-[calc(100vh-30px)] flex-row items-center justify-center"
            >
           
            <explosao-terceiro :titulo_esquerdo='titulo_esquerdo3' :titulo_direito='titulo_direito3'/>
              <!-- <partes-millenium /> -->
            </div>
            <div
              @click="solucaoDetalhe(1)"
              class="seta right-[15%] ztop-[70%] lg:right-[25%] lg:bottom-[15%]"
            >
              <div></div>
              <div></div>
              <div>{{ $t("confira") }}</div>
            </div>
          </div>
        </div>


        

        <nav id="navigation">
          <div class="bullet"></div>
          <div class="bullet"></div>
          <div class="bullet"></div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { useNuxtApp } from '#app';
import { onMounted } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);
gsap.config({
  nullTargetWarn: false,
  trialWarn: false,
});

let nuxtApp = ref()

async function solucaoDetalhe(linhaID) {


  await nuxtApp.value.$fb.track("track","Click banner "+ linhaID)

  window.location.assign("/solucoes?linha=" + linhaID);
}


let ANIMACOES = ref([]);
let ANIMACOES1 = ref([]);
let ANIMACOES2 = ref([]);
let ANIMACOES3 = ref([]);

const titulo_esquerdo1 = ref("")
const titulo_direito1 = ref("")
const titulo_esquerdo2 = ref("")
const titulo_direito2 = ref("")
const titulo_esquerdo3 = ref("")
const titulo_direito3 = ref("")
async function getAnimacoes() {
  let R = await $fetch("/api/formAnima.php", {
    method: "GET",
    //    params: queryTagBlog.value,
  }).then((R) => {
    let r = JSON.parse(R);
    console.log(r.dados);
    if (r.dados.length > 0) {
      ANIMACOES.value = r.dados;
      ANIMACOES1.value = r.dados[0];
      titulo_esquerdo1.value = ANIMACOES1.value.titulo_esquerdo
      titulo_direito1.value = ANIMACOES1.value.titulo_direito
      ANIMACOES2.value = r.dados[1];
      titulo_esquerdo2.value = ANIMACOES2.value.titulo_esquerdo
      titulo_direito2.value = ANIMACOES2.value.titulo_direito
      ANIMACOES3.value = r.dados[2];
      titulo_esquerdo3.value = ANIMACOES3.value.titulo_esquerdo
      titulo_direito3.value = ANIMACOES3.value.titulo_direito
    } else {
      ANIMACOES.value = [];
    }
  });
}

onMounted(()=>{
  getAnimacoes()
})

onMounted(() => {

  //TSTE FACEBOOK
  nuxtApp.value = useNuxtApp()
  //nuxtApp.value.$fb.enable()
  nuxtApp.value.$fb.init()

  //nuxtApp.$fb('track', 'Purchase', {currency: "USD", value: 30.00});





  // SET VIDEO CONTENT
  const video_inst = ref(document.getElementById("proj_vid-1"))


  let tl = gsap.timeline({
    scrollTrigger: {
      trigger: "#slider",
      start: "top top",
      end: "bottom top",
      toggleActions: "play restart play reverse",
    },
  });
  tl.to("#navigation", {
    duration: 0.6,
    y: "50px",
    ease: "power3",
    stagger: 0.5,
  });

  class Utility {
    debounce(func, wait, immediate) {
      var timeout;
      return function () {
        var context = this,
          args = arguments;
        var later = function () {
          timeout = null;
          if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
      };
    }

    getMousePosition(e) {
      let posX = 0;
      let posY = 0;

      if (!e) {
        e = window.event;
      }

      if (e.pageX || e.pageY) {
        posX = e.pageX;
        posY = e.pageY;
      } else if (e.clientX || e.clientY) {
        posX =
          e.clientX +
          document.body.scrollLeft +
          document.documentElement.scrollLeft;
        posY =
          e.clientY +
          document.body.scrollTop +
          document.documentElement.scrollTop;
      }

      return {
        x: posX,
        y: posY,
      };
    }

    docScrolls() {
      return {
        x: document.body.scrollLeft + document.documentElement.scrollLeft,
        y: document.body.scrollTop + document.documentElement.scrollTop,
      };
    }
  }

  class Tilt {
    constructor(el, options) {
      this.el = el;
      this.init();
      this.settings = {
        rotate: {
          x: 20,
          y: 20,
          z: 5,
        },
        translate: {
          x: 20,
          y: 20,
          z: 0,
        },
        lock: false,
        speed: 1000,
      };
      Object.assign(this.settings, options);
      this.utility = new Utility();
      this.bindEvents();
    }

    calculateRotation(pos, ref) {
      const percentageX = pos.x / this.bounds.width;
      const percentageY = pos.y / this.bounds.height;
      const percentageZ = pos.x / this.bounds.width;

      const rX = ref.x - percentageX * ref.x * 2;
      const rY = ref.y - percentageY * ref.y * 2;
      const rZ = ref.z - percentageZ * ref.z * 2;

      return {
        y: rX,
        x: rY * -1,
        z: rZ * -1,
      };
    }

    calculateTranslation(pos, ref) {
      const percentageX = pos.x / this.bounds.width;
      const percentageY = pos.y / this.bounds.height;
      const percentageZ = pos.x / this.bounds.width;

      const tX = ref.x - percentageX * ref.x * 2;
      const tY = ref.y - percentageY * ref.y * 2;
      const tZ = ref.z - percentageZ * ref.z * 2;

      return {
        x: tX * -1,
        y: tY * -1,
        z: tZ * -1,
      };
    }

    init() {
      this.bounds = this.el.getBoundingClientRect();
    }

    bindEvents() {
      let mousePos;
      let bounds = this.el.getBoundingClientRect();
      let docScrolls = this.utility.docScrolls();
      this.el.addEventListener("mousemove", (e) => {
        mousePos = this.utility.getMousePosition(e);

        const relMousePos = {
          x: mousePos.x - bounds.left - docScrolls.x,
          y: mousePos.y - bounds.top - docScrolls.y,
        };

        const translation = this.calculateTranslation(
          relMousePos,
          this.settings.translate
        );
        const rotation = this.calculateRotation(
          relMousePos,
          this.settings.rotate
        );

        this.animate({
          translation,
          rotation,
        });
      });

      window.addEventListener(
        "resize",
        this.utility.debounce((e) => {
          this.bounds = this.el.getBoundingClientRect();
          docScrolls = this.utility.docScrolls();
        }, 250)
      );
      window.addEventListener(
        "scroll",
        this.utility.debounce((e) => {
          this.bounds = this.el.getBoundingClientRect();
          docScrolls = this.utility.docScrolls();
        }, 250)
      );
    }

    animate(ref) {
      gsap.to(this.el.querySelector("img"), {
        duration: this.settings.speed / 1000,
        x: ref.translation.x,
        y: ref.translation.y,
        z: ref.translation.z,
        rotationX: ref.rotation.x,
        rotationY: ref.rotation.y,
        rotationZ: ref.rotation.z,

        ease: "power4-out",
      });
    }
  }

  class Slide {
    constructor(el) {
      this.DOM = {};
      this.DOM.el = el;
      this.DOM.wrap = el.querySelector(".slide-wrapper");
      this.DOM.imgWrapper = el.querySelector(".img-wrapper");
      this.DOM.titleWrap = el.querySelector(".title-wrapper");
      this.DOM.envelopeAnima = el.querySelector(".envelopeAnima");
      this.DOM.title = el.querySelector(".inner-wrapper");
      this.config = {
        animation: {
          duration: 1,
          ease: "power4-out",
        },
        tiltOptions: {
          translate: {
            x: -10,
            y: -10,
            z: 5,
          },
          rotate: {
            x: 0,
            y: 0,
            z: 0,
          },
        },
      };

      this.DOM.img = new Tilt(el, this.config.tiltOptions);
    }

    setCurrent(isCurrent = true) {
      this.DOM.el.classList[isCurrent ? "add" : "remove"]("current");
    }
    hide(direction) {
      return this.toggle("hide", direction);
    }
    show(direction) {
      this.DOM.el.style.zIndex = 11;
      return this.toggle("show", direction);
    }

    toggle(action, direction) {
      return new Promise((resolve) => {
        if (action === "show") {
          gsap.to(this.DOM.wrap, {
            duration: this.config.animation.duration,
            ease: this.config.animation.ease,
            startAt: {
              x: direction === "right" ? "-100%" : "-100%",
            },
            x: "0%",
          });
          gsap.to(this.DOM.titleWrap, this.config.animation.duration, {
            ease: this.config.animation.ease,
            startAt: {
              x: direction === "right" ? "-100%" : "100%",
            },
            x: "0%",
          });
          gsap.to(this.DOM.title, this.config.animation.duration, {
            ease: this.config.animation.ease,
            startAt: {
              filter: `blur(30px)`,
              opacity: 0.2,
            },
            filter: `blur(0px)`,
            opacity: 1,
          });
          gsap.to(this.DOM.envelopeAnima, this.config.animation.duration, {
            ease: this.config.animation.ease,
            startAt: {
              filter: `blur(30px)`,
              opacity: 0.2,
            },
            filter: `blur(0px)`,
            opacity: 1,
          });
        }
        if (action === "hide") {
          // gsap.fromTo(this.DOM.title, {
          //   duration: this.config.animation.duration,
          //   ease: this.config.animation.ease,
          //   startAt: {
          //     filter: `blur(0px)`,
          //     opacity: 1,
          //   },
          //   filter: `blur(30px)`,
          //   opacity: 0.2,
          // });

          gsap.to(this.DOM.envelopeAnima, this.config.animation.duration, {
            ease: this.config.animation.ease,
            startAt: {
              filter: `blur(0px)`,
              opacity: 1,
            },
            filter: `blur(30px)`,
            opacity: 0.2,
          });
        }

        // alter para o anima
        gsap.to(this.DOM.envelopeAnima, this.config.animation.duration, {
          ease: this.config.animation.ease,
          startAt:
            action === "hide"
              ? {}
              : {
                  x: direction === "right" ? "-100%" : "100%",
                  scale: 1.1,
                },
          x: "0%",
          scale: action === "hide" ? 1.1 : 1,
          onStart: () => {
            this.DOM.envelopeAnima.style.transformOrigin =
              action === "hide"
                ? direction === "right"
                  ? "100% 50%"
                  : "0% 50%"
                : direction === "right"
                ? "0% 50%"
                : "100% 50%";
            this.DOM.el.style.opacity = 1;
          },
          onComplete: () => {
            this.DOM.el.style.zIndex = 9;
            this.DOM.el.style.opacity = action === "hide" ? 0 : 1;
            resolve();
          },
        }); // alter para o anima

        gsap.to(this.DOM.imgWrapper, this.config.animation.duration, {
          ease: this.config.animation.ease,
          startAt:
            action === "hide"
              ? {}
              : {
                  x: direction === "right" ? "-100%" : "100%",
                  scale: 1.1,
                },
          x: "0%",
          scale: action === "hide" ? 1.1 : 1,
          onStart: () => {
            this.DOM.imgWrapper.style.transformOrigin =
              action === "hide"
                ? direction === "right"
                  ? "100% 50%"
                  : "0% 50%"
                : direction === "right"
                ? "0% 50%"
                : "100% 50%";
            this.DOM.el.style.opacity = 1;
          },
          onComplete: () => {
            this.DOM.el.style.zIndex = 9;
            this.DOM.el.style.opacity = action === "hide" ? 0 : 1;
            resolve();
          },
        });
      });
    }
  }

  class Navigation {
    constructor(el, settings) {
      this.DOM = {};
      this.DOM.el = el;
      this.bullets = [];
      this.settings = {
        active: 0,
        onClick: () => false,
      };
      Object.assign(this.settings, settings);
      this.init();
    }
    init() {
      Array.from(this.DOM.el.querySelectorAll(".bullet")).forEach((bullet) => {
        this.bullets.push(bullet);
      });

      this.bullets[this.settings.active].classList.add("current");
      this.bindEvents();
    }

    bindEvents() {
      this.bullets.forEach((bullet, idx) => {
        bullet.addEventListener("click", () => {
          this.settings.onClick(idx);
        });
      });
    }

    setCurrent(idx) {
      // CONTROLE DO VIDEO INSTITUCIOAL
      // COMENTADO EM 27/10/2023 ESTAVA CAUSANDO ERRO DE CLICK, POIS ESTA SEM O VIDEO
      // if (idx == 0) {
      //   video_inst.value.play();
      // } else {
      //   video_inst.value.pause();
      // }

      this.bullets.forEach((bullet) => {
        bullet.classList.remove("current");
      });
      this.bullets[idx].classList.add("current");
    }
  }

  class Slider {
    constructor(el, settings) {
      this.DOM = {};
      this.DOM.el = el;
      this.slides = [];

      this.settings = {
        currentSlide: 0,
      };
      Object.assign(this.settings, settings);
      this.init();
    }
    init() {
      this.navigation = new Navigation(document.querySelector("#navigation"), {
        active: this.settings.currentSlide,
        onClick: (idx) => this.navigate(idx),
      });
      Array.from(this.DOM.el.querySelectorAll(".slide")).forEach((slide) => {
        this.slides.push(new Slide(slide));
      });
      this.slides[this.settings.currentSlide].setCurrent();
    }

    async navigate(idx) {
      if (this.isAnimating || idx === this.settings.currentSlide) return;
      this.isAnimating = true;

      const direction = idx > this.settings.currentSlide ? "right" : "left";

      this.navigation.setCurrent(idx);
      await Promise.all([
        this.slides[this.settings.currentSlide].hide(direction),
        this.slides[idx].show(direction),
      ]);
      this.slides[this.settings.currentSlide].setCurrent(false);
      this.settings.currentSlide = idx;
      this.slides[this.settings.currentSlide].setCurrent();
      this.isAnimating = false;
    }
  }

  const sliderEl = document.querySelector("#slider");
  const slider = new Slider(sliderEl);
});
</script>

<style scoped>
/* TESTE NOVO BANNER */
* {
  box-sizing: border-box;
}

@import url("https://fonts.googleapis.com/css?family=Roboto:400,700,900");
:root {
  --text-color: rgb(255, 255, 255);
  --blend-color: rgba(46, 61, 102, 0.6);
  --bullets-color: rgb(255, 255, 255);
  --transform-amount: 20px;
  --bullets-count: 5;
}

* {
  box-sizing: border-box;
}

.wrapper {
  height: 100%;
  width: calc(100vw + 50px);
}

#slider {
  width: 100%;
  height: 100%;
  overflow: hidden;
  position: relative;
}

.slide {
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  pointer-events: none;
}

.slide.current {
  pointer-events: initial;
  opacity: 1;
  z-index: 10;
}

.slide-wrapper {
  width: 100%;
  height: 100%;
  overflow: hidden;
  position: relative;
  overflow-y: clip;
}

.img-wrapper {
  width: 100%;
  height: 100%;
  background: #1b3346
}
.img-wrapperVid {
  width: 100%;
  height: 100%;
  background: #1b3346;
}

.img-wrapper img {
  width: calc(100% + 20px);
  height: 100%;
  /*   height: calc(100% + 20px);   */
  object-fit: cover;
  top: calc(20px / 2 * -1);
  left: calc(20px / 2 * -1);
  position: relative;

  background: no-repeat center;
  background-size: cover;
}
.img-wrapper video {
  width: calc(100% + 20px);
  /* height: calc(100% + 20px); object-fit: cover;*/
  top: calc(20px / 2 * -1);
  left: calc(20px / 2 * -1);
  position: relative;

  background: no-repeat center;
  background-size: cover;
}
.img-wrapperVid video {
  width: calc(100% + 20px);
  /* height: calc(100% + 20px); object-fit: cover;*/
  top: calc(20px / 2 * -1);
  left: calc(20px / 2 * -1);
  position: relative;

  background: no-repeat center;
  background-size: cover;
}

.title-wrapper {
  position: relative;
  top: 0;
  width: 100%;
  height: 100%;
}

.inner-wrapper {
  position: relative;
  bottom: 20em;
  left: 25%;
  color: #fff;
  max-width: 70%;
}

.slide-title {
  white-space: nowrap;
  text-transform: uppercase;
  font-size: 4em;
  font-weight: 900;
}

.slide-subtitle {
  font-size: 1.5em;
}

#navigation {
  pointer-events: none;
  position: absolute;
  bottom: 100px;
  z-index: 15;
  width: 100%;
  height: 50px;
  display: grid;
  grid-template-columns: repeat(3, 20px);
  grid-gap: 40px;
  justify-content: center;
  align-items: center;
}

.bullet {
  pointer-events: initial;
  ---border-radius: 10px;
  cursor: pointer;
  ---height: 5px;
  ---background: rgb(255, 255, 255);
  transition: opacity 0.3s ease;
  opacity: 1;

  width: 16px;
  height: 16px;
  border-radius: 16px;
  background-color: #00b1ef;
}

.bullet.current {
  opacity: 1;
  width: 48px !important;
  background-color: #00b1ef !important;
  transition: 1s;
}

.bullet:not(.current):hover {
  opacity: 0.5;
}

@media (max-width: 700px) {
  .slide-title {
    font-size: 3em;
  }
  .slide-subtitle {
    font-size: 1.2em;
  }
}

@media (max-width: 500px) {
  .inner-wrapper {
    left: initial;
    width: 100%;
    max-width: initial;
  }
  .slide-title {
    font-size: 4em;
    text-align: center;
  }
  .slide-subtitle {
    display: none;
  }
}

@media (max-width: 450px) {
  .slide-title {
    font-size: 3em;
  }
}
/* TESTE NOVO BANNER */

.drawLine {
  z-index: 9999;
  position: absolute;
  left: 50%;
  top: auto;
  right: auto;
  bottom: -310px;
  overflow: hidden;
  width: 1px;
  height: 320px;
}
.drawLineInner {
  width: 1px;
  height: 100%;
  background-color: #00b1ef;
}

.seta {
  position: absolute;
}
.seta:hover {
  cursor: pointer;
}
.seta > div:nth-child(1) {
  position: absolute;
  padding: 10px;
  box-shadow: 2px -2px 0 1px #00b1ef inset;
  border: solid transparent;
  border-width: 0 0 3px 3px;
  transform: rotate(225deg);
}
.seta > div:nth-child(2) {
  position: absolute;
  top: 10px;
  right: -19px;
  width: 50px;
  height: 3px;
  background-color: #00b1ef;
}
.seta > div:nth-child(3) {
  position: absolute;
  top: -5px;
  right: 50px;
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #00b1ef;
}

.arrow {
  width: 100px;
  height: 30px;
  margin: 0px;
  display: inline-block;
  position: relative;

  &::before {
    content: "";
    display: block;
    width: 20px;
    height: 20px;
    top: 21px;
    left: 55px;
    border-style: solid;
    border-color: #fff;
    border-width: 0.13rem 0.13rem 0 0;
    position: absolute;
    transform-origin: 52% 45%;
  }

  &.right::before {
    transform: rotate(45deg);
    margin: -15px 0 0 -20px;
  }

  &::after {
    content: "";
    display: block;
    top: 50%;
    left: 50%;
    border-style: solid;
    border-color: #ffffff;
    position: absolute;
    transform-origin: 50% 50%;
  }

  &.right::after {
    width: 60px;
    height: 0;
    border-width: 2px 0 0 0;
    transform: translate(-52px, -1px);
  }
}
.arrow:hover {
  cursor: pointer;
}
</style>