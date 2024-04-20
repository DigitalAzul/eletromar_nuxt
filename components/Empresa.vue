<template>
  <div id="TOPO" envelope="empresa">
    <div class="drawLineContEmp">
      <div
        class="drawLineInnerContEmp"
        id="drawLineInnerContIDEmp"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>
    <div
      class="bg_empresa relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        class="absolute left-0 top-0 h-[1000px] w-screen bg-gradient-to-r"
      ></div>
      <div
        id="txLinhaTempoID"
        class="container relative mx-auto text-center text-6xl font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("linhadotempo") }}
      </div>
    </div>
    <div
      id="empresaTitID"
      class="mx-auto overflow-hidden bg-[#1b3346] pb-[60px]"
    >
      <div class="container mx-auto space-y-4 pt-[130px] text-center">
        <div class="H1Emp">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("empresa")
          }}</span>
        </div>
        <div class="H2Emp">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("conhecanossahistoria")
          }}</span>
        </div>
      </div>

      <!-- LINHA DO TEMPO -->
      <div class="">
        <!-- CARROUSSEL LINHA TEMPO ANOS-->
        <div
          id="linhaTempoAnos"
          class="lnCont container mx-auto flex w-[280px] snap-x snap-mandatory flex-row overflow-auto overflow-y-hidden scroll-smooth pt-40 md:w-[600px] lg:w-[930px] lg:overflow-x-hidden xl:w-[1120px]"
        >
          <div
            v-for="(ano, index) in anosCadastrados"
            :key="index"
            class="sublnCont flex w-[160px] snap-start flex-row items-center justify-center"
            @click="selecionaAno(index, true)"
          >
            <div
              class="--xl:text-[5.1rem] w-[80%] cursor-pointer p-2 text-[3rem] font-bold"
              :class="[
                ano.ano == anoSelecionado.ano
                  ? 'animate-pulse text-[#00b1ef]'
                  : 'text-white',
              ]"
            >
              {{ ano.ano }}
            </div>
            <div
              v-if="index < ano.length - 1"
              class="w-[20%] px-5 pr-6 text-center"
            >
              <div class="h-2 w-2 rounded-full bg-[#00b1ef]"></div>
            </div>
          </div>
        </div>
        <!-- TEXTO LINHA TEMPO -->
        <div
          class="lnCont container relative mx-auto overflow-hidden overflow-x-hidden px-6 md:px-32 py-28 text-justify text-2xl text-white sm:text-3xl"
        >
          <div
            v-for="(t, index) in anoSelecionado.texto_anoLang"
            :key="index"
            class="sublnCont"
          >
            {{ t.texto }}
          </div>
        </div>

        <!-- IMAGEM -->
        <div class="relative mx-auto min-h-[300px] overflow-hidden pb-28">
          <div
            class="container relative z-10 mx-auto flex h-auto w-full flex-col items-center justify-center bg-transparent"
          >
            <figure class="imgRotacao relative h-full w-full px-5">
              <div
                id="setaEsqEmp"
                @click="clickEsq()"
                class="absolute left-[calc(50%-100px)] top-[calc(100%)] h-[100px] w-[100px] scale-75 rounded-full border-2 border-white bg-transparent hover:border-transparent hover:bg-[#00b1ef] md:h-[100px] md:w-[100px] lg:left-[40px] lg:top-[calc(50%-50px)] lg:scale-100"
              >
                <div></div>
                <div></div>
              </div>

              <img
                id="imgGalFigID"
                v-if="true"
                v-bind:src="pathEmpresa + anoSelecionado.imagem_ano"
                class="w-full object-cover object-center lg:px-12"
              />

              <div
                id="setaDirEmp"
                @click="clickDir()"
                class="Xlg:right-0 X2xl:right-[80px] absolute right-[calc(50%-100px)] top-[calc(100%)] h-[100px] w-[100px] scale-75 rounded-full border-2 border-white bg-transparent hover:border-transparent hover:bg-[#00b1ef] md:h-[100px] md:w-[100px] lg:right-[40px] lg:top-[calc(50%-50px)] lg:scale-100"
              >
                <div></div>
                <div></div>
              </div>
            </figure>
          </div>

          <div
            id="bg_Image50p"
            class="bg_galeria absolute h-[2000px] w-screen"
          ></div>
        </div>

        <!-- TEXTO INSTITUCIONAL -->
        <div
          v-if="Object.keys(aEmpresa).length > 0"
          class="container mx-auto mt-20 space-y-12 overflow-hidden break-words px-6 md:px-32 pb-28 text-justify text-2xl text-white sm:text-3xl"
        >
          <div
            v-for="(p, index) in aEmpresa.historiaLang"
            :key="index"
            class="lnCont overflow-clip"
          >
            <p class="sublnCont">
              {{ p.texto }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- MISSÃO -->
    <div
      v-if="Object.keys(aEmpresa).length > 0"
      id="institucionalID"
      class="Xmin-h-screen flex flex-col overflow-hidden bg-[#1b3346] xl:flex-row"
    >
      <div
        id="imgInst-1"
        class="bg_mvv xlg:rounded-full h-[890px] w-full xl:w-[52%]"
        :class="{ 'bg-[url(pathEmpresa + aEmpresa.img_url)': true }"
      >
        <img
          v-if="false"
          v-bind:src="pathEmpresa + aEmpresa.img_url"
          class="h-auto w-auto object-fill"
        />
      </div>

      <div
        class="relative -left-12 flex w-full flex-col justify-around space-y-14 pt-10 xl:w-[40%]"
      >
        <div class="instituTxtEnvelope flex flex-row items-center space-x-14">
          <div
            class="min-h-[100px] min-w-[100px] rounded-full bg-[#00b1ef]"
          ></div>
          <div class="w-full">
            <p class="text-2xl font-bold uppercase text-[#00b1ef]">
              {{ $t("missao") }}
            </p>
            <h1
              class="break-words pt-6 text-[1.6rem] leading-8 text-white sm:text-[1.3rem] lg:leading-6"
            >
              {{ aEmpresa.missaoLang.texto }}
              <!-- Buscar a excelência na fabricação de produtos para instalação
              elétrica de baixa tensão, satisfazendo as necessidades de nossos
              clientes com funcionalidade e inovação. O estado da arte! -->
            </h1>
          </div>
        </div>
        <div class="instituTxtEnvelope flex flex-row items-center space-x-14">
          <div
            class="min-h-[100px] min-w-[100px] rounded-full bg-[#00b1ef]"
          ></div>
          <div class="w-[600px]">
            <p class="text-2xl font-bold uppercase text-[#00b1ef]">
              {{ $t("visao") }}
            </p>
            <h1
              class="break-words pt-6 text-[1.6rem] leading-8 text-white sm:text-[1.3rem] lg:leading-6"
            >
              {{ aEmpresa.visaoLang.texto }}
              <!-- Liderar o mercado brasileiro de materiais elétricos, com uma marca
              reconhecida e consagrada pelo elevado padrão de qualidade. -->
            </h1>
          </div>
        </div>
        <div class="instituTxtEnvelope flex flex-row items-center space-x-14">
          <div
            class="min-h-[100px] min-w-[100px] rounded-full bg-[#00b1ef]"
          ></div>
          <div class="w-[600px]">
            <p class="text-2xl font-bold uppercase text-[#00b1ef]">
              {{ $t("valores") }}
            </p>
            <h1
              class="break-words pt-6 text-[1.6rem] leading-8 text-white sm:text-[1.3rem] lg:leading-6"
            >
              <p
                v-for="(code, index) in aEmpresa.valoresLang.texto.split('#')"
                :key="index"
              >
                {{ code }};
              </p>
            </h1>
          </div>
        </div>
      </div>
    </div>

    <!-- GALERIA -->
    <div envelope="galeria" class="bg-[#1b3346] pb-32 pt-40">
      <div
        id="envelopeOverlayGaleria"
        class="fixed bottom-0 left-0 right-0 top-0 z-[99999] mx-auto my-auto flex flex-col items-center justify-center overflow-hidden bg-black"
      >
        <div class="relative h-auto w-auto md:h-[90%] md:w-[90%]">
          <div
            @click="selecionaImagemGalOverlay()"
            class="absolute right-0 top-0 z-[99999] flex h-14 w-14 flex-col items-center justify-center rounded-full p-2 text-white"
          >
            <ph-x :size="32" />
          </div>
          <img
            :src="imagemGaleriaOverlay_Sel"
            class="h-full w-full object-contain"
          />
        </div>
      </div>

      <div class="container mx-auto">
        <div
          class="galeriaBG relative mx-auto h-[196px] w-full text-[#004425] md:h-[232px] md:w-[760px] xl:h-[345px] xl:w-[1140px] 2xl:h-[462px] 2xl:w-[1520px]"
          style="letter-spacing: -30pt"
        ></div>
        <div
          class="xl:-top-[80px relative -top-[44px] h-auto w-auto overflow-hidden md:-top-[53px] xl:-top-[80px] 2xl:-top-[105px]"
        >
          <div
            id="setaEsqGal"
            @click="clickEsqGal()"
            class="block w-screen md:hidden"
          >
            <div></div>
            <div></div>
          </div>

          <div
            id="galeriaEnveloperID"
            class="relative top-[0px] flex h-auto w-auto snap-x snap-mandatory flex-row overflow-x-auto md:flex-wrap md:justify-center lg:overflow-hidden xl:justify-center"
          >
            <div
              v-for="(imagem, index) in galeriaArrayImg"
              :key="index"
              class="galeriaImagem snap-start"
              @click="selecionaImagemGalOverlay(pathGaleria + imagem.img_url)"
            >
              <div class="galeriaImagemOverlay"></div>
              <figure class="h-auto w-screen md:h-[380px] md:w-[380px]">
                <img
                  v-bind:src="pathGaleria + imagem.img_url"
                  class="h-full w-full object-fit"
                />
                <figcaption></figcaption>
              </figure>
            </div>
          </div>
          <div id="setaDirGal" @click="clickDirGal()" class="block md:hidden">
            <div></div>
            <div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { PhX } from "phosphor-vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import SplitType from "split-type";
gsap.registerPlugin(ScrollTrigger);
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

components: {
  PhX;
}
// const anos = ref([
//   {
//     ano: 1989,
//     texto:
//       "1989Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst1.png",
//   },
//   {
//     ano: 1993,
//     texto:
//       "1998 Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst2.png",
//   },
//   {
//     ano: 1998,
//     texto:
//       "1993 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
//     img: "/img/inst3.png",
//   },
//   {
//     ano: 2003,
//     texto:
//       "1998 Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst4.png",
//   },
//   {
//     ano: 2013,
//     texto:
//       "1989Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst1.png",
//   },
//   {
//     ano: 2016,
//     texto:
//       "1999 Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst1.png",
//   },
//   {
//     ano: 2017,
//     texto:
//       "1998 Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
//     img: "/img/inst1.png",
//   },
// ]);

let queryGaleriaImg = ref({
  q: "",
  offset: 0,
  qpag: 0,
});

let galeriaArrayImg = ref([]);
const pathGaleria = "\\media\\galeria\\";
async function getGaleriaImagens() {
  let R = await $fetch("/api/formGaleria.php", {
    method: "GET",
    params: queryGaleriaImg.value,
  }).then((R) => {
    let X = JSON.parse(R);
    if (X.codigo == 0) {
      galeriaArrayImg.value = X.dados;
    } else {
    }
  });
}

onBeforeMount(() => {
  queryGaleriaImg.value.q = "galeria_home";
  queryGaleriaImg.value.offset = 0;
  queryGaleriaImg.value.qpag = 12;
  getGaleriaImagens();
});

let imagemGaleriaOverlay_Sel = ref({ texto: "", img: "" });
// const galeria = ref([
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal1.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal2.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal3.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal4.png",
//   },

//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal2.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal1.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal3.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal4.png",
//   },

//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal4.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal1.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal2.png",
//   },
//   {
//     texto: "çfdsçflkdsçfkdçslkfç",
//     img: "/galeria_img/gal3.png",
//   },
// ]);

let anoSelecionado = ref("");
let anoSelecionadoIDX = ref(0);

/// ANOS LIST
const pathEmpresa = "\\media\\empresa\\";
let anosCadastrados = ref([]);
let aEmpresa = ref([]);

onBeforeMount(() => {
  getEmpresaAnos();
  atualizaLocale();
});

let lang = ref();
const { t, locale } = useI18n();
watch(i18nLocale.locale, () => {
  atualizaLocale();
  blocksToArray();
});
watch(lang.value, () => {
  atualizaLocale();
  blocksToArray();
});

function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}

