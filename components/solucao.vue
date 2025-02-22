<template>
  <div envelope="solucoesHome">
    <div class="drawLineContSolu">
      <div
        class="drawLineInnerContSolu"
        id="drawLineInnerContIDSolu"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>
    <div
      class="bg_solucoes relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txSolucaoID"
        class="container relative mx-auto text-center text-[3rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("solucoes") }}
      </div>
    </div>
    <div class="bg-[#1b3346] py-[60px]">
      <div
        id="slucoesHomeTitID"
        class="space-y-4 overflow-hidden pt-[130px] text-center"
      >
        <div class="H1Solu">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("paraoseudiaadia")
          }}</span>
        </div>
        <div class="H2Solu">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("confiraassolucoes")
          }}</span>
        </div>
      </div>

      <!-- ALTeracao 2025 -->
      <div
      v-if="videosAtivos"
       class="container relative mx-auto flex flex-col pt-32 lg:flex-row">
        <!-- v-show="MOBILE == false" -->
        <div
          id="produtosDestaqueID"
          class="container mx-auto flex flex-row flex-nowrap justify-center overflow-hidden px-0 xl:px-[100px]"
        >
          <div
            class="gridProdutosAnimacoes z_hidden z_grid-cols-[repeat(auto-fill,_minmax(350px,_1fr))] flex flex-col px-6 py-40 lg:grid lg:grid-cols-[repeat(3,_minmax(400px,_1fr))]"
          >
            <!-- PRODUTO -->
            <div
              v-for="(item, index) in produtosDestaqueAnimacoes"
              :key="index"
              class="prodHome z-50 -ml-[2px] -mt-[2px] h-full w-full border-[2px] border-white"
              @click="solucaoLinha(item.id)"
              @mouseenter="playVideo(item.id)"
              @mouseleave="pauseVideo(item.id)"
            >
              <div
                class="relative flex min-h-[750px] flex-col items-center overflow-hidden pt-16"
              >
                <div class="w-[385px] opacity-60">
                  <div class="verdadeiro relative h-[350px] overflow-clip">
                    <video
                      v-if="item.id != videoPlayCorrenteID"
                      :src="
                        pathSolucoes + '\linhas_destaque\\' + item.link + '.mp4'
                      "
                      muted
                      stop
                      class="absolute left-0 top-0 w-[385px] p-1"
                      type="video/mp4"
                    ></video>
                    <video
                      :id="item.id"
                      :src="
                        pathSolucoes + '\linhas_destaque\\' + item.link + '.mp4'
                      "
                      loop
                      muted
                      playsinline
                      class="absolute left-0 top-0 w-[385px] p-1"
                      :class="{ 'opacity-0': item.id != videoPlayCorrenteID }"
                      type="video/mp4"
                    ></video>
                  </div>
                </div>

                <div class="space-y-5 px-10 pt-10 text-center">
                  <h1 class="text-3xl font-semibold">{{ item.titulo }}</h1>
                  <div class="flex flex-col -space-y-0">
                    <div class="text-base tracking-tighter sm:text-lg">
                      {{ item.tituloLang }} item.tituloLang
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
            @click="getSolucoesDestaques(19, false), setBanner(3)"
          ></label>
        </div>
        <!-- PAGINACAO -->
      </div>
      <!-- ALTeracao 2025 -->

      <!-- GRID DE PRODUTOS texto e produtos -->
      <div
      v-if="!videosAtivos"
        class="container mx-auto flex flex-col justify-center pb-10 pt-32 lg:flex-row lg:pb-32"
      >
        <div class="h-[200px] w-full lg:h-[1000px] xl:w-[340px] 2xl:w-1/3">
          <div
            @click="selectedLinhas()"
            class="flex flex-row justify-center py-4 pt-3 text-center text-xl font-bold uppercase text-white"
          >
            <div>{{ $t("nossaslinhas") }}</div>
            <div
              v-if="MOBILE"
              :class="{ 'animate-bounce': !menuDestaqueToggle }"
            >
              <ph-arrow-down :size="22" class="relative left-5 top-1" />
            </div>
          </div>
          <!--Seletor de linhas Desk-->
          <div v-if="!MOBILE" class="scrollRep h-[1000px]">
            <div
              class="border-b-[1px] border-t-[1px] border-transparent py-3 pl-6 text-lg font-bold uppercase text-white hover:border-b-[1px] hover:border-t-[1px] hover:border-[#00b1ef] hover:text-[#00b1ef]"
              v-for="(linha, index) in menuLinhas"
              :key="index"
            >
              <div
                @click="getSolucoesDestaquesLinhas(0, linha.id, false)"
                class="cursor-pointer"
              >
                {{ linha.titulo }}
              </div>
            </div>
          </div>
          <!--Seletor de linhas Mob-->
          <div
            v-if="MOBILE && menuDestaqueToggle"
            class="xhidden flex-col space-y-3 px-6 pr-4 pt-10 lg:flex"
            :class="{
              'h-[300px] overflow-y-auto bg-[#1b3346] text-center': MOBILE,
            }"
          >
            <div
              class="border-b-[1px] border-t-[1px] border-transparent py-3 text-lg font-bold uppercase text-white hover:border-b-[1px] hover:border-t-[1px] hover:border-[#00b1ef] hover:text-[#00b1ef]"
              v-for="(linha, index) in menuLinhas"
              :key="index"
            >
              <div
                @click="getSolucoesDestaquesLinhas(0, linha.id, false)"
                class="cursor-pointer"
              >
                {{ linha.titulo }}
              </div>
            </div>
          </div>
          <x-modal v-model="modalLinhas"> Carregando...! </x-modal>
          
        </div>

        <div
          id="solucoesHomeID"
          v-if="!menuDestaqueToggle"
          class="flex h-auto w-full flex-col flex-nowrap items-center justify-center overflow-hidden pt-10 lg:w-[950px]"
        >
          <div class="gridProdutos z-10 w-full px-5">
            <!-- PRODUTO -->
            <div
              @click="solucaoDetalhe(item.id)"
              v-for="(item, index) in produtosDestaque"
              :key="index"
              class="prodSolu z-50 mb-0 h-full w-full lg:mb-12"
            >
              <div
                :class="{
                  ' -mt-[2px] h-[620px] items-center border-[1px] border-[#c3d3cb] text-white hover:text-[#00b1ef]':
                    item.titulo,
                }"
                class="relative flex flex-col items-center justify-center pt-12 hover:bg-[#0c1a25]"
              >
                <div
                  class="relative flex h-[640px] w-full flex-row items-center justify-center lg:w-[300px]"
                >
                  <img
                    :src="
                      pathSolucoes +
                      '\\' +
                      pathLinhaCorrente.path +
                      '\\' +
                      item.img_1
                    "
                    alt=""
                    width="195"
                    height="320"
                    class="object-fill"
                  />
                  <img
                    v-if="item.img_2"
                    :src="
                      pathSolucoes +
                      '\\' +
                      pathLinhaCorrente.path +
                      '\\' +
                      item.img_2
                    "
                    alt=""
                    width="195"
                    height="320"
                    class="invisible object-fill"
                  />
                  <img
                    v-else
                    :src="
                      pathSolucoes +
                      '\\' +
                      pathLinhaCorrente.path +
                      '\\' +
                      item.img_1
                    "
                    alt=""
                    width="195"
                    height="320"
                    class="object-fill"
                  />
                </div>
                <div class="space-y-5 px-10 pt-7 text-center">
                  <h1 class="text-3xl font-semibold uppercase">
                    {{ item.titulo }}
                  </h1>
                  <h3 class="text-lg">{{ $t("codigo") }} {{ item.codigo }}</h3>
                </div>
                <div class="items-center pb-14 pt-6 lg:bottom-10">
                  <div class="flex flex-row space-x-12 space-y-3">
                    <div @click="teste()" class="pt-1 text-[1.425rem]">
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

          <div
            v-if="produtosDestaque.length > 0"
            class="text-g mb-[8.5rem] mt-28 flex h-[3rem] w-[260px] cursor-pointer flex-col items-center justify-center bg-[#00b1ef] text-[1.2rem] text-[#1b3346] sm:w-[450px]"
            @click="
              (offSetPagina += 9),
                getSolucoesDestaquesLinhas(offSetPagina, null, true)
            "
          >
            {{ $t("carregarmaisprodutos") }}
          </div>
        </div>
        <!-- MODAL -->
        <label class="btn" for="modal-1"></label>
        <input class="modal-state" id="modal-1" type="checkbox" />
        <div class="modal">
          <label class="modal__bg" for="modal-1"></label>
          <div class="modal__inner">
            <label class="modal__close" for="modal-1"></label>

            <p class="pt-10 text-center text-2xl text-[#00b1ef]">
              {{ $t("semmaisparaexibir") }}
            </p>
          </div>
        </div>
        <!-- MODAL -->
        <x-modal v-model="show1">
          {{ $t("semmaisparaexibir") }}
        </x-modal>
      </div>


    </div>
  </div>
