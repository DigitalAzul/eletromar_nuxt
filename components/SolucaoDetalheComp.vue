<template>
  <div envelope="solucaoDetalhe">
    <div class="drawLineContSoluDet">
      <div
        class="drawLineInnerContSoluDet"
        id="drawLineInnerContID"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      class="bg_solDet relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txSolucaoDetalID"
        class="container relative mx-auto text-center text-[3rem] font-normal uppercase tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        {{ $t("solucoes") }}
      </div>
    </div>
    <div class="relative bg-[#1b3346] pb-[18rem] pt-[200px] lg:px-0">
      <div
        id="solucaoDetalTitID"
        class="container mx-auto space-y-4 overflow-clip pt-[130px] text-center"
      >
        <div class="H1SoluDetal">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("paraoseudiaadia")
          }}</span>
        </div>
        <div class="H2SoluDetal">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("confiraassolucoes")
          }}</span>
        </div>
      </div>

      <!-- Armazena produto todo-->
      <div class="container mx-auto flex flex-col pt-32 lg:flex-row">
        <!-- PRODUTO IMAGEM -->
        <div class="min-w-1/3 px-5">
          <div class="flex flex-col pt-1 lg:space-y-3 lg:px-10">
            <div class="xprodSolHome h-[640px] w-full lg:w-[460px]">
              <div
                class="slides h-[640px] w-full border-[2px] border-[#c3d3cb] hover:bg-[#0c1a25] lg:w-[460px]"
              >
                <!--Nav radios-->

                <input type="radio" name="radioDestq-bt" id="radioDestq0" />
                <input type="radio" name="radioDestq-bt" id="radioDestq1" />
                <input type="radio" name="radioDestq-bt" id="radioDestq2" />

                <div
                  class="slide first flex h-[640px] w-full flex-row items-center justify-center lg:w-[460px]"
                >
                  <img
                    :src="
                      pathSolucoes +
                      '\\' +
                      produtoDetalhe.link +
                      '\\' +
                      produtoDetalhe.img_1
                    "
                    alt=""
                    width=""
                    height=""
                    class="object-fill"
                  />
                </div>
                <div
                  class="slide flex h-[640px] w-full flex-row items-center justify-center lg:w-[460px]"
                >
                  <img
                    :src="
                      pathSolucoes +
                      '\\' +
                      produtoDetalhe.link +
                      '\\' +
                      produtoDetalhe.img_2
                    "
                    alt=""
                    width=""
                    height=""
                    class="object-fill"
                  />
                </div>
                <div
                  class="slide flex h-[640px] w-full flex-row items-center justify-center lg:w-[460px]"
                >
                  <img
                    :src="
                      pathSolucoes +
                      '\\' +
                      produtoDetalhe.link +
                      '\\' +
                      produtoDetalhe.img_3
                    "
                    alt=""
                    width=""
                    height=""
                    class="object-fill"
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="manual-nav mt-10 flex justify-center space-x-3">
            <!-- <label
                v-for="(img, index) in produtoDetalhe.imagens"
                :key="index"
                :for="'radio' + index"
                class="manual-bt-destaque"
                :id="'manualDestaque-bt' + index"
                @click="setBanner(index)"
              ></label> -->

            <label
              for="radioDestq0"
              class="manual-bt-destaque"
              id="manualDestaque-bt0"
              @click="setBanner(0)"
            ></label>
            <label
              for="radioDestq1"
              class="manual-bt-destaque"
              id="manualDestaque-bt1"
              @click="setBanner(1)"
            ></label>
            <label
              for="radioDestq2"
              class="manual-bt-destaque"
              id="manualDestaque-bt2"
              @click="setBanner(2)"
            ></label>
          </div>
        </div>

        <!-- PRODUTO INFOS -->
        <div
          class="mt-10 w-full px-5 sm:pl-10 sm:pr-20 md:w-[768px] lg:w-[960px] lg:pl-10 lg:pr-10 xl:pl-14"
        >
          <div class="mx-auto w-full">
            <div class="bg-[#1b3346] pt-2">
              <p class="text-4xl font-bold text-white lg:text-5xl">
                {{ produtoDetalhe.tituloLang }}
              </p>
            </div>

            <div
              class="mt-9 border-t-[2px] border-[#00b1ef] pt-7 text-2xl font-semibold uppercase text-[#00b1ef] lg:text-3xl"
            >
              <h2>{{ $t("cod") }}.: {{ produtoDetalhe.codigo }}</h2>
            </div>

            <div
              class="pt-14 text-xl font-medium text-white lg:pt-14 lg:text-2xl"
            >
              <p>{{ $t("descricao") }}:</p>
            </div>

            <div
              class="break-words pt-8 text-xl font-light leading-6 text-white lg:font-normal lg:leading-8"
            >
              <p
                v-for="(d, index) in produtoDetalhe.descricaoLang"
                :key="index"
              >
                {{ d }}
              </p>
              <!-- <pre class="pre">
                {{ produtoDetalhe.descricaoLang }}
              </pre> -->
            </div>
          </div>
          <!--Botão catálogo-->
          <div
          id="baixar_catalogoID"
            class="zlg:mt-[70px] zxl:mt-[116px] zmb-[2.5rem] mt-20 flex h-[50px] w-[360px] cursor-pointer flex-row items-center justify-center space-x-14 bg-[#00b1ef] text-xl text-[#115125] sm:w-[390px]"
          >
            <div
              @click="catalogosAmostra = !catalogosAmostra"
              class="flex h-[50px] flex-row place-items-center text-lg text-white hover:text-[#0c1a25] md:text-xl"
            >
              {{ $t("baixeocatalogo") }}
            </div>

            <div
              class="mt-[1.8rem] flex h-[50px] flex-row place-items-center md:mt-8"
              id="seta"
            >
              <div></div>
              <div></div>
            </div>
          </div>

          <div
          id="baixar_dwgID"
            class="mb-[2.5rem] mt-4 flex h-[50px] w-[360px] cursor-pointer flex-row items-center justify-center space-x-14 bg-[#00b1ef] text-xl text-white sm:w-[390px] zlg:mt-[70px] zxl:mt-[116px]"
          >
            <div
              @click="catalogosAmostra = !catalogosAmostra"
              class="flex h-[50px] flex-row place-items-center text-lg text-white md:text-xl hover:text-[#0c1a25]"
            >
              {{ $t("baixeodwg") }}
            </div>

            <div
              class="mt-[1.8rem] flex h-[50px] flex-row place-items-center md:mt-8"
              id="seta"
            >
              <div></div>
              <div></div>
            </div>
          </div>
          <!-- <div
            v-if="catalogosAmostra"
            class="mb-[2.5rem] flex flex-row space-x-4"
          >
            <div
              v-for="(catalogo, index) in catalogos"
              :key="index"
              class="h-[70px] w-[70px] border border-[#70df3f]"
            >
              <div
                
                class="absolute left-0 top-0 h-[70px] w-[70px] cursor-pointer"
              ></div>
              <figure class="left-0 top-0 h-[70px] w-[70px]">
                <i
                  :id="'pdf-' + index"
                  target="_blank"
                  :href="pathCatalogos + catalogo.pdf"
                >
                  <img
                    v-bind:src="pathCatalogos + catalogo.imagem"
                    class="h-[70px] w-[70px]"
                  />
                </i>
                <figcaption
                  class="w-full pt-2 text-center text-sm capitalize text-[#70df3f]"
                >
                  {{ catalogo.titulo }}
                </figcaption>
              </figure>
            </div>
          </div> -->
          <div v-if="catalogosAmostra">
            <div class="pb-4 text-white">
              <p class="text-xl">Informe que não é um robô</p>
              <p class="text-sm">Faça login pelo Google ou Facebook</p>
            </div>
            <GoogleSignInButton
              @success="handleLoginSuccess"
              @error="handleLoginError"
            ></GoogleSignInButton>
            <FacebookSignin
              :appId="facebookAppId"
              @success="onSignInSuccessFacebook"
              @error="onSignInErrorFacebook"
              class="cursor-pointer text-white"
            >
              <div
                class="btn-primary mt-2 h-[40px] w-[218px] rounded-md bg-blue-500 px-6 py-2"
              >
                Login com Facebook
              </div>
            </FacebookSignin>
          </div>
          <div v-if="dwgAmostra">
            <div class="pb-4 text-white">
              <p class="text-xl">Informe que não é um robô</p>
              <p class="text-sm">Faça login pelo Google ou Facebook</p>
            </div>
            <GoogleSignInButton
              @success="handleLoginSuccessDwg"
              @error="handleLoginError"
            ></GoogleSignInButton>
            <FacebookSignin
              :appId="facebookAppId"
              @success="onSignInSuccessFacebookDwg"
              @error="onSignInErrorFacebook"
              class="cursor-pointer text-white"
            >
              <div
                class="btn-primary mt-2 h-[40px] w-[218px] rounded-md bg-blue-500 px-6 py-2"
              >
                Login com Facebook
              </div>
            </FacebookSignin>
          </div>
        </div>
      </div>
      <!--VIDEO PRODUTO-->
      <div class="container relative mx-auto px-5">
        <div
          class="container relative mx-auto mb-7 mt-7 flex flex-col items-center justify-center bg-black"
        >
          <div
            class="flex w-full flex-row items-center justify-center overflow-hidden lg:h-[610px] lg:w-[540px]"
          >
            <video
              :src="
                pathSolucoes +
                '\\' +
                produtoDetalhe.link +
                '\\' +
                produtoDetalhe.video_destaque
              "
              width="500"
              controls
            ></video>
          </div>
        </div>
      </div>

      <div class="relative w-full">
        <div class="drawLineCont2SoluDet">
          <div
            class="drawLineInnerCont2SoluDet"
            id="drawLineInnerContID2SoluDet"
            style="
              will-change: transform;
              transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1)
                rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
              transform-style: preserve-3d;
            "
          ></div>
        </div>
      </div>

      <div class="bg-[#1b3346] pt-[200px]">
        <div class="space-y-4 pb-[100px] pt-[130px] text-center">
          <p class="text-3xl uppercase text-[#00b1ef]">
            {{ $t("paraoseudiaadia") }}
          </p>
          <p class="text-3xl font-bold uppercase text-white sm:text-4xl">
            {{ $t("produtosrelacionados") }}
          </p>
        </div>
      </div>

      <!--Carrosel detalhe produtos produtos relacionados-->
      <div class="relative overflow-hidden">
        <div id="setaEsqSolDet" @click="clickEsq()" class="w-screen lg:block">
          <div></div>
          <div></div>
        </div>

        <div
          id="carrouselSolDetalhe"
          class="detalheEnvelope relative h-[600px] w-full snap-x snap-mandatory flex-row overflow-hidden pl-[2px]"
        >
          <div
            v-for="(item, index) in produtosCarrousel"
            :key="index"
            class="cardDetalhe relative h-[300px] w-full shrink-0 snap-start sm:w-[285px]"
          >
            <div
              :class="{
                '-ml[1px] -mr-[2px] h-[580px] items-center border-[1px] border-[#c3d3cb] text-white hover:text-[#0c1a25]':
                  item.titulo,
              }"
              class="relative flex flex-col items-center pt-8 hover:bg-[#00b1ef]"
            >
              <div class="mw-100% h-90% h-80 w-48">
                <img
                  :src="pathSolucoes + '\\' + item.link + '\\' + item.img_1"
                  alt=""
                  width="195"
                  height="320"
                />
              </div>
              <div class="space-y-5 px-10 pt-7 text-center">
                <h1 class="break-words text-2xl font-semibold uppercase">
                  {{ item.tituloLang }}
                </h1>
                <h3 class="text-lg">
                  {{ item.codigo }}
                </h3>
              </div>
              <div class="items-center pb-14 pt-6 lg:bottom-10">
                <div class="flex flex-row space-x-12 space-y-3">
                  <div
                    @click="solucaoDetalhe(item.id)"
                    class="pt-1 text-[1.425rem]"
                  >
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
        <div id="setaDirSolDet" @click="clickDir()" class="w-screen lg:block">
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</template>
    
    <script setup>
