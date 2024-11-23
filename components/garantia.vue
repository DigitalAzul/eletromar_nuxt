 <template>
  <div envelope="Garantia">
    <div class="drawLineContGaran">
      <div
        class="drawLineInnerContGaran"
        id="drawLineInnerContIDGaran"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      class="bg_garantia relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txGarantiaID"
        class="container relative mx-auto text-center text-[2.5rem] font-normal uppercase tracking-[.20em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("termosgarantia") }}
      </div>
    </div>
    <div class="bg-[#1b3346] pb-[60px]">
      <div
        id="garantiaTitID"
        class="space-y-4 overflow-hidden pt-[230px] text-center"
      >
        <div class="H1Garantia">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("saibamais")
          }}</span>
        </div>
        <div class="H2Garantia">
          <span class="text-4xl font-bold text-white">{{
            $t("termosgarantia")
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
            class="space-y-4 text-justify leading-[2rem] text-white sm:text-xl lg:text-3xl lg:leading-[3rem]"
          >
            <div v-for="(g, index) in itemGarantias" :key="index">
              <div class="flex flex-row items-start justify-start space-x-3">
                <div
                  class="relative top-4 min-h-[18px] min-w-[18px] rounded-full bg-[#00b1ef]"
                ></div>
                <p>{{ g.texto }}</p>
              </div>
            </div>
            
          </div>
          <div
            class="relative -left-[45px] flex min-h-[100px] w-auto flex-row items-center justify-center pt-20 text-start"
          >
            <div class="pdf flex min-h-[80px] min-w-[80px] mt-6"></div>
            <div class="min-h-[140px] w-full pt-2">
              <p
                id="baixar"
                class="w-2 cursor-pointer pt-8 font-medium text-[#00b1ef] sm:text-xl lg:text-2xl"
              >
                <a
                  v-if="Object.keys(garantia).length > 0"
                  target="_blank"
                  :href="pathGarantia + garantia[0].arquivo"
                >
                  <div class="text-xl uppercase">{{ $t("baixar") }}</div>
                </a>
              </p>
              <p
                class="w-[180px] font-normal text-white sm:text-xl md:w-auto lg:text-2xl"
              >
                {{ $t("termosgarantia") }}
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
import SplitType from "split-type";
gsap.registerPlugin(ScrollTrigger);
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

const pathGarantia = "\\media\\garantia\\";
let atualY = ref(-100);
let ultimaPosicao = ref(0);
let lang = ref("pt");
onMounted(() => {
  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#garantiaTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1Garantia", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2Garantia", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  ScrollTrigger.create({
    trigger: ".drawLineContGaran",
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
    let txGarantiaIDspacer = document.getElementById("txGarantiaID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDGaran.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.2) txGarantiaIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.2) txGarantiaIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDGaran.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

const { t, locale } = useI18n();
const textoGarantiasLang = ref({});
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
  getGarantia();
});
let garantia = ref([]);
let doisParagrafos = ref([]);
let itemGarantias = ref([]);

function blocksToArray() {
  doisParagrafos.value = [];
  itemGarantias.value = [];

  garantia.value.map((g, index) => {
    if (lang.value == "pt") {
      textoGarantiasLang.value = JSON.parse(g.texto);
    } else if (lang.value == "en") {
      textoGarantiasLang.value = JSON.parse(g.texto_en);
    } else {
      textoGarantiasLang.value = JSON.parse(g.texto_es);
    }

    textoGarantiasLang.value.map((b, index) => {
      if (index < 2) {
        doisParagrafos.value.push(b);
      } else {
        itemGarantias.value.push(b);
      }
    });
  });
}

async function getGarantia() {
  let R = await $fetch("/api/formGarantia.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      garantia.value = r.dados;
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

#garantiaID {
  opacity: 0;
  transform: rotate(0deg) translateY(0%);
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
  from {
    z-index: 1;
    opacity: 0.3;

    transform: rotate(0deg) translateY(150%);
  }
  to {
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
  background-color: #00b1ef;
}
.pdf {
  background-color: #1b3346;
  background-image: url("/img/pdfOver.svg");
  background-repeat: no-repeat;
  background-size: cover;
}
.bg_garantia {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}

.drawLineContGaran {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -150px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContGaran {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
</style>