async function getEmpresaAnos() {
  let R = await $fetch("/api/formEmpresaAno.php", {
    method: "GET",
  }).then((R) => {
    let X = JSON.parse(R);
    if (X.codigo == 0) {
      anosCadastrados.value = X.dados.empresa_ano;
      aEmpresa.value = X.dados.empresa[0];

      anosCadastrados.value.map((ano, index) => {
        anosCadastrados.value[index].texto_ano = JSON.parse(ano.texto_ano);
        anosCadastrados.value[index].texto_ano_en = JSON.parse(
          ano.texto_ano_en
        );
        anosCadastrados.value[index].texto_ano_es = JSON.parse(
          ano.texto_ano_es
        );
      });

      resizeFigure();
      blocksToArray();
    } else {
    }
  });
}

function blocksToArray() {
  anosCadastrados.value.map((b, index) => {
    if (lang.value == "pt") {
      anosCadastrados.value[index].texto_anoLang = b.texto_ano;
    } else if (lang.value == "en") {
      anosCadastrados.value[index].texto_anoLang = b.texto_ano_en;
    } else {
      anosCadastrados.value[index].texto_anoLang = b.texto_ano_es;
    }
  });

  if (lang.value == "pt") {
    aEmpresa.value.historiaLang = JSON.parse(aEmpresa.value.historia);
    // missao
    let t = JSON.parse(aEmpresa.value.missao);
    aEmpresa.value.missaoLang = t[0];
    let v = JSON.parse(aEmpresa.value.visao);
    aEmpresa.value.visaoLang = v[0];
    let vl = JSON.parse(aEmpresa.value.valores);
    aEmpresa.value.valoresLang = vl[0];
  } else if (lang.value == "en") {
    aEmpresa.value.historiaLang = JSON.parse(aEmpresa.value.historia_en);
    // missao
    let t = JSON.parse(aEmpresa.value.missao);
    console.log("ingles", t);
    aEmpresa.value.missaoLang = t[1];
    let v = JSON.parse(aEmpresa.value.visao);
    aEmpresa.value.visaoLang = v[1];
    let vl = JSON.parse(aEmpresa.value.valores);
    aEmpresa.value.valoresLang = vl[1];
  } else {
    aEmpresa.value.historiaLang = JSON.parse(aEmpresa.value.historia_es);
    // missao
    let t = JSON.parse(aEmpresa.value.missao);
    aEmpresa.value.missaoLang = t[2];
    let v = JSON.parse(aEmpresa.value.visao);
    aEmpresa.value.visaoLang = v[2];
    let vl = JSON.parse(aEmpresa.value.valores);
    aEmpresa.value.valoresLang = vl[2];
  }

  selecionaAno(anoSelecionadoIDX.value);
}