</template>

<script setup>
import { XModal } from "@indielayer/ui";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { PhArrowDown } from "phosphor-vue";
import { onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";
gsap.registerPlugin(ScrollTrigger);
const i18nLocale = useI18n();

components: {
  XModal;
}
const route = useRoute();
const router = useRouter();


const rota_linha_id = ref(route.query.linha ? route.query.linha : "1");

let lang = ref("pt");
const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});

watch(i18nLocale.locale, () => {
  atualizaLocale();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}

const show1 = ref(false);
const modalLinhas = ref(false);

const pathSolucoes = "\\media\\solucoes\\";

const menuDestaqueToggle = ref(false);
const MOBILE = ref(false);

let windowWidth = ref(0);
onBeforeMount(() => {
  getWindowSize();
  window.addEventListener("resize", getWindowSize);
  getWindowSize();
  function getWindowSize() {
    if (process.client) {
      windowWidth.value = document.documentElement.clientWidth;
      if (windowWidth.value <= 1023) {
        MOBILE.value = true;
        menuDestaqueToggle.value = false;
      } else {
        MOBILE.value = false;
        //menuDestaqueToggle.value = true;
      }
    }
  }
});
function selectedLinhas() {
  if (MOBILE) {
    menuDestaqueToggle.value = !menuDestaqueToggle.value;
  }
}
onBeforeMount(() => {
  getSolucoesLinhas();
});
function getSolucoesLinhas() {
  let R = null;

  let q = {
    ativo: "s", // s | n | t
  };

  R = $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
    params: q,
  }).then((R) => {
    menuLinhas.value = JSON.parse(R);
    console.log("menuLinhas.value", menuLinhas.value[0].link);
    setPathLinhaCorrente(rota_linha_id.value);
    setPathLinhaCorrente(
      rota_linha_id.value ? rota_linha_id.value : menuLinhas.value[0].link
    );
  });
}

