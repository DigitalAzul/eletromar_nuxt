<template>
  <div envelope="BlogDetalhe">
    <div class="drawLineContBlogDet">
      <div
        class="drawLineInnerContBlogDet"
        id="drawLineInnerContIDBlogDet"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      class="bg_blogDetalhe relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txBlogDetalID"
        class="container relative mx-auto text-center text-6xl font-normal tracking-[.3em] text-white md:top-20 md:text-6xl"
      >
        BLOG
      </div>
    </div>
    <div class="bg-[#1b3346] pb-[60px] pt-14">
      <div
        id="blogDetalTitID"
        class="space-y-4 overflow-hidden pt-[130px] text-center"
      >
        <div class="H1BlogDetal">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("noticias")
          }}</span>
        </div>
        <div class="H2BlogDetal">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("fiquepordentrotudo")
          }}</span>
        </div>
      </div>

      <!-- IMAGEM -->
      <div
        class="container relative mx-auto min-h-[300px] overflow-hidden px-4 pb-10"
      >
        <div
          class="container mx-auto flex h-auto flex-col items-center justify-center bg-transparent pt-24"
        >
          <div class="relative">
            <div
              id="setaEsqBlogDet"
              @click="clickEsq()"
              class="absolute left-[calc(50%-100px)] top-[calc(100%-50px)] z-30 h-[100px] w-[100px] scale-75 rounded-full border-2 border-white bg-transparent hover:cursor-pointer hover:border-transparent hover:bg-[#00b1ef] md:h-[100px] md:w-[100px] lg:-left-[0px] lg:top-[calc(50%-50px)] lg:scale-100 xl:left-[25px]"
            >
              <div></div>
              <div></div>
            </div>

            <div
              
              id="scrollSlidesID"
              class="slides relative flex snap-x snap-mandatory flex-row"
            >
              <div
                v-for="(imagem, index) in getImgSlides"
                :key="index"
                class="slide shrink-0 snap-start lg:px-6"
              >
                <img
                  :src="pathBlogImagens + imagem.imagem_url"
                  class="object-cover"
                />
              </div>
            </div>

            <div
              id="setaDirblogDet"
              @click="clickDir()"
              class="absolute right-[calc(50%-100px)] top-[calc(100%-50px)] z-30 h-[100px] w-[100px] scale-75 rounded-full border-2 border-white bg-transparent hover:border-transparent hover:bg-[#00b1ef] md:h-[100px] md:w-[100px] lg:-right-[0px] lg:top-[calc(50%-50px)] lg:scale-100 xl:right-[25px]"
            >
              <div></div>
              <div></div>
            </div>
          </div>
        </div>
      </div>

      <div
        v-if="Object.keys(blogPost).length > 0"
        class="container mx-auto px-6 pb-32 pt-32 text-white md:px-32"
      >
        <div
          class="flex h-24 w-full flex-col justify-between border-b-[1px] border-[#00b1ef] pb-28 lg:flex-row"
        >
          <div class="text-xl font-semibold text-white sm:text-4xl">
            <h1>{{ blogPost[0].tituloLang }}</h1>
          </div>
          <div class="text-sm uppercase sm:text-xl">
            <h3>{{ blogPost[0].data_br }}</h3>
          </div>
        </div>

        <div
          
          class="container mx-auto flex flex-col items-start space-y-6 pt-10 text-justify ztext-xl font-light zsm:text-3xl"
        >
          <!-- <span
            v-for="(p, index) in blogPost[0].descricaoLang"
            :key="index"
            :class="{ hidden: index > 1 }"
          >
            <p v-if="index < 2">{{ p.texto }}</p>
          </span> -->

          <div class="ql-editor" v-html="blogPost[0].descricaoLang[0].texto"></div>
          <!-- <div v-html="blogPost[0].paragrafo1"></div> -->
        </div>
        <!--Grid de imagem-->
        <div
          class="lg:space-x-4 flex flex-col justify-between space-y-6 pb-[5.5rem] pt-[5.5rem] lg:flex-row"
        >
          <!-- OVERLAY  -->
          <div
            id="envelopeOverlayBlogDet"
            class="fixed bottom-0 left-0 right-0 top-0 z-[99999] mx-auto my-auto flex flex-col items-center justify-center overflow-hidden bg-black"
          >
            <div class="relative h-auto w-auto">
              <div
                @click="selecionaImagemGalOverlay()"
                class="absolute right-0 top-0 z-[99999] flex h-14 w-14 flex-col items-center justify-center rounded-full p-2 text-white"
              >
                <ph-x :size="32" />
              </div>
              <img
                :src="imagemBlogDetOverlay_Sel"
                class="h-auto w-auto object-fill"
              />
            </div>
          </div>
          <!-- ERRO QUEBRANDO PÁGINA IMAGENS DO TEXTO ABAIXO NECESSITANDO TER DUAS -->
          <div
            v-if=" getImgBlog[0] "
            class="blogImgOverlay w-full lg:h-auto lg:w-[595px]"
            @click="
              selecionaImagemGalOverlay(
                pathBlogImagens + getImgBlog[0].imagem_url
              )
            "
          >
            <img
              :src="pathBlogImagens + getImgBlog[0].imagem_url"
              class="h-full w-full object-cover"
            />
          </div>
          <div
            v-if=" getImgBlog[1] "
            class="blogImgOverlay w-full lg:h-auto lg:w-[595px]"
            @click="
              selecionaImagemGalOverlay(
                pathBlogImagens + getImgBlog[1].imagem_url
              )
            "
          >
            <img
              :src="pathBlogImagens + getImgBlog[1].imagem_url"
              class="h-full w-full object-cover"
            />
          </div>
        </div>

        <div
          class="container mx-auto flex flex-col space-y-6 text-justify ztext-xl font-light zsm:text-3xl"
        >
           <!-- <span
           v-show="false"
            v-for="(p, index) in blogPost[0].descricaoLang"
            :key="index"
            :class="{ hidden: index < 2 }"
          >
            <p v-if="index > 2">{{ p.texto }}</p>
          </span> -->
          <div class="ql-editor" v-html="blogPost[0].descricaoLang[1].texto"></div>
        </div>

        <!-- AUTOR -->
        <div class="container mx-auto flex flex-col space-y-10">
          <div class="flex w-full flex-col py-16 lg:flex-row lg:space-x-6">
            <div
              class="flex items-center justify-center overflow-clip rounded-full"
            >
              <img
                :src="pathBlogImagens + blogPost[0].imagem_autor"
                alt=""
                width="250"
                height="250"
                class="rounded-full object-cover"
              />
            </div>
            <div class="w-full pt-14">
              <div>
                <h2 class="text-lg font-light uppercase">
                  {{ $t("escritopor") }}
                </h2>
                <h1 class="pb-6 text-xl font-semibold uppercase text-[#00b1ef]">
                  {{ blogPost[0].nome }}
                </h1>
                <p class="text-justify text-base sm:text-xl">
                  {{ blogPost[0].bioLang }}
                </p>
              </div>
              <!-- SOCIAL -->
              <div class="w-[200px] pt-3">
                <div class="flex h-[80px] flex-row items-center justify-around">
                  <div
                    @click="
                      irParaSocial('instagram', blogPost[0].social_instagram)
                    "
                    id="rodape_instagran"
                    class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] transition-all hover:bg-[#00b1ef]"
                  >
                    <img
                      src="/img/icon_insta.png"
                      alt=""
                      width="24"
                      height="24"
                    />
                  </div>
                  <div
                    @click="
                      irParaSocial('facebook', blogPost[0].social_facebook)
                    "
                    id="xlogoFacebook"
                    class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] p-[20px] transition-all hover:bg-[#00b1ef]"
                  >
                    <img
                      src="/img/icon_face.png"
                      alt=""
                      width="16"
                      height="16"
                    />
                  </div>
                  <div
                    @click="
                      irParaSocial('linkedin', blogPost[0].social_linkedin)
                    "
                    class="flex h-14 w-14 cursor-pointer flex-row items-center justify-center rounded-full border-2 border-[#00b1ef] p-[16px] transition-all hover:bg-[#00b1ef]"
                  >
                    <img src="/img/icon_in.png" alt="" width="16" height="16" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- COMENTARIOS -->
          <div>
            <div class="text-3xl font-medium text-[#00b1ef]">
              {{ blogPost[0].comentarios.length }}
              <span class="uppercase"> {{ $t("comentarios") }}</span
              >(s)
            </div>
            <div>
              <div
                envelope="comentarios"
                class="container mx-auto flex flex-col pt-20 sm:pt-20 lg:flex-row lg:space-x-8"
                v-for="(comentario, index) in blogPost[0].comentarios"
                :key="index"
              >
                <div class="flex flex-col rounded-full lg:flex-row">
                  <div class="min-w-[50%]">
                    <img
                      :src="comentario.imagem_url"
                      alt=""
                      width="100"
                      height="100"
                    />
                  </div>
                </div>

                <div class="min-w-[50%]">
                  <div>
                    <article class="pt-6 lg:pt-0">
                      <h2 class="text-lg font-light uppercase">
                        {{ comentario.data_br }}
                      </h2>
                      <h1
                        class="pb-6 text-xl font-semibold uppercase text-[#00b1ef]"
                      >
                        {{ comentario.nome }}
                      </h1>
                    </article>
                  </div>
                  <p class="text-justify text-base sm:text-xl">
                    {{ comentario.comentario }}
                  </p>
                  <div class="pt-6">
                    <div
                      class="text-base font-semibold hover:cursor-pointer hover:text-[#00b1ef]"
                    >
                      {{ $t("resposta") }}
                    </div>

                    <div
                      v-if="comentario.resposta.length > 0"
                      class="mt-6 flex w-full flex-row space-x-6 border border-white border-opacity-25 py-6"
                    >
                      <div
                        class="flex items-start overflow-clip rounded-full pl-4 lg:items-center lg:justify-center"
                      >
                        <img
                          :src="pathBlogImagens + blogPost[0].imagem_autor"
                          alt=""
                          width="70"
                          height="70"
                          class="rounded-full object-cover"
                        />
                      </div>
                      <div class="w-full lg:pt-0">
                        <div>
                          <p class="text-[9pt] font-light uppercase">
                            {{ $t("escritopor") }}
                          </p>
                          <p
                            class="text-[9pt] font-semibold uppercase text-white"
                          >
                            {{ blogPost[0].nome }}
                          </p>
                          <div
                            class="break-words pt-4 text-[10pt] text-[#00b1ef]"
                          >
                            {{ comentario.resposta }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- FORM DEIXE COMENTARIOS -->
        <div
          v-if="true"
          envelope="enviar_comentario"
          class="container mx-auto pt-32"
        >
          <form action="">
            <div class="ml-2 space-y-10">
              <h1 class="text-3xl font-semibold uppercase text-[#00b1ef]">
                {{ $t("deixeumcomentario") }}
              </h1>
              <h2 class="text-xl font-light">{{ $t("lgpdemail") }} *</h2>
            </div>
            <div class="my-10 flex h-[200px] w-full flex-row">
              <textarea
                v-model="blogComentariosForm.comentario"
                name=""
                id=""
                cols="30"
                rows="10"
                :placeholder="$t('seucomentario')"
                class="h-60 w-full border-2 border-white bg-transparent p-4 text-white"
              ></textarea>
            </div>
            <div
              class="flex h-16 w-full flex-row border-white border-b-2 pb-10 pt-14"
            >
              <div class="mr-8 w-full">
                <input
                  v-model="blogComentariosForm.nome"
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('seunome')"
                />
              </div>
            </div>
            <div
              class="flex h-16 w-full flex-row border-white border-b-2 pb-10 pt-14"
            >
              <div class="mr-8 w-full">
                <input
                  v-model="blogComentariosForm.email"
                  class="h-10 w-full bg-transparent"
                  type="email"
                  :placeholder="$t('seuemail')"
                />
              </div>
            </div>
            <div
              class="flex h-16 w-full flex-row border-white border-b-2 pb-10 pt-14"
            >
              <div class="mr-8 w-full">
                <input
                  v-model="blogComentariosForm.localidade"
                  class="h-10 w-full bg-transparent"
                  type="text"
                  :placeholder="$t('localnaredeinternet')"
                />
              </div>
            </div>
            <div class="mt-5">
              <label class="checkboxID text-lg font-light text-white"
                >{{ $t("cacheLogin") }}
                <input type="checkbox" />
                <span class="checkmark"></span>
              </label>
            </div>
            <div 
              class="max-h-[200px]  pr-6  overflow-clip flex flex-col space-y-4">
              <div
              id="postarComentID"
               class="h-[200px] flex flex-col items-start justify-center">
                
                <div
                @click="postarComentariox()"
                class="SETANEWS flex flex-row justify-start space-x-14 pt-20"
                >
                  <div>
                    {{ $t("postarcomentario") }}
                  </div>
                    <div>
                    <div id="seta">
                      <div></div>
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>

              <div 
              id="newsSucessoSocial"
              class="h-[200px] flex flex-col items-start justify-center opacity-0">
                <div class="py-6">
                  <p class="text-xl">Informe que não é um robô</p>
                  <p class="text-sm">Faça login pelo Google ou Facebook</p>
                </div>
                <div>
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
                    <div class="btn-primary h-[40px] py-2 w-[218px] bg-blue-500 rounded-md px-6 mt-4">Login com Facebook</div>
                    
                  </FacebookSignin>
                </div>
                
              </div>

            </div>


            <!-- <div class="container mx-auto flex pt-24">
              <div @click="postarComentario()" id="setaPostarComentario">
                <div></div>
                <div></div>
                <div>{{ $t("postarcomentario") }}</div>
              </div>
            </div> -->
          </form>
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
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

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
      blogComentariosForm.value.imagem_url = userPicture;
      postarComentario();
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
  console.log("Access Token", credential);
  const decodedCredential = decodeCredential(credential);
  console.log("User:", decodedCredential);

  blogComentariosForm.value.imagem_url = decodedCredential.picture;
  postarComentario();
};
// handle an error event
const handleLoginError = () => {
  console.error("Login failed");
};

gsap.registerPlugin(ScrollTrigger);
components: {
  PhX;
}
let blogComentariosForm = ref({
  emEdicao: false,
  blog_posts_id: null,
  nome: "",
  criado_em: "",
  comentario: "",
  email: "",
  localidade: "",
  imagem_url: "",
  ativado: false,
  resposta: "",
});

function postarComentariox(){
  console.log(document.getElementById('postarComentID'));
   let formNewsSend = document.getElementById("postarComentID");
   let formNewsSendSocial = document.getElementById("newsSucessoSocial");
  //document.getElementById('postarComentID').scrollTo({top: 100, behavior: 'smooth'})

formNewsSend.classList.add("newsSucesso");
newsSucessoSocial.classList.add("newsSucessoSocial");

//formNewsSend.classList.remove("newsSucesso");

}

async function postarComentario() {
  //ADD FORM JSON
  let formComent = new FormData();
  formComent.append("json", JSON.stringify(blogComentariosForm.value));

  const R = await $fetch("/api/formBlogComentarios.php", {
    mode: "cors",
    method: "POST",
    body: formComent,
  }).then(() => {
    alert(
      "Postagem recebida com Sucesso.\nReceberá uma notificação\nassim que for publicada!"
    );
  });
}

let ROTA = ref();

const route = useRoute();
const router = useRouter();
const blog_id = ref(route.query.post ? route.query.post : "");

onMounted(() => {
  ROTA = useRoute();
  resetFormPostBlogQuery();
  queryPostBlog.value.post = blog_id;
  blogComentariosForm.value.blog_posts_id = blog_id;
  getPostsBlog();
});
let blogPost = ref([]);
let queryPostBlog = ref({
  q: "",
  offset: 0,
  qpag: 1,
  post: null,
});
function resetFormPostBlogQuery() {
  queryPostBlog.value = {
    q: "",
    offset: 0,
    qpag: 1,
    post: null,
  };
}
async function getPostsBlog() {
  let R = await $fetch(
    "/api/formBlog.php",

    {
      method: "GET",
      params: queryPostBlog.value,
    }
  ).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        blogPost.value = RS.dados;
        console.log("post_blog_comen", blogPost.value[0].imagens);
        blocksToArray();
      } else {
        blogPost.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}

// imagens slide
const getImgSlides = computed(() => {
  let I = [];
  if(blogPost.value[0]){
    console.log("computed",blogPost.value[0] );

    blogPost.value[0].imagens.map((img) => {
      if (img.tipo == "1") {
        I.push(img);
      }
    });
  }
  return I;
});

const getImgBlog = computed(() => {
  let I = [];
  try {
    blogPost.value[0].imagens.map((img) => {
      if (img.tipo == "0") {
        I.push(img);
      }
    });
    return I;
  } catch (error) {
    return [];
  }
});

function irParaSocial(social, link) {
  if (social == "instagram") {
    console.log(link);
    window.open("https://www.instagram.com/" + link, "_blank");
  }
  if (social == "facebook") {
    console.log(link);
    window.open("https://pt-br.facebook.com/" + link, "_blank");
  }
  if (social == "linkedin") {
    console.log(link);
    window.open("https://br.linkedin.com/in/" + link, "_blank");
  }
}
const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});
let lang = ref("pt");
watch(i18nLocale.locale, () => {
  atualizaLocale();
  //lang.value = i18nLocale.locale.value;
  blocksToArray();
});
function atualizaLocale() {
  //  lang.value = i18nLocale.locale.value;
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");
}

