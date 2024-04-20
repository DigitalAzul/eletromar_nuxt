<template>
  <div class="slider">
    <div class="slides">
      <input type="radio" name="radio-bt" id="radio1" />
      <input type="radio" name="radio-bt" id="radio2" />
      <input type="radio" name="radio-bt" id="radio3" />

      <div
        id="slide-1"
        class="slide first banner_em_teste xitems-center xjustify-center xtop-[15%] relative flex flex-col"
      >
        <img src="/img/fd_banner1.jpg" class="bannerImgGB" />

        <div class="absolute">
          <anima-mecplus />
        </div>

        <div class="seta left-[15%] top-[18%] lg:left-[25%] lg:top-[0%]">
          <div></div>
          <div></div>
          <div>Confira</div>
        </div>
      </div>

      <div
        id="slide2"
        class="slide first banner_em_teste xitems-center xjustify-center xtop-[15%] relative flex flex-col"
      >
        <img src="/img/bg-banner_1.jpg" class="bannerImgGB" />

        <div class="absolute">
          <anima-mecplus />
        </div>

        <div class="seta left-[15%] top-[18%] lg:left-[25%] lg:top-[0%]">
          <div></div>
          <div></div>
          <div>Confira</div>
        </div>
      </div>

      <div
        id="slide-3"
        class="slide first banner_em_teste xitems-center xjustify-center xtop-[15%] relative flex flex-col"
      >
        <img src="/img/fd_banner1.jpg" class="bannerImgGB" />

        <div class="absolute">
          <anima-mecplus />
        </div>

        <div class="seta left-[15%] top-[18%] lg:left-[25%] lg:top-[0%]">
          <div></div>
          <div></div>
          <div>Confira</div>
        </div>
      </div>
    </div>

    <div
      id="manualNavID"
      class="manual-nav bottom-[50px] flex flex-row items-center justify-center space-x-3 lg:bottom-[100px]"
    >
      <label
        for="radio1"
        class="manual-bt radioAtivo"
        id="manual-bt1"
        @click="setBanner(1)"
      ></label>
      <label
        for="radio2"
        class="manual-bt"
        id="manual-bt2"
        @click="setBanner(2)"
      ></label>
      <label
        for="radio3"
        class="manual-bt"
        id="manual-bt3"
        @click="setBanner(3)"
      ></label>
    </div>

    <div id="faixaHorzBanner" class="z-[50] hidden"></div>
  </div>
</template>

<script setup>
import { ref, onBeforeMount, onMounted } from "vue";

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

let countBanner = ref(0);

onMounted(() => {
  // setBanner(1);

  const slidesBanner = gsap.utils.toArray(".slide");
  const bannerImgGBARR = gsap.utils.toArray(".bannerImgGB");
  let zCont = 9;
  slidesBanner.forEach((slideBan, i) => {
    gsap.set(slideBan, { css: { zIndex: zCont } });
    zCont--;
    slideBan.addEventListener("mousemove", (e) => {
      gsap.set(bannerImgGBARR[i], { transformStyle: "preserve-3d" });
      let sxPos = (e.pageX / slideBan.offsetWidth) * 100 - 50;
      let syPos = (e.pageY / slideBan.offsetHeight) * 100 - 50;

      gsap.set(bannerImgGBARR[i], {
        rotationY: 0.05 * sxPos,
        rotationX: 0.05 * syPos,
        rotationZ: "-0.1",
        transformPerspective: 500,
      });
      gsap.set(bannerImgGBARR[i], { transformOrigin: "center center 150px" });
    });
  });
  const tlBanner = gsap.timeline();
  // tlBanner.to(slidesBanner[1], {
  //   duration: 0.3,
  //   x: "-100%",
  //   ease: "power4-out",
  // });
  let x = 0;
  let bannerRotacao = setInterval(function () {
    gsap.set(slidesBanner[x], { css: { zIndex: 3 } });

    tlBanner.to(slidesBanner[x], {
      duration: 3,
      xPercent: 100,
      ease: "power4",
      onComplete: refazZindex(x),
    });
    x += 1;
    if (x > 2) x = 0;
  }, 5000);

  let bannerCorrente = null;
  function playBanner(banner) {
    bannerCorrente = banner;
  }
  function refazZindex() {
    tlBanner.to(slidesBanner[x], {
      xPercent: 0,
    });
  }
  // const slide1 = document.getElementById("slide-1");
  // const slide2 = document.getElementById("slide2");
  // const slide3 = document.getElementById("slide-3");
  // const bannerImgGB1 = document.getElementsByClassName("bannerImgGB-1");
  // const bannerImgGB2 = document.getElementsByClassName("bannerImgGB-2");
  // const bannerImgGB3 = document.getElementsByClassName("bannerImgGB-3");

  // gsap.set(bannerImgGB1, { transformStyle: "preserve-3d" });
  // //gsap.set(bannerImgGB2, { transformStyle: "preserve-3d" });
  // gsap.set(bannerImgGB3, { transformStyle: "preserve-3d" });

  // slide1.addEventListener("mousemove", (e) => {
  //   let sxPos = (e.pageX / slide1.offsetWidth) * 100 - 50;
  //   let syPos = (e.pageY / slide1.offsetHeight) * 100 - 50;
  //   gsap.set(bannerImgGB1, {
  //     rotationY: 0.05 * sxPos,
  //     rotationX: 0.05 * syPos,
  //     rotationZ: "-0.1",
  //     transformPerspective: 500,
  //   });
  //   gsap.set(bannerImgGB1, { transformOrigin: "center center 150px" });
  // });

  // slide2.addEventListener("mousemove", (e) => {
  //   let sxPos = (e.pageX / slide2.offsetWidth) * 100 - 50;
  //   let syPos = (e.pageY / slide2.offsetHeight) * 100 - 50;
  //   gsap.set(".bannerImgGB-2", {
  //     rotationY: 0.05 * sxPos,
  //     rotationX: 0.05 * syPos,
  //     rotationZ: "-0.1",
  //     transformPerspective: 500,
  //   });
  //   gsap.set(".bannerImgGB-2", { transformOrigin: "center center 150px" });
  // });

  // slide3.addEventListener("mousemove", (e) => {
  //   let sxPos = (e.pageX / slide3.offsetWidth) * 100 - 50;
  //   let syPos = (e.pageY / slide3.offsetHeight) * 100 - 50;
  //   gsap.set(bannerImgGB2, {
  //     rotationY: 0.05 * sxPos,
  //     rotationX: 0.05 * syPos,
  //     rotationZ: "-0.1",
  //     transformPerspective: 500,
  //   });
  //   gsap.set(bannerImgGB2, { transformOrigin: "center center 150px" });
  // });
});