import { ref, onMounted } from "vue";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

import { FacebookSignin } from "vue3-google-facebook-signin";

const facebookAppId = ref("1656170781561123");
function onSignInSuccessFacebook(response) {
  // Dados de sucesso do login
  // console.log(response);

  // acessa os dados do usuário
  const userID = response.authResponse.userID;
  const accessToken = response.authResponse.accessToken;

  // Obter nome e foto do perfil
  window.FB.api(`/${userID}?fields=name,picture`, function (response) {
    if (response && !response.error) {
      const userName = response.name;
      const userPicture = response.picture.data.url;
      // 24/02/2024 >> luiz blogComentariosForm.value.imagem_url = userPicture;
      clickDownload();
    } else {
      alert("Opa! algum erro na autenticação. ");
    }
  });
}
function onSignInSuccessFacebookDwg(response) {
  // Dados de sucesso do login
  // console.log(response);

  // acessa os dados do usuário
  const userID = response.authResponse.userID;
  const accessToken = response.authResponse.accessToken;

  // Obter nome e foto do perfil
  window.FB.api(`/${userID}?fields=name,picture`, function (response) {
    if (response && !response.error) {
      const userName = response.name;
      const userPicture = response.picture.data.url;
      // 24/02/2024 >> luiz blogComentariosForm.value.imagem_url = userPicture;
      clickDownloadDwg();
    } else {
      alert("Opa! algum erro na autenticação. ");
    }
  });
}
function onSignInErrorFacebook(error) {
  // Manipula erro do login
  console.log("login failed");
}