function hideY(elem) {
  gsap.set(elem, { y: "100%" });
}
function hideOpacit(elem) {
  gsap.set(elem, { x: "100%", opacity: 0 });
}
function resizeFigure() {
  setTimeout(() => {
    let imgGalFigID = document.getElementById("imgGalFigID");
    let bg_Image50p = document.getElementById("bg_Image50p");
    topDoBackImagem.value = imgGalFigID.clientHeight / 2;
    bg_Image50p.style.top = topDoBackImagem.value + "px";
  }, 500);
}
// FAIXA IMG DIVISOR
let topDoBackImagem = ref(0);
onMounted(() => {
  window.addEventListener("resize", function () {
    resizeFigure();
  });
});

//SPACER TITULO PAG
onMounted(() => {
  let atualY = ref(-100);
  let ultimaPosicao = ref(0);
  ScrollTrigger.create({
    trigger: ".drawLineContEmp",
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
    let txLinhaTempoIDspacer = document.getElementById("txLinhaTempoID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDEmp.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txLinhaTempoIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txLinhaTempoIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDEmp.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
}); //SPACER TITULO PAG

onMounted(() => {
  setTimeout(() => {
    //SUB LINHAS
    gsap.utils.toArray(".sublnCont").forEach(function (elem) {
      hideY(elem);

      const tlTexto = gsap.timeline({
        scrollTrigger: {
          trigger: elem,
          start: "top bottom",
          end: "bottom bottom",
        },
      });

      tlTexto.to(elem, 1, {
        y: "0%",
        ease: "Power3.easeInOut",
        stagger: {
          amount: 1.5,
        },
      });
    });

    // LINHAS
    let mm = gsap.matchMedia();

    const txLinhaTempoID = new SplitType("#txLinhaTempoID", {
      charClass: "caracter",
    });
    // anim texto
    gsap.from(txLinhaTempoID.chars, {
      y: "100%",
      stagger: 0.05,
      duration: 0.5,
      ease: "power4.out",
    });

    // MOBILE

    gsap.utils.toArray(".instituTxtEnvelope").forEach(function (elem) {
      hideOpacit(elem);
      const tlTxInst = gsap.timeline({
        scrollTrigger: {
          trigger: elem,

          start: "top center",
          end: "bottom bottom",
        },
      });
      tlTxInst.to(elem, 1, {
        x: "0%",
        opacity: 1,
        ease: "Power3.easeInOut",
        stagger: {
          amount: 1.5,
        },
      });
    });

    // GALERIA
    const imagensGaleria = gsap.utils.toArray(".galeriaImagem");

    imagensGaleria.forEach((imgGal, i) => {
      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: "#galeriaEnveloperID",
          start: "top center",
          end: "center bottom",
          toggleActions: "play none play reverse",
        },
      });
      tl.from(imgGal, {
        duration: 1,
        ease: "power4",
        stagger: {
          amount: (i + 1) * 0.3,
        },
        y: 100 * (i + 1) * 10,
        opacity: 0,
      });
    });

    const tlContTitEmp = gsap.timeline({
      scrollTrigger: {
        trigger: "#empresaTitID",
        start: "top center",
        end: "bottom bottom",
        toggleActions: "play restart play reverse",
      },
    });
    tlContTitEmp.from(".H1Emp", {
      duration: 0.6,
      xPercent: 100,
      ease: "power4",
      stagger: 0.1,
    });
    tlContTitEmp.from(".H2Emp", {
      duration: 0.6,
      xPercent: -100,
      ease: "power4",
      stagger: 0.1,
    });
  }, 2000);
});

