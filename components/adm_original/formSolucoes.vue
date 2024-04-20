<template>
  <div class="flex h-screen w-[calc(100vw-20px)] flex-row">
    <div
      COLUNA="1"
      class="flex h-screen min-w-[500px] flex-col overflow-y-auto overflow-x-hidden border-r-2 p-6"
    >
      <div class="p-4 text-center text-3xl">SOLUÇÕES/PRODUTOS</div>
      <div class="w-[500px]">
        <x-tab-group v-model="tab" class="w-[90%] pb-10" variant="line" grow>
          <x-tab value="a" label="Cadastro">
            <div class="pt-6">
              <form @submit.prevent="formRequest">
                <div>
                  <x-input
                    v-model="solucoesForm.titulo"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>

                <div>
                  <x-select
                    v-model="solucoesForm.linha_id"
                    label="categoria"
                    :options="solucaoLinhasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>

                <div>
                  <x-input
                    v-model="solucoesForm.codigo"
                    label="Código:"
                    size="sm"
                    name="codigo"
                    block
                  />
                </div>
                <div class="flex flex-col space-y-3 py-3 text-black">
                  <div>
                    <span>Imagem 1 (255 x 331) :: Frente</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-1"
                        onchange="document.getElementById('imagem-1').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-1"
                        type="file"
                        accept="image/png, image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(1)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 2 (255 x 331) :: Lateral</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-2"
                        onchange="document.getElementById('imagem-2').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-2"
                        placeholder="imagem"
                        block
                        type="file"
                        accept="image/png, image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(2)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 3 (255 x 331) :: Outra</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-3"
                        onchange="document.getElementById('imagem-3').src =
                      window.URL.createObjectURL(this.files[0])"
                        name="imagem-3"
                        placeholder="imagem"
                        block
                        type="file"
                        accept="image/png,
                      image/jpeg"
                      />
                      />
                      <p
                        @click="resetProdFORM(3)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Video destaque</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="videoTag"
                        onchange="document.getElementById('video').src = window.URL.createObjectURL(this.files[0])"
                        type="file"
                        name="video_destaque"
                        placeholder="video"
                        block
                        accept="video/*.mp4"
                      />
                      <p
                        @click="resetProdFORM(4)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao"
                    label="Descrição:"
                    name="descricao"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao_en"
                    label="Descrição EN:"
                    name="descricaoEN"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="solucoesForm.descricao_es"
                    label="Descrição ES:"
                    name="descricaoES"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div class="flex justify-end p-2 pt-3">
                  <x-toggle
                    v-model="solucoesForm.destaque"
                    size="xl"
                    :label="
                      solucoesForm.destaque ? 'EM DESTAQUE' : 'NÃO DESTAQUE'
                    "
                  />
                </div>

                <div
                  id="submitButtonAddSoluID"
                  class="flex flex-row justify-between p-10"
                >
                  <input type="submit" value="Salvar" class="cursor-pointer" />
                  <p class="cursor-pointer" @click="resetProdFORM(5)">
                    Cancelar
                  </p>
                </div>
              </form>
            </div>
          </x-tab>
          <x-tab value="b" label="Pesquisa">
            <div v-if="produtoEmEdicao.emEdicao == false" class="py-10">
              <div class="flex flex-col space-y-3 px-10">
                <div>
                  <x-input
                    @keyup.enter.exact.stop.prevent="getSolucoes()"
                    v-model="querySolucoes.q"
                    label="Por titulo:"
                    size="sm"
                    name="titulo"
                    placeholder="+ de 3 Caracteres"
                    block
                  />
                </div>
                <div>
                  <x-input
                    @keyup.enter.exact.stop.prevent="getSolucoes()"
                    v-model="querySolucoes.c"
                    label="Por código:"
                    size="sm"
                    name="Codigo"
                    block
                  />
                </div>
              </div>
              <div controles="" class="p-10">
                <x-button @click="getSolucoes()"> Pesquisar</x-button>
              </div>
            </div>

            <!-- EDICAO PRODUTO -->
            <div v-if="produtoEmEdicao.emEdicao == true" class="pt-6">
              <form @submit.prevent="formRequestEdita">
                <div>
                  <x-input
                    v-model="produtoEmEdicao.titulo"
                    label="Título:"
                    size="sm"
                    name="titulo"
                    block
                  />
                </div>

                <div>
                  <x-select
                    v-model="produtoEmEdicao.linha_id"
                    label="categoria"
                    :options="solucaoLinhasOPT"
                    placeholder="categoria"
                    class="w-full"
                  />
                </div>

                <div>
                  <x-input
                    v-model="produtoEmEdicao.codigo"
                    label="Código:"
                    size="sm"
                    name="codigo"
                    block
                  />
                </div>
                <div class="flex flex-col space-y-3 py-3 text-black">
                  <div>
                    <span>Imagem 1 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-1b"
                        :src="pathSolucoes + produtoEmEdicao.img_1"
                        onchange="document.getElementById('imagem-1b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-1"
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
                    <span>Imagem 2 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-2b"
                        onchange="document.getElementById('imagem-2b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-2"
                        placeholder="imagem"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMEdita(2)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Imagem 3 (255 x 331)</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="imagemTag-3b"
                        onchange="document.getElementById('imagem-3b').src = window.URL.createObjectURL(this.files[0])"
                        name="imagem-3"
                        placeholder="imagem"
                        block
                        type="file"
                      />
                      <p
                        @click="resetProdFORMEdita(3)"
                        class="cursor-pointer text-3xl hover:text-red-400"
                      >
                        X
                      </p>
                    </div>
                  </div>
                  <div>
                    <span>Video MP4</span>
                    <div
                      class="flex flex-row items-center justify-between space-x-2"
                    >
                      <input
                        id="videoTag-1b"
                        onchange="document.getElementById('video-1b').src = window.URL.createObjectURL(this.files[0])"
                        type="file"
                        name="video-1"
                        placeholder="video"
                        block
                      />
                      <!-- <p @click="resetProdFORMEdita(3)" class="text-3xl cursor-pointer hover:text-red-400">X</p> -->
                    </div>
                  </div>
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao"
                    label="Descrição:"
                    name="descricao"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao_en"
                    label="Descrição EN:"
                    name="descricaoEN"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div>
                  <x-textarea
                    v-model="produtoEmEdicao.descricao_es"
                    label="Descrição ES:"
                    name="descricaoES"
                    :adjust-to-text="false"
                    rows="4"
                    style="display: block !important"
                  />
                </div>
                <div class="flex justify-end p-2 pt-3">
                  <x-toggle
                    v-model="produtoEmEdicao.destaque"
                    size="xl"
                    :label="produtoEmEdicao.destaque ? 'ATIVADO' : 'DESATIVADO'"
                  />
                </div>
                <div
                  id="submitButtonEditaSoluID"
                  class="flex flex-row justify-between p-10"
                >
                  <input
                    type="submit"
                    value="Atualizar"
                    class="cursor-pointer"
                  />
                  <p class="cursor-pointer" @click="resetProdFORMEdita(4)">
                    Cancelar
                  </p>
                </div>
              </form>
            </div>
          </x-tab>
        </x-tab-group>
      </div>
    </div>

    <!-- TAB A -->
    <div
      v-if="tab == 'a'"
      COLUNA="2"
      class="flex w-full flex-row items-center justify-center overflow-auto"
    >
      <div class="container flex shrink-0 flex-row space-x-2 overflow-auto">
        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-1" class="object-fill" />
          </div>
        </div>

        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-2" class="object-fill" />
          </div>
        </div>

        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <img id="imagem-3" class="object-fill" />
          </div>
        </div>
        <div>
          <div
            class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
          >
            <video
              id="video"
              muted
              playsinline
              loop
              autoplay
              class="object-fill"
            ></video>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB B -->
    <div v-if="tab == 'b'">
      <div class="h-screen overflow-auto">
        <!-- LINHA DE IMAGENS ATUAIS -->
        <div class="container mx-auto flex flex-row flex-wrap pt-6">
          <div
            v-for="(p, index) in produtoDetalhe"
            :key="index"
            class="relative flex justify-center"
            @click="editaSolucao(p)"
          >
            <div class="absolute left-2 top-2 z-[99999]">
              <x-popover align="left">
                <x-button>COD: {{ p.codigo }}</x-button>
                <template #content>
                  <x-popover-container class="w-80 p-3">
                    {{ p.descricao }}
                  </x-popover-container>
                </template>
              </x-popover>
            </div>
            <div class="flex flex-col lg:space-y-3">
              <div class="h-[640px] w-full lg:w-[460px]">
                <div
                  class="slides h-[640px] w-full space-x-1 border-[2px] border-[#c3d3cb] lg:w-[460px]"
                >
                  <div
                    class="slide first flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + p.img_1"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + p.img_2"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <img
                      :src="pathSolucoes + p.img_3"
                      alt=""
                      width=""
                      height=""
                      class="object-fill"
                    />
                  </div>
                  <div
                    class="slide flex h-[640px] w-full flex-row items-center justify-center bg-[#004425] lg:w-[460px]"
                  >
                    <video
                      :src="pathSolucoes + p.video_destaque"
                      muted
                      playsinline
                      loop
                      autoplay
                      name="video_destaque"
                    ></video>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- LINHA DE IMAGENS ATUALIZADAS -->
        <div
          v-if="produtoEmEdicao.emEdicao == true"
          class="container mx-auto flex flex-row pt-6"
        >
          <div class="flex w-[90%] shrink-0 flex-row space-x-2 overflow-auto">
            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-1b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-2b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <img id="imagem-3b" class="object-fill" />
              </div>
            </div>

            <div>
              <div
                class="flex h-[640px] w-full flex-row items-center justify-center overflow-hidden bg-[#004425] lg:w-[460px]"
              >
                <video
                  id="video-1b"
                  muted
                  playsinline
                  loop
                  autoplay
                  class="object-fill"
                ></video>
              </div>
            </div>
          </div>
        </div>
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
  XPopover,
} from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, XSelect, XTab, XTabGroup, XPopover;
}