const pathBlogImagens = "\\media\\blog\\";

function blocksToArray() {
  blogPost.value.map((b, index) => {
    if (lang.value == "pt") {
      try {
        blogPost.value[index].descricaoLang = JSON.parse(b.descricao);
      } catch (error) {}
      blogPost.value[index].tituloLang = b.titulo || "";
      blogPost.value[index].bioLang = b.bio || "";
    } else if (lang.value == "en") {
      try {
        blogPost.value[index].descricaoLang = JSON.parse(b.descricao_en);
      } catch (error) {}
      blogPost.value[index].tituloLang = b.titulo_en || "";
      blogPost.value[index].bioLang = b.bio_en || "";
    } else {
      try {
        blogPost.value[index].descricaoLang = JSON.parse(b.descricao_es);
      } catch (error) {}
      blogPost.value[index].tituloLang = b.titulo_es || "";
      blogPost.value[index].bioLang = b.bio_es || "";
    }
  });
}

let imagemBlogDetOverlay_Sel = ref();

let atualY = ref(-100);
let ultimaPosicao = ref(0);
onMounted(() => {
  const tlContTitCont = gsap.timeline({
    scrollTrigger: {
      trigger: "#blogDetalTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlContTitCont.from(".H1BlogDetal", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlContTitCont.from(".H2BlogDetal", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });

  ScrollTrigger.create({
    trigger: ".drawLineContBlogDet",
    start: "top bottom",
    end: "bottom top",
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
    let txBlogDetalIDspacer = document.getElementById("txBlogDetalID");
    let drawLineInnerContIDBlogDet = document.getElementById(
      "drawLineInnerContIDBlogDet"
    );

    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;
        drawLineInnerContIDBlogDet.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txBlogDetalIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txBlogDetalIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDBlogDet.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
});

let MOBILEBlogDetal = ref(null);
let pagianacaoImgBlog = ref(null);
let windowWidth = ref(0);

onBeforeMount(() => {
  getWindowSize();
  window.addEventListener("resize", getWindowSize);
  getWindowSize();
  function getWindowSize() {
    if (process.client) {
      windowWidth.value = document.documentElement.clientWidth;
      if (windowWidth.value <= 1023) {
        MOBILEBlogDetal.value = true;
        pagianacaoImgBlog.value = 300;
      } else {
        MOBILEBlogDetal.value = false;
        pagianacaoImgBlog.value = 1200;
      }
    }
  }
});

function clickEsq() {
  document.getElementById("scrollSlidesID").scrollLeft -=
    pagianacaoImgBlog.value;
}
function clickDir() {
  document.getElementById("scrollSlidesID").scrollLeft +=
    pagianacaoImgBlog.value;
}

function selecionaImagemGalOverlay(url) {
  const imgOverlay = document.getElementById("envelopeOverlayBlogDet");

  if (url) {
    imagemBlogDetOverlay_Sel.value = url;
    imgOverlay.classList.add("over");
    document.body.style.overflowY = "hidden";
  } else {
    imgOverlay.classList.remove("over");

    document.body.style.overflowY = "auto";
  }
}
</script>
    
    <style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
.newsSucesso {
  animation-name: newsSend;
  animation-duration: 1s;
  animation-fill-mode: forwards;
}
.newsSucessoSocial {
  animation-name: newsSendSocial;
  animation-duration: 1s;
  animation-fill-mode: forwards;
}
@keyframes newsSend {
  0% {
    margin-top: 0px;
    opacity: 1;
  }

  100% {
    margin-top: -200px;
    opacity: 0;
  }
}
@keyframes newsSendSocial {
  0% {

    opacity: 0;
  }

  100% {

    opacity: 1;
  }
}

input {
  color: #fff;
  font-size: 1em;
  border: none;
  -webkit-appearance: none;
  -ms-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
input:focus {
  border: none;
  outline: none;
  box-shadow: none;
}
textarea:focus {
  outline: none; 
}
input::placeholder,
textarea::placeholder {
  color: #fff;
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

.over {
  width: 100vw !important;
  height: 100vh !important;
  margin: auto !important;
  visibility: visible !important;
  opacity: 1 !important;
}
#envelopeOverlayBlogDet {
  visibility: hidden;
  width: 0;
  height: 0;
  opacity: 0;
  --margin: 0px;
  transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -webkit-transition: all 0.25s;
}

.bg_blogDetalhe {
  background: url("/img/fd_banner_empresa.jpg");
  background-size: cover;
}
/*Checkbox css */
.checkboxID {
  display: block;
  position: relative;
  padding-left: 25px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkboxID input {
  position: absolute;

  opacity: 0;
  cursor: pointer;
  height: 0px;
  width: 0px;
  border: 1px solid #ffffff;
  background-color: transparent;
  border-radius: 5px;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 3px;
  left: 0;
  height: 22px;
  width: 19px;
  background-color: transparent;
  border: 1px solid #ffffff;
  background-color: transparent;
  border-radius: 4px;
}

/* On mouse-over, add a grey background color */
.checkboxID:hover input ~ .checkmark {
  background-color: transparent;
}

/* When the checkbox is checked, add a blue background */
.checkboxID input:checked ~ .checkmark {
  background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkboxID input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkboxID .checkmark:after {
  left: 6px;
  top: -3px;
  width: 8px;
  height: 15px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

/*Seta enviar comentário  */
#setaNewsMais {
  position: relative;
  left: 120px;
  cursor: pointer;
  display: flex;
  flex-direction: row;
  align-items: center;
}
#setaNewsMais:hover div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
#setaNewsMais:hover div:nth-child(2) {
  background-color: #00b1ef;
}
#setaNewsMais:hover div:nth-child(3) {
  color: #00b1ef;
}
#setaNewsMais > div:nth-child(1) {
  position: absolute;
  top: 0px;
  padding: 9px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
}
#setaNewsMais > div:nth-child(2) {
  position: absolute;
  top: 8px;
  left: -30px;
  width: 50px;
  height: 2px;
  background-color: #fff;
}
#setaNewsMais > div:nth-child(3) {
  position: absolute;
  top: -10px;
  right: 20px;
  width: 100px;
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
}

/*Seta enviar setaPostarComentario  */
#setaPostarComentario {
  position: relative;
  left: 255px;
  cursor: pointer;
  display: flex;
  flex-direction: row;
  align-items: center;
}
#setaPostarComentario:hover div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
#setaPostarComentario:hover div:nth-child(2) {
  background-color: #00b1ef;
}
#setaPostarComentario:hover div:nth-child(3) {
  color: #00b1ef;
}
#setaPostarComentario > div:nth-child(1) {
  position: absolute;
  top: 0px;
  padding: 9px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
}
#setaPostarComentario > div:nth-child(2) {
  position: absolute;
  top: 8px;
  left: -30px;
  width: 50px;
  height: 2px;
  background-color: #fff;
}
#setaPostarComentario > div:nth-child(3) {
  position: absolute;
  top: -10px;
  right: -10px;
  width: 270px;
  font-size: 1.3rem;
  letter-spacing: 0.1rem;
  color: #fff;
}