let menuLinhas = ref([
  { titulo: "LINHA RAPID", link: "/RAPID" },
  { titulo: "LINHA PRISMA", link: "/PRISMA" },
  { titulo: "LINHA PETRA", link: "/PETRA" },
]);

//menuLinhas.value = JSON.parse(dados.value);

let ROTA = ref();
onMounted(() => {
  ROTA = useRouter();
});
onMounted(() => {
  setTimeout(() => {
    const produtosSolu = gsap.utils.toArray(".prodSolu");
    produtosSolu.forEach((prodS, i) => {
      let tlProdSolu = gsap.timeline({
        scrollTrigger: {
          trigger: "#solucoesHomeID",
          start: "top center",
          end: "bottom top",
          toggleActions: "play restart play reverse",
        },
      });

      tlProdSolu.from(prodS, {
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
  }, 3000);
});

onMounted(() => {
  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#slucoesHomeTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1Solu", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2Solu", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });
});
//SPACER TITULO PAG
onMounted(() => {
  let atualY = ref(-100);
  let ultimaPosicao = ref(0);
  ScrollTrigger.create({
    trigger: ".drawLineContSolu",
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
    let txSolucaoIDspacer = document.getElementById("txSolucaoID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDSolu.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txSolucaoIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txSolucaoIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDSolu.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
}); //SPACER TITULO PAG

let querySolucoesLinhas = {
  q: "destaqueLinha_home",
  linha_id: 1,
  offset: 0,
  qpag: 9,
  c: "",
};
const produtosDestaque = ref([]);

let offSetPagina = 0;
onBeforeMount(() => {
  if (rota_linha_id.value > 0) {
    querySolucoesLinhas.linha_id = rota_linha_id.value;
    getSolucoesDestaquesLinhas(offSetPagina, null);
    querySolucoesLinhas.q = "destaqueLinha_home";
  } else {
    querySolucoesLinhas.q = "";
    querySolucoesLinhas.offset = 0;
    querySolucoesLinhas.qpag = 9;

    getSolucoesDestaquesLinhas(offSetPagina, 0);
  }
});

function getSolucoesDestaquesLinhasDoSelect(a, ev) {
  console.log(ev.target.value);
}

const pathLinhaCorrente = ref({
  titulo: "",
  path: "",
});
function setPathLinhaCorrente(linha_id) {
  menuLinhas.value.map((L) => {
    if (L.id == linha_id) {
      pathLinhaCorrente.value.path = L.link;
      pathLinhaCorrente.value.titulo = L.titulo;
    }
  });
}
function getSolucoesDestaquesLinhas(pagina, linha_id, push) {
  let R = null;
  setPathLinhaCorrente(linha_id);

  if (linha_id > 0) {
    querySolucoesLinhas.linha_id = linha_id;
  }
  if (pagina == 0) {
    querySolucoesLinhas.qpag = 9;
    querySolucoesLinhas.offset = 0;
    offSetPagina = 0;
  }
  querySolucoesLinhas.offset = pagina;
  querySolucoesLinhas.q = "destaqueLinha_home";

  R = $fetch(
    "/api/formSolucoes.php",

    {
      method: "GET",
      params: querySolucoesLinhas,
    }
  ).then((R) => {
    if (JSON.parse(R).length > 0) {
      // produtosDestaque.value = [];

      let S = JSON.parse(R);

      // analisa se o click veio do menu lateral >> push = false
      if (push == true) {
        produtosDestaque.value = produtosDestaque.value.concat(S);
        // S.map((s) => {
        //   produtosDestaque.value.push(s);
        // });
      } else {
        produtosDestaque.value = S;
      }

      menuDestaqueToggle.value = false;
    } else {
      let M = document.getElementById("modal-1");
      M.click();
      //show1.value = true;
    }
  });
}
//produtosDestaque.value = JSON.parse(dadosP.value);

function solucaoDetalhe(solucaoCOD) {
  //const POST = JSON.stringify(post);

  window.location.assign("/solucaodetalhes?solucao=" + solucaoCOD);
}
//   ROTA.push({ path: "/solucaodetalhes", query: { solucao: solucaoID } });
// }

// alter 2025 videos destaques
function solucaoLinha(linhaID) {
  window.location.assign("/solucoes?linha=" + linhaID);
}
const videosAtivos = ref(route.query.linha ? false : true); // se há query linha então da hidde em animações
const produtosDestaqueAnimacoes = ref([]);
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
      produtosDestaqueAnimacoes.value = JSON.parse(R);

      console.log("produtosDestaqueAnimacoes.value", JSON.parse(R));
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
      produtosDestaqueAnimacoes.value = [];
    }
  });
}
onBeforeMount(() => {
  // ALTERAÇÃO JEAN
  getSolucoesDestaques(0, true);
  if (rota_linha_id.value > 0) {
    querySolucoesLinhas.linha_id = rota_linha_id.value;
    getSolucoesDestaquesLinhas(offSetPagina, null);
    querySolucoesLinhas.q = "destaqueLinha_home";
  } else {
    querySolucoesLinhas.q = "";
    querySolucoesLinhas.offset = 0;
    querySolucoesLinhas.qpag = 9;

    getSolucoesDestaquesLinhas(offSetPagina, 0);
  }
});
// alteração grid produtos

const videoPlayCorrenteID = ref("");
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
// alter 2025 videos destaques
</script>

<style scoped>
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
  background-color: #00b1ef;
}

.gridProdutos {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}

.gridProdutos > div:hover {
  cursor: pointer;
}

#seta {
  position: relative;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 9px;
  top: 1px;
  left: -11px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0px 0 1px 1px;
  transform: rotate(225deg);
}
#seta > div:nth-child(2) {
  position: absolute;
  top: 9px;
  left: -37px;
  width: 45px;
  height: 2px;
  background-color: #fff;
}
.prodSolu {
  text-align: center;
  color: #fff;
}