function selecionaAno(anoIndex, clicado) {
  anoSelecionado.value = anosCadastrados.value[anoIndex];

  anoSelecionado.value.texto = anoSelecionado.value.texto_anoLang;

  const lta = document.getElementById("linhaTempoAnos");

  if (anoIndex > anoSelecionadoIDX.value) {
    if (clicado) lta.scrollLeft += 160;
  } else {
    if (clicado) lta.scrollLeft -= 160;
  }
  anoSelecionadoIDX.value = anoIndex;

  //anos.value[ano].selecionado = true;
}

function clickEsq() {
  if (anoSelecionadoIDX.value == 0) return;

  anoSelecionadoIDX.value = anoSelecionadoIDX.value - 1;

  selecionaAno(anoSelecionadoIDX.value, true);

  const lta = document.getElementById("linhaTempoAnos");
  lta.scrollLeft -= 160;
}
function clickDir() {
  const qtdAnos = anosCadastrados.value.length;

  if (anoSelecionadoIDX.value == qtdAnos - 1) return;

  anoSelecionadoIDX.value = anoSelecionadoIDX.value + 1;

  selecionaAno(anoSelecionadoIDX.value, true);

  const lta = document.getElementById("linhaTempoAnos");
  lta.scrollLeft += 160;
}

function clickEsqGal() {
  document.getElementById("galeriaEnveloperID").scrollLeft -= 480;
}
function clickDirGal() {
  document.getElementById("galeriaEnveloperID").scrollLeft += 480;
}

