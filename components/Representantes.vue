<template>
  <div
    id="representanteID"
    class="xh-[1500px] bg-representante relative mx-auto snap-center bg-no-repeat pt-10"
  >
    <div class="drawLineRep">
      <div
        class="drawLineInnerRep"
        id="drawLineInnerRepID"
        style="
          will-change: transform;
          transform: translate3d(0px, 0%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      id="representanteTitID"
      class="space-y-4 overflow-clip py-10 pt-44 text-center"
    >
      <div class="H1Representa">
        <span class="text-3xl uppercase text-[#00b1ef]">
          {{ $t("representantes") }}
        </span>
      </div>
      <div class="H2Representa">
        <span class="text-4xl font-bold uppercase text-white">
          {{ $t("escolhaoestadodesejado") }}
        </span>
      </div>
    </div>

    <div
      class="relative mx-auto mt-10 grid min-h-[800px] grid-rows-2 overflow-hidden lg:h-[1000px] lg:grid-cols-2 lg:items-start"
    >
      <!-- 2xl:left-16 3xl:left-32 4xl:left-[270px] -->
      <div id="homemRepID" class="relative">
        <div
          id="homemRep"
          class="absolute mx-0 mt-14 h-[500px] w-full md:h-[calc(100vw)] lg:h-[430px] xl:h-[680px] 2xl:left-16 z3xl:left-32 4xl:left-[200px]"
        ></div>
      </div>

      <div id="mapaRepID" class="xorder-first xlg:order-last h-[650px]">
        <mapa-brasil />
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from "vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

let Y = -100;
let ease = 0.5;

onMounted(() => {
  let ultimaPosicao = 0;
  let drawLineInnerRepID = document.getElementById("drawLineInnerRepID");
  let representanteID = document.getElementById("representanteID");
  let topPosRep = representanteID.offsetTop;

  const tlRepresentanteTit = gsap.timeline({
    scrollTrigger: {
      trigger: "#representanteTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlRepresentanteTit.from(".H1Representa", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlRepresentanteTit.from(".H2Representa", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  setTranslate(-100);
  function setTranslate(yPos) {
    drawLineInnerRepID.style.transform = `translate3d(0, ${yPos}%, 0)`;
    if (Y < -100) Y = -100;
    if (Y > 100) Y = 100;
  }

  window.addEventListener("scroll", () => {
    let { scrollY } = window;
    let yInicial = window.scrollY;
    if (scrollY > topPosRep - 1000) {
      if (yInicial > ultimaPosicao) {
        //pra baixo
        //console.log("scrollYREp, topPosRep", scrollY, topPosRep);
        // console.log("↓↓↓");
        // console.log("topPosRep", topPosRep, 0.1 * (scrollY - topPosRep) + 100);
        if (Y <= 100) {
          //Y += 4; //0.1 * (scrollY - topPosRep) + 100;
          //setTranslate(Y);
          Y += 10 * ease;
          setTranslate(Y);
        }
      } else {
        // pra cima
        // console.log("↑↑↑");
        // console.log("scrollY", scrollY);
        // console.log("topPosRep", topPosRep);
        if (scrollY == 0) {
          setTranslate(-100);
          Y = -100;
          return;
        }
        if (Y >= -100) {
          Y -= 4; //0.1 * (scrollY - topPosRep) + 100;
          setTranslate(Y);
        }
      }
      ultimaPosicao = yInicial;
    }
  });

  let homemRepID = document.getElementById("homemRepID");

  ///
  /// REPRESENTANTE IMAGEM
  var homemRepIDOB = new IntersectionObserver(
    function (entries) {
      // isIntersecting is true when element and viewport are overlapping
      // isIntersecting is false when element and viewport don't overlap
      if (entries[0].isIntersecting === true) {
        homemRepID.classList.add("paraLadoDir");
      } else {
        //homemRepID.classList.remove("paraLadoDir");
      }
    },
    { threshold: [0.4] }
  );
  homemRepIDOB.observe(document.querySelector("#homemRepID"));
  ///
  /// REPRESENTANTE MAPA
  var mapaRepIDOB = new IntersectionObserver(
    function (entries) {
      // isIntersecting is true when element and viewport are overlapping
      // isIntersecting is false when element and viewport don't overlap
      if (entries[0].isIntersecting === true) {
        mapaRepID.classList.add("paraLadoEsq");
      } else {
        //mapaRepID.classList.remove("paraLadoEsq");
      }
    },
    { threshold: [0.4] }
  );
  mapaRepIDOB.observe(document.querySelector("#mapaRepID"));
  ///
});
</script>




<style scoped>
.bg-representante {
  background: #0c1a25;
  background: -moz-linear-gradient(
    180deg,
    #0c1a25 0%,
    #1b3346 100%
  );
  background: -webkit-linear-gradient(
    180deg,
    #0c1a25 0%,
    #1b3346 100%
  );
  background: linear-gradient(
    180deg,
    #0c1a25 0%,
    #1b3346 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#00b1ef",endColorstr="#006038",GradientType=1);
}
#homemRepID {
  visibility: hidden;
  --transform: rotate(0deg) translateX(-10%);
  opacity: 0;
}

.paraLadoDir {
  visibility: visible !important;
  animation-name: paraLadoDir;
  animation-delay: 0.5s;
  animation-duration: 0.5s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in-out;
}

@keyframes paraLadoDir {
  0% {
    transform: rotate(0deg) translateX(-10%);
    opacity: 0;
  }

  100% {
    opacity: 1;
    transform: rotate(0deg) translatex(0%);
  }
}

#mapaRepID {
  visibility: hidden;
  --transform: rotate(0deg) translateX(0%);
  opacity: 0;
}
.paraLadoEsq {
  visibility: visible !important;
  animation-name: paraLadoEsq;
  animation-delay: 0.2s;
  animation-duration: 0.5s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in-out;
}
@keyframes paraLadoEsq {
  0% {
    opacity: 0;
    transform: rotate(0deg) translateX(10%);
  }
  100% {
    opacity: 1;
    transform: rotate(0deg) translatex(0%);
  }
}

.drawLineRep {
  z-index: 9999999;
  position: absolute;
  left: 50%;
  top: -30px;
  right: auto;

  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerRep {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
#faixaHorzBanner {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: -370px;
  width: 3px;
  height: 320px;
  background-color: #00b1ef;
}

#homemRep {
  background-size: contain;
  background-image: url("/img/homemRepresentante.png");
  background-repeat: no-repeat;
  background-position: center;
}
</style>