#setaDirblogDet {
  z-index: 1;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaDirblogDet > div:nth-child(1) {
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
#setaDirblogDet > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 0px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirblogDet:hover {
  /* top: calc(50% - 50px);
  background-color: rgba(0, 255, 0, 1);
  border: solid transparent; */
  --transform: translateX(-50px);
}
#setaDirblogDet:hover > div:nth-child(1) {
  opacity: 1;

  right: 30px;
}

#setaDirblogDet:hover > div:nth-child(2) {
  opacity: 1;
  left: 25px;
}

setaEsqBlogDet {
  z-index: 2;
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
#setaEsqBlogDet > div:nth-child(1) {
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
#setaEsqBlogDet > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaEsqBlogDet:hover {
  /* top: calc(50% - 50px);*/
  background-color: rgba(0, 255, 0, 1);
  --border: solid transparent;
  --transform: translateX(50px);
}
@media (hover: hover) and (pointer: fine) {
  #setaEsqBlogDet:hover {
    background-color: gba(0, 255, 0, 1);
  }
  #setaDirblogDet:hover {
    background-color: gba(0, 255, 0, 1);
  }
}
@media (hover: none) {
  #setaEsqBlogDet:hover {
    background-color: transparent;
    border: 2px solid #fff;
  }
  #setaDirblogDet:hover {
    background-color: transparent;
    border: 2px solid #fff;
  }
}
#setaEsqBlogDet:hover > div:nth-child(1) {
  opacity: 1;
  left: 30px;
}

