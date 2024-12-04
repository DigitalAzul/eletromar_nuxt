<template>
  <div envelope="blogHome" class="relative">
    <div class="drawLineContBlog">
      <div
        class="drawLineInnerContBlog"
        id="drawLineInnerContIDBlog"
        style="
          will-change: transform;
          transform: translate3d(0px, -100%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>
    <x-modal v-model="modalBlog"> {{ $t("semmaisparaomomento") }} </x-modal>
    <div
      class="bg_blog relative flex min-h-screen w-full flex-col items-center justify-center overflow-hidden bg-[#1b3346]"
    >
      <div
        id="txBlogID"
        class="container relative mx-auto text-center text-6xl font-normal tracking-[0.25em] text-white md:top-20 md:text-6xl"
      >
        BLOG
      </div>
    </div>
    <div class="overflow-clip bg-[#1b3346] py-20">
      <div id="blogTitID" class="space-y-4 px-5 pt-[130px] text-center">
        <div class="H1Blog">
          <span class="text-3xl uppercase text-[#00b1ef]">{{
            $t("noticias")
          }}</span>
        </div>
        <div class="H2Blog">
          <span class="text-4xl font-bold uppercase text-white">{{
            $t("fiquepordentro")
          }}</span>
        </div>
      </div>

      <!-- GRID DE BLOG -->

      <div
        class="container mx-auto flex min-h-screen flex-col justify-center pt-20"
      >
        <div
          id="blogColunasID"
          class="flex flex-col-reverse justify-around xl:flex-row"
        >
          <!-- COLUMA 1 -->
          <div
            id="blogColuna-1"
            class="flex flex-col items-center justify-center space-y-28 opacity-100"
          >
            <div
              :class="{ 'envelopeBlog opacity-10 ': isFetching }"
              class="space-y-28"
            >
              <div
                v-for="(post, index) in blogPosts"
                :key="index"
                @click="blogDetalhes(post.id)"
                class="envelopePostBlog container mx-auto flex w-full flex-col justify-center xl:w-[900px]"
              >
                <div
                  class="Zmb-[250px] Zlg:mb-[550px] relative w-full px-4 xl:mb-0 xl:h-[550px] xl:w-[900px]"
                >
                  <div
                    class="blogImagemOverlay left-0 top-0 w-full lg:h-[550px] lg:w-[900px]"
                  >
                    <figure class="">
                      <!-- <span v-for="(img, index) in post.imagens" :key="index">
                        <img
                        v-if="img.tipo == 2"
                        class="w-full object-cover xl:h-[550px] xl:w-[900px]"
                        :src="pathBlogImagens + img.imagem_url"
                      /> 
                      </span> -->
                      <img
                        v-if="Object.keys(blogPosts).length > 0"
                        class="w-full object-cover xl:h-[550px] xl:w-[900px]"
                        :src="pathBlogImagens + post.img_capa_url"
                      />
                    </figure>
                  </div>
                </div>

                <div
                  class="my-14 text-center text-2xl font-bold uppercase text-white"
                >
                  {{ post.tituloLang }}
                </div>
                <div
                  class="mx-4 grid grid-cols-5 border-b border-t border-[#00b1ef] text-center font-light tracking-tighter text-white"
                >
                  <div
                    class="h-full border-r border-[#00b1ef] py-2 pr-2 text-sm font-medium text-white sm:text-lg"
                  >
                    {{ trataData(post.criado_em) }}
                  </div>
                  <div
                    class="col-span-4 py-2 text-sm font-medium uppercase sm:text-lg"
                  >
                    {{ post.tituloLang }}
                  </div>
                </div>
                <div
                  class="flex flex-col space-y-3 p-6 text-justify text-lg text-white"
                >
                  <p v-if="Object.keys(blogPosts).length > 0">
                    {{ post.descricaoLang[0].texto.replace(/^(.{250}[^\s]*).*/, "$1") }}
                    <span class="pl-1">...</span>
                  
                  </p>
                </div>
                <div class="flex flex-row justify-center space-x-8 pt-10">
                  <div
                    @click="blogDetalhes(post.id)"
                    class="-mt-[0.4rem] text-lg text-[#00b1ef]"
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

              <!-- PAGINAÇÃO MAIS POSTS -->
              <div
                class="relative mt-28 flex h-40 w-screen flex-row justify-between md:w-[800px]"
              >
                <div
                  id="setaEsqBlogHome"
                  @click="maisPosts(0)"
                  class="left-5 scale-75 md:left-24 md:scale-100"
                >
                  <div></div>
                  <div></div>
                </div>
                <div
                  id="setaDirBlogHome"
                  @click="maisPosts(1)"
                  class="right-5 scale-75 md:right-24 md:scale-100"
                >
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>
          </div>

          <!-- COLUMA 2 -->
          <div
            id="blogColuna-2"
            class="mb-14 flex w-full flex-col px-4 pt-10 lg:w-[480px] xl:mb-0"
          >
            <div class="w-full">
              <div
                class="flex h-12 w-full flex-row items-center justify-between border-b border-[#00b1ef] bg-transparent"
              >
                <div class="h-12 w-4/5 px-4">
                  <input
                    @keyup.enter="busarBlog()"
                    v-model="pesquisaBlog"
                    class="inputBlog h-12 w-full text-white focus:outline-none"
                    type="text"
                    name="pesquisaBlog"
                    :placeholder="$t('pesquise...')"
                    id="pesquisaBlogID"
                  />
                </div>
                <div
                  class="flex h-full w-1/5 flex-row items-center justify-center"
                >
                  <ph-magnifying-glass :size="20" class="text-white" />
                </div>
              </div>
            </div>

            <div class="w-full pt-14">
              <div
                @click="categoriaToggle()"
                class="mb-6 flex h-14 w-full items-center bg-[#00b1ef] pl-2 text-[1.8rem] text-white"
              >
                {{ $t("categorias") }}
              </div>
              <div id="categoriaPostgensID" class="hidden lg:block">
                <div
                  v-for="(categoria, index) in categoriasBlog"
                  :key="index"
                  @click="busarBlogPorCategoria(categoria.categoria_id)"
                  class="ml-3 pb-2 text-base text-white hover:cursor-pointer hover:text-[#00b1ef] hover:underline"
                >
                  {{ categoria.tituloLang }} ({{ categoria.qtd }})
                </div>
              </div>
            </div>
            <div class="w-full pt-4 lg:pt-14">
              <div
                @click="postsRecentes()"
                class="mb-6 flex h-14 w-full items-center bg-[#00b1ef] pl-2 text-[1.8rem] text-white"
              >
                {{ $t("postagensrecentes") }}
              </div>
              <div id="categoriaPostsRecentesID" class="hidden lg:block">
                <div
                  v-for="(postagem, index) in postgensRecentes"
                  :key="index"
                  @click="blogDetalhes(postagem.id)"
                  class="overPostRecente ml-3 pb-2 text-base text-white hover:cursor-pointer hover:text-[#00b1ef]"
                >
                  <div>
                    {{ postagem.data_br }}
                  </div>
                  <div class="font-semibold">
                    {{ postagem.tituloLang }}
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full pt-4 lg:pt-14">
              <div
                class="mb-6 flex h-14 w-full items-center bg-[#00b1ef] pl-2 text-[1.8rem] text-white"
              >
                Tag
              </div>
              <div class="flex">
                <ul>
                  <li
                    v-for="(tag, index) in tags"
                    :key="index"
                    @click="getPostBlogPorTag(tag.tag_id)"
                    class="inline-block pr-2 text-base text-white hover:cursor-pointer hover:text-[#00b1ef] hover:underline"
                  >
                    <span class="">
                      {{ tag.tituloLang }}
                      <span v-if="index < tags.length - 1">,</span>
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import { ref, onMounted } from "vue";
import { PhMagnifyingGlass } from "phosphor-vue";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();
gsap.registerPlugin(ScrollTrigger);
import { XModal } from "@indielayer/ui";

components: {
  PhMagnifyingGlass, XModal;
}
const pathBlogImagens = "\\media\\blog\\";
const urlLocation = "\\ui\\";

onBeforeMount(() => {
  //onst { data: dados } = useFetch("https://localhost/mec/formBlogGET.php");
  getPostsBlog('inicio');
  getCol2Dados();
});
let ROTA = ref();
let pesquisaBlog = ref("");
const modalBlog = ref(false);

function busarBlog() {
  resetFormPostBlogQuery();
  queryPostBlog.value.q = pesquisaBlog;
  getPostsBlog('');
}
function busarBlogPorCategoria(categoria_id) {
  resetFormPostBlogQuery();
  queryPostBlog.value.categoria_id = categoria_id;

  getPostsBlog('');
}
// animações
onMounted(() => {
  ROTA = useRouter();

  const tlBlogTit = gsap.timeline({
    scrollTrigger: {
      trigger: "#blogTitID",
      start: "top center",
      end: "bottom bottom",
      toggleActions: "play restart play reverse",
    },
  });
  tlBlogTit.from(".H1Blog", {
    duration: 0.6,
    xPercent: 100,
    ease: "power4",
    stagger: 0.1,
  });
  tlBlogTit.from(".H2Blog", {
    duration: 0.6,
    xPercent: -100,
    ease: "power4",
    stagger: 0.1,
  });
});

let lang = ref("pt");
const { t, locale } = useI18n();
onMounted(() => {
  atualizaLocale();
});

watch(i18nLocale.locale, () => {
  atualizaLocale();
  blocksToArray();
  blocksToArrayRecentes();
});
function atualizaLocale() {
  locale.value = localStorage.getItem("lang");
  lang.value = localStorage.getItem("lang");

}

let queryPostBlog = ref({
  q: "",
  offset: 0,
  qpag: 4,
  lang: "pt",
  categoria_id: null,
});

let blogPosts = ref([]);

function trataData(data) {
  let D = null;
  D = data.split("-");
  return D[2] + "." + D[1] + "." + D[0];
}

// function trataUrlImagem(imagem) {
//   let X = null;
//   imagem.map((img) => {
//     if (img.tipo == 2) {
//       console.log(pathBlogImagens + img.imagem_url);
//       X = pathBlogImagens + img.imagem_url;
//     }
//   });
//   return X;
// }

function resetFormPostBlogQuery() {
  queryPostBlog.value = {
    q: "",
    offset: 0,
    qpag: 4,
    lang: "pt",
    categoria_id: null,
  };
}

// const { data: postsT } = await useAsyncData(
//   "postsx",
//   () =>
//     $fetch("/api/formBlog.php", {
//       method: "GET",
//       params: queryPostBlog.value,
//     })
//   //{ watch: [lang] }
// );

function maisPosts(arg) {
  if (arg == 1) {
    queryPostBlog.value.offset += 4;
  }
  if (arg == 0) {
    if (queryPostBlog.value.offset == 0) return;
    queryPostBlog.value.offset -= 4;
  }

  getPostsBlog('');
}

function getPostBlogPorTag(tag) {
  console.log(tag);
  resetFormPostBlogQuery();
  queryPostBlog.value.tag = tag;
  getPostsBlog('');
}


const isFetching = ref(false);

async function getPostsBlog(inicio) {
  if(inicio == 'inicio'){
    queryPostBlog.value.q = "blog_home";
  }
  isFetching.value = false;
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
        
        blogPosts.value =  RS.dados;

        blogPosts.value.sort((a, b) => a.id > b.id);
        blocksToArray();
        isFetching.value = false;
      } else {
        //blogPosts.value = [];
        isFetching.value = false;
        modalBlog.value = true;
      }
    }
  });
}