import { GoogleSignInButton, decodeCredential } from "vue3-google-signin";

// handle success event
const handleLoginSuccess = (response) => {
  const { credential } = response;

  const decodedCredential = decodeCredential(credential);

  // 24/02/2024 >> luiz  blogComentariosForm.value.imagem_url = decodedCredential.picture;
  clickDownload();
};
const handleLoginSuccessDwg = (response) => {
  const { credential } = response;

  const decodedCredential = decodeCredential(credential);

  // 24/02/2024 >> luiz  blogComentariosForm.value.imagem_url = decodedCredential.picture;
  clickDownloadDwg();
};

function clickDownload() {
  catalogos.value.map((c, index) => {
    const url = `${pathCatalogos}${c.pdf}`;
    const a = document.createElement("a");
    a.href = url;
    a.download = url.split("/").pop();
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  });
}
function clickDownloadDwg() {
  const url = `${pathSolucoes}${produtoDetalhe.value.dwg}`;
  console.log(url);

  const a = document.createElement("a");
  a.href = url;
  a.download = url.split("/").pop();
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
}

gsap.registerPlugin(ScrollTrigger);

let ROTA = ref();
const pathSolucoes = "\\media\\solucoes\\";
const dir_1 = "\\1\\";
const dir_2 = "\\2\\";
const route = useRoute();
const router = useRouter();

