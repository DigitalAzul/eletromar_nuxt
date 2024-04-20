<template>
  <div
    id="noticiasID"
    class="xlg:pt-[200px] relative mx-auto min-h-[1400px] snap-center bg-[#1b3346] pt-[100px]"
  >
    <div id="drawLineNotID" class="drawLineNot top-0 lg:top-[-100px]">
      <div
        class="drawLineInnerNot"
        id="drawLineInnerNotID"
        style="
          will-change: transform;
          transform: translate3d(0px, 0%, 0px) scale3d(1, 1, 1) rotateX(0deg)
            rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg);
          transform-style: preserve-3d;
        "
      ></div>
    </div>

    <div
      id="noticiasTitID"
      class="space-y-4 overflow-hidden pt-[230px] text-center lg:pt-[130px]"
    >
      <div class="H1Not">
        <span class="text-3xl uppercase text-[#00b1ef]">{{
          $t("noticias")
        }}</span>
      </div>
      <div class="H2Not">
        <span class="text-4xl font-bold uppercase text-white">{{
          $t("blogdamectronic")
        }}</span>
      </div>
    </div>

    <div class="relative mt-32 overflow-hidden">
      <div id="setaEsqBlog" @click="clickEsq()" class="w-screen lg:block">
        <div></div>
        <div></div>
      </div>

      <div
        id="carrousselBlogID"
        class="blogEnvelope snap-x snap-mandatory flex-row lg:overflow-hidden"
      >
        <figure
          v-for="(blog, index) in blogNews"
          :key="index"
          @click="rotaPagBlog(blog.id)"
          class="cardBlog relative h-[670px] w-full shrink-0 snap-start overflow-hidden md:w-[485px]"
        >
          <!-- <img :src="blog.img" /> -->

      <div class="filter-b">

        <img :src="pathBlogImagens + blog.imagem_capa" />
      </div>
    

          <div class="baseTextoEnvelope">
            <div
              class="baseTexto flex w-full flex-col items-center space-y-12 px-10 py-6 text-center text-white"
            >
              <div class="linha -top-[200px] text-xl">
                <div class="subLinha container mx-auto">{{ blog.data_br }}</div>
              </div>
              <div class="linha text-3xl font-semibold uppercase">
                <div class="subLinha container -top-[200px] mx-auto">
                  {{ blog.tituloLang }}
                </div>
              </div>
              <div class="linha -top-[100px]">
                <div class="subLinha container mx-auto" v-html="descricaoSlice(blog.descricaoLang)">
                </div>
              </div>

              <div
                id="setaBlogMais"
                
                class="subLinha pb-14"
              >
                <div></div>
                <div></div>
                <div>{{ $t("saibamais") }}</div>
              </div>
            </div>
          </div>
        </figure>
      </div>
      <!-- <div id="setaDirNoticias"></div> -->
      <div id="setaDirBlog" @click="clickDir()" class="lg:block">
        <div></div>
        <div></div>
      </div>
    </div>

    <div v-if="false" id="faixaHorzBlog" class="z-[50]"></div>
  </div>
</template>


<script setup >
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { useI18n } from "vue-i18n";
const i18nLocale = useI18n();

gsap.registerPlugin(ScrollTrigger);

///
let linhaVisivel = ref(false);
let ROTA = ref();
const pathBlogImagens = "\\media\\blog\\";
let lang = ref("pt");
///
onMounted(() => {
  atualizaLocale();
  console.log("iii", i18nLocale.locale.value);
});
watch(i18nLocale.locale, () => {
  atualizaLocale();
  blocksToArray();
});
function atualizaLocale() {
  lang.value = i18nLocale.locale.value;
  blocksToArray();
}

onMounted(() => {
  setTimeout(() => {
    const tlNotTitNot = gsap.timeline({
      scrollTrigger: {
        trigger: "#noticiasTitID",
        start: "top center",
        end: "bottom bottom",
        toggleActions: "play restart play reverse",
      },
    });
    tlNotTitNot.from(".H1Not", {
      duration: 0.6,
      xPercent: 100,
      ease: "power4",
      stagger: 0.1,
    });
    tlNotTitNot.from(".H2Not", {
      duration: 0.6,
      xPercent: -100,
      ease: "power4",
      stagger: 0.1,
    });

    const tlNot = gsap.timeline({
      scrollTrigger: {
        trigger: "#carrousselBlogID",
        start: "top center",
        end: "bottom bottom",
        toggleActions: "play restart play reverse",
      },
    });
    tlNot.from(".linha .subLinha", 0.8, {
      y: "120",
      ease: "expo",
      opacity: 0,
      stagger: {
        amount: 1,
      },
    });

    ROTA = useRouter();
    let ultimaPosicao = 0;
    let Y = -100;
    let ease = 0.5;
    ///
    var observer = new IntersectionObserver(
      function (entries) {
        // isIntersecting is true when element and viewport are overlapping
        // isIntersecting is false when element and viewport don't overlap
        if (entries[0].isIntersecting === true) {
          linhaVisivel = true;
        } else {
          linhaVisivel = false;
        }
      },
      { threshold: [1] }
    );

    observer.observe(document.querySelector(".drawLineNot"));

    //setTranslate(-100);
    function setTranslate(yPos) {
      drawLineInnerNotID.style.transform = `translate3d(0, ${yPos}%, 0)`;
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
            Y += 10 * ease;

            setTranslate(Y);
          }
        } else {
          // pra cima

          if (Y >= -100) {
            Y -= 10 * ease;
            setTranslate(Y);
          }
        }
      }

      ultimaPosicao = yInicial;
    });
  }, 3000);
});