async function getCol2Dados() {
  let R = await $fetch("/api/formCategoriasGet.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
      if (r.dados.length > 0) {
        categoriasBlog.value = r.dados;
          blocksToArray();
      } else {
        categoriasBlog.value = [];  
      }

  });

  let R2 = await $fetch("/api/formBlogRecentesGET.php", {
    method: "GET",
  }).then((R2) => {
    let RS2 = JSON.parse(R2);
    postgensRecentes.value = RS2;
    blocksToArrayRecentes();
  });

  queryPostBlog.value.q="blog_home";
  
  let R3 = await $fetch("/api/formGetTags.php", {
    method: "GET",
    params: queryPostBlog.value,
  }).then((R3) => {
    let RS3 = JSON.parse(R3);
    RS3 = RS3.dados
    tags.value = RS3;
    blocksToArray();

  });
}

function blocksToArrayRecentes() {
  postgensRecentes.value.map((b, index) => {
    if (lang.value == "pt") {
      postgensRecentes.value[index].tituloLang = b.titulo;
    } else if (lang.value == "en") {
      postgensRecentes.value[index].tituloLang = b.titulo_en;
    } else {
      postgensRecentes.value[index].tituloLang = b.titulo_es;
    }
  });
}
function blocksToArray() {

  
  blogPosts.value.map((b, index) => {

    let continuar_busca_capaImg = true;

    //TRATAMENTO IMAGEM
    b.imagens.map((img)=>{
      if(img.tipo == "1" && continuar_busca_capaImg == true){
      blogPosts.value[index].img_capa_url = img.imagem_url;
      continuar_busca_capaImg = false;
    }
    })
    

    if (lang.value == "pt") {


      //TRADUCAO POST BLOG
      blogPosts.value[index].descricaoLang = JSON.parse(b.descricao);
      blogPosts.value[index].descricaoLang[0].texto = blogPosts.value[index].descricaoLang[0].texto.replace(/(<([^>]+)>)/gi, "");
      blogPosts.value[index].tituloLang = b.titulo;
    } else if (lang.value == "en") {



      //TRADUCAO POST BLOG
      blogPosts.value[index].descricaoLang = JSON.parse(b.descricao_en);
      blogPosts.value[index].descricaoLang[0].texto = blogPosts.value[index].descricaoLang[0].texto.replace(/(<([^>]+)>)/gi, "");
      blogPosts.value[index].tituloLang = b.titulo_en;
    } else {



      //TRADUCAO POST BLOG
      blogPosts.value[index].descricaoLang = JSON.parse(b.descricao_es);
      blogPosts.value[index].descricaoLang[0].texto = blogPosts.value[index].descricaoLang[0].texto.replace(/(<([^>]+)>)/gi, "");
      blogPosts.value[index].tituloLang = b.titulo_es;
    }
  });

    //TRADUCAO CATEGORIA
    categoriasBlog.value.map((c,index)=>{


      if (lang.value == "pt") {
        categoriasBlog.value[index].tituloLang = c.titulo;
      }
      if (lang.value == "en") {
        categoriasBlog.value[index].tituloLang = c.titulo_en;
      }
      if (lang.value == "es") {
        categoriasBlog.value[index].tituloLang = c.titulo_es;
      }
    })


    //TRADUCAO TAGs
    tags.value.map((t,index)=>{

      if (lang.value == "pt") {
        tags.value[index].tituloLang = t.titulo;
      }
      if (lang.value == "en") {
        tags.value[index].tituloLang = t.titulo_en;
      }
      if (lang.value == "es") {
        tags.value[index].tituloLang = t.titulo_es;
      }
    })
}