function selecionaImagemGalOverlay(url) {
  const imgOverlay = document.getElementById("envelopeOverlayGaleria");

  if (url) {
    imagemGaleriaOverlay_Sel.value = url;
    imgOverlay.classList.add("over");
    document.body.style.overflowY = "hidden";
  } else {
    imgOverlay.classList.remove("over");
    //imagemGaleriaOverlay_Sel.value = {};

    document.body.style.overflowY = "auto";
  }
}
</script>


<style scoped>
::-webkit-scrollbar {
  width: 6px;
  height: 8px;
}
::-webkit-scrollbar-thumb {
  background: #70df3f;
  border-radius: 20px;
}
::-webkit-scrollbar-track {
  background: none;
}

#empresaTitID {
  --opacity: 0;
  --transform: rotate(0deg) translateY(0%);
}

.over {
  width: 100vw !important;
  height: 100vh !important;
  margin: auto !important;
  visibility: visible !important;
  opacity: 1 !important;
}
#envelopeOverlayGaleria {
  visibility: hidden;
  width: 0;
  height: 0;
  opacity: 0;
  --margin: 0px;
  transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -webkit-transition: all 0.25s;
}

body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
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

#setaEsqEmp {
  z-index: 1;
  /* position: absolute;
  left: 80px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: transparent;
  border: 2px solid #fff;
  border-radius: 100%; */
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaEsqEmp > div:nth-child(1) {
  z-index: 2;
  position: absolute;
  top: 38px;
  left: 60px;
  padding: 10px;
  opacity: 1;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(45deg);
  transition: all 0.5s ease;
}
#setaEsqEmp > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaEsqEmp:hover {
  /* top: calc(50% - 50px);*/
  background-color: rgba(0, 255, 0, 1);
  --border: solid transparent;
  --transform: translateX(50px);
}
@media (hover: hover) and (pointer: fine) {
  #setaEsqEmp:hover {
    background-color: #1b3346;
  }
  #setaDirEmp:hover {
    background-color: #1b3346;
  }
}
@media (hover: none) {
  #setaEsqEmp:hover {
    background-color: transparent;
    border: 2px solid #fff;
  }
  #setaDirEmp:hover {
    background-color: transparent;
    border: 2px solid #fff;
  }
}
#setaEsqEmp:hover > div:nth-child(1) {
  opacity: 1;
  left: 30px;
}