const pathSolucoes = "\\media\\solucoes\\";
let querySolucoes = ref({
  q: "",
  offset: 0,
  qpag: 30,
  c: "",
});
let produtoDetalhe = ref({});
let produtoEmEdicao = ref({
  emEdicao: false,
});

onMounted(() => {
  getLinhas();
});

let tab = ref("b");

function editaSolucao(produto) {
  console.log(produto);
  if (produto.destaque == 0) {
    produto.destaque = false;
  } else {
    produto.destaque = true;
  }

  produtoEmEdicao.value = produto;
  produtoEmEdicao.value.emEdicao = true;
  produtoDetalhe.value = [];
  produtoDetalhe.value.push(produto);
}
async function getSolucoes() {
  let Qlen = querySolucoes.value.q.length;
  let Cod = querySolucoes.value.c.length;
  if (Qlen >= 3 || Cod > 0) {
    let R = await $fetch(
      "/api/formSolucoes.php",

      {
        method: "GET",
        params: querySolucoes.value,
      }
    ).then((R) => {
      if (JSON.parse(R).length > 0) {
        produtoDetalhe.value = JSON.parse(R);
      } else {
        produtoDetalhe.value = [];
        alert("Sem resultados pra pesquisa !");
      }
    });
  }
}

async function getLinhas() {
  let L = await $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
  }).then((L) => {
    let soluTMP = [];
    if (JSON.parse(L).length > 0) {
      let LI = JSON.parse(L);

      LI.forEach((L) => {
        soluTMP.push({ value: L.id, label: L.titulo });
      });
    } else {
      alert("Não há Linhas cadastrados !");
    }
    solucaoLinhasOPT.value = soluTMP;
  });
}
const solucaoLinhasOPT = ref([]);