let posts = ref([
  {
    id: 234,
    titulo: "LINHA PRISMA - EDIÇÃO 2022",
    titulo_en: "",
    titulo_es: "",
    descricao:
      "quia suscipit quis officiis libero molestiae repellendus possimus Praesentium tenetur quos, inventore nihil maxime libero voluptatibus repellendus sequi odio labore ex.",
    descricao_en: "",
    descricao_es: "",
    link: "/RAPID",
    imagem_url: "/bd_imagens/blogImg1.png",
    criado_em: "25.11.2022",
  },
  {
    id: 56565,
    titulo: "LINHA PRISMA - EDIÇÃO 2022",
    titulo_en: "",
    titulo_es: "",
    descricao:
      "quia suscipit quis officiis libero molestiae repellendus possimus Praesentium tenetur quos, inventore nihil maxime libero voluptatibus repellendus sequi odio labore ex.",
    descricao_en: "",
    descricao_es: "",
    link: "/RAPID",
    imagem_url: "/bd_imagens/blogImg2.png",
    criado_em: "25.11.2022",
  },
]);

let categoriasBlog = ref([
  // { titulo: "Marketing", quantidade: 2 },
  // { titulo: "Negócios", quantidade: 2 },
  // { titulo: "Dicas", quantidade: 2 },
  // { titulo: "Designer", quantidade: 2 },
  // { titulo: "Linha Petra", quantidade: 2 },
  // { titulo: "Eletromar", quantidade: 2 },
  // { titulo: "Videos", quantidade: 2 },
]);