#setaEsqBlogDet:hover > div:nth-child(2) {
  opacity: 1;
  left: 30px;
}

.slider {
  overflow: clip;
}
.slides {
  display: flex;
  flex-wrap: nowrap;
  overflow-y: hidden;
  overflow-x: hidden;
  -webkit-overflow-scrolling: touch;
  transition: all 0.3s ease;
  scroll-behavior: smooth;
  scroll-snap-type: x mandatory;
}
.slide {
  scroll-snap-align: start;
  flex-shrink: 0;
  width: 100%;
  transition: 1s;
  position: relative;

  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 100px;
}

.blogImgOverlay {
  background-image: url("/img/blogInternoOverlay.png");

  background-size: cover;
  background-repeat: no-repeat;
}
.blogImgOverlay:hover {
  border: 1px solid #fff;
  cursor: pointer;
}
.blogImgOverlay:hover img {
  filter: grayscale(1) opacity(0.3);
}

.drawLineContBlogDet {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContBlogDet {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}

.SETANEWS:hover {
  position: relative;
  cursor: pointer;
}
.SETANEWS > div:nth-child(1) {
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
  transform: translateY(-5px);
}
.SETANEWS:hover div:nth-child(1) {
  color: #00b1ef;
}
.SETANEWS:hover #seta > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset;
}
.SETANEWS:hover #seta > div:nth-child(2) {
  background-color: #00b1ef;
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
</style>
    