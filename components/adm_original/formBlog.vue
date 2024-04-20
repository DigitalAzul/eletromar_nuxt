<template>
  <div>
    <div
      class="flex max-h-screen flex-row space-x-3 overflow-x-auto overflow-y-hidden p-6"
    >
      <div
        COLUNA="1"
        class="h-screen w-[350px] overflow-y-auto border-r-2 px-3"
      >
        <div v-if="formBlog.emEdicao == false" class="p-4 text-center text-3xl">
          BLOG
        </div>
        <div
          v-else
          class="animate-pulse bg-yellow-300 p-4 text-center text-3xl"
        >
          EM EDIÇÃO
        </div>

        <x-tab-group v-model="tab" class="pb-10" grow variant="line">
          <x-tab value="a" label="Cadastro">
            <div>
              <form
                id="formBlogID"
                @submit.prevent="formRequest"
                enctype="multipart/form-data"
                XXboundary="---------------------------974767299852498929531610575"
                XXaction="https://localhost/mec/formBlog.php"
                XXXmethod="post"
                class="flex flex-col"
              >
                <div>
                  <x-select
                    size="sm"
                    v-model="formBlog.blog_posts_id"
                    label="Autor"
                    :options="autoresOPT"
                    placeholder="Autor"
                    class="w-full py-4"
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo"
                    label="Titulo"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo_en"
                    label="Titulo EN:"
                    size="sm"
                    name="tituloEN"
                    block
                  />
                </div>
                <div>
                  <x-input
                    v-model="formBlog.titulo_es"
                    label="Titulo ES:"
                    size="sm"
                    name="tituloES"
                    block
                  />
                </div>

                <div class="flex flex-col space-y-3 py-3 text-black">
                  <span>Imagem Banner 1</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="
                        document.getElementById('c2-banner-1').src =
                          window.URL.createObjectURL(this.files[0])
                      "
                      id="banner-1"
                      name="banner-1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem Banner 2</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-banner-2').src = window.URL.createObjectURL(this.files[0])"
                      id="banner-2"
                      name="banner-2"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem Banner 3</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-banner-3').src = window.URL.createObjectURL(this.files[0])"
                      id="banner-3"
                      name="banner-3"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                </div>

                <div>
                  <x-input
                    v-model="formBlog.criado_em"
                    label="data:"
                    type="date"
                    name="data"
                    size="sm"
                    block
                  />
                </div>
                <p class="py-4">Texto Português</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorPT'"
                    :existingContent="editorContentBR"
                    @contentChanged="_onChangeBR"
                  />
                </div>

                <p class="py-4">Texto Inglês</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorEN'"
                    :existingContent="editorContentEN"
                    @contentChanged="_onChangeEN"
                  />
                </div>
                <p class="py-4">Texto Espanhol</p>
                <div
                  class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
                >
                  <Editor
                    :resetEditor="resetEditor"
                    :idContainer="'editorES'"
                    :existingContent="editorContentES"
                    @contentChanged="_onChangeES"
                  />
                </div>

                <div class="flex flex-col space-y-3 py-3 text-black">
                  <span>Imagem blog 1</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      id="arquivo-1"
                      onchange="document.getElementById('c2-textImg-1').src = window.URL.createObjectURL(this.files[0])"
                      label="imagemURL:"
                      name="imagemURL1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem blog 2</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      id="arquivo-2"
                      onchange="document.getElementById('c2-textImg-2').src = window.URL.createObjectURL(this.files[0])"
                      label="imagemURL:"
                      name="imagemURL2"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                  <span>Imagem Capa Blog</span>
                  <div
                    class="flex flex-row items-center justify-between space-x-2"
                  >
                    <input
                      onchange="document.getElementById('c2-capaTag-1').src = window.URL.createObjectURL(this.files[0])"
                      id="c2-capa-1"
                      name="banner-1"
                      placeholder="Placeholder"
                      block
                      type="file"
                    />
                    <p
                      @click="resetProdFORMEdita(1)"
                      class="cursor-pointer text-3xl hover:text-red-400"
                    >
                      X
                    </p>
                  </div>
                </div>

                <div class="flex flex-col space-y-3 text-black"></div>
                <div>
                  <x-select
                    v-model="formBlog.categoria_id"
                    label="categoria"
                    :options="categoriasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>
                <div class="mt-4">
                  <x-textarea
                    v-model="formBlog.tags"
                    label="Tags"
                    name="Tags"
                    :adjust-to-text="false"
                    rows="2"
                    class="w-full"
                    style="display: block !important; width: 100%"
                  />
                </div>
                <div class="flex w-[90%] flex-row justify-between pt-10">
                  <x-button color="#000" light type="submit"> Salvar </x-button>
                  <x-button @click="resetFormBlog()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
              </form>
            </div>
          </x-tab>
          <x-tab value="b" label="Pesquisa">
            <div id="editorjs"></div>
            <div class="w-[400px] px-4 pt-10">
              <form @submit.prevent="getPostsBlog">
                <div>
                  <x-input
                    v-model="queryPostBlog.q"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    class="w-4/5"
                  />
                </div>
                <div>
                  <x-input
                    v-model="queryPostBlog.autor"
                    label="Autor"
                    size="sm"
                    name="autor"
                    class="w-4/5"
                  />
                </div>
                <div class="flex w-[80%] flex-row justify-between pt-10">
                  <x-button color="#000" light type="submit">
                    Pesquisar
                  </x-button>
                  <x-button @click="resetFormPostBlogQuery()" color="#000" light
                    >Cancelar</x-button
                  >
                </div>
              </form>
            </div>
          </x-tab>
        </x-tab-group>
      </div>

      <!-- COLUNA A TAB A -->
      <div v-show="tab == 'a'" COLUNA="2" class="w-[1400px] overflow-x-auto">
        <div class="flex flex-row space-x-3">
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col space-y-2 overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Carroussel Blog</p>
            <img id="c2-banner-1" />
            <img id="c2-banner-2" />
            <img id="c2-banner-3" />
          </div>
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col space-y-2 overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Imagem dentro do Blog</p>
            <img id="c2-textImg-1" />
            <img id="c2-textImg-2" />
          </div>
          <div
            class="flex h-[calc(100vh-50px)] w-[500px] flex-col overflow-x-auto text-center"
          >
            <p class="font-semibold uppercase">Capa Blog</p>
            <img id="c2-capaTag-1" />
          </div>
        </div>
      </div>

      <div v-show="tab == 'b'" COLUMA="2TB" class="w-[1500px] overflow-x-auto">
        <!-- FOR DA PESQUISA -->
        <div class="flex flex-row flex-wrap gap-2">
          <div
            v-for="(b, index) in blogPosts"
            :key="index"
            class="relative h-[670px] w-[485px] cursor-pointer"
            @click="editaBlogPost(b)"
          >
            <div class="absolute left-2 top-2">
              <x-popover align="left">
                <x-button>ID: {{ b.id }}</x-button>
                <template #content> </template>
              </x-popover>
            </div>

            <span v-for="(img, indexM) in b.imagens" :key="indexM">
              <img
                v-if="img.tipo == 2"
                :src="pathBlogImagens + img.imagem_url"
              />
            </span>
            <p
              class="absolute bottom-10 w-full bg-black bg-opacity-25 p-4 text-center text-white"
            >
              {{ b.titulo }}
            </p>
          </div>
        </div>

        <!-- ESTE CODIGO SERA USADO NA HOME DO SITE /BLOG_DETALHES -->
        <div v-if="1 == 2">
          <div v-for="(b, index) in blogPosts" :key="index">
            <!-- CARROUSSEL DE IMAGENS -->

            <span v-for="(img, indexM) in b.imagens" :key="indexM">
              <img
                v-if="img.tipo == 1"
                :src="pathBlogImagens + img.imagem_url"
              />
            </span>

            <!-- DOIS PARAGRAFOS-->
            <div>
              <div>{{ b.titulo }}</div>
              <div class="uppercase">{{ b.data_br }}</div>
            </div>
            <div v-for="(bl, indexP) in b.descricao.blocks" :key="indexP">
              <div v-if="indexP < 2">
                <p class="p-6">
                  {{ bl.data.text }} <span class="text-3xl">{{ indexP }}</span>
                </p>
              </div>
            </div>

            <!-- DUAS IMAGENS -->
            <span v-for="(img, indexM) in b.imagens" :key="indexM">
              <img
                v-if="img.tipo == 0"
                :src="pathBlogImagens + img.imagem_url"
              />
            </span>

            <div v-for="(bl, indexP2) in b.descricao.blocks" :key="indexP2">
              <div v-if="indexP2 > 1">
                <p class="p-6">
                  {{ bl.data.text }} <span class="text-3xl">{{ indexP2 }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- ESTE CODIGO SERA USADO NA HOME DO SITE /BLOG_DETALHES -->
      </div>
    </div>
  </div>
</template>


<script setup>
import {
  createUI,
  XButton,
  XAlert,
  XTextarea,
  XSelect,
  XTab,
  XTabGroup,
  XTable,
  XPopover,
} from "@indielayer/ui";
import Editor from "~/components/Editor.vue";

components: {
  createUI,
    XButton,
    XAlert,
    XTextarea,
    XSelect,
    Editor,
    XTab,
    XTabGroup,
    XTable,
    XPopover;
}
const tab = ref("a");

let editorContentBR = {};
let editorContentEN = {};
let editorContentES = {};

function _onChangeBR(data) {
  formBlog.value.descricao = JSON.stringify(data);
  editorContentBR = data;
}
function _onChangeEN(data) {
  formBlog.value.descricao_en = JSON.stringify(data);
  editorContentEN = data;
}
function _onChangeES(data) {
  formBlog.value.descricao_es = JSON.stringify(data);
  editorContentES = data;
}

if (process.client) {
}

const tagsOPT = ref([
  { value: "Marketing", label: "Marketing" },
  { value: "Operacional", label: "Operacional" },
]);
const categoriasOPT = ref([
  { value: "1", label: "Marketing" },
  { value: "2", label: "Operacional" },
]);
//" + Math.random().toString().substr(2)"
let novaTag = ref("");
let file = ref(null);

let formBlog = ref({
  emEdicao: false,
  titulo: "",
  titulo_en: "",
  titulo_es: " ",
  criado_em: new Date().toISOString().substring(0, 10),
  descricao: "",
  descricao_en: "",
  descricao_es: "",
  categoria_id: "1",
  blog_autor_id: 1,
  tags: "",
});
let arrayImgExcluir = ref([]);
let formBlogImgs = new FormData();
function apendFile(n) {
  let arq;
  let arqData;
  formBlogImgs = new FormData();
  arrayImgExcluir.value = [];

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("banner-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("0", arqData);

    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[0])
      arrayImgExcluir.value.push(formBlog.value.imagens[0].imagem_url);
  }
  arq = null;
  arq = document.getElementById("banner-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("1", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[1]) {
      try {
        arrayImgExcluir.value.push(formBlog.value.imagens[1].imagem_url);
      } catch (error) {}
    }
  }
  arq = null;
  arq = document.getElementById("banner-3");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("2", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[2]) {
      try {
        arrayImgExcluir.value.push(formBlog.value.imagens[2].imagem_url);
      } catch (error) {}
    }
  }

  // ***** IMAGEM BLOG
  arq = document.getElementById("arquivo-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("3", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[3])
      arrayImgExcluir.value.push(formBlog.value.imagens[3].imagem_url);
  }
  arq = null;
  arq = document.getElementById("arquivo-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("4", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[4])
      arrayImgExcluir.value.push(formBlog.value.imagens[4].imagem_url);
  }

  arq = null;
  arq = document.getElementById("c2-capa-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formBlogImgs.append("5", arqData);
    // IMAGEM PARA EXLUIR, FOI ATUALIZA
    if (formBlog.value.emEdicao == true && formBlog.value.imagens[5])
      arrayImgExcluir.value.push(formBlog.value.imagens[5].imagem_url);
  }

  if (formBlog.value.emEdicao == true) {
    formBlog.value.imgParaExcluir = arrayImgExcluir.value;
    arrayImgExcluir.value = [];
  }

  //ADD FORM JSON

  formBlogImgs.append("json", JSON.stringify(formBlog.value));
}