let postgensRecentes = ref([]);

// faltando criar tabela e organizar ela

let tags = ref([
  { titulo: "tags", link: "/link" },
  { titulo: "linha petra1", link: "/link" },
  { titulo: "linha petra2", link: "/link" },
  { titulo: "linha petra3", link: "/link" },
  { titulo: "linha petra4", link: "/link" },
]);

//SPACER TITULO PAG

onMounted(() => {
  //setTimeout(() => {
  /////

  let atualY = ref(-100);
  let ultimaPosicao = ref(0);
  ScrollTrigger.create({
    trigger: ".drawLineContBlog",
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
    let txBlogIDspacer = document.getElementById("txBlogID");
    if (yInicial > ultimaPosicao.value) {
      //pra baixo

      if (atualY.value < 100) {
        atualY.value += 5;

        drawLineInnerContIDBlog.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
        if (pg > 0.25) txBlogIDspacer.style.letterSpacing = `${pg}em`;
      } else {
        atualY.value = 100;
      }
    } else {
      if (atualY.value > -100) {
        atualY.value -= 5;
      }
      if (pg > 0.25) txBlogIDspacer.style.letterSpacing = `${pg}em`;
      drawLineInnerContIDBlog.style.transform = `translate3d(0, ${atualY.value}%, 0)`;
    }

    ultimaPosicao.value = yInicial;
  }
  ////
  gsap.set("#blogColuna-1", { x: "-100%", opacity: 0 });
  gsap.set("#blogColuna-2", { x: "100%", opacity: 0 });

  const tlBlogColunas = gsap.timeline({
    scrollTrigger: {
      trigger: "#blogColunasID",
      start: "top center ",
      end: "top top",
    },
  });

  tlBlogColunas.to("#blogColuna-1", {
    x: "0%",
    opacity: 1,
    ease: "Power3.easeInOut",
  });
  tlBlogColunas.to("#blogColuna-2", {
    x: "0%",
    opacity: 1,
    ease: "Power3.easeInOut",
  });
  //}, 2000);
});
function blogDetalhes(postID) {
  window.location.assign("/blogdetalhe?post=" + postID);
}
// function XblogDetalhes(postID) {
//   ROTA.push({ path: "/blogDetalhe", query: { post: postID } });
// }
function categoriaToggle() {
  const categoriaPostgensID = document.getElementById("categoriaPostgensID");
  categoriaPostgensID.classList.toggle("hidden");
  categoriaPostgensID.classList.toggle("block");
}
function postsRecentes() {
  const categoriaPostsRecentesID = document.getElementById(
    "categoriaPostsRecentesID"
  );
  categoriaPostsRecentesID.classList.toggle("hidden");
  categoriaPostsRecentesID.classList.toggle("block");
}
</script>
  
  <style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
  font-family: "Montserrat", Helvetica, Arial;
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
  animation-delay: 5s;
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

#faixaHorzBlog {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0;
  width: 3px;
  height: 220px;
  background-color: #70df3f;
}

