<template>
  <div
    envelope="HOMEconteudo"
    class="relative flex min-h-[calc(100vh+500px)] w-full snap-center flex-col overflow-hidden bg-[#1b3346] px-5 pb-44 pt-10"
  >
    <div id="drawLineContID" class="drawLineCont">
      <div
        class="drawLineInnerCont"
        id="drawLineInnerContID"
        style="
          will-change: transform;
          transform: translate3d(0px, 0%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div class="container mx-auto flex flex-col items-center py-10 pt-20">
      <div
        id="conteudoTitID"
        class="relative space-y-4 overflow-clip pt-44 text-center"
      >
        <div class="H1Conteudo">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("solucoesemdestaque")
          }}</span>
        </div>
        <!-- <div class="H2Conteudo">
          <span class="text-4xl font-bold uppercase text-white">
            {{ $t("produtosfeitoscomcarinho") }}
          </span>
        </div> -->
      </div>
      <!-- LISTA PRODUTOS -->
    </div>
    
    <div class="container mx-auto flex flex-col pt-32 lg:flex-row">
      <!-- MOBILE -->
      <!--Carrosel detalhe produtos -->
      <div
        v-if="MOBILE == true"
        class="relative block overflow-clip pt-10 lg:hidden"
      >
        <div id="setaEsqConteudo" @click="clickEsq()">
          <div></div>
          <div></div>
        </div>
        <div
          id="carousselConteudoProdID"
          class="cardsConteudoEnvelope Xoverflow-x-hidden Xoverflow-clip flex h-[750px] w-full snap-x snap-mandatory flex-row flex-nowrap justify-start px-[2px]"
        >
          <div
            v-for="(item, index) in produtosDestaque"
            :key="index"
            class="prodHome MOB primeiro min-h-[750px] w-full shrink-0 snap-start border-[2px] border-white"
            @click="solucaoLinha(item.linha_id)"
          >
            <div
              class="relative flex min-h-[750px] flex-col items-center overflow-hidden pt-16"
            >
              <div v-if="item.video == true" class="w-[385px] opacity-60">
                <div class="verdadeiro overflow-clip h-[350px]">
                  <video
                    :id="item.id"
                    :src="pathSolucoes + item.video_destaque"
                    muted
                    playsinline
                    loop
                    autoplay
                    class="w-[385px] p-1"
                  ></video>
                </div>
              </div>

              <div v-else class="h-80 w-64">
                <img
                  :src="pathSolucoes + item.img_1"
                  alt=""
                  width="266"
                  height="320"
                />
              </div>
              <div class="space-y-5 px-10 pt-10 text-center">
                <h1 class="text-3xl font-semibold">{{ item.tituloLang }}</h1>
                <h3 class="text-base sm:text-lg">
                  {{ item.descricaoLang.substring(0, 175) }}
                </h3>
              </div>
              <div class="py-10">
                <div class="flex flex-row space-x-14">
                  <div class="-mt-[10px] text-[1.5rem]">
                    {{ $t("saibamais") }}
                  </div>
                  <div>
                    <div id="seta">
                      <div></div>
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="setaDirConteudo" @click="clickDir()">
          <div></div>
          <div></div>
        </div>
      </div>

      <!-- DESKTOP -->
      <div
        v-show="MOBILE == false"
        id="produtosDestaqueID"
        class="container mx-auto flex flex-row flex-nowrap justify-center overflow-hidden px-0 xl:px-[100px]"
      >
        <div
          class="gridProdutos hidden grid-cols-[repeat(auto-fill,_minmax(350px,_1fr))] py-40 lg:grid lg:grid-cols-[repeat(3,_minmax(400px,_1fr))]"
        >
          <!-- PRODUTO -->
          <div

            v-for="(item, index) in produtosDestaque"
            :key="index"
            class="prodHome z-50 h-full w-full"
            :class="{
              '-ml-[2px] -mt-[2px] border-[2px] border-white': item.tituloLang,
            }"
            @click="solucaoLinha(item.id)"
            @mouseenter="playVideo(item.id)"
            @mouseleave="pauseVideo(item.id)"
          >
            <div

              class="relative flex min-h-[750px] flex-col items-center overflow-hidden pt-16"
            >
              <div  class="w-[385px] opacity-60">
                <div class="verdadeiro overflow-clip h-[350px] relative">

                    
                  <video
                  v-if="item.id != videoPlayCorrenteID"
                    
                    :src="pathSolucoes  + '\linhas_destaque\\' + item.link + '.mp4'"
                    
                    muted
                    stop
                    class="w-[385px] p-1 absolute top-0 left-0 "
                    type="video/mp4"
                  >
                  </video>
                  <video
                  
                  :id="item.id"
                  :src="pathSolucoes  + '\linhas_destaque\\' + item.link + '.mp4'"
                  loop
                  muted
                  playsinline
                  class="w-[385px] p-1 absolute top-0 left-0 "
                  :class="{'opacity-0':item.id != videoPlayCorrenteID}"
                  type="video/mp4"
                >
                </video>
                </div>
              </div>

              <div class="space-y-5 px-10 pt-10 text-center">
                <h1 v-if="pressCTRL == true" >{{item.id}}</h1>
                <h1 class="text-3xl font-semibold">{{ item.titulo }}</h1>
                <div class="flex flex-col -space-y-0">
                  <div class="text-base sm:text-lg tracking-tighter">
                    {{item.tituloLang}}
                  </div>
                  <!-- <span 
                v-for="(d, index) in item.descricaoLang" :key="index"
                class="text-base sm:text-lg tracking-tighter">
                  {{ d }}
                </span> -->
                </div>

              </div>
              <div class="py-10">
                <div class="flex flex-row space-x-14">
                  <div class="-mt-[10px] text-[1.5rem]">
                    {{ $t("saibamais") }}
                  </div>
                  <div>
                    <div id="seta">
                      <div></div>
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGINACAO -->
    <div class="hidden">
      <input type="radio" name="radioDestq-bt" id="radioDestq1" />
      <input type="radio" name="radioDestq-bt" id="radioDestq2" />
      <input type="radio" name="radioDestq-bt" id="radioDestq3" />
    </div>
    <div
      class="manual-nav bottom-[60px] flex flex-row items-center justify-center space-x-3 lg:bottom-[80px]"
    >
      <label
        for="radio1"
        class="manual-bt-destaque"
        id="manualDestaque-bt1"
        @click="getSolucoesDestaques(0, false), setBanner(1)"
      ></label>
      <label
        for="radio2"
        class="manual-bt-destaque"
        id="manualDestaque-bt2"
        @click="getSolucoesDestaques(9, false), setBanner(2)"
      ></label>
      <label
        for="radio3"
        class="manual-bt-destaque"
        id="manualDestaque-bt3"
        @click="getSolucoesDestaques(1, false), setBanner(3)"
      ></label>
    </div>
  </div>