async function addInfos() {
  await $fetch("https://localhost/mec/", {
    method: "POST",
    body: JSON.stringify(formBlog),
  });
}

///////
function formSubmit() {
  formRequest()
    .then((result) => {
      console.log(result);
    })
    .catch((error) => {
      console.error("Contact form could not be send", error);
    });
}

/// get posts
onMounted(() => {
  getPostsBlog();
  getAutorBlog();
});

let blogPosts = ref([]);

let queryPostBlog = ref({
  q: "",
  offset: 0,
  qpag: 30,
});

function editaBlogPost(blog) {
  formBlog.value = blog;
  formBlog.value.emEdicao = true;

  _onChangeBR(JSON.parse(blog.descricao));
  _onChangeEN(JSON.parse(blog.descricao_en));
  _onChangeES(JSON.parse(blog.descricao_es));

  document.getElementById("c2-banner-1").src = formBlog.value.imagens[0]
    ? pathBlogImagens + formBlog.value.imagens[0].imagem_url
    : null;
  document.getElementById("c2-banner-2").src = formBlog.value.imagens[1]
    ? pathBlogImagens + formBlog.value.imagens[1].imagem_url
    : null;
  document.getElementById("c2-banner-3").src = formBlog.value.imagens[2]
    ? pathBlogImagens + formBlog.value.imagens[2].imagem_url
    : null;
  document.getElementById("c2-textImg-1").src = formBlog.value.imagens[3]
    ? pathBlogImagens + formBlog.value.imagens[3].imagem_url
    : null;
  document.getElementById("c2-textImg-2").src = formBlog.value.imagens[4]
    ? pathBlogImagens + formBlog.value.imagens[4].imagem_url
    : null;
  document.getElementById("c2-capaTag-1").src = formBlog.value.imagens[5]
    ? pathBlogImagens + formBlog.value.imagens[5].imagem_url
    : null;

  // vai para o form
  tab.value = "a";
}