const solucao_id = ref(route.query.solucao ? route.query.solucao : "");

onMounted(() => {
  ROTA = useRoute();

  getSolucoesDetalhes(solucao_id);
  getCatalogos();
});

let countBanner = ref(0);

let querySolucoesDet = {
  q: "solucao_detalhe",
  linha_id: 1,
  offset: 0,
  qpag: 9,
  c: "",
  id: null,
};

const pathCatalogos = "\\media\\catalogos\\";
const catalogos = ref([]);

const catalogosAmostra = ref(false);
const dwgAmostra = ref(false);

function xclickDownload(index) {
  document.getElementById("pdf-" + index).click();
}
async function getCatalogos() {
  let R = await $fetch("/api/formCatalogo.php", {
    method: "GET",
  }).then((R) => {
    if (JSON.parse(R).length > 0) {
      catalogos.value = JSON.parse(R);
    } else {
      catalogos.value = [];
    }
  });
}

function splitSolucaoDetalhe(solucao) {
  //let S = solucao.split(" ");
  let sR = [];
  // S.map((s) => {
  //   sR += `<p>${s}</p>`;
  // });
  return sR;
}
function solucaoDetalhe(solucaoCOD) {
  //const POST = JSON.stringify(post);

  window.location.assign("/solucaodetalhes?solucao=" + solucaoCOD);
}

