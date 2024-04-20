<template>
  <div envelope="Politica">
    <div class="drawLineContAbien">
      <div
        class="drawLineInnerContAmbien"
        id="drawLineInnerContIDAmbien"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      class="bg_mambiente relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#006038]"
    >
      <div
        id="txMeiAmbienteID"
        class="container relative mx-auto text-center text-[2.5rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("meioambiente") }}
      </div>
    </div>
    <div class="bg-[#006038] pb-[60px]">
      <div
        id="meioAmbienteTitID"
        class="space-y-4 overflow-hidden pt-[230px] text-center"
      >
        <div class="H1MeioAmbiente">
          <span class="text-3xl uppercase text-[#72df42]">{{
            $t("saibamais")
          }}</span>
        </div>
        <div class="H2MeioAmbiente">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("meioambiente")
          }}</span>
        </div>
      </div>

      <!-- Politicas de privacidade -->
      <div
        class="container mx-auto flex px-6 md:px-32 pt-20 sm:pb-72 sm:pt-32 lg:pb-[30rem]"
      >
        <div
          class="container mx-auto min-h-[800px] space-y-3 text-justify text-lg text-white sm:text-2xl lg:text-3xl"
        >
          <div class="flex flex-col space-y-12 pb-14 text-justify">
            <span
              v-for="(g, index) in doisParagrafos"
              :key="index"
              class="space-y-12"
            >
              <p>{{ g.texto }}</p>
            </span>
          </div>

          <div
            class="space-y-4 text-justify leading-[2rem] text-white sm:text-xl lg:text-4xl lg:leading-[4rem]"
          >
            <div
              class="space-y-4 text-justify leading-[2rem] text-white sm:text-xl lg:text-3xl lg:leading-[3rem]"
            >
              <div v-for="(g, index) in itemMambiente" :key="index">
                <div class="flex flex-row items-start justify-start space-x-3">
                  <div
                    class="relative top-4 min-h-[18px] min-w-[18px] rounded-full bg-[#70dc40]"
                  ></div>
                  <p>{{ g.texto }}</p>
                </div>
              </div>
            </div>
          </div>
          <div
            class="relative -left-[45px] flex min-h-[100px] w-auto flex-row items-center justify-center pt-20 text-start"
          >
            <div class="pdf flex min-h-[140px] min-w-[130px]"></div>
            <div class="min-h-[140px] w-full pt-2">
              <p
                id="baixar"
                class="w-2 cursor-pointer pt-8 font-medium text-[#70dc40] sm:text-xl lg:text-2xl"
              >
                <a
                  v-if="Object.keys(mAmbiente).length > 0"
                  target="_blank"
                  :href="pathAmbiente + mAmbiente[0].arquivo"
                >
                  <div class="text-xl uppercase">{{ $t("baixar") }}</div>
                </a>
              </p>
              <p
                class="w-[180px] font-normal uppercase text-white sm:text-xl md:w-auto lg:text-2xl"
              >
                {{ $t("termospolitica") }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

let atualY = ref(-100);
let ultimaPosicao = ref(0);
const pathAmbiente = "\\media\\ambiente\\";

onMounted(() => {
  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#meioAmbienteTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1MeioAmbiente", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2MeioAmbiente", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  ScrollTrigger.create({
    trigger: ".drawLineContAbien",
    start: "center bottom",
    end: "+=1000px",
    onEnter: () => {
      atualY.value = -100;
    },
    onLeave: () => {
      atualY.value = 100;
    },
    onEnterBack: () => {
      atualY.value = 100;
    },
    onUpdate: (self) => setTranslate(self.progress),
  });

  function setTranslate(pg) {
    let yInicial = pg;
    let txMeiAmbienteIDspacer = document.getElementById("txMeiAmbienteID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDAmbien.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.2) txMeiAmbienteIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.2) txMeiAmbienteIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDAmbien.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

let lang = ref("pt");
const { t, locale } = useI18n();

onMounted(() => {
  atualizaLocale();
});

watch(i18nLocale.locale, () => {
  atualizaLocale();
  blocksToArray();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}

onMounted(() => {
  getMeioAmbiente();
});
let mAmbiente = ref([]);
let doisParagrafos = ref([]);
let itemMambiente = ref([]);
const textoAmbientesLang = ref({});
function blocksToArray() {
  doisParagrafos.value = [];
  itemMambiente.value = [];

  mAmbiente.value.map((g, index) => {
    if (lang.value == "pt") {
      textoAmbientesLang.value = JSON.parse(g.texto);
    } else if (lang.value == "en") {
      textoAmbientesLang.value = JSON.parse(g.texto_en);
    } else {
      textoAmbientesLang.value = JSON.parse(g.texto_es);
    }

    textoAmbientesLang.value.map((b, index) => {
      if (index < 2) {
        doisParagrafos.value.push(b);
      } else {
        itemMambiente.value.push(b);
      }
    });
  });
}

async function getMeioAmbiente() {
  let R = await $fetch("/api/formAmbiente.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      mAmbiente.value = r.dados;
      blocksToArray();
    } else {
    }
  });
}
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}

.praCimaTit > div:nth-child(1) {
  animation-name: paraCima;
  --animation-delay: 0.3s;
  animation-duration: 1s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in-out;
  /* animation: paraCima 0.6s ease-in-out forwards; */
}
.praCimaTit > div:nth-child(2) {
  animation-name: paraCima;
  --animation-delay: 0.5s;
  animation-duration: 1.5s;
  animation-fill-mode: forwards;
  transition-timing-function: ease-in;
  /* animation: paraCima 0.6s ease-in-out forwards; */
}

.praCimaTit {
  opacity: 1 !important;
  animation-delay: 1s;
}
@keyframes paraCima {
  0% {
    z-index: 1;
    opacity: 0.3;

    transform: rotate(0deg) translateY(150%);
  }
  100% {
    z-index: 1;
    opacity: 1;
    transform: rotate(0deg) translateY(-100%);
  }
}

#faixaHorzEmp {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0;
  width: 3px;
  height: 220px;
  background-color: #70df3f;
}
.pdf {
  background-color: #006038;
  background-image: url("/img/pdfOver.svg");
  background-repeat: no-repeat;
  background-size: cover;
}
.bg_mambiente {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}

.drawLineContAbien {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -150px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContAmbien {
  width: 2px;
  height: 100%;
  background-color: #70df3f;
}
</style>