let solucoesForm = ref({
  emEdicao: false,
  titulo: "",
  codigo: "",
  linha_id: null,
  descricao: "",
  descricao_en: "",
  destaque: false,
});

//EDITA PRODUTO

let formSoluImgsEdita = new FormData();
function apendFileEdit() {
  formSoluImgsEdita = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemTag-1b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("0", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-2b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("1", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-3b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("2", arqData);
  }
  arq = null;
  arq = document.getElementById("videoTag-1b");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgsEdita.append("3", arqData);
  }

  //ADD FORM JSON
  formSoluImgsEdita.append("json", JSON.stringify(produtoEmEdicao.value));
}
async function formRequestEdita() {
  apendFileEdit();
  document.getElementById("submitButtonEditaSoluID").disabled = "disabled";

  return await $fetch("/api/formSolucoes.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------974767299852498929531610575",
    },
    method: "POST",
    body: formSoluImgsEdita,
  }).then((R) => {
    alert(R);
    document.getElementById("submitButtonEditaSoluID").disabled = "false";
    resetProdFORMEdita(4);
  });
}
//FIM EDITA PRODUTO

// ADD PRODUTO
let formSoluImgs = new FormData();
function apendFile() {
  let arq;
  let arqData;
  formSoluImgs = new FormData();

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("imagemTag-1");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("0", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-2");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("1", arqData);
  }
  arq = null;
  arq = document.getElementById("imagemTag-3");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("2", arqData);
  }
  arq = null;
  arq = document.getElementById("videoTag");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formSoluImgs.append("3", arqData);
  }

  //ADD FORM JSON
  formSoluImgs.append("json", JSON.stringify(solucoesForm.value));
}
function resetProdFORM(input) {
  if (input) {
    switch (input) {
      case 1:
        document.getElementById("imagem-1").src = "";
        document.getElementById("imagemTag-1").value = "";
        break;
      case 2:
        document.getElementById("imagem-2").src = "";
        document.getElementById("imagemTag-2").value = "";
        break;
      case 3:
        document.getElementById("imagem-3").src = "";
        document.getElementById("imagemTag-3").value = "";
        break;
      case 4:
        document.getElementById("video").src = "";
        document.getElementById("videoTag").value = "";
        break;
      case 5:
        solucoesForm.value = {
          emEdicao: false,
          linha_id: null,
          titulo: "",
          codigo: "",
          descricao: "",
          descricao_en: "",
          descricao_es: "",
          destaque: false,
        };
        document.getElementById("imagem-1").src = "";
        document.getElementById("imagemTag-1").value = "";

        document.getElementById("imagem-2").src = "";
        document.getElementById("imagemTag-2").value = "";

        document.getElementById("imagem-3").src = "";
        document.getElementById("imagemTag-3").value = "";

        document.getElementById("video").src = "";
        document.getElementById("videoTag").value = "";
        break;

      default:
        break;
    }
  }
}