const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});
let lang = ref("pt");
watch(i18nLocale.locale, () => {
  atualizaLocale();
  blocksToArray();
});

function atualizaLocale() {
  //  lang.value = i18nLocale.locale.value;
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}
function blocksToArray() {
  if (lang.value == "pt") {
    try {
      produtoDetalhe.value.tituloLang = produtoDetalhe.value.titulo;
      produtoDetalhe.value.descricaoLang =
        produtoDetalhe.value.descricao.split("#");

      // carroussell produtosCarroussel
      produtosCarrousel.value.map((p, index) => {
        produtosCarrousel.value[index].tituloLang = p.titulo;
      });
    } catch (error) {}
  } else if (lang.value == "en") {
    try {
      produtoDetalhe.value.tituloLang = produtoDetalhe.value.titulo_en;
      produtoDetalhe.value.descricaoLang =
        produtoDetalhe.value.descricao_en.split("#");

      // carroussell produtosCarroussel
      produtosCarrousel.value.map((p, index) => {
        produtosCarrousel.value[index].tituloLang = p.titulo_en;
      });
    } catch (error) {}
  } else {
    try {
      produtoDetalhe.value.tituloLang = produtoDetalhe.value.titulo_es;
      produtoDetalhe.value.descricaoLang =
        produtoDetalhe.value.descricao_es.split("#");

      // carroussell produtosCarroussel
      produtosCarrousel.value.map((p, index) => {
        produtosCarrousel.value[index].tituloLang = p.titulo_es;
      });
    } catch (error) {}
  }
}

function getSolucoesDetalhes(solucao_id) {
  let R = null;
  querySolucoesDet.id = solucao_id.value;
  R = $fetch(
    "/api/formSolucoes.php",

    {
      method: "GET",
      params: querySolucoesDet,
    }
  ).then((R) => {
    if (JSON.parse(R).length > 0) {
      produtoDetalhe.value = JSON.parse(R)[0];
      blocksToArray();
      getprodutosCarrousel(9, produtoDetalhe.value.linha_id);
    } else {
      window.location.assign("/solucoes");
    }
  });
}
// get por linha
function getprodutosCarrousel(pagina, linha_id) {
  let R = null;
  let querySolucoesCarroul = {
    q: "destaqueLinha_home",
    linha_id: linha_id,
    offset: 0,
    qpag: 9,
    c: "",
    id: null,
  };

  R = $fetch(
    "/api/formSolucoes.php",

    {
      method: "GET",
      params: querySolucoesCarroul,
    }
  ).then((R) => {
    if (JSON.parse(R).length > 0) {
      produtosCarrousel.value = null;
      produtosCarrousel.value = JSON.parse(R);
      blocksToArray();
    }
  });
}

const produtoDetalhe = ref({
  titulo: "",
  codigo: null,
  descricao: [{ texto: "" }, { texto: "" }, { texto: "" }, { texto: "" }],
  imagens: [{ url: "" }, { url: "" }, { url: "" }],
  // titulo: "3 interruptores simples com placa",
  // codigo: 81014,
  // descricao: [
  //   { texto: "Tensão: 250V" },
  //   { texto: "Amperagem: 10A" },
  //   { texto: "Certificação compulsória: Sim" },
  //   { texto: "Normas: NBR NM 60884-1 e NBR 60669-1" },
  // ],
  // imagens: [
  //   { url: "/img/linhaRapid.png" },
  //   { url: "/img/tomada.png" },
  //   { url: "/img/tomada.png" },
  // ],
});

let produtosCarrousel = ref([]);

function clickEsq() {
  document.getElementById("carrouselSolDetalhe").scrollLeft -= 320;
}
function clickDir() {
  document.getElementById("carrouselSolDetalhe").scrollLeft += 320;
}

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