// GET NEWS
onBeforeMount(() => {
  getBlogNewsHome(0);
});

function blocksToArray() {
  blogNews.value.map((b, index) => {


    b.imagens.map((img) => {
      if (img.tipo == 2) {
        blogNews.value[index].imagem_capa = img.imagem_url;
      }
    });


    if (lang.value == "pt") {
      try {
        blogNews.value[index].descricaoLang = JSON.parse(b.descricao);
      } catch (error) {}
      blogNews.value[index].tituloLang = b.titulo || "";
    } else if (lang.value == "en") {
      try {
        blogNews.value[index].descricaoLang = JSON.parse(b.descricao_en);
      } catch (error) {}
      blogNews.value[index].tituloLang = b.titulo_en || "";
    } else {
      try {
        blogNews.value[index].descricaoLang = JSON.parse(b.descricao_es);
      } catch (error) {}
      blogNews.value[index].tituloLang = b.titulo_es || "";
    }
  });
}

function descricaoSlice(descricao) {
  //let D = JSON.parse(descricao);
  return descricao[0].texto.replace(/^(.{125}[^\s]*).*/, "$1") + " ...";

  //descricao[0].texto = descricao[0].texto.replace(/(<([^>]+)>)/gi, "");
  //return descricao[0].texto.slice(0, 125) + " ...";
}
function getBlogNewsHome(pagina) {
  let R = null;
  let queryBlogNews = {
    q: "blog_home",
    offset: 0,
    qpag: 9,
    c: "",
  };

  R = $fetch(
    "/api/formBlog.php",

    {
      method: "GET",
      params: queryBlogNews,
    }
  ).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      blogNews.value = RS.dados;
      blocksToArray();
    } else {
      blogNews.value = [];
    }
  });
}

// GET NEWS fgfgffff

const blogNews = ref([]);

function clickEsq() {
  document.getElementById("carrousselBlogID").scrollLeft -= 485;
}
function clickDir() {
  document.getElementById("carrousselBlogID").scrollLeft += 485;
}

function rotaPagBlog(postID) {
  window.open("/blogdetalhe?post=" + postID, "_self");
  // ROTA.push({ path: "/blogDetalhe", query: { post: postID } });
}
</script>

<style scoped>
body * {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-tap-highlight-color: transparent;
}
.linha {
  position: relative;
  width: 100%;
}
.subLinha {
  position: absolute;
  transform: translateY(0px);
}
.baseTextoEnvelope {
  position: relative;
  width: 100%;
}
#xnoticiasTitID {
  opacity: 0;
  transform: rotate(0deg) translateY(0%);
}

.drawLineNot {
  z-index: 9999;
  position: absolute;
  left: 50%;
  --top: -100px;
  right: auto;

  overflow: hidden;
  width: 2px;
  height: 220px;
}
.drawLineInnerNot {
  width: 2px;
  height: 100%;
  background-color: #00b1ef;
}
#faixaHorzBlog {
  position: absolute;
  z-index: 9999;
  margin: 0 50%;
  bottom: 0px;
  width: 3px;
  height: 220px;
  background-color: #00b1ef;
}

.blogEnvelope {
  display: flex;
  flex-wrap: nowrap;
  --flex-direction: column;
  overflow-y: hidden;
  overflow-x: hidden;
  -webkit-overflow-scrolling: touch;
  transition: all 0.3s ease;
  scroll-behavior: smooth;
  &::-webkit-scrollbar {
    display: none;
  }
  .cardBlog {
    flex: 0 0 auto;
    --filter: grayscale(100%) brightness(30%) sepia(100%) hue-rotate(50deg)
      saturate(600%) contrast(0.8);
  }
}
.cardBlog:hover {
  cursor: pointer;
}
.cardBlog img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.5s all ease-in-out;

}