#setaEsqEmp:hover > div:nth-child(2) {
  opacity: 1;
  left: 30px;
}

#setaDirEmp {
  z-index: 1;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaDirEmp > div:nth-child(1) {
  z-index: 2;
  position: absolute;
  top: 38px;
  right: 60px;
  padding: 10px;
  opacity: 1;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
  transition: all 0.5s ease;
}
#setaDirEmp > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 0px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirEmp:hover {
  /* top: calc(50% - 50px);
  background-color: rgba(0, 255, 0, 1);
  border: solid transparent; */
  --transform: translateX(-50px);
}
#setaDirEmp:hover > div:nth-child(1) {
  opacity: 1;

  right: 30px;
}

#setaDirEmp:hover > div:nth-child(2) {
  opacity: 1;
  left: 25px;
}

.galeriaImagem {
  position: relative;
  background-color: #1b3346;
}
.galeriaImagem:hover figure {
  cursor: pointer;
  filter: grayscale(1) opacity(0.1);
}
.galeriaImagem:hover .galeriaImagemOverlay {
  opacity: 1;
}

.galeriaImagemOverlay {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-image: url("/img/overlayGalImagem.png");
}

.galeriaBG {
  background-image: url("/img/galeria.svg");
  background-repeat: no-repeat;
  background-size: cover;
}