</template>
  
  <script setup>
import gsap from "gsap";
import { onBeforeMount, onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

let countBanner = ref(0);
let linhaVisivel = ref(false);
let MOBILE = ref(null);
let windowWidth = ref(0);

const videoPlayCorrenteID = ref("")

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





// LANGUAGE
function blocksToArray() {
  console.log("pt",lang.value);
  if (lang.value == "pt") {
    try {
      produtosDestaque.value.map((p, index) => {
        produtosDestaque.value[index].tituloLang = p.descricao;
        //produtosDestaque.value[index].descricaoLang = p.descricao.split("#");
      });

    } catch (error) {}
  } else if (lang.value == "en") {
    try {

      produtosDestaque.value.map((p, index) => {
        produtosDestaque.value[index].tituloLang = p.descricao_en;
      //produtosDestaque.value[index].descricaoLang = p.descricao_en.split("#");
      });

    } catch (error) {}
  } else {
    try {

        produtosDestaque.value.map((p, index) => {
          produtosDestaque.value[index].tituloLang = p.descricao_es;
      //produtosDestaque.value[index].descricaoLang = p.descricao_es.split("#");
      });


    } catch (error) {}
  }
}
// LANGUAGE





function clickEsq() {
  document.getElementById("carousselConteudoProdID").scrollLeft -= 485;
}
function clickDir() {
  document.getElementById("carousselConteudoProdID").scrollLeft += 485;
}

const Stime = ref(null);



function playVideo(videoID) {
  let VID = null;

  videoPlayCorrenteID.value = videoID;
document.getElementById(videoID).play();
  VID = document.getElementById(videoID);

    //  setTimeout(() => {
    // }, 500);
    
    document.getElementById(videoID).play();

}
function pauseVideo(videoID) {
  videoPlayCorrenteID.value = null;
  clearTimeout(Stime.value);
  let VID = null;
  VID = document.getElementById(videoID);
//  if (VID) {
    document.getElementById(videoID).currentTime = 0;
    document.getElementById(videoID).pause();
//  }
}

onBeforeMount(() => {
  getWindowSize();
  window.addEventListener("resize", getWindowSize);
  getWindowSize();
  function getWindowSize() {
    if (process.client) {
      windowWidth.value = document.documentElement.clientWidth;
      //    windowHeight.value = document.documentElement.clientHeight;
      if (windowWidth.value <= 1023) {
        MOBILE.value = true;
        console.log(windowWidth.value, true);
      } else {
        MOBILE.value = false;
      }
    }
  }
});

let ROTA = ref();

onMounted(() => {
  let mm = gsap.matchMedia();

  setBanner(1);
  ROTA = useRouter();

  let ultimaPosicao = 0;
  let Y = -100;
  let ease = 0.5;

  // ANIMAÇÕES
  const tlConteudoTit = gsap.timeline({
    scrollTrigger: {
      trigger: "#conteudoTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlConteudoTit.from(".H1Conteudo", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlConteudoTit.from(".H2Conteudo", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  setTimeout(() => {
    /// ANIMAÇÃO
    mm.add("(min-width: 1024px)", () => {
      const produtosDestaqueGS = gsap.utils.toArray(".prodHome");
      produtosDestaqueGS.forEach((prodDestaq, i) => {
        let tl = gsap.timeline({
          scrollTrigger: {
            trigger: "#produtosDestaqueID",
            start: "top center",
            end: "bottom top",
            toggleActions: "play restart play reverse",
          },
        });

        tl.from(prodDestaq, {
          duration: 1.5,
          ease: "power2",
          stagger: {
            amount: (i + 1) * 0.3,
          },
          y: 100 * (i + 1) * 10,
          x: 100 * (i + 1) * 10,
          rotationZ: "-180deg",
          scale: 0.1,
          opacity: 0,
        });
      });
    });

    /// ANIMAÇÃO
  }, 3000);

  //NOVA
  var drawLineContOB = new IntersectionObserver(
    function (entries) {
      if (entries[0].isIntersecting === true) {
        linhaVisivel = true;
      } else {
        linhaVisivel = false;
      }
    },
    { threshold: [0.3] }
  );

  drawLineContOB.observe(document.querySelector(".drawLineCont"));

  //setTranslate(-100);
  function setTranslate(yPos) {
    drawLineInnerContID.style.transform = `translate3d(0, ${yPos}%, 0)`;
    if (Y < -100) Y = -100;
    if (Y > 100) Y = 100;
  }

  window.addEventListener("scroll", () => {
    let { scrollY } = window;
    let yInicial = window.scrollY;

    if (linhaVisivel == true) {
      if (yInicial > ultimaPosicao) {
        //pra baixo

        if (Y >= -100) {
          Y += 7 * ease;

          setTranslate(Y);
        }
      } else {
        // pra cima

        if (Y >= -100) {
          Y -= 7 * ease;
          setTranslate(Y);
        }
      }
    }

    ultimaPosicao = yInicial;
  });
  ///
});

onBeforeMount(() => {
  getSolucoesDestaques(0, true);
  if (1 == 2) {
    let destaqueProd = setInterval(function () {
      avancaBanner();
    }, 3000);
  }
  function avancaBanner() {
    countBanner.value++;
    if (countBanner.value > 3) {
      countBanner.value = 1;
    }

    document
      .getElementById("manualDestaque-bt1")
      .classList.remove("radioAtivo");
    document
      .getElementById("manualDestaque-bt2")
      .classList.remove("radioAtivo");
    document
      .getElementById("manualDestaque-bt3")
      .classList.remove("radioAtivo");

    document.getElementById("radioDestq" + countBanner.value).checked = true;
    document
      .getElementById("manualDestaque-bt" + countBanner.value)
      .classList.add("radioAtivo");
  }
});

const produtosDestaque = ref([]);

// NAVEGAÇÃO BT

function setBanner(radio) {
  const todosRadios = document.getElementsByClassName("radioAtivo");
  for (let i = 0; i < todosRadios.length; i++) {
    todosRadios[i].classList.remove("radioAtivo");
  }

  document.getElementById("radioDestq" + radio).checked = true;

  if (document.getElementById("radioDestq" + radio).checked) {
    document
      .getElementById("manualDestaque-bt" + radio)
      .classList.add("radioAtivo");
  }
}
function solucaoLinha(linhaID) {
  window.location.assign("/solucoes?linha=" + linhaID);
  //ROTA.push({ path: "/solucoes", query: { linha: linhaID } });
}

// BUSCA MAIS SOLUCOES DESTAQUES
/// INICIA DADOS PRA PRODUTOS DESTAQUES
const pathSolucoes = "\\media\\solucoes\\";
async function getSolucoesDestaques(pagina, inicial) {
  let R = null;
  let querySolucoes = {
    q: "destaque_home",
    offset: pagina,
    qpag: 9,
    c: "",
  };

  R = $fetch(
    "/api/formSolucoes.php",

    {
      method: "GET",
      params: querySolucoes,
    }
  ).then((R) => {
    if (JSON.parse(R).length > 0) {
      produtosDestaque.value = JSON.parse(R);
      console.log('produtosDestaque.value', JSON.parse(R));
      //evita scroll ao iniciar a pagina
      if (!inicial) {
        document.getElementById("produtosDestaqueID").scrollIntoView({
          behavior: "smooth",
          block: "start",
          inline: "nearest",
        });
      }
      blocksToArray();
    } else {
      produtosDestaque.value = [];
    }
  });
}
const pressCTRL = ref(false);
onMounted(() => {

  window.addEventListener('keydown', controlPress);
  window.addEventListener('keyup', controlPress);
  
  function controlPress(event) {
    if(event.ctrlKey){
      pressCTRL.value = !pressCTRL.value;
    }
  
  }
});
</script>
  
  <style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}

.drawLineCont {
  z-index: 1;
  position: absolute;
  left: 50%;
  top: 30px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerCont {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}

#conteudoTitID {
  opacity: 1;
}

.gridProdutos {
  --display: grid;

  /* grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); */
}
.gridProdutos > div:hover {
  background-color: #00b1ef;
  transition-delay: 0.15s;
  transition: all 0.1s;
}
#seta {
  position: relative;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 10px;
  box-shadow: 2px -2px 0 1px #fff inset;
  border: solid transparent;
  border-width: 0 0 3px 3px;
  transform: rotate(225deg);
}
#seta > div:nth-child(2) {
  position: absolute;
  top: 10px;
  left: -37px;
  width: 60px;
  height: 3px;
  background-color: #fff;
}