let atualY2 = ref(-100);
let ultimaPosicao2 = ref(0);
onMounted(() => {
  ScrollTrigger.create({
    trigger: ".drawLineCont2SoluDet",
    start: "top center",
    end: "bottom top",
    onEnter: () => {
      atualY2.value = -100;
    },
    onLeave: () => {
      atualY2.value = 100;
    },
    onEnterBack: () => {
      atualY2.value = 100;
    },
    onUpdate: (self) => setTranslate2(self.progress),
  });

  function setTranslate2(pg) {
    let yInicial2 = pg;

    if (yInicial2 > ultimaPosicao2.value) {
      //pra baixo

      if (atualY2.value < 100) {
        atualY2.value += 5;

        drawLineInnerContID2SoluDet.style.transform = `translate3d(0, ${atualY2.value}%, 0)`;
      } else {
        atualY2.value = 100;
      }
    } else {
      if (atualY2.value > -100) {
        atualY2.value -= 5;
      }
      drawLineInnerContID2SoluDet.style.transform = `translate3d(0, ${atualY2.value}%, 0)`;
    }

    ultimaPosicao2.value = yInicial2;
  }
});

let atualY = ref(-100);
let ultimaPosicao = ref(0);
onMounted(() => {
  ScrollTrigger.create({
    trigger: ".drawLineContSoluDet",
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
    let ttxSolucaoDetalIDDspacer = document.getElementById("txSolucaoDetalID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContID.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) ttxSolucaoDetalIDDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) ttxSolucaoDetalIDDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContID.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

onMounted(() => {
  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#solucaoDetalTitID",
      start: "top center",
      end: "+=400px",
      toggleActions: "play none play reverse",
    },
  });
  tlContTitCont.from(".H1SoluDetal", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2SoluDetal", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });
});
</script>
    
    <style scoped>
.slides {
  display: flex;

  overflow-x: hidden;
  overflow-y: hidden;
  scroll-snap-type: x mandatory;

  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}
.slide {
  scroll-snap-align: center;
  flex-shrink: 0;
  transition: 1s;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}
.slides input {
  display: none;
}
.radioAtivo {
  width: 48px !important;
  background-color: #00b1ef !important;
}
#radioDestq0:checked ~ .first {
  margin-left: 0px;
}
#radioDestq1:checked ~ .first {
  margin-left: -100%;
}
#radioDestq2:checked ~ .first {
  margin-left: -200%;
}
.manual-nav {
  display: flex;
  justify-content: center;
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

body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
#baixar_catalogoID:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}
#baixar_catalogoID:hover #seta > div:nth-child(2) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}
#baixar_catalogoID:hover > div {
  color: #0c1a25;
}
#baixar_dwgID:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}
#baixar_dwgID:hover #seta > div:nth-child(2) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}
#baixar_dwgID:hover > div {
  color: #0c1a25;
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

.prodSolHome {
  text-align: center;
  color: #fff;
}

.prodSolHome:hover {
  --background-color: #24462b;
  cursor: pointer;
  color: #71df43;
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

.cardDetalhe:hover {
  cursor: pointer;
}
.cardDetalhe:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}
.cardDetalhe:hover #seta > div:nth-child(2) {
  box-shadow: 2px -2px 0 0px #0c1a25 inset;
}

.cardDetalhe:hover > div > div:nth-child(2) h3 {
  text-decoration: underline;
}

#setaDirSolDet {
  z-index: 1;
  position: absolute;
  right: -50px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: #00b1ef4d;
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
  background-color: #00b1ef;
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
    background-color: #00b1ef;
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
  background-color: #00b1ef4d;
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

.bg_solDet {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}

.drawLineContSoluDet {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -250px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContSoluDet {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
.drawLineCont2SoluDet {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -250px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerCont2SoluDet {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
.pre {
  line-height: 1.5em;
  /* some extra styles*/
  padding: 0px;
  text-align: left;
  font-family: inherit;
  tab-size: 0px;
  white-space: pre-line;
}
</style>
    