onBeforeMount(() => {
  if (1 == 11) {
    let bannerRotacao = setInterval(function () {
      avancaBanner();
    }, 3000);
  }
  function avancaBanner() {
    countBanner.value++;
    if (countBanner.value > 3) {
      countBanner.value = 1;
    }
    //document.getElementById("radio" + countBanner),

    //setBanner(countBanner.value);
    document.getElementById("manual-bt1").classList.remove("radioAtivo");
    document.getElementById("manual-bt2").classList.remove("radioAtivo");
    document.getElementById("manual-bt3").classList.remove("radioAtivo");

    document.getElementById("radio" + countBanner.value).checked = true;
    document
      .getElementById("manual-bt" + countBanner.value)
      .classList.add("radioAtivo");
  }
});

function setBanner(radio) {
  const todosRadios = document.getElementsByClassName("radioAtivo");
  for (let i = 0; i < todosRadios.length; i++) {
    todosRadios[i].classList.remove("radioAtivo");
  }

  document.getElementById("radio" + radio).checked = true;

  if (document.getElementById("radio" + radio).checked) {
    document.getElementById("manual-bt" + radio).classList.add("radioAtivo");
  }
}
</script>

<style scoped>
.bannerImgGB {
  transform-style: preserve-3d;
  /* --transform: matrix3d(
    0.999266,
    -0.00174405,
    -0.0382788,
    7.65576e-5,
    0.00174533,
    0.999998,
    0,
    0,
    0.0382787,
    -6.68091e-5,
    0.999267,
    -0.00199853,
    0,
    0,
    0,
    -150
  ); 
  transform-origin: center center -150px !important;*/
  position: absolute;
  opacity: 1.45;
  margin: auto;
  width: 150%;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  transform-origin: 50% 50% -150px !important;
}
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
  background-color: #70df3f;
}

.slider {
  position: relative;
  overflow: clip;
  height: calc(100vh + 200px);
}
.slides {
  ----display: flex;

  overflow: hidden;
  scroll-snap-type: x mandatory;

  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}
.slides input {
  display: none;
}
.slide {
  scroll-snap-align: start;
  flex-shrink: 0;
  width: 100%;
  height: calc(100vh + 200px);
  --transform-origin: center center;
  --transform: scale(1);
  --transition: transform 0.5s;
  --transition: 1s;
  position: absolute;
  top: 0;
  left: 0;

  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 100px;
}
.radioAtivo {
  width: 48px !important;
  background-color: #9ade53 !important;
}
.xauto-nav div {
  cursor: pointer;
  transition: 1s;
  width: 16px;
  height: 16px;
  border-radius: 16px;
  background-color: #35603d;
}
.xauto-bt:hover {
  background-color: #9ade53;
}
.xauto-nav {
  position: absolute;
  width: 100%;
}

.manual-nav {
  position: absolute;
  width: 100%;
}
.manual-bt {
  cursor: pointer;
  transition: 1s;
  width: 16px;
  height: 16px;
  border-radius: 16px;
  background-color: #35603d;
}
.manual-bt:hover {
  background-color: #9ade53;
}
#radio1:checked ~ .first {
  margin-left: 0px;
}
#radio2:checked ~ .first {
  margin-left: -100%;
}
#radio3:checked ~ .first {
  margin-left: -200%;
}

.banner {
  background: url("/img/fd_banner1.jpg");
  background-size: cover;
  background-position: center;
}
.banner2 {
  --background: url("/img/bg-banner_1.jpg");
  --background-size: cover;
}

.seta {
  position: relative;
}
.seta:hover {
  cursor: pointer;
}
.seta > div:nth-child(1) {
  position: absolute;
  padding: 10px;
  box-shadow: 2px -2px 0 1px #9ade53 inset;
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
  background-color: #9ade53;
}
.seta > div:nth-child(3) {
  position: absolute;
  top: -5px;
  right: 50px;
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #9ade53;
}
#faixaHorzBanner {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0px;
  width: 3px;
  height: 20px;
  background-color: #70df3f;
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