.prodHome {
  text-align: center;
  color: #fff;
}

.prodHome:hover {
  cursor: pointer;
  color: #1b3346;
}
.prodHome:hover > div > div:nth-child(1) {
  opacity: 1 !important;
}
.prodHome:hover > div > div:nth-child(2) > h3 {
  text-decoration: underline;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 1px #1b3346 inset;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #1b3346;
}
.prodHome:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #1b3346;
}

/* NAVEGAÇÃO BT */
.radioAtivo {
  width: 48px !important;
  background-color: #00b1ef !important;
}
.manual-nav {
  position: absolute;
  width: 100%;
}
.manual-bt-destaque {
  cursor: pointer;
  transition: 1s;
  width: 16px;
  height: 16px;
  border-radius: 16px;
  background-color: #ffffff;
}
.manual-bt-destaque:hover {
  background-color: #00b1ef;
}

#faixaHorzBanner {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: -170px;
  width: 3px;
  height: 220px;
  background-color: #72df42;
}

/* SETAS CARDS */

#setaDirConteudo {
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
#setaDirConteudo > div:nth-child(1) {
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
#setaDirConteudo > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 30px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirConteudo:hover {
  background-color: rgba(0, 255, 0, 1);
}
@media (hover: hover) and (pointer: fine) {
  /* DIREITA */
  #setaDirConteudo:hover {
    transform: translateX(-50px);
  }
  #setaDirConteudo:hover > div:nth-child(1) {
    opacity: 1;
    right: 30px;
  }
  #setaDirConteudo:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }

  /* ESQUERDA */
  #setaEsqConteudo:hover {
    background-color: rgba(0, 255, 0, 1);
    transform: translateX(50px);
  }
  #setaEsqConteudo:hover > div:nth-child(1) {
    opacity: 1;
    left: 30px;
  }

  #setaEsqConteudo:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }
}
@media (hover: none) {
  /* DIREITA */
  #setaDirConteudo:hover > div:nth-child(1) {
    right: 60px;
  }

  #setaDirConteudo:hover {
    background-color: rgba(0, 255, 0, 0.3);
  }
  #setaDirConteudo:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }

  /* ESQUERDA */

  #setaEsqConteudo:hover {
    left: -50px;
  }
  #setaEsqConteudo:hover > div:nth-child(1) {
    opacity: 1;
    left: 60px;
  }

  #setaEsqConteudo:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }
}