@media (hover: none) {
  .galeriaImagem:hover figure {
    cursor: pointer;
    filter: grayscale(0) opacity(1);
  }
  .galeriaImagemOverlay {
    opacity: 0;
    display: none;
  }

  /* DIREITA */
  #setaDirGal:hover > div:nth-child(1) {
    right: 60px;
  }

  #setaDirGal:hover {
    background-color: rgba(0, 255, 0, 0.3);
  }
  #setaDirGal:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }

  /* ESQUERDA */

  #setaEsqGal:hover {
    left: -50px;
  }
  #setaEsqGal:hover > div:nth-child(1) {
    opacity: 1;
    left: 60px;
  }

  #setaEsqGal:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }
}
@media (hover: hover) and (pointer: fine) {
  /* DIREITA */
  #setaDirGal:hover {
    transform: translateX(-50px);
  }
  #setaDirGal:hover > div:nth-child(1) {
    opacity: 1;
    right: 30px;
  }
  #setaDirGal:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }

  /* ESQUERDA */
  #setaEsqGal:hover {
    background-color: rgba(0, 255, 0, 1);
    transform: translateX(50px);
  }
  #setaEsqGal:hover > div:nth-child(1) {
    opacity: 1;
    left: 30px;
  }

  #setaEsqGal:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }
}

#setaDirGal {
  z-index: 1;
  position: absolute;
  right: -50px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: rgba(0, 255, 0, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaDirGal > div:nth-child(1) {
  z-index: 2;
  position: absolute;
  top: 38px;
  right: 60px;
  padding: 10px;
  opacity: 1;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
  transition: all 0.5s ease;
}
#setaDirGal > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 30px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirGal:hover {
  background-color: rgba(0, 255, 0, 1);
}

#setaEsqGal {
  z-index: 1;
  position: absolute;
  left: -50px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: rgba(0, 255, 0, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaEsqGal > div:nth-child(1) {
  z-index: 2;
  position: absolute;
  top: 38px;
  left: 60px;
  padding: 10px;
  opacity: 1;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(45deg);
  transition: all 0.5s ease;
}
#setaEsqGal > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
.bg_empresa {
  background: url("/img/bg_banner_1.jpg");
  background-size: cover;
}
.bg_mvv {
  background: url("/img/fd_emp_missao.jpg");
  background-size: cover;
}
.bg_galeria {
  background: #0c1a25;
  background: linear-gradient(180deg, #0c1a25 0%, #1b3346 10%);
}

.flip-vertical-right {
  -webkit-animation: flip-vertical-right 1s infinite
    cubic-bezier(0.455, 0.03, 0.515, 0.955) both;
  animation: flip-vertical-right 1s 3 cubic-bezier(0.455, 0.03, 0.515, 0.955)
    both;
}

@-webkit-keyframes flip-vertical-right {
  0% {
    -webkit-transform: rotateY(0);
    transform: rotateY(0);
  }
  100% {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
  }
}
@keyframes flip-vertical-right {
  0% {
    -webkit-transform: rotateY(0);
    transform: rotateY(0);
  }
  100% {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
  }
}
.drawLineContEmp {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContEmp {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
</style>