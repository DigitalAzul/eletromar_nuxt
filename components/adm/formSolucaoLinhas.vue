<template>
  <div class="flex h-screen w-[calc(100vw-180px)] flex-row">
    <div
      COLUNA="1"
      class="flex h-screen w-[500px] flex-col overflow-auto border-r border-slate-300 p-6"
    >
      <div class="p-4 text-center text-3xl">LINHAS</div>
      <form
        @submit.prevent="formRequestLinhaAdd()"
        class="flex flex-col space-y-3"
      >
      <div class="pt-3">
          <x-input
            v-model="solucaoLinhasFORM.ordem"
            label="Ordem:"
            size="sm"
            name="Ordem"
            placeholder="Ordem"
            block
          />
        </div>
        <div class="pt-3">
          <x-input
            v-model="solucaoLinhasFORM.titulo"
            label="Titulo:"
            size="sm"
            name="titulo"
            placeholder="Titulo"
            block
          />
        </div>
        <div class="pt-3">
          <x-input
            v-model="solucaoLinhasFORM.link"
            label="Link:"
            size="sm"
            name="titulo"
            placeholder="Link"
            block
          />
        </div>
        <div class="pt-3">
          <x-textarea
            v-model="solucaoLinhasFORM.descricao"
            label="Descrição:"
            name="descricao"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div class="pt-3">
          <x-textarea
            v-model="solucaoLinhasFORM.descricao_en"
            label="Descrição EN:"
            name="descricao"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div class="pt-3">
          <x-textarea
            v-model="solucaoLinhasFORM.descricao_es"
            label="Descrição ES:"
            name="descricao"
            :adjust-to-text="false"
            rows="4"
            style="display: block !important"
          />
        </div>
        <div class="pb-6">
          <x-select
            v-model="solucaoLinhasFORM.ativo"
            label="Ativo"
            :options="SN_OPT"
            placeholder="ativo"
            class="w-full"
          />
        </div>
        <div class="rounded-xl bg-slate-500 p-4">
          <span class="">Video da linha</span>
          <div class="flex flex-row items-center justify-between space-x-2 p-2">
            <input
              id="form_video_destaque-input"
              onchange="document.getElementById('form_video_destaque-tag').src = window.URL.createObjectURL(this.files[0])"
              placeholder="imagem"
              block
              type="file"
            />
            <p
              @click="resetLinhaFORM()"
              class="cursor-pointer text-3xl hover:text-red-400"
            >
              X
            </p>
          </div>

          <div class="flex items-center justify-center bg-white p-3 py-4">
            <div>
              <video
                id="form_video_destaque-tag"
                src=""
                muted
                controls
                name="video_destaque"
              ></video>
            </div>
          </div>
        </div>
        <div class="flex w-full flex-row justify-between space-x-6 pt-10">
          <div class="">
            <x-button color="#000" light type="submit"> Salvar </x-button>
            <x-button @click="resetLinhaFORM()" color="#000" light
            >Cancelar</x-button
          >
        </div>
          
          <div class="">          
            <x-button color="#ff0000" light @click="deleteLinha(solucaoLinhasFORM)"> Excluir </x-button>
          </div>
        </div>
      </form>
    </div>
    <div
      COLUNA="2"
      class="flex h-screen w-[1000px] flex-col overflow-auto border-r border-slate-300 p-6"
    >
      <div>
        <div
          @click="getLinhas"
          class="flex cursor-pointer flex-col items-center justify-center pb-6"
        >
          <ph-arrow-counter-clockwise :size="32" />
          <div>Recarregar</div>
        </div>
      </div>
      <div class="flex flex-col space-y-3">
        <div
          class="cursor-pointer rounded-xl border border-slate-300 bg-white p-4 shadow-lg hover:bg-yellow-200"
          :class="{ 'bg-yellow-400': linha.emEdicao == true }"
          v-for="(linha, index) in solucaoLinhas"
          :key="index"
          @click="editLinha(linha)"
        >
          <div class="flex flex-row space-x-2">
            <div class="w-1/2 space-y-3">
              <div>
                <p class="text-2xl font-semibold">{{ linha.titulo }}</p>
                <span class="font-light">Nome linha</span>
              </div>
              <div>
                <span class="font-semibold">Link</span>
                <p>{{ linha.link }}</p>
              </div>
              <div>
                <span class="break-words font-semibold">Descrição</span>
                <p>{{ linha.descricao }}</p>
              </div>
              <div>
                <span class="break-words font-semibold">Descrição EN</span>
                <p>{{ linha.descricao_en }}</p>
              </div>
              <div>
                <span class="break-words font-semibold">Descrição ES</span>
                <p>{{ linha.descricao_es }}</p>
              </div>
              <div class="flex flex-row justify-between items-center">
                <div>
                  <span class="break-words font-semibold">Ativo</span>
                  <div
                    v-if="linha.ativo == '1'"
                    class="flex flex-row items-center justify-start space-x-3"
                  >
                    <div class="h-4 w-4 rounded-full bg-lime-400"></div>
                    <div>SIM</div>
                  </div>
                  <div
                    v-else
                    class="flex flex-row items-center justify-start space-x-3"
                  >
                    <div class="h-4 w-4 rounded-full bg-red-400"></div>
                    <div>NÂO</div>
                  </div>
                </div>
                <div>
                  <span class="break-words font-semibold">Ordem</span>
                  <p>{{linha.ordem  }}</p>
                </div>
              </div>

            </div>
            <div class="m-2 h-fit w-1/2 rounded-xl border border-slate-300 p-2">
              <div>
                <video
                  :src="
                    pathSolucoes + '\linhas_destaque\\' + linha.link + '.mp4'
                  "
                  muted
                  controls
                  name="video_destaque"
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
import { PhArrowCounterClockwise } from "phosphor-vue";
import { createUI, XButton, XAlert, XTextarea } from "@indielayer/ui";
components: {
  createUI, XButton, XAlert, XTextarea, PhArrowCounterClockwise;
}

const SN_OPT = ref([
  { value: "1", label: "SIM" },
  { value: "0", label: "NÃO" },
]);

const pathSolucoes = "\\media\\solucoes\\";
onMounted(() => {
  getLinhas();
});
let solucaoLinhas = ref([]);
let solucaoLinhasFORM = ref({
  id: "",
  titulo: "",
  link: "",
  descricao: "",
  descricao_en: "",
  descricao_es: "",
  ativo: 1,
  emEdicao: false,
  ordem: 0
});

function resetLinhaFORM() {
  solucaoLinhasFORM.value = {
    titulo: "",
    link: "",
    descricao: "",
    descricao_en: "",
    descricao_es: "",
    emEdicao: false,
    ordem: 0
  };
  document.getElementById("form_video_destaque-tag").src = "";
  document.getElementById("form_video_destaque-input").value = "";
}
let q = {
  ativo: "t", // s | n | t
};
async function getLinhas() {
  let L = await $fetch("/api/formSolucaoLinhas.php", {
    method: "GET",
    params: q,
  }).then((L) => {
    if (JSON.parse(L).length > 0) {
      solucaoLinhas.value = JSON.parse(L);
    } else {
      alert("Não há Linhas cadastrados !");
    }
  });
}
async function deleteLinha(linha) {

  const id = linha.id;


  let T = prompt(`Deseja excluir a linha? " ${linha.titulo} "\nIsso irá excluir todos os produtos associado a ela.\n\nFavor digite 'SIM' abaixo e em OK`)

  if (T.toLowerCase() != "sim") {
    return;
}

  let L = await $fetch(`/api/formSolucaoLinhas.php/?d=${id}`, {
    method: "DELETE",

  }).then((L) => {
  resetLinhaFORM()
  getLinhas()

  });
}

function editLinha(linha) {
  solucaoLinhasFORM.value = Object.assign({}, linha);
  solucaoLinhasFORM.value.emEdicao = true;
}

async function formRequestLinhaAdd() {
  //ADD FORM JSON
  let formLinha = new FormData();

  // IMAGEM BANNER BLOG
  let arq = null;
  arq = document.getElementById("form_video_destaque-input");
  if (arq.files[0]) {
    let arqData = arq.files[0];
    formLinha.append("0", arqData);
  }

  formLinha.append("json", JSON.stringify(solucaoLinhasFORM.value));

  const L = await $fetch("/api/formSolucaoLinhas.php", {
    mode: "cors",
    method: "POST",
    body: formLinha,
  });
  resetLinhaFORM()
  getLinhas();
  alert(L);
}

function salvarForm() {
  console.log(solucaoLinhas.value);
}
</script>