#setaEsqConteudo {
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
#setaEsqConteudo > div:nth-child(1) {
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
#setaEsqConteudo > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
.cardsConteudoEnvelope {
  display: flex;
  flex-wrap: nowrap;
  --flex-direction: column;
  overflow-y: hidden;
  --overflow-x: hidden;
  -webkit-overflow-scrolling: touch;
  transition: all 0.3s ease;
  scroll-behavior: smooth;
}

/* GIRO CARD */

/* entire container, keeps perspective */
.flip-container {
  perspective: 1000px;
}
/* flip the pane when hovered */
.flip-container:hover .flipper,
.flip-container.hover .flipper {
  ---transform: rotateY(180deg);
  -webkit-animation-name: spinner;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-duration: 2.8s;
  animation-name: spinner;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
  animation-duration: 2.8s;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
}

.flip-container,
.front,
.back {
  width: 320px;
  height: 480px;
}

/* flip speed goes here */
.flipper {
  transition: 0.6s;
  transform-style: preserve-3d;
  position: relative;
}

@keyframes spinner {
  from {
    -moz-transform: rotateY(-360deg);
    -ms-transform: rotateY(-360deg);
    transform: rotateY(-360deg);
  }
  to {
    -moz-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
  }
}
/* hide back of pane during swap */
.front,
.back {
  backface-visibility: hidden;

  position: absolute;
  top: 0;
  left: 0;
}