.cardBlog:hover .filter-b  {
  transition: 0.1s all ease-in-out;
  -webkit-filter: grayscale(1) brightness(20%) sepia(100%) hue-rotate(170deg) saturate(600%) contrast(0.8);
    filter: grayscale(1) brightness(20%) sepia(100%) hue-rotate(170deg) saturate(600%) contrast(0.8);
  transform: scale(1.1);
}
.cardBlog:hover .filter-b img {
  transform: scale(1.1);
}

.cardBlog:hover .baseTextoEnvelope {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 670px;
}
.cardBlog:hover .baseTextoEnvelope > .baseTexto div:nth-child(2) {
  color: #00b1ef;
  text-decoration: underline;
}
.cardBlog:hover .baseTextoEnvelope div:nth-child(1) > div:nth-child(3) {
  text-decoration: underline;
}
.cardBlog:hover
  .baseTextoEnvelope
  div:nth-child(1)
  > div:nth-child(4)
  > div:nth-child(3) {
  color: #00b1ef !important;
}
.cardBlog:hover
  .baseTextoEnvelope
  div:nth-child(1)
  > div:nth-child(4)
  > div:nth-child(1) {
  box-shadow: 2px -2px 0 0px #00b1ef inset !important;
}
.cardBlog:hover
  .baseTextoEnvelope
  div:nth-child(1)
  > div:nth-child(4)
  > div:nth-child(2) {
  background-color: #00b1ef !important;
}

.baseTexto {
  background: #1b3346;
  background: linear-gradient(0deg, #1b3346 15%, rgba(55, 96, 48, 0) 100%);
  position: absolute;
  bottom: 0;
}

#setaBlogMais {
  position: relative;

  display: flex;
  flex-direction: row;
  align-items: center;
  left: 60px;
}
#setaBlogMais > div:nth-child(1) {
  position: absolute;
  top: 0px;
  padding: 9px;
  box-shadow: 2px -2px 0 0px #fff inset;
  border: solid transparent;
  border-width: 0 0 1px 1px;
  transform: rotate(225deg);
}
#setaBlogMais > div:nth-child(2) {
  position: absolute;
  top: 8px;
  left: -30px;
  width: 50px;
  height: 2px;
  background-color: #fff;
}
#setaBlogMais > div:nth-child(3) {
  position: absolute;
  top: -10px;
  right: 20px;
  width: 175px;
  font-size: 1.4rem;
  letter-spacing: 0.1rem;
  color: #fff;
}

#setaDirBlog {
  z-index: 1;
  position: absolute;
  right: -50px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: hsla(207, 44%, 19%, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaDirBlog > div:nth-child(1) {
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
#setaDirBlog > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 30px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
#setaDirBlog:hover {
  background-color: hsla(207, 44%, 19%, 1);
}
@media (hover: hover) and (pointer: fine) {
  /* DIREITA */
  #setaDirBlog:hover {
    transform: translateX(-50px);
  }
  #setaDirBlog:hover > div:nth-child(1) {
    opacity: 1;
    right: 30px;
  }
  #setaDirBlog:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }

  /* ESQUERDA */
  #setaEsqBlog:hover {
    background-color: hsla(207, 44%, 19%, 1);
    transform: translateX(50px);
  }
  #setaEsqBlog:hover > div:nth-child(1) {
    opacity: 1;
    left: 30px;
  }

  #setaEsqBlog:hover > div:nth-child(2) {
    opacity: 1;
    left: 30px;
  }
}
@media (hover: none) {
  /* DIREITA */
  #setaDirBlog:hover > div:nth-child(1) {
    right: 60px;
  }

  #setaDirBlog:hover {
    background-color: hsla(207, 44%, 19%, 0.3);
  }
  #setaDirBlog:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }

  /* ESQUERDA */

  #setaEsqBlog:hover {
    left: -50px;
  }
  #setaEsqBlog:hover > div:nth-child(1) {
    opacity: 1;
    left: 60px;
  }

  #setaEsqBlog:hover > div:nth-child(2) {
    opacity: 0;
    left: 30px;
  }
}

#setaEsqBlog {
  z-index: 1;
  position: absolute;
  left: -50px;
  top: calc(50% - 50px);
  width: 100px;
  height: 100px;
  background-color: hsla(207, 44%, 19%, 0.3);
  border-radius: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}
#setaEsqBlog > div:nth-child(1) {
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
#setaEsqBlog > div:nth-child(2) {
  position: absolute;
  top: 47px;
  left: 60px;
  width: 40px;
  height: 2px;
  opacity: 0;
  background-color: #fff;
  transition: all 0.5s ease;
}
</style>