.envelopePostBlog {
  cursor: pointer;
  --width: 900px;
}

.envelopePostBlog:hover > div:nth-child(2) {
  text-decoration: underline;
  color: #00b1ef;
}
.envelopePostBlog:hover > div:nth-child(4) {
  text-decoration: underline;
  color: #00b1ef;
}
/* .envelopePostBlog:hover .blogImagemOverlay {
  z-index: 99;
  border: 1px solid #fff;
} */
.envelopePostBlog:hover figure {
  filter: grayscale(1) opacity(0.3);
}
/* .blogImagemOverlay {
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  opacity: 1;
  background-image: url("/img/blogOverlay.png");
  width: 100%;
  height: 100%;
  --background-size: contain;
  background-repeat: no-repeat;
} */
.blogImagemOverlay {
  background-image: url("/img/blogOverlay.png");
  width: 100%;
  height: 100%;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}
.blogImagemOverlay:hover {
  border: 1px solid #fff;
}

#seta {
  position: relative;
}
#seta > div:nth-child(1) {
  position: absolute;
  padding: 8px;
  box-shadow: 2px -2px 0 0px #1b3346 inset;
  border: solid transparent;
  border-width: 0 0 2px 2px;
  transform: rotate(225deg);
}
#seta > div:nth-child(2) {
  position: absolute;
  top: 6pt;
  left: -18px;
  width: 35px;
  height: 2px;
  background-color: #1b3346;
}
.inputBlog {
  background: transparent;
  border: none;
  outline: none;
  box-shadow: none;
}
.inputBlog:focus {
  background: transparent;
  border: none;
  outline: none;
}
.inputBlog::placeholder {
  font-style: italic;
  font-weight: 100;
  color: #fff;
}