/* front pane, placed above back */
.front {
  z-index: 2;
  /* for firefox 31 */
  transform: rotateY(0deg);
}

/* back, initially hidden pane */
.back {
  transform: rotateY(180deg);
}
</style>

<style scoped>
#setaDirSolDet {
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
#setaDirSolDet > div:nth-child(1) {
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
#setaDirSolDet > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 30px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirSolDet:hover {
  background-color: rgba(0, 255, 0, 1);
}
@media (hover: hover) and (pointer: fine) {
  /* DIREITA */
  #setaDirSolDet:hover {
    transform: translateX(-50px);
  }
  #setaDirSolDet:hover > div:nth-child(1) {
    opacity: 1;
    right: 30px;
  }
  #setaDirSolDet:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }

  /* ESQUERDA */
  #setaEsqSolDet:hover {
    background-color: rgba(0, 255, 0, 1);
    transform: translateX(50px);
  }
  #setaEsqSolDet:hover > div:nth-child(1) {
    opacity: 1;
    left: 30px;
  }

  #setaEsqSolDet:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }
}
@media (hover: none) {
  /* DIREITA */
  #setaDirSolDet:hover > div:nth-child(1) {
    right: 60px;
  }

  #setaDirSolDet:hover {
    background-color: rgba(0, 255, 0, 0.3);
  }
  #setaDirSolDet:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }

  /* ESQUERDA */

  #setaEsqSolDet:hover {
    left: -50px;
  }
  #setaEsqSolDet:hover > div:nth-child(1) {
    opacity: 1;
    left: 60px;
  }

  #setaEsqSolDet:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }
}

#setaEsqSolDet {
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
#setaEsqSolDet > div:nth-child(1) {
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
#setaEsqSolDet > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
.detalheEnvelope {
  display: flex;
  flex-wrap: nowrap;
  --flex-direction: column;
  overflow-y: hidden;
  overflow-x: hidden;
  -webkit-overflow-scrolling: touch;
  transition: all 0.3s ease;
  scroll-behavior: smooth;
}
</style>