.prodSolu:hover {
  --background-color: #0c1a25;
  cursor: pointer;
  color: #00b1ef;
}
.prodSolu:hover > div > div:nth-child(2) > h3 {
  text-decoration: underline;
}
.prodSolu > div > div:nth-child(1) img {
  position: absolute;
  top: 0;
  left: 0;
  margin: 150px 50%;
  transform: translate(-50%, -50%);
}
.prodSolu:hover > div > div:nth-child(1) img:nth-child(2) {
  visibility: visible;
}
.prodSolu:hover > div > div:nth-child(1) img:nth-child(1) {
  visibility: hidden;
}
.prodSolu:hover > div > div > div > div > #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 1px #00b1ef inset;
}
.prodSolu:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #00b1ef;
}
.prodSolu:hover > div > div > div > div > #seta > div:nth-child(2) {
  background-color: #00b1ef;
}

.bg_solucoes {
  background: url("/img/bg_banner_1.jpg");
  background-size: cover;
}

.drawLineContSolu {
  z-index: 9;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContSolu {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}

.modal {
  opacity: 0;
  z-index: 99999;
  visibility: hidden;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  text-align: left;
  background-color: #00b1ef;
  transition: opacity 0.5s ease;
  width: 100vw;
  height: 100vh;
}

.modal__bg {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  cursor: pointer;
}

.modal-state {
  display: none;
}

.modal-state:checked + .modal {
  opacity: 1;
  visibility: visible;
  top: 0px;
}

.modal-state:checked + .modal .modal__inner {
  top: 0;
}

.modal__inner {
  transition: top 0.25s ease;
  position: absolute;
  top: -20%;
  right: 0;
  bottom: 0;
  left: 0;
  width: 30%;
  margin: auto;
  overflow: auto;
  background: #fff;
  border-radius: 5px;
  height: 10%;
}

.modal__close {
  position: absolute;
  right: 1em;
  top: 1em;
  width: 1.1em;
  height: 1.1em;
  cursor: pointer;
}

.modal__close:after,
.modal__close:before {
  content: "";
  position: absolute;
  width: 2px;
  height: 1.5em;
  background: #ccc;
  display: block;
  transform: rotate(45deg);
  left: 50%;
  margin: -3px 0 0 -1px;
  top: 0;
}

.modal__close:hover:after,
.modal__close:hover:before {
  background: #aaa;
}

.modal__close:before {
  transform: rotate(-45deg);
}

@media screen and (max-width: 768px) {
  .modal__inner {
    width: 90%;
    height: 10%;
    box-sizing: border-box;
  }
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


.gridProdutosAnimacoes {
  --display: grid;

  /* grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); */
}
.gridProdutosAnimacoes > div:hover {
  background-color: #00b1ef;
  transition-delay: 0.15s;
  transition: all 0.1s;
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
</style>