function resetProdFORMEdita(input) {
  if (input) {
    switch (input) {
      case 1:
        document.getElementById("imagem-1b").src = "";
        document.getElementById("imagemTag-1b").value = "";
        break;
      case 2:
        document.getElementById("imagem-2b").src = "";
        document.getElementById("imagemTag-2b").value = "";
        break;
      case 3:
        document.getElementById("imagem-3b").src = "";
        document.getElementById("imagemTag-3b").value = "";
        break;
      case 4:
        // BOTÃO CANCELAR
        produtoEmEdicao.value = {
          emEdicao: false,
          linha_id: null,
          titulo: "",
          codigo: "",
          descricao: "",
          descricaoEN: "",
          descricaoES: "",
        };
        document.getElementById("imagem-1b").src = "";
        document.getElementById("imagemTag-1b").value = "";

        document.getElementById("imagem-2b").src = "";
        document.getElementById("imagemTag-2b").value = "";

        document.getElementById("imagem-3b").src = "";
        document.getElementById("imagemTag-3b").value = "";

        document.getElementById("imagemTag-1b").src = "";
        document.getElementById("imagem-1b").value = "";

        getSolucoes();
        break;

      default:
        break;
    }
  }
}
async function formRequest() {
  apendFile();
  document.getElementById("submitButtonAddSoluID").disabled = "disabled";
  return await $fetch("/api/formSolucoes.php", {
    mode: "cors",
    headers: {
      boundary:
        "---------------------------" +
        Math.floor(Math.random() * 16).toString(16),
    },
    method: "POST",
    body: formSoluImgs,
  }).then((R) => {
    alert(R);
    document.getElementById("submitButtonAddSoluID").disabled = "false";
    resetProdFORM(5);
  });
}
</script>

<style scoped>
.slides {
  display: flex;
  --overflow-x: hidden;
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
  background-color: #74df43 !important;
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
  background-color: #74df43;
}
</style>