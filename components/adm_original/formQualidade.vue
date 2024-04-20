<template>
  <div
    class="flex max-h-screen flex-row space-x-3 overflow-x-auto overflow-y-hidden p-6"
  >
    <div
      COLUNA="1"
      class="h-screen min-w-[500px] max-w-[500px] overflow-y-auto border-r-2 p-6"
    >
      <div class="p-4 text-center text-3xl">Politica de Qualidade</div>
      <div>
        <form
          @submit.prevent="formRequestQualidade"
          method="post"
          class="felx felx-col space-y-3"
          v-if="editorA"
        >
          <div>
            <p class="py-4">Texto Português</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorQualidadePT'"
                :existingContent="editorContentTexto"
                @contentChanged="_onChangeTextoBR"
              />
            </div>
          </div>
          <div>
            <p class="py-4">Texto Inglês</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorQualidadeEN'"
                :existingContent="editorContentTexto_en"
                @contentChanged="_onChangeTextoEN"
              />
            </div>
          </div>
          <div>
            <p class="py-4">Texto Espanhol</p>
            <div
              class="h-[350px] overflow-clip overflow-y-auto rounded-lg border-2 border-slate-500 p-4"
            >
              <Editor
                :resetEditor="resetEditor"
                :idContainer="'editorQualidadeES'"
                :existingContent="editorContentTexto_es"
                @contentChanged="_onChangeTextoES"
              />
            </div>
          </div>
          <div>
            <input
              type="file"
              accept="application/pdf,application/vnd.ms-excel"
              id="arqQualidade"
            />
          </div>

          <div class="flex flex-row justify-between">
            <x-button color="#000" light type="submit"> Salvar </x-button>
            <x-button color="#000" light @click="cancelaEdiQualidade"
              >Cancelar</x-button
            >
          </div>
        </form>
      </div>
    </div>
    <div CLUNA="2" class="w-[1100px] overflow-hidden overflow-y-auto">
      <div class="flex h-screen flex-col">
        <div
          v-if="Object.keys(Qualidade).length > 0"
          class="flex h-full flex-col"
        >
          <div
            @click="editaQualidade()"
            class="grid cursor-pointer grid-cols-3 p-6 hover:bg-yellow-100"
          >
            <div class="border-r-2">
              <p>EM PORTUGUÊS</p>
              <div>
                <p v-for="i in Qualidade[0].texto.blocks" :key="i" class="py-2">
                  {{ i.data.text }}
                </p>
              </div>
            </div>
            <div class="border-r-2">
              <p>EM INGLÊS</p>
              <div>
                <p
                  v-for="i in Qualidade[0].texto_en.blocks"
                  :key="i"
                  class="py-2"
                >
                  {{ i.data.text }}
                </p>
              </div>
            </div>
            <div class="border-r-2">
              <p>EM ESPANHOL</p>
              <div>
                <p
                  v-for="i in Qualidade[0].texto_es.blocks"
                  :key="i"
                  class="py-2"
                >
                  {{ i.data.text }}
                </p>
              </div>
            </div>
          </div>

          <div class="flex flex-row gap-x-3 pt-4">
            <div class="p-3 hover:bg-slate-500">
              <a target="_blank" :href="pathQualidade + Qualidade[0].arquivo">
                <div class="text-xl">Download</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>









<script setup>
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea;
}

const editorA = ref(true);
const pathQualidade = "\\media\\qualidade\\";

/// editor
let resetEditor = "";
let editorContentTexto = ref({});
let editorContentTexto_en = ref({});
let editorContentTexto_es = ref({});

function _onChangeTextoBR(data) {
  QualidadeForm.value.texto = JSON.stringify(data);
  editorContentTexto.value = data;
}
function _onChangeTextoEN(data) {
  QualidadeForm.value.texto_en = JSON.stringify(data);
  editorContentTexto_en.value = data;
}
function _onChangeTextoES(data) {
  QualidadeForm.value.texto_es = JSON.stringify(data);
  editorContentTexto_es.value = data;
}

async function formRequestQualidade() {
  apendFileQualidade();
  return await $fetch("/api/formQualidade.php", {
    mode: "cors",
    headers: {
      boundary: "---------------------------97476729985249432331610575",
    },
    method: "POST",
    body: formQualidade,
  }).then((R) => {
    let r = JSON.parse(R);
    getQualidade();
    alert(r.msg);
  });
}

onBeforeMount(() => {});

onMounted(() => {
  getQualidade();
});
let Qualidade = ref([]);

async function getQualidade() {
  let R = await $fetch("/api/formQualidade.php", {
    method: "GET",
  }).then((R) => {
    let r = JSON.parse(R);
    if (r.codigo == 0) {
      Qualidade.value = r.dados;

      Qualidade.value.map((g, index) => {
        Qualidade.value[index].texto = JSON.parse(g.texto);
        Qualidade.value[index].texto_en = JSON.parse(g.texto_en);
        Qualidade.value[index].texto_es = JSON.parse(g.texto_es);
      });
    } else {
    }
  });
}

function editaQualidade() {
  cancelaEdiQualidade();
  editorA.value = false;
  QualidadeForm.value.emEdicao = true;
  QualidadeForm.value.id = Qualidade.value[0].id;
  _onChangeTextoBR(Qualidade.value[0].texto);
  _onChangeTextoEN(Qualidade.value[0].texto_en);
  _onChangeTextoES(Qualidade.value[0].texto_es);
  setTimeout(() => {
    editorA.value = true;
  }, 300);
}
function cancelaEdiQualidade() {
  resetEditor = randonico(7);
  editorContentTexto.value = {};
  editorContentTexto_en.value = {};
  editorContentTexto_es.value = {};
  QualidadeForm.value = {
    emEdicao: false,
    texto: "",
    texto_en: "",
    texto_es: "",
    arquivo: "",
  };
  document.getElementById("arqQualidade").src = "";
  document.getElementById("arqQualidade").value = "";
}

let QualidadeForm = ref({
  emEdicao: false,
  texto: "",
  texto_en: "",
  texto_es: "",
  arquivo: "",
});

let formQualidade = new FormData();
function apendFileQualidade() {
  formQualidade = new FormData();
  let arq;
  let arqData;

  // IMAGEM BANNER BLOG
  arq = null;
  arq = document.getElementById("arqQualidade");
  if (arq.files[0]) {
    arqData = arq.files[0];
    formQualidade.append("0", arqData);
  }

  //ADD FORM JSON
  formQualidade.append("json", JSON.stringify(QualidadeForm.value));
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
</script>