function resetFormPostBlogQuery() {
  queryPostBlog.value = {
    q: "",
    offset: 0,
    qpag: 10,
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
        blogPosts.value = RS.dados;
        blocksToArray();
      } else {
        blogPosts.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}

const blogPostsAutor = ref([]);
const autoresOPT = ref([]);
async function getAutorBlog() {
  resetFormPostBlogQuery();
  queryPostBlog.value.q = "todos";
  let R = await $fetch("/api/formBlogAutor.php?todos", {
    method: "GET",
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      if (RS.dados.length > 0) {
        blogPostsAutor.value = RS.dados;

        blogPostsAutor.value.map((a) => {
          autoresOPT.value.push({ value: a.id, label: a.nome });
        });
      } else {
        blogPostsAutor.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    }
  });
}
const pathBlogImagens = "\\media\\blog\\";
function blocksToArray() {
  blogPosts.value.map((b, index) => {
    blogPosts.value[index].descricao = b.descricao;
    blogPosts.value[index].descricao_en = b.descricao_en;
    blogPosts.value[index].descricao_es = b.descricao_es;
  });
}

let resetEditor = "";
function resetFormBlog() {
  editorContentBR = {};
  editorContentEN = {};
  editorContentES = {};
  resetEditor = randonico(7);
  formBlog.value = {
    emEdicao: false,
    titulo: "",
    titulo_en: "",
    titulo_es: "",
    data: new Date().toISOString().substring(0, 10),
    descricao: "",
    descricao_en: "",
    descricao_es: "",
    categoria_id: "1",
    blog_autor_id: 1,
    tags: "",
  };
  formBlogImgs.delete("0");
  formBlogImgs.delete("1");
  formBlogImgs.delete("2");
  formBlogImgs.delete("3");
  formBlogImgs.delete("4");
  formBlogImgs.delete("5");
  formBlogImgs.delete("json");
  document.getElementById("banner-1").value = "";
  document.getElementById("banner-2").value = "";
  document.getElementById("banner-3").value = "";

  document.getElementById("arquivo-1").value = "";
  document.getElementById("arquivo-2").value = "";
  document.getElementById("c2-capa-1").value = "";

  document.getElementById("c2-banner-1").src = "";
  document.getElementById("c2-banner-2").src = "";
  document.getElementById("c2-banner-3").src = "";

  document.getElementById("c2-textImg-1").src = "";
  document.getElementById("c2-textImg-2").src = "";

  document.getElementById("c2-capaTag-1").src = "";
}

//"Content-Type": "multipart/form-data",
async function formRequest() {
  apendFile();
  let R = await $fetch("/api/formBlog.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formBlogImgs,
  }).then((R) => {
    let RS = JSON.parse(R);
    if (RS.codigo == 0) {
      alert(RS.msg);
      resetFormBlog();
    } else {
      alert(RS.msg);
    }
  });
}

function randonico(length) {
  let result = "";
  const characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
//////
</script>