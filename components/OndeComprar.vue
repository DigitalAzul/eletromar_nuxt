<template>
  <div envelope="OndeComprar">


    <div
      class="bg_comprar static flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >

    <div class="drawLineOndeComprar">
      <div
        class="drawLineInnerOndeComprar"
        id="drawLineInnerContIDOndeComprar"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>


      <div
        class="container relative mx-auto text-center text-[3rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("confiraasregioes") }}
      </div>
    </div>
    <div class="bg-[#1b3346] py-[60px]">
      <div class="space-y-4 pt-[130px] text-center">
        <p class="text-3xl uppercase text-[#00b1ef]">
          {{ $t("representantes") }}
        </p>
        <p class="text-4xl font-bold uppercase text-white">
          {{ $t("escolhaoestadodesejado") }}
        </p>
      </div>

      <!-- <div id="faixaHorzOndeComprar" class="z-[50]"></div> -->

      <div class="container mx-auto flex flex-col pb-[10rem] pt-32">
        <div
          class="container mx-auto flex justify-center pb-5 pl-6 pt-3 text-3xl font-semibold text-white lg:justify-start xl:pl-10"
        >
          <p v-if="EstadoExtenso.length > 0">
            {{ $t("representantesde") }} {{ EstadoExtenso }}
          </p>
          <p v-else>
            {{ $t("Estadoaindanaopossui") }} <br />{{ $t("representantes") }}
          </p>
        </div>
        <!-- TOGLE LISTA ESTADOS -->
        <div class="w-full px-4 pt-14 lg:hidden">
          <div
            @click="ondeComprarToggle()"
            class="mb-6 flex h-14 w-full cursor-pointer items-center bg-[#00b1ef] pl-2 text-[1.8rem] text-white"
          >
            Estados
          </div>
          <div
            id="ondeComprarID"
            class="hidden h-[400px] overflow-y-auto lg:block"
          >
            <div
              v-for="(uf, index) in UF"
              :key="index"
              @click="
                (queryRep.q = 'por_uf'),
                  (queryRep.uf = uf.value),
                  getRepresentantes(),
                  ondeComprarToggle()
              "
              class="ml-3 pb-2 text-base text-white hover:cursor-pointer hover:text-[#00b1ef] hover:underline"
            >
              {{ uf.label }}
            </div>
          </div>
        </div>
        <div
          class="container mx-auto mt-10 flex h-[500px] flex-col justify-around lg:flex-row"
        >
          <!-- Localidades para comprar -->
          <div
            class="justfy-center  relative flex flex-col pr-1 text-start sm:w-full lg:w-1/2 xl:left-0"
          >
            <x-modal v-model="modalRep">
              {{ $t("Estadoaindanaopossui") }} {{ $t("representantes") }}
            </x-modal>
            <div class="flex flex-col  lg:items-center lg:space-y-0">
              <div
                class="scrollRep zlg:h-[900px] zjustify-center flex h-[500px] w-full overflow-y-auto overflow-x-hidden px-6 pr-6 md:justify-start lg:w-3/5"
              >
                <div class="relative space-y-3">
                  <div
                    v-for="(representante, index) in representantes"
                    :key="index"
                  >
                    <div
                      class="pt-6 text-xl font-medium uppercase text-[#66ccff]"
                    >
                      <p>{{ representante.estabelecimento }}</p>
                    </div>
                    <div class="pt-4 text-xl font-light leading-8 text-white">
                      <p
                        v-for="(rep, index) in representante.contato"
                        :key="index"
                      >
                        {{ rep }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- MAPA -->

          <div class="order-last hidden w-1/2 flex-col lg:block">
            <div><mapa-brasil-rep @setUf="setUf" /></div>
          </div>
          <!-- MAPA -->
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { XModal } from "@indielayer/ui";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

components: {
  XModal;
}

let estadosCaompara = [
  "ac",
  "ap",
  "am",
  "ba",
  "ce",
  "df",
  "es",
  "go",
  "ma",
  "mt",
  "ms",
  "mg",
  "pa",
  "pr",
  "pe",
  "pi",
  "rj",
  "rn",
  "rs",
  "ro",
  "rr",
  "sc",
  "sp",
  "se",
  "to",
];
const route = useRoute();
const router = useRouter();
const _UF = ref(route.query.uf ? route.query.uf : "");
const vindoDoHome = ref(false);
if (estadosCaompara.includes(_UF.value)) {
  vindoDoHome.value = true;
}

let atualY = ref(-100);
let ultimaPosicao = ref(0);
onMounted(() => {
  const tlContTitCont = gsap.timeline({});


  ScrollTrigger.create({
    trigger: ".drawLineOndeComprar",
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
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDOndeComprar.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      
      drawLineInnerContIDOndeComprar.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

let ROTA = ref();
let UF = ref([]);
onMounted(() => {
  ROTA = useRoute();
  getUfs();

  if (vindoDoHome.value === true) {
    queryRep.value.uf = _UF.value.toUpperCase();
  }

  getRepresentantes();
  findEstado();
});
const modalRep = ref(false);
let EstadoExtenso = ref("");

const setUf = (uf) => {
  queryRep.value.q = "por_uf";
  queryRep.value.uf = uf;
  getRepresentantes();
};
function findEstado() {
  UF.value.map((u) => {
    if (u.value == queryRep.value.uf) {
      console.log(EstadoExtenso.value.length);
      EstadoExtenso.value = u.label;
    }
  });
}

let queryRep = ref({
  q: "por_uf",
  uf: "PE",
});
function getRepresentantes() {
  let R = null;
  R = $fetch(
    "/api/formRepresentantes.php",

    {
      method: "GET",
      params: { json: queryRep.value },
    }
  ).then((R) => {
    let REP = JSON.parse(R);
    if (REP.codigo == 0) {
      REP.dados.map((r) => {
        // r.contato = JSON.parse(r.contato);
        r.contato = r.contato.split("\n");
      });
      representantes.value = REP.dados;
      findEstado();
    } else {
      EstadoExtenso.value = "";
      representantes.value = [];
      modalRep.value = true;
    }
  });
}
function getUfs() {
  let R = null;
  R = $fetch(
    "/api/formUfs.php",

    {
      method: "GET",
    }
  ).then((R) => {
    UF.value = JSON.parse(R);
  });
}

const { data: dados } = useFetch("/api/formUfs.php");

let representantes = ref([]);

function ondeComprarToggle() {
  const ondeComprarID = document.getElementById("ondeComprarID");
  ondeComprarID.classList.toggle("hidden");
  ondeComprarID.classList.toggle("block");
}
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
#faixaHorzOndeComprar {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0;
  width: 3px;
  height: 220px;
  background-color: #70df3f;
}

.scrollRep {
  overflow-y: auto;
}

::-webkit-scrollbar {
  width: 6px;
  height: 10px;
  align-items: center;
}
::-webkit-scrollbar-thumb {
  background: #66ccff;
  border-radius: 20px;
}
.bg_comprar {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}

#svg-map path {
  fill: #004425;
}
#svg-map text {
  fill: #fff;
  font: 12px Arial-BoldMT, sans-serif;
  cursor: pointer;
}
#svg-map a {
  text-decoration: none;
}
#svg-map a:hover {
  cursor: pointer;
  text-decoration: none;
}
#svg-map a:hover path {
  fill: #71df43 !important;
}
.marcador {
  fill: #fff !important;
}
.marcador ~ text {
  fill: #000000 !important;
}
#svg-map .circle {
  --fill: #66ccff;
}
#svg-map a:hover .circle {
  fill: #003399 !important;
  cursor: pointer;
}

.drawLineOndeComprar {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -150px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerOndeComprar {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
</style>