.overPostRecente:hover > div:nth-child(2) {
  text-decoration: underline;
}
#setaDirBlogHome {
  z-index: 1;
  position: absolute;
  --right: 100px;
  top: 0;
  width: 100px;
  height: 100px;
  border: 3px solid rgba(0, 177, 239, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}

#setaDirBlogHome > div:nth-child(1) {
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
#setaDirBlogHome > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: -10px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirBlogHome:hover {
  background-color: hsla(207, 44%, 19%, 1);
}
/* ESQUERDA */

#setaEsqBlogHome {
  z-index: 1;
  position: absolute;
  --left: 100px;
  top: 0px;
  width: 100px;
  height: 100px;
  --background-color: rgba(0, 255, 0, 0.3);

  border: 3px solid rgba(0, 177, 239, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaEsqBlogHome > div:nth-child(1) {
  z-index: 2;
  position: absolute;
  top: 38px;
  left: 60px;
  padding: 11px;
  opacity: 1;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(45deg);
  transition: all 0.5s ease;
}
#setaEsqBlogHome > div:nth-child(2) {
  position: absolute;
  top: 49px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}

#setaEsqBlogHome:hover > div:nth-child(1) {
  opacity: 1;
  left: 30px;
}

#setaEsqBlogHome:hover > div:nth-child(2) {
  opacity: 1;
  left: 30px;
}
@media (hover: hover) and (pointer: fine) {
  /* DIREITA */
  #setaDirBlogHome:hover {
    --transform: translateX(-50px);
    background-color: rgba(0, 175, 239, 0.3);

  }
  #setaDirBlogHome:hover > div:nth-child(1) {
    opacity: 1;
    right: 30px;
  }
  #setaDirBlogHome:hover > div:nth-child(2) {
    opacity: 1;
    left: 27px;
  }

  /* ESQUERDA */
  #setaEsqBlogHome:hover {
    background-color: rgba(0, 175, 239, 0.3);
    --transform: translateX(50px);
  }
  #setaEsqBlogHome:hover > div:nth-child(1) {
    opacity: 1;
    left: 30px;
  }

  #setaEsqBlogHome:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }
}
@media (hover: none) {
  /* DIREITA */
  #setaDirBlogHome:hover > div:nth-child(1) {
    right: 60px;
  }

  #setaDirBlogHome:hover {

    background-color: hsla(207, 44%, 19%, 1);
  }
  #setaDirBlogHome:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }

  /* ESQUERDA */

  #setaEsqBlogHome:hover {
  background-color: #00b1ef;
    --left: -50px;
  }
  #setaEsqBlogHome:hover > div:nth-child(1) {
    opacity: 1;
    left: 60px;
  }

  #setaEsqBlogHome:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }
}
.bg_blog {
  background: url("/img/bg_banner_1.jpg");
  background-size: cover;
}

.drawLineContBlog {
  z-index: 9999;
  position: absolute;
  left: 50%;
  bottom: -100px;
  right: auto;
  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerContBlog {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